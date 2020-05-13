<?php
/**
 * Created by PhpStorm.
 * User: misr computer
 * Date: 16/07/2019
 * Time: 11:23 �
 */

namespace App\Help;


use Illuminate\Support\Facades\Auth;

class Utility
{
    const  Web = "web";
    const  Admin = "admin";

    public static function get_guard(){
        if(Auth::guard('admin')->check())
        {return "admin";}
        elseif(Auth::guard('web')->check())
        {return "web";}
    }

}
