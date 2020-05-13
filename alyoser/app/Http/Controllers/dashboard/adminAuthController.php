<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Mail\AdminResetPassword;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class adminAuthController extends Controller
{
    public function forgetPassword() {
        return view('auth.passwords.email');
    }

    public function forgetPasswordPost(Request $request) {

        $admin = User::where('email', $request->email)->first();
        if(!empty($admin)) {
            $token =app('auth.password.broker')->createToken($admin);
            $data = DB::table('password_resets')->insert([
                'email' => $admin->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);

            $dataa = [
                'token' => $token,
                'email' => $admin->email,
            ];

            Mail::send('admin.email.email', $dataa, function($message) use ($admin) {
                $message->to($admin->email, $admin->name)->subject
                ('رسالة استعادة كلمة المرور');
                $message->from('yosr@yahoo.com','yosr');
            });
//            Mail::to($admin->email)->send(new AdminResetPassword(['data' =>$admin,'token'=> $token]));
            session()->flash('success', 'تم الارسال بنجاح');
            return back();
        }
        session()->flash('success', 'عفوا لايوجد هذا الايميل');
        return back();
    }

    public function resetPassword($token) {
        $check_token = DB::table('password_resets')->
        where('token', $token)->
        where('created_at','>', Carbon::now()->subHours(2))->
        first();

        if(!empty($check_token)){
            return view('admin.email.reset',compact('check_token'));
        }else{
            return redirect()->route('adminLogin-forget');
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
            $admin = User::where('email' , $csrf_token->email )->update(['email'=>$csrf_token->email,'password'=>bcrypt($request->password)]);
            DB::table('password_resets')->where('email',$request->email)->delete();
          if (auth()->attempt(['email'=>$csrf_token->email,'password'=>$request->password], true)) {

              session()->flash('success','مرحبا في لوحة التحكم');
              return redirect()->route('dashboard');
          }

        }else{
            return redirect()->route('adminLogin-forget');
        }
    }
}
