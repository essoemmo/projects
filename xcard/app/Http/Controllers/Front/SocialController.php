<?php

namespace App\Http\Controllers\Front;

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
        auth()->login($user);
        return redirect()->intended();
    }
    function createUser($getInfo,$provider){
        $user = User::where('provider_id', $getInfo->id)->first();
        $splitName = explode(' ', $getInfo->name, 2);
        if (!$user) {
            $user = User::create([
                'first_name'     => $splitName[0],
                'last_name'     => !empty($splitName[1]) ? $splitName[1] : '',
                'email'    => $getInfo->email,
                'password'    => Hash::make(rand(11111111,99999999)),
                'guard' => 'web',
                'provider' => $provider,
                'provider_id' => $getInfo->id
            ]);
        }
        return $user;
    }
}
