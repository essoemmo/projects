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
    const  Store = "store";


    public static function get_guard()
    {
        if (Auth::guard('admin')->check()) {
            return "admin";
        } elseif (Auth::guard('web')->check()) {
            return "web";
        } elseif (Auth::guard('store')->check()) {
            return "store";
        }
    }

    function get_guardByNum($id)
    {
        if ($id == 1) {
            return "admin";
        } elseif ($id == 2) {
            return "web";
        } elseif ($id == 3) {
            return "store";
        }
    }


    public static function admin()
    {
        return auth()->guard('admin');
    }

    public static function store()
    {
        return auth()->guard('store');
    }

    public static function MasterLang()
    {

        if (session()->has('MasterLang')) {
            return session('MasterLang');
        } else {
            $firstLang = \App\Models\Language::first();
            session()->put('MasterLang', $firstLang->code);
            return session('MasterLang');
        }
    }


}
