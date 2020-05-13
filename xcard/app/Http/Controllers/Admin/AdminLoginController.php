<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Mail\AdminResetPassword;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Mail;

class AdminLoginController extends Controller
{
    public function login() {
        return view('admin.layout.login');
    }

    public function doLogin(Request $request) {


        $remember_me = request('remember_me') == 1 ? true : false;

        if(admin()->attempt(['email' => $request->email, 'password' => $request->password], $remember_me)){

            return redirect()->route('main');
        } else {
            return redirect(aUrl('login'));
        }
    }

    public function logout() {
        admin()->logout();
        return redirect(aUrl('login'));
    }

    public function forgetPassword() {
        return view('admin.layout.forgetPassword');
    }

    public function forgetPasswordPost(Request $request) {
        $admin = Admin::where('email', $request->email)->first();
        if(!empty($admin)) {
            $token =app('auth.password.broker')->createToken($admin);
            $data = DB::table('password_resets')->insert([
                'email' => $admin->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);
            Mail::to($admin->email)->send(new AdminResetPassword(['data' => $admin,'token'=> $token]));
            session()->flash('success', _i('Link Sent'));
            return back();
        }
        return back();
    }

    public function resetPassword($token) {
        $check_token = DB::table('password_resets')->where('token', $token)->where('created_at','>', Carbon::now()->subHours(2))->first();
        if(!empty($check_token)){
            return view('admin.layout.reset_password',compact('check_token'));
        }else{
            return redirect(aUrl('forgetPassword'));
        }
    }

    public function resetPasswordPost(Request $request,$token){
        $this->validate($request,[
            'password' => 'required|confirmed',
            'password_confirmation'=>'required'
        ],[],[
            'password' => _i('Password'),
            'password_confirmation' => _i('PasswordConfirm')
        ]);
        $csrf_token = DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();
        if(!empty($csrf_token)){
            $admin = Admin::where('email' , $csrf_token->email )->update(['email'=>$csrf_token->email,'password'=>bcrypt($request->password)]);
            DB::table('password_resets')->where('email',$request->email)->delete();
            admin()->attempt(['email'=>$csrf_token->email,'password'=>$request->password], true);
            return redirect('admin');
        }else{
            return redirect(aUrl('forgetPassword'));
        }
    }
}
