<?php

namespace App\Http\Controllers\Front;

use App\Mail\AdminResetPassword;
use App\Mail\UserResetPassword;
use App\Models\EmailTemplate;
use App\Models\EmailTemplateData;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgetPassController extends Controller
{
    public function forgetPassword() {
        return view('front.user.forget_password');
    }

    public function forgetPasswordPost(Request $request) {
        //dd($request);
        $guard = 'web';
        $user = User::where('email', $request->email)->where('guard',$guard)->first();
        $emailTemplate = EmailTemplate::where('code', 'UserResetPassword')->first();
        $emailTemplateData = EmailTemplateData::leftJoin('email_templates_data_translations','email_templates_data_translations.email_template_data_id','email_templates_data.id')
            ->where('email_template_id', $emailTemplate->id)
            ->where('email_templates_data_translations.locale', \app()->getLocale())
            ->select('email_templates_data.id as id','email_templates_data.from_email as from_email','email_templates_data_translations.body as body','email_templates_data_translations.subject as subject')
            ->first();
        if(!empty($user)) {
            $token =app('auth.password.broker')->createToken($user);
            $data = DB::table('password_resets')->insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);

            Mail::to($user->email)->send(new UserResetPassword(['data' =>$user,'token'=> $token,'body' => $emailTemplateData->body,'subject' => $emailTemplateData->subject]));
            return redirect()->back()->with('success', _i('link Sent'));
        }
        return redirect()->back()->with('error', _i('Try Again'));
    }



    public function resetPassword($token) {
        $check_token = DB::table('password_resets')->where('token', $token)->where('created_at','>', Carbon::now()->subHours(2))->first();
        if(!empty($check_token)){
            return view('front.user.reset_password',compact('check_token'));
        }else{
            return redirect(url('forgetPassword'));
        }
    }

    public function resetPasswordPost(Request $request,$token){
        $this->validate($request,[
            'password' => 'required|confirmed',
            'password_confirmation'=>'required'
        ]);

        $csrf_token = DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();
        $user = User::where('email' , $csrf_token->email)->first();
        if(Hash::check($request->input('password'), $user->password)) {
            return redirect()->back()->with('error', 'Can\'t Accept This Password');
        }

        if(!empty($csrf_token)){
            $user = User::where('email' , $csrf_token->email)->update(['email'=> $csrf_token->email,'password'=> Hash::make($request->password)]);
            DB::table('password_resets')->where('email',$request->email)->delete();
            auth()->attempt(['email'=>$csrf_token->email,'password'=>$request->password], true);
            return redirect()->route('home');
        }else{
            return redirect(url('forgetPassword'));
        }
    }
}
