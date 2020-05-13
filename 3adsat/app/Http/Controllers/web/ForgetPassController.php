<?php

namespace App\Http\Controllers\web;

use App\Mail\AdminResetPassword;
use App\Mail\UserResetPassword;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ForgetPassController extends Controller
{
    public function forgetPassword() {
        return view('web.user.forget_password');
    }

    public function forgetPasswordPost(Request $request) {
        $guard = 'web';
        $user = User::where('email', $request->email)->where('guard',$guard)->first();
        if(!empty($user)) {
            $token =app('auth.password.broker')->createToken($user);
            $data = DB::table('password_resets')->insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);
            Mail::to($user->email)->send(new UserResetPassword(['data' =>$user,'token'=> $token]));
            session()->flash('success', _i('link Sent'));
            return back();
        }
        session()->flash('success', _i('Try Again'));
        return back();
    }



    public function resetPassword($token) {
        $check_token = DB::table('password_resets')->where('token', $token)->where('created_at','>', Carbon::now()->subHours(2))->first();
        if(!empty($check_token)){
            return view('web.user.reset_password',compact('check_token'));
        }else{
            return redirect(url('forgetPassword'));
        }
    }

    public function resetPasswordPost(Request $request,$token){
        $this->validate($request,[
            'password' => 'required|confirmed',
            'password_confirmation'=>'required'
        ],[],[
            'password' => trans('admin.password'),
            'password_confirmation' => trans('admin.password_Confirm')
        ]);
        $csrf_token = DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();
        if(!empty($csrf_token)){
            $user = User::where('email' , $csrf_token->email )->update(['email'=>$csrf_token->email,'password'=>bcrypt($request->password)]);
            DB::table('password_resets')->where('email',$request->email)->delete();
            auth()->attempt(['email'=>$csrf_token->email,'password'=>$request->password], true);
            return redirect()->route('homepage');
            return redirect()->intended();

        }else{
            return redirect(url('forgetPassword'));
        }
    }
}
