<?php
/**
 * Created by PhpStorm.
 * User: misr computer
 * Date: 27/06/2019
 * Time: 04:34 م
 */

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class AdminResetPassword extends Controller
{

    public function resetForm()
    {
        return view('auth.passwords.email');
    }

    public function resetdata(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'email'  => 'required|string|email|max:100|exists:users'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::where('email', $request->email)->first();
        $isAdmin = $user->is_admin;
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

                return redirect()->back()->with('success', 'تم إرسال الكود الخاص بك بنجاح, من فضلك تفقد بريدك الإلكتروني الآن !');

            }else{
                return redirect()->back()->withInput()->with('danger', 'عفوا حدث خطأ , الرجاءالمحاولة مرة أخري !');
            }

        }else{
            return redirect()->back()->withInput()->with('danger', 'عفوا ,لا يوجد حساب مرتبط بهذا البريد الإلكتروني !');
        }
    }

    public function updatePasswordForm(){
        return view('auth.passwords.reset');
    }

    public function updatePassword(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'pin_code' => 'required|exists:users|integer',
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
                return redirect('/admin');
            }
            else{
                return redirect()->back()->withInput()->with('danger', 'عفوا حدث خطأ , الرجاءالمحاولة مرة أخري !');
            }
        }
        else{
            return redirect()->back()->withInput()->with('danger', 'عفوا ,هذا الكود غير صالح !');
        }

    }

}