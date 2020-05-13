<?php
/**
 * Created by PhpStorm.
 * User: misr computer
 * Date: 16/06/2019
 * Time: 03:39 م
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;
class ResetPasswordController  extends Controller
{


    public function showEmailForm()
    {
        return view('auth.passwords.email');
    }

    public function postEmailForm(Request $request)
    {
//        $user = User::where('email', $request->email)->first();
//dd($user);
        $validator = validator()->make($request->all(), [
            'email'  => 'required|string|email|max:100|exists:users'
        ]);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::where('email', $request->email)->first();
        $isAdmin = $user->is_admin;
//        dd($isAdmin);
        if($user->is_admin == 1)
        {
            $code = rand(111111,999999);
            $updateUser = $user->update(['pin_code' => $code]);
            if($updateUser)
            {
                //send email
                Mail::to($user->email)
                    ->bcc("shimaa_naga@yahoo.com")
                    ->send(new ResetPassword($code,$isAdmin));

                session()->flash('success', _i('Your code has been sent successfully. Please check your email now !'));
                return back();
              

            }else{
                  session()->flash('success', _i('Sorry an error occurred, please try again !'));
                return back();
            }

        }else{
            session()->flash('danger', _i('Sorry, there is no account associated with this email !'));
                return back();
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
//                return redirect()->back()->withInput()->with('success', 'تم تغيير الرقم السري بنجاح !');
                 return redirect('/adminpanel/home');
            }
            else{
                return redirect()->back()->withInput()->with('danger', _i('Sorry an error occurred, please try again !'));
            }
        }
        else{
            // return responseJson(0, 'This code is invalid');
            return redirect()->back()->withInput()->with('danger',_i('Sorry, this code is not valid') );
        }

    }


}