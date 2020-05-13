<?php


use App\Models\cities;
use App\Models\CurrencyConvertor;
use App\Models\Settings\Setting;

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

if (!function_exists('lang')){
    function lang(){

        if(session()->has('lang')){
            return session('lang');
        }else{
              $firstLang = \App\Models\Language::first();
            session()->put('lang',$firstLang->code);
            session()->put('lang_id',$firstLang->id);
            return session('lang');
        }
    }
}

if (!function_exists('getRate')) {
     function getRate($country_code)
    {
        $convert = CurrencyConvertor::where('country_code',$country_code)->first();
        if($convert==null)
        {
            $convert = new \stdClass();
            $convert->rate =1;
            $convert->code ="usd";
        }
        return $convert ;
    }
}

if (!function_exists('adminLang')){
    function adminLang(){

        if(session()->has('adminLang')){
            return session('adminLang');
        }else{
             $firstLang = \App\Models\Language::first();
            session()->put('adminLang',$firstLang->code);
            return session('adminLang');
        }
    }
}


if (!function_exists('getLang')){

    function getLang($session){
        $language = \App\Models\Language::where('code',$session)->first();
        if ($language == null){
            return;
        }else{
            session()->put("lang_id", $language["id"]);
            return $language['id'];
        }

//         if(session()->has('lang_id')){
//            return session('lang_id');
//        }else{
//              $language = \App\Models\Language::where('code',$session)->first();
//        if ($language == null){
//            return;
//        }else{
//            session()->put("lang_id", $language["id"]);
//            return $language['id'];
//        }
//        }

    }
}


if (!function_exists('getLangCode')){
    function getLangCode($lang_id){
        $language = \App\Models\Language::where('id',$lang_id)->first();
        return $language['code'];
    }
}

if (!function_exists('settings')){

    function settings(){
        $settings = \App\Models\Setting::where('lang_id',session('language'))->first();

        if (!$settings) {
            $settings = \App\Models\Setting::where('source_id',null)->first();

        }else{
            $settings = \App\Models\Setting::where('lang_id',session('language'))->first();

        }
        return $settings;
    }
}


if (!function_exists('checknotsessionlang')){

    function checknotsessionlang(){
        $lang = app()->getLocale();

       // dd($lang);
        if (!session('language')){
            $lanuage = \Illuminate\Support\Facades\DB::table('languages')
                ->first();
            return $lanuage->id;

        }else{
            return session('language');

        }
    }
}

function getCategoryHomepage($sort = null){
    $homepage = \App\Models\homepage::leftJoin('category_descriptions','category_descriptions.category_id','store_homepages.category_id')
        ->where('language_id',getlang(lang()))
        ->where('sort',$sort)
        ->first();
    if(request()->cookie('code') != null){
        $countries = \Illuminate\Support\Facades\DB::table('countries')
            ->where('iso_code',request()->cookie('code'))->first();
    }else{
        $countries = \Illuminate\Support\Facades\DB::table('countries')
            ->first();

    }
    $product = \Illuminate\Support\Facades\DB::table('product_categories')
        ->leftJoin('products','products.id','=','product_categories.product_id')
        ->leftJoin('product_descriptions','products.id','=','product_descriptions.product_id')
        ->leftJoin('product_images','products.id','=','product_images.product_id')
        ->leftJoin('product_price','products.id','=','product_price.product_id')

        ->select(['products.*',
            'product_descriptions.name as namedesc',
            'product_descriptions.language_id',
            'product_images.image as proimage',
            'product_price.price as proprice',
            'product_price.country_id as procountry',
            'product_price.discount as discount',
            'product_price.quantity as quantity',
        ])
        ->where('product_descriptions.language_id','=',getLang(lang()))
        ->where('product_categories.category_id','=',$homepage->category_id)
        ->where('product_price.country_id','=',$countries->id)
        ->groupBy('products.id')->take(6)->get();
    if ($homepage != null){
        return [$product,$homepage];
    }else{
        return null;
    }
}

if (!function_exists('stockStatus')){
    function stockStatus($id){
        if(request()->cookie('code') != null){
            $countries = \Illuminate\Support\Facades\DB::table('countries')
                ->where('iso_code',request()->cookie('code'))->first();
        }else{
            $countries = \Illuminate\Support\Facades\DB::table('countries')
                ->first();

        }
        $product = \App\Models\Product::leftJoin('product_price', 'product_price.product_id','products.id')
            ->leftJoin('stock_statuses', 'stock_statuses.id','product_price.stock_status_id')
            ->leftJoin('stock_status_descriptions', 'stock_status_descriptions.stock_status_id','stock_statuses.id')
            ->where('product_price.country_id','=',$countries->id)
            ->where('products.id',$id)
            ->select('stock_status_descriptions.name')
            ->first();
        return $product;
    }
}


if (!function_exists('getCities')){
    function getCities($country_id){
        $cities = cities::where('country_id', $country_id)->where('lang_id', getLang(lang()))->get();
        return $cities;
    }
}






