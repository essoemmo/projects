<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use App\Mail\AdminResetPassword;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;


class AdminAuth extends Controller
{
    //
    use AuthenticatesUsers;

    public function login() {


        if(Auth::check()){
            if(auth()->user()->guard == 'admin'){
                return redirect()->route('adminHome');
            }else{
                return view('admin.login');

            }
        }else{
            return view('admin.login');
        }

//        return view('admin.login');

    }

    public function doLogin(Request $request) {
        $guard_name = 'admin';

        $remember_me = request('remember_me') == 1 ? true : false;
        $admin = User::where('email','=',$request->email)->where('guard',$guard_name)->first();

        if (isset($admin)){
            try {
                if(auth()->attempt(['email' => $request->email, 'password' => $request->password], $remember_me)){
                    return redirect()->route('adminHome');

                } else {

                    session()->flash('error', trans('admin.incorrect_info'));
                    return redirect()->back()
                        ->withInput($request->only('email', 'remember'))
                        ->withErrors([
                            $this->username() => _i('Your credentials doesn`t match our service'),
                        ]);
                }
            } catch (\Exception $e) {
                return redirect()->route('adminHome');
                return redirect()->intended();

            }
        }else{
            session()->flash('error', trans('admin.incorrect_info'));
            return redirect()->back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    $this->username() => _i('Your credentials doesn`t match our service'),
                ]);

        }

    }

    public function logout() {
        
            try {
            auth()->logout();
            return redirect(aUrl('login'));
        } catch (\Exception $e) {
            return redirect(aUrl('login'));

        }
        // auth()->logout();
        // return redirect(aUrl('login'));
    }

    public function forgetPassword() {
        return view('admin.forget_password');
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
            Mail::to($admin->email)->send(new AdminResetPassword(['data' =>$admin,'token'=> $token]));
            session()->flash('success', trans('admin.link_sent'));
            return back();
        }
        return back();
    }



    public function resetPassword($token) {
        $check_token = DB::table('password_resets')->where('token', $token)->where('created_at','>', Carbon::now()->subHours(2))->first();
        if(!empty($check_token)){
            return view('admin.reset_password',compact('check_token'));
        }else{
            return redirect(aUrl('forgetPassword'));
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
            $admin = Admin::where('email' , $csrf_token->email )->update(['email'=>$csrf_token->email,'password'=>bcrypt($request->password)]);
            DB::table('password_resets')->where('email',$request->email)->delete();
            admin()->attempt(['email'=>$csrf_token->email,'password'=>$request->password], true);
            return redirect('admin');
        }else{
            return redirect(aUrl('forgetPassword'));
        }
    }
}

