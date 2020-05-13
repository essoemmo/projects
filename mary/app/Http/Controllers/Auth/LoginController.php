<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    // save data of user login
    public function login (Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email|exists:users',
            'password' => 'required|min:5'
        ]);

        $guard_web = 'web';
        $user = User::where('email',$request->email)->where('guard','=',$guard_web)->first();
        if (isset($user) && $user->userlog == 1){
            try {
                if (Auth::guard($guard_web)->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
//            return redirect('/');
                    return redirect()->intended();
                }
            } catch (\Exception $e) {
                return redirect('/');
                return redirect()->intended();

            }

            return redirect()->back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    $this->username() => _i('Your credentials doesn`t match our service'),
                ]);
        }else{
            return redirect()->back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    $this->username() => _i('Your credentials doesn`t match our service'),
                ]);
        }


    }


    // show user login form
    public function showLoginForm()
    {
        if(auth()->user() != null)
            return redirect ("/");

        return view('web.user.login');
    }

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


}
