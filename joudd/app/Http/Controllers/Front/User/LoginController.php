<?php

/**
 * Created by PhpStorm.
 * User: misr computer
 * Date: 29/05/2019
 * Time: 01:09 �
 */

namespace App\Http\Controllers\Front\User;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller {

    use AuthenticatesUsers;


    public function logout() {
//        dd(auth()->id());
        auth()->logout();
        return redirect('/user/login');
    }

}
