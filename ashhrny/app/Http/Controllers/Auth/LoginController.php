<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/after_register';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function getLogin(Request $request){

        return view('front.user.login');
    }

    public function UserLogin(Request $request){

        $this->validate($request, [
            'email'   => 'required|email|exists:users',
            'password' => 'required|min:5'
        ]);

        $guard_web = 'web';
        $user = User::where('email',$request->email)->where('guard','=',$guard_web)->first();
        if(!$user->email_verified_at) {
            return redirect(route('verify', $user->id));
        }
        if($user->status == 0) {
            return redirect(route('suspended'));
        }
        if(userSetting()->register_section == 1 && userSetting()->register_section != 0) {
            if (isset($user)){

                if (Auth::guard($guard_web)->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                return redirect('/after_register');
    //                return redirect()->intended();
                }else{
                    return redirect()->back()
                        ->withInput($request->only('email', 'remember'))
                        ->withErrors([
                            $this->username() => _i('Your credentials doesn`t match our service'),
                        ]);
                }

            }else{
                return redirect()->back()
                    ->withInput($request->only('email', 'remember'))
                    ->withErrors([
                        $this->username() => _i('Your credentials doesn`t match our service'),
                    ]);
            }
        } return redirect(route('home'))->with('success', _i('Registration is currently unavailable'));
    }
}
