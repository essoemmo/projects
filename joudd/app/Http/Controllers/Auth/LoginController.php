<?php

namespace App\Http\Controllers\Auth;

use App\Help\Utility;
use App\Http\Controllers\Controller;
use App\User;
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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showAdminLoginForm()
    {
        if(auth()->user() != null && auth()->user()->is_admin === 1)
            return redirect ("/home");

        return redirect('/');
    }

//
//    public function adminLogin(Request $request)
//    {
//        $this->validate($request, [
//            'email'   => 'required|email|exists:users',
//            'password' => 'required|min:6'
//        ]);
//
//
//        $user = User::where('email' ,$request->email)->first();
//
//        if ($user && $user->is_admin == 1 ){
//
//            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
//
//                return redirect()->intended('/home');
//            }
//         }
////        return back()->withErrors($this->validate())->withInput($request->only('email', 'remember'));
//        return redirect()->back()
//            ->withInput($request->only('email', 'remember'))
//            ->withErrors([
//                $this->username() => _i('Your credentials doesn`t match our service'),
//            ]);
//    }





    // show user login form
    public function showUserLoginForm()
    {
        if(auth()->user() != null && auth()->user()->is_admin === 0) {
            return redirect ("/");
        }
        return view('front.user.login');
    }

//    // save data of user login
    public function UserLogin (Request $request)
    {

        $this->validate($request, [
            'email'   => 'required|email|exists:users',
            'password' => 'required|min:6'
        ]);


        $user = User::where('email' , $request->email)->first();
        if($user->is_active == 1) {
            if($user->hasRole('registered-users'))
            {
                if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                    if($user->is_active == 1) {
                        return redirect("/profile")->with('login_message' ,_i('Thanks for Your Registeration') );
                    } elseif($user->is_active == 0) {
                        return redirect()->back()
                            ->withInput($request->only('email', 'remember'))
                            ->withErrors([
                                $this->username() => _i('Admin Will Activate Your Account Soon!!'),
                            ]);
                    }
                }


                return redirect()->back()
                    ->withInput($request->only('email', 'remember'))
                    ->withErrors([
                        $this->username() => _i('Your credentials doesn`t match our service'),
                    ]);
            } elseif($user->hasRole('trainer')) {
                if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                    if($user->is_active == 1) {
                        return redirect("/");
                    } elseif($user->is_active == 0) {
                        return redirect()->back()
                            ->withInput($request->only('email', 'remember'))
                            ->withErrors([
                                $this->username() => _i('Admin Will Activate Your Account Soon!!'),
                            ]);
                    }
                }


                return redirect()->back()
                    ->withInput($request->only('email', 'remember'))
                    ->withErrors([
                        $this->username() => _i('Your credentials doesn`t match our service'),
                    ]);
            }
            return redirect()->back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    $this->username() => _i('You doesn`t have Role to login'),
                ]);
        } else {
            return redirect()->back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    $this->username() => _i('Admin Will Activate Your Account Soon!!'),
                ]);
        }

    }

}
