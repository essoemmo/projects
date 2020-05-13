<?php

namespace App\Http\Controllers\web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Validator,Redirect,Response,File;
;
//use Laravel\Socialite\One\User;


class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }


    public function callback($provider)
    {
        $getInfo = Socialite::driver($provider)->stateless()->user();

        $email = User::where('email',$getInfo->email)->first();
        if (!$email){
            $user = $this->createUser($getInfo, $provider);
            auth()->login($user);
            session()->flash('success', _i('welcome visitor You login by '.$provider));
            return redirect()->route('homepage');
        }else{
//            $email->delete();
            $user = $this->createUser($getInfo, $provider);
            auth()->login($user);
            session()->flash('success', _i('welcome visitor You login by '.$provider));
            return redirect()->route('homepage');
        }

    }


    function createUser($getInfo, $provider)
    {
//        dd($getInfo);

        $user = User::where('provider_id', $getInfo->id)->first();
        if (!$user) {
            $user = User::create([
                'name' => $getInfo->name,
                'email' => $getInfo->email,
                'guard' => 'web',
                'image' => $getInfo->avatar,
                'provider' => $provider,
                'provider_id' => $getInfo->id
            ]);
        }
        return $user;
    }


}
