<?php

namespace App\Http\Controllers\Auth\store;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }



    public function postEmailForm(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'email'  => 'required|string|email|max:191|exists:users'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::where('email', $request->email)->first();
        $guard = $user->guard;
//        dd($isAdmin);
        if($user)
        {
            $code = rand(111111,999999);
            $updateUser = $user->update(['pin_code' => $code]);
            if($updateUser)
            {
                //send email
                Mail::to($user->email)
                    //->bcc("shimaa_naga@yahoo.com")
                    ->send(new ResetPassword($code,$guard));

                return redirect()->back()->with('success', _i('Your code has been sent successfully, please check your email now!'));

            }else{
                return redirect()->back()->withInput()->with('danger', _i('Sorry, an error has occurred, please try again!'));
            }

        }else{
            return redirect()->back()->withInput()->with('danger', _i('Sorry, there is no account associated with this email!'));
        }
    }



    public function showResetPasswordForm()
    {
        return view('auth.passwords.reset');
    }

    public function updatePassword(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'pin_code' => 'required|exists:users|integer',
//            'pin_code' => 'required|integer',
            'password' => 'required|confirmed|min:6'
        ]);

        if($validator->fails())
            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput();
            }

        $user = User::where('pin_code',$request->pin_code)->where('pin_code','!=',0)->first();
        if($user)
        {
            $user->password = bcrypt($request->password);
            $user->pin_code = null;
            if($user->save())
            {
                if($user->guard == "admin")
                {
                    return redirect('/adminpanel');
                }else{
                    return redirect('/');
                }
            }
            else{
                return redirect()->back()->withInput()->with('danger', _i('Sorry, an error has occurred, please try again!'));
            }
        }
        else{
            // return responseJson(0, 'This code is invalid');
            return redirect()->back()->withInput()->with('danger', _i('Sorry, this code is invalid!'));
        }

    }


}
