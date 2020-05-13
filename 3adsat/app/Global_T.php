<?php
namespace App;


use Illuminate\Support\Facades\Config;

class Global_T{
    public const FEATURE_CATEGORIES_CUSTOM = "custom";
    public const FEATURE_CATEGORIES_LANGUAGE = "language";
    public const DEFAULT_LANGUAGE_CODE = "en";
    public const DEFUALT_PROVIDER_HOTEL_TYPE = "direct";
    public const DEFAULT_PROPERTIES_CODE = "TRV";
    public const DEFAULT_LANGUAGE_IN_TRANSLATION = 2;
    public const PROCESS_STEP = -1;
    
    public const MODIFI_SUCCESS = "SUCCESS";
    public const DATA_IS_MODIFIDED = "ERROR";
    //Success Codes
    public const MODIFI_SUCCESS_CODE = 200;
    //Error Codes
    public const MODIFI_ERROR_CODE = 302;
    public const USER_ID_NOT_FOUND = 201;
    public const SUPER_ADMIN_ROLE_NAME = "SUPER_ADMIN";
    public const USER_TYPES = ['SUPER_ADMIN'=>'super_admin','ADMIN'=>'admin','USER','user'];
    public static function GetDefaultLang(){
        $langCode = Config::get('app.site_defualt_language','en');
        $language = Models\Language::where('code',$langCode)->first();
        if(isset($language)){
            return $language->id;
        }
        return session('language');
    }
}
