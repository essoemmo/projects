<?php

use App\Models\Front\CurrencyConvertor;
use App\Models\Product;
use App\Models\ProductCode;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

if (!function_exists('aUrl')){
    function aUrl($value = null){
        return url(LaravelLocalization::setLocale() . '/admin/'.$value);
    }
}

if (!function_exists('admin')){
    function admin(){
        return auth()->guard('admin');
    }
}

if (!function_exists('web')){
    function web(){
        return auth()->guard('web');
    }
}


if (!function_exists('lang')){
    function lang(){
        $firstLang = \App\Models\SiteLanguage::first();
        if(session()->has('lang')){
            return session('lang');
        }else{
            session()->put('lang',$firstLang->locale);
            return session('lang');
        }
    }
}

if (!function_exists('adminLang')){
    function adminLang(){
        $firstLang = \App\Models\SiteLanguage::first();

        if(session()->has('adminLang')){
            return session('adminLang');
        }else{
            session()->put('adminLang',$firstLang->locale);
            return session('adminLang');
        }
    }
}

if (!function_exists('getLang')){
    function getLang($session){
        $language = \App\Models\SiteLanguage::where('locale',$session)->first();
        if ($language == null){
            return;
        }else{
            return $language['id'];
        }
    }
}
if (!function_exists('langs')){
    function langs(){
        $language = \App\Models\SiteLanguage::all();
        return $language;
    }
}

if (!function_exists('countries')){
    function countries(){
        $countries = \App\Models\Country::select('countries_translations.title as title' ,'countries.id as id' ,'currencies_translation.code')
            ->leftJoin('currencies','currencies.country_id','=','countries.id')
            ->leftJoin('currencies_translation','currencies_translation.currency_id','=','currencies.id')
            ->leftJoin('countries_translations','countries_translations.country_id','=','countries.id')->where('countries_translations.locale',App::getLocale())->where('currencies_translation.locale',App::getLocale())->get();
        return $countries;
    }
}

if (!function_exists('getRate')) {
    function getRate($country_code)
    {
        $convert = CurrencyConvertor::where('code', $country_code)->first();
        if ($convert == null) {
            $convert = new \stdClass();
            $convert->rate = 1;
            $convert->code = "usd";
        }
        return $convert;
    }
}

if (!function_exists('country_code')) {
    function country_code() {
        if(request()->cookie('country_id') != null) {
            $country = \App\Models\Country::findOrFail(request()->cookie('country_id'));
            $country_code = $country->code;
        } else {
            $country_code = \App\Models\Country::first()->code;
        }
        return $country_code;
    }
}

if (!function_exists('currency')) {
    function currency() {
        if(request()->cookie('country_id') != null) {
            $country = \App\Models\Country::findOrFail(request()->cookie('country_id'));
            $country_id = $country->id;
        } else {
            $country_id = \App\Models\Country::first()->id;
        }
        $currency = \App\Models\Currency::select('currencies_translation.title as title' ,'currencies.id as id','currencies.country_id as country_id','currencies_translation.code')
            ->leftJoin('currencies_translation','currencies_translation.currency_id','=','currencies.id')
            ->where('locale',App::getLocale())
            ->where('country_id', $country_id)->first();
        if(!$currency){
                $currency = new \stdClass();
                $currency->rate =1;
                $currency->code ="usd";
            }
        return $currency;
    }
}

if (!function_exists('enCurrency')) {
    function enCurrency() {
        if(request()->cookie('country_id') != null) {
            $country = \App\Models\Country::findOrFail(request()->cookie('country_id'));
            $country_id = $country->id;
        } else {
            $country_id = \App\Models\Country::first()->id;
        }
        $enCurrency = \App\Models\Currency::select('currencies_translation.title as title' ,'currencies.id as id','currencies.country_id as country_id','currencies_translation.code')
            ->leftJoin('currencies_translation','currencies_translation.currency_id','=','currencies.id')
            ->where('country_id', $country_id)->
            first();
        if(!$enCurrency){
            $enCurrency = new \stdClass();
            $enCurrency->rate =1;
            $enCurrency->code ="usd";
        }
        return $enCurrency;
    }
}

if(!function_exists('codes')) {
    function codes($product_id,$count) {
        $codes = ProductCode::where('product_id', $product_id)->where('status', 0)->take($count)->get();
        return $codes;
    }
}

if (!function_exists('setting')){
    function setting($value = null){
        return \App\Models\Setting::leftJoin('settings_translations','settings_translations.setting_id','=','settings.id')->where('locale',App::getLocale())->first();
    }
}

if(!function_exists('waiting_products')) {
    function waiting_products($value = null) {
        $waiting_product = Product::where('release_date', ">" , DB::raw('NOW()') )->limit(2)->get();
        return $waiting_product;
    }
}

if (!function_exists('regions')){
    function regions(){
        $regions = \App\Models\Region::select('regions_translations.title as title','regions.code as code' ,'regions.id as id')
            ->leftJoin('regions_translations','regions_translations.region_id','=','regions.id')->where('locale',App::getLocale())->get();
        return $regions;
    }
}
