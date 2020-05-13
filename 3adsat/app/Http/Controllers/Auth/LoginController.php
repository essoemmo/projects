<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    public function getlogin(Request $request){

        return view('auth.login');
    }

    public function loginpost(\Illuminate\Http\Request $request){

        $this->validate($request, [
            'email'   => 'required|email|exists:users',
            'password' => 'required|min:5'
        ]);

        $guard_web = 'web';
        $user = User::where('email',$request->email)->where('guard','=',$guard_web)->first();
        if (isset($user)){

                if (Auth::guard($guard_web)->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
//            return redirect('/');
                    return redirect()->intended();
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
    }
}
