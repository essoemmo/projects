<?php


if (!function_exists('aUrl')){
    function aUrl($value = null){
        return url('admin/'.$value);
    }
}

if (!function_exists('admin')){
    function admin(){
        return auth()->guard('admin');
    }
}


if (!function_exists('settings')){
    function settings(){
        if (!session('language')){
            $settings = \App\Models\Setting::where('lang_id',session('language'))->first();

        }else{
            $settings = \App\Models\Setting::where('lang_id',session('language'))->first();
        }
        return $settings;
    }
}

if (!function_exists('getLang')){
    function getLang(){
        $lang = app()->getLocale();
            if (!session('language')){
                $lang = $lang;
            }else{
                $lang = session('language');
            }
            return $lang;
    }
}
