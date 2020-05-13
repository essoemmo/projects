<?php

namespace App\Http\Controllers\dashboard;

//use App\Models\Admin;
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
                return redirect()->route('dashboard');
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
            if(auth()->attempt(['email' => $request->email, 'password' => $request->password], $remember_me)){
                return redirect()->route('dashboard');

            } else {
                session()->flash('error', trans('admin.incorrect_info'));
                return redirect()->back()
                    ->withInput($request->only('email', 'remember'))
                    ->withErrors([
                        $this->username() => _i('Your credentials doesn`t match our service'),
                    ]);
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

         auth()->logout();
         return redirect(url('admin/panel/login'));
    }

    public function forgetPassword() {
        return view('admin.forget_password');
    }

    public function forgetPasswordPost(Request $request) {
        $guard = 'admin';
        $admin = User::where('email', $request->email)->where('guard',$guard)->first();
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
        session()->flash('success', trans('admin.Try_again'));
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
            $admin = User::where('email' , $csrf_token->email )->update(['email'=>$csrf_token->email,'password'=>bcrypt($request->password)]);
            DB::table('password_resets')->where('email',$request->email)->delete();
            auth()->attempt(['email'=>$csrf_token->email,'password'=>$request->password], true);
            return redirect()->route('dashboard');
            return redirect()->intended();

        }else{
            return redirect(url('admin/panel/forgetPassword'));
        }
    }
}

