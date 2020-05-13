<?php

namespace App\Bll;

use App\Models\Category;
use App\Models\Pages\Page;
use App\Models\product\orders;
use App\Models\product\products;
use App\Models\Seo\Seo;
use App\Models\settings\StoreOption;
use App\Store;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utility
 *
 * @author fz
 */
class Utility
{

    //put your code here
    public static $demoId = 3;

    public static function IsDemoStore()
    {
        if (self::$demoId == self::getStoreId())
            return true;
        return false;
    }

    public static function getCategories($categories, &$result, $parent_id = 0, $depth = 0)
    {
        //filter only categories under current "parent"
        $cats = $categories->filter(function ($item) use ($parent_id) {
            return $item->parent_id == $parent_id;
        });

        //loop through them
        foreach ($cats as $cat) {
            //add category. Don't forget the dashes in front. Use ID as index
            $result[$cat->id] = str_repeat('-', $depth) . $cat->title;
            //go deeper - let's look for "children" of current category
            self::getCategories($categories, $result, $cat->id, $depth + 1);
        }
    }

    public static function getStoreId()
    {

        if (session()->get(Constants::StoreId) == null) {

        }
        return session()->get(Constants::StoreId);
    }

    public static function lang()
    {

        if (session()->has('lang')) {
            return session('lang');
        } else {
            $firstLang = \App\Models\Language::first();
            session()->put('lang', $firstLang->code);
            return session('lang');
        }
    }

    public static function storeLang()
    {
        $local = \Xinax\LaravelGettext\Facades\LaravelGettext::getLocale();
        //dd($local);
        return \App\Models\Language::where("code", $local)->first()->id;
    }

    public static function language()
    {

        $code = lang();
        return \App\Models\Language::where("code", $code)->first();
    }

    public static function getTemplateCode()
    {
        $setting_template = \App\Models\Settings\Setting::where('store_id', \App\Bll\Utility::getStoreId())->first();

        if ($setting_template->template_id != null) {
            $template = \App\Models\Template::where('id', $setting_template->template_id)->first();
            return $template['code'];
        } else {
            $template = \App\Models\Template::first();
            return $template['code'];
        }
    }

    public static function getSetting()
    {
        //$settings = \App\Models\Settings\Setting::where(Constants::StoreId, self::getStoreId())->first();
        $settings = \App\Models\Settings\Setting::where("store_id", self::getStoreId())->first();

        if ($settings == null) {
            $settings = new \App\Models\Settings\Setting();
            $settings->store_id = self::getStoreId();
            $settings->logo = asset('uploads/settings/site_settings/default.png');

            return $settings;
        }
        if ($settings->logo == null) {
            $settings->logo = asset('uploads/settings/site_settings/default.png');
        } else {
            $settings->logo = asset($settings->logo);

        }

        return $settings;
    }

    public static function getMasterprofile()
    {
        $id = auth()->user()->id;
        $masters = \App\Admin::findOrFail($id);

        return $masters;
    }

    public static function getStoreprofile()
    {
        $id = auth()->user()->id;
        $user = \App\User::findOrFail($id);

        return $user;
    }

    public static function getStoreName()
    {
        $store = \App\Models\product\stores::findOrFail(\App\Bll\Utility::getStoreId());

        return $store->title;
    }

    public static function getStoreDomain()
    {
        $store = \App\Models\product\stores::findOrFail(\App\Bll\Utility::getStoreId());

        return $store->domain;
    }

    public static function getlogsfront()
    {
        $storesetting = \App\Models\Settings\Setting::
        leftJoin('settings_data', 'settings.id', '=', 'settings_data.setting_id')
            ->select(
                'settings_data.id as id',
                'settings.store_id as stores_id',
                'settings_data.title as title',
                'settings.id as setting_id',
                'settings_data.lang_id as lang_id',
                'settings.logo as logo'
            )->get();
        if ($storesetting == null) {
            $settings = new \App\Models\Settings\Setting();
            $settings->store_id = self::getStoreId();
            $settings->logo = asset('uploads/settings/site_settings/default.png');
            return $settings;
        }

        return $storesetting;
    }

    public static function getStoreSettigs()
    {
        $storesetting = \App\Models\Settings\Setting::
        leftJoin('settings_data', 'settings.id', '=', 'settings_data.setting_id')
            ->select(
                'settings_data.id as id',
                'settings.id as setting_id',
                'settings.store_id as stores_id',
                'settings.maintenance as maintenance',
                'settings_data.title as title',
                'settings_data.maintenance_title as maintenance_title',
                'settings_data.maintenance_message as maintenance_message',
                'settings.id as setting_id',
                'settings.store_id as store_id',
                'settings_data.lang_id as lang_id',
                'settings.logo as logo',
                'settings.facebook_url as facebook_url',
                'settings.twitter_url as twitter_url',
                'settings.instagram_url as instagram_url')
            ->where('store_id', self::getStoreId())
            ->first();
        if ($storesetting == null) {
            $settings = new \App\Models\Settings\Setting();
            $settings->store_id = self::getStoreId();
            $settings->logo = asset('uploads/settings/site_settings/default.png');
            return $settings;
        }

        return $storesetting;
    }

    public static function getMasterSettigs()
    { // get master settings
        $masterSetting = \App\Models\Settings\Setting::
        leftJoin('settings_data', 'settings.id', '=', 'settings_data.setting_id')
            ->select(
                'settings.id as id',
                'settings.store_id as stores_id',
                'settings_data.title as title',
                'settings.id as setting_id',
                'settings.store_id as store_id',
                'settings_data.lang_id as lang_id',
                'settings.logo as logo',
                'settings.facebook_url as facebook_url',
                'settings.twitter_url as twitter_url',
                'settings.instagram_url as instagram_url')
            ->where('store_id', null)->where('settings_data.lang_id', getLang(session('MasterLang')))->first();

        if ($masterSetting == null) {
            $settings = new \App\Models\Settings\Setting();
            $settings->store_id = null;
            $settings->logo = asset('uploads/settings/site_settings/default.png');
            return $settings;
        }
        return $masterSetting;
    }

    public static function getFrontSettigs()
    { // get master settings
        $masterSetting = \App\Models\Settings\Setting::
        leftJoin('settings_data', 'settings.id', '=', 'settings_data.setting_id')
            ->select(
                'settings_data.*',

                'settings.id as setting_id',

                'settings.logo as logo',
                'settings.facebook_url as facebook_url',
                'settings.twitter_url as twitter_url',
                'settings.instagram_url as instagram_url')
            ->where('store_id', null)->where('settings_data.lang_id', getLang(\LaravelGettext::getLocale()))->first();

        if ($masterSetting == null) {
            $settings = new \App\Models\Settings\Setting();
            $settings->store_id = null;
            $settings->logo = asset('uploads/settings/site_settings/default.png');
            return $settings;
        }
        return $masterSetting;
    }

    public static function setDate($date = null)
    {

        $date = empty($date) ? time() : strtotime($date);

        // Monday, 1st January 2010, 09:30:56
        return date('F Y', $date);

    }

    public static function allDays()
    {
        $days = [];
        for ($i = 1; $i <= 7; $i++) {
            $days[] = Carbon::now()->subDays($i)->format('l');
        }
        return $days;
    }

    public static function allyears()
    {
        $years = range(Carbon::now()->year, 2018);

        return $years;
    }

    public static function allMonths()
    {
        $monthes = array();
        array_push($monthes, date('F'));
        for ($i = -1; $i <= 12 - date('m'); $i++) {
            array_push($monthes, date('F', strtotime("+$i months")));
        }
        return $monthes;
    }

    public static function LastWeek()
    {
        $previous_week = strtotime("-1 week +1 day");
        $start_week = strtotime("last sunday midnight", $previous_week);
        $end_week = strtotime("next saturday", $start_week);
        $start_week = date("Y-m-d", $start_week);
        $end_week = date("Y-m-d", $end_week);

        $lastweek = [$start_week, $end_week];

        return $lastweek;
    }

    public static function getCategoriesNav()
    {
        $categoriesnav = \App\Models\Category::where('lang_id', getLang(\LaravelGettext::getLocale()))->where('store_id', self::getStoreId())->whereNull("parent_id")->get();
        if ($categoriesnav == null) {
            $categories = 'No categories until now';
            return $categories;
        }
        return $categoriesnav;
    }

    public static function getFeature($id = null)
    {
        $feature = \App\Models\product\features::leftJoin('features_data', 'features_data.feature_id', 'features.id')
            ->where('features.id', $id)
            ->where('features_data.lang_id', getLang(\LaravelGettext::getLocale()))
            ->first();
        return $feature;
    }

    public static function getFeatureOption($id = null, $feature_id = null)
    {
        $option = \App\Models\product\feature_options::leftJoin('feature_options_data', 'feature_options_data.feature_option_id', 'feature_options.id')
            ->where('feature_options.id', $id)
            ->where('feature_options.feature_id', $feature_id)
            ->where('feature_options_data.lang_id', getLang(\LaravelGettext::getLocale()))
            ->first();
        return $option;
    }

    public static function getSamples()
    {
        $samples = \App\Sample::
        leftJoin('master_samles_data', 'master_samles_data.sample_id', 'master_samples.id')
            ->leftJoin('stores', 'stores.id', '=', 'master_samples.store_id')
            ->select('master_samples.id as id', 'master_samples.img_url as img_url', 'master_samples.created_at as created_at', 'stores.title as title', 'master_samles_data.description as description')
            ->where('master_samles_data.lang_id' , getLang(app()->getLocale()))
            ->get();
        return $samples;
    }

    public static function GetRating($user_id, $product_id)
    {
        $userrate = \App\Models\rating\userRating::leftJoin('ratings', 'ratings.id', '=', 'user_rating.rating_id')
            ->where('user_rating.user_id', $user_id)
            ->where('ratings.product_id', $product_id)
            ->select('user_rating.user_id as userid', 'user_rating.rating as rating', 'ratings.product_id as productid', 'user_rating.rating_id as ratingid', 'user_rating.store_id as storeid')->first();
        // dd($userrate);

        return $userrate;
    }

    public static function getProduct($id)
    {
        $product = products::leftJoin('product_details', 'product_details.product_id', 'products.id')
            ->leftJoin('product_photos', 'product_photos.product_id', 'products.id')
            ->where('products.id', $id)
            ->where('product_photos.main', 1)
//            ->where('product_details.lang_id', getLang(session('lang')))
            ->select('products.*', 'product_details.title', 'product_details.description', 'product_photos.photo')
            ->first();

        return $product;
    }

    public static function getCategory($id)
    {
        $category = Category::findOrFail($id);
        return $category;
    }

    public static function getPage($id)
    {
        $page = Page::leftJoin('pages_data', 'pages_data.page_id', 'pages.id')
            ->where('pages.id', $id)
            ->select('pages.*', 'pages_data.title', 'pages_data.content')
            ->first();
        return $page;
    }

    public static function getCelebrated()
    {
        $createdStore = Store::where('id', Utility::getStoreId())->value('created_at');
        $newnow = date('Y-m-d', strtotime('+1 year', strtotime($createdStore)));
        $nowDate = date('Y-m-d');

        // total price

        $sumTotal = orders::where('store_id', Utility::getStoreId())->sum('total');

        // rating

        $rating = DB::table('user_rating')->where('store_id', Utility::getStoreId())->avg('rating');

        if ($nowDate <= $newnow && $sumTotal <= 50000 && $rating >= 4) {
            return 'true';
        } else {
            return 'false';
        }


    }

    public static function getCustomDesign()
    {
        $custom_design = \App\Models\Settings\CustomDesign::where('store_id', Utility::getStoreId())->get();
        return $custom_design;
    }


    public static function getPages()
    {
        //dd(app()->getLocale());
        $pages = Page::leftJoin('pages_data', 'pages_data.page_id', 'pages.id')
            ->where('pages.store_id', Utility::getStoreId())
            ->where('pages.published', 1)
            ->where('pages_data.lang_id', getLang(app()->getLocale()))
            ->select('pages.*', 'pages_data.title as title')->get();
        return $pages;
    }

    public static function purchased_quantity($product_id, $store_id)
    {
        $purchased_quantity = orders::leftJoin('order_products', 'order_products.order_id', 'orders.id')
            ->where('orders.store_id', $store_id)
            ->where('order_products.product_id', $product_id)
            ->where('order_products.count', '!=', null)
            ->select('order_products.*')
            ->sum('order_products.count');
        return $purchased_quantity;
    }

    public static function storeOptions($store_id)
    {
        $storeOptions = StoreOption::where('store_id', $store_id);
        return $storeOptions;
    }

    public static function getSlider()
    {
         $sliders = \App\Models\Settings\Slider::where('published', '=', 1)->where('store_id', self::getStoreId())->get();
         return $sliders;
    }

    public static function storeSeo($store_id, $item_id, $item_type)
    {
        if ($store_id != null) {
            $storeSeo = Seo::leftJoin('seo_translations', 'seo_translations.seo_id', 'seo.id')
                ->where('store_id', $store_id)
                ->where('itemable_id', $item_id)
                ->where('itemable_type', $item_type)
                ->where('seo_translations.source_id', null)
                ->select('seo.*', 'seo_translations.meta_title', 'seo_translations.meta_description', 'seo_translations.lang_id')
                ->first();
        } else {
            $storeSeo = Seo::leftJoin('seo_translations', 'seo_translations.seo_id', 'seo.id')
                ->where('store_id', null)
                ->where('itemable_id', $item_id)
                ->where('itemable_type', $item_type)
                ->where('seo_translations.source_id', null)
                ->select('seo.*', 'seo_translations.meta_title', 'seo_translations.meta_description', 'seo_translations.lang_id')
                ->first();
        }
        return $storeSeo;
    }

}
