<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Settings\Setting;
use App\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Xinax\LaravelGettext\Facades\LaravelGettext;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
        $this->middleware('guest');
    }

    public function reset(){
//        $setting_logo = Setting::where('store_id' , null)->first()->logo;
//        dd(asset($setting_logo));
       // dd(getLang(LaravelGettext::getLocale()));
        return view('auth.passwords.resetweb');
    }

    public function sendReset(\Illuminate\Http\Request $request){

        $user = User::where('email','=',$request->email)->first();

        if ($user != null){
            $email = $request->input('email');

            Mail::send('auth.passwords.sendemail', ['email' => $email ], function ($message )
            {
                $setting = Setting::leftJoin('settings_data','settings_data.setting_id','settings.id')
                    ->select('settings.email','settings_data.title')
                    ->where('settings_data.lang_id', getLang(LaravelGettext::getLocale()))
                    ->where('settings.store_id',null)->first();
                if($setting != null){
                    $setting_email = $setting['email'];
                    $setting_title = $setting['title'];
                }else{
                    $setting_email = "salla@salla.com";
                    $setting_title = "salla";
                }

                $message->from($setting_email, $setting_title);
                $message->to(\request()->email);
            });
            session()->flash('status',_i('Well done the email send'));
            return back();
        }else{
            session()->flash('status',_i('Sorry this Email not exist'));
            return back();
        }
//        return response()->json(['message' => 'Request completed']);
    }

    public function changePass(\Illuminate\Http\Request $request){
        return view('auth.passwords.resetsite');
    }

    public function changePassput(\Illuminate\Http\Request $request){
        $request->validate([
            'email' =>'required',
            'password' =>'required|confirmed',
            ]);
        $user = User::where('email','=',$request->email)->first();
        if (!empty($user) && $user->email == $request->email){
            $user = User::find($user->id);
            $user->password = bcrypt($request->password);
            $user->save();

            session()->flash('status',_i('Well done the password is changed'));
            return redirect()->route('webLogin' ,LaravelGettext::getLocale());
        }else{
            session()->flash('status',_i('Sorry the email is correct'));
            return back();
        }

    }
}
