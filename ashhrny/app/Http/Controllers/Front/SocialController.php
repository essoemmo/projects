<?php

namespace App\Http\Controllers\Front;

use App\Mail\VerifyMail;
use App\Models\VerifyUser;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class SocialController extends Controller
{
    use AuthenticatesUsers;
    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }
    public function callback($provider){
        $getInfo = Socialite::driver($provider)->user();
        $user = $this->createUser($getInfo,$provider);
//        dd($user);
        if(!$user->email_verified_at) {
            return redirect(route('verify' , $user->id))->with('success', _i('Thanks for Your Registration, We Will Sent Email With Activation'));
        }
        auth()->login($user);
        return redirect('/after_register');
    }
    function createUser($getInfo,$provider){
        $user = User::where('provider_id', $getInfo->id)->first();
        $splitName = explode(' ', $getInfo->name, 2);
        $number = User::where('user_type' , "famous")
            ->orWhere('user_type' , "normal")
            ->orderBy('id', 'desc')->first();
        if($number){
            $membership_number = $number['membership_number'] + 1 ;
        }else{
            $membership_number = 1;
        }

        if (!$user) {
            $user = User::create([
                'first_name'     => $splitName[0],
                'last_name'     => !empty($splitName[1]) ? $splitName[1] : '',
                'email'    => $getInfo->email,
                'password'    => Hash::make(rand(11111111,99999999)),
                'guard' => 'web',
                'membership_number' => $membership_number,
                'provider' => $provider,
                'provider_id' => $getInfo->id
            ]);
            $user->assignRole('registered-users');
            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);
            \Mail::to($user->email)->send(new VerifyMail($user));
        }
        return $user;
    }
}
