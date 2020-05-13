<?php

use App\Models\EmailTemplate;
use App\Models\EmailTemplateData;
use App\Models\Front\CurrencyConvertor;
use App\Models\Product;
use App\Models\ProductCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

if (!function_exists('aUrl')) {
    function aUrl($value = null)
    {
        return url(LaravelLocalization::setLocale() . '/admin/' . $value);
    }
}

if (!function_exists('admin')) {
    function admin()
    {
        return auth()->guard('admin');
    }
}

if (!function_exists('web')) {
    function web()
    {
        return auth()->guard('web');
    }
}


if (!function_exists('lang')) {
    function lang()
    {
        $firstLang = \App\Models\SiteLanguage::first();
        if (session()->has('lang')) {
            return session('lang');
        } else {
            session()->put('lang', $firstLang->locale);
            return session('lang');
        }
    }
}

if (!function_exists('adminLang')) {
    function adminLang()
    {
        $firstLang = \App\Models\SiteLanguage::first();

        if (session()->has('adminLang')) {
            return session('adminLang');
        } else {
            session()->put('adminLang', $firstLang->locale);
            return session('adminLang');
        }
    }
}

if (!function_exists('getLang')) {
    function getLang($session)
    {
        $language = \App\Models\SiteLanguage::where('locale', $session)->first();
        if ($language == null) {
            return;
        } else {
            return $language['id'];
        }
    }
}
if (!function_exists('langs')) {
    function langs()
    {
        $language = \App\Models\SiteLanguage::all();
        return $language;
    }
}

if (!function_exists('countries')) {
    function countries()
    {
        $countries = \App\Models\Country::select('countries_translations.title as title', 'countries.id as id', 'currencies_translation.code')
            ->leftJoin('currencies', 'currencies.country_id', '=', 'countries.id')
            ->leftJoin('currencies_translation', 'currencies_translation.currency_id', '=', 'currencies.id')
            ->leftJoin('countries_translations', 'countries_translations.country_id', '=', 'countries.id')->where('countries_translations.locale', App::getLocale())->where('currencies_translation.locale', App::getLocale())->get();
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
    function country_code()
    {
        if (request()->cookie('country_id') != null) {
            $country = \App\Models\Country::findOrFail(request()->cookie('country_id'));
            $country_code = $country->code;
        } else {
            $country_code = \App\Models\Country::first()->code;
        }
        return $country_code;
    }
}

if (!function_exists('country_call_code')) {
    function country_call_code()
    {
        if (request()->cookie('country_id') != null) {
            $country = \App\Models\Country::findOrFail(request()->cookie('country_id'));
            $country_call_code = $country->call_code;
        } else {
            $country_call_code = \App\Models\Country::first()->call_code;
        }
        return $country_call_code;
    }
}

if (!function_exists('country_call_code_with_id')) {
    function country_call_code_with_id($country_id)
    {
        if ($country_id != null) {
            $country = \App\Models\Country::findOrFail($country_id);
            $country_call_code = $country->call_code;
        } else {
            $country_call_code = \App\Models\Country::first()->call_code;
        }
        return $country_call_code;
    }
}

if (!function_exists('currency')) {
    function currency()
    {
        if (request()->cookie('country_id') != null) {
            $country = \App\Models\Country::findOrFail(request()->cookie('country_id'));
            $country_id = $country->id;
        } else {
            $country_id = \App\Models\Country::first()->id;
        }
        $currency = \App\Models\Currency::select('currencies_translation.title as title', 'currencies.id as id', 'currencies.country_id as country_id', 'currencies_translation.code')
            ->leftJoin('currencies_translation', 'currencies_translation.currency_id', '=', 'currencies.id')
            ->where('locale', App::getLocale())
            ->where('country_id', $country_id)->first();
        if (!$currency) {
            $currency = new \stdClass();
            $currency->rate = 1;
            $currency->code = "usd";
        }
        return $currency;
    }
}

if (!function_exists('enCurrency')) {
    function enCurrency()
    {
        if (request()->cookie('country_id') != null) {
            $country = \App\Models\Country::findOrFail(request()->cookie('country_id'));
            $country_id = $country->id;
        } else {
            $country_id = \App\Models\Country::first()->id;
        }
        $enCurrency = \App\Models\Currency::select('currencies_translation.title as title', 'currencies.id as id', 'currencies.country_id as country_id', 'currencies_translation.code')
            ->leftJoin('currencies_translation', 'currencies_translation.currency_id', '=', 'currencies.id')
            ->where('country_id', $country_id)->
            first();
        if (!$enCurrency) {
            $enCurrency = new \stdClass();
            $enCurrency->rate = 1;
            $enCurrency->code = "usd";
        }
        return $enCurrency;
    }
}

if (!function_exists('setting')) {
    function setting()
    {
        $setting = \App\Models\Setting::leftJoin('settings_translations', 'settings_translations.setting_id', '=', 'settings.id')->where('locale', App::getLocale())->first();
        return $setting;
    }
}

if (!function_exists('forgetPassword')) {
    function forgetPassword($value)
    {
        $emailTemplate = EmailTemplate::where('code', $value)->first();
        $emailTemplateData = EmailTemplateData::leftJoin('email_templates_data_translations', 'email_templates_data_translations.email_template_data_id', 'email_templates_data.id')
            ->where('email_template_id', $emailTemplate->id)
            ->where('email_templates_data_translations.locale', App::getLocale())->first();
        return $emailTemplateData;
    }
}

if (!function_exists('userSetting')) {
    function userSetting($value = null)
    {
        $userSetting = \App\Models\UserSetting::first();
        if ($userSetting != null) {
            return $userSetting;
        }
    }
}

if (!function_exists('waiting_products')) {
    function waiting_products($value = null)
    {
        $waiting_product = Product::where('release_date', ">", DB::raw('NOW()'))->limit(2)->get();
        return $waiting_product;
    }
}

if (!function_exists('regions')) {
    function regions()
    {
        $regions = \App\Models\Region::select('regions_translations.title as title', 'regions.code as code', 'regions.id as id')
            ->leftJoin('regions_translations', 'regions_translations.region_id', '=', 'regions.id')->where('locale', App::getLocale())->get();
        return $regions;
    }
}

if (!function_exists('membership_number')) {
    function membership_number($value)
    {
        return str_pad($value, 7, '0', STR_PAD_LEFT);
    }
}

if (!function_exists('ordersCount')) {
    function ordersCount()
    {
        $orders = \App\Models\Order::where('status', 'wait')->get();
        return count($orders);
    }
}

if (!function_exists('featuredCount')) {
    function featuredCount()
    {
        $featured = \App\Models\FeaturedAdUser::where('publish', 0)->get();
        return count($featured);
    }
}

if (!function_exists('famousCount')) {
    function famousCount()
    {
        $SocialAdvertisementUser = \App\Models\SocialAdvertisementUser::where('publish', 0)->where('advert_type', 'user')->get();
        return count($SocialAdvertisementUser);
    }
}

if (!function_exists('ourAdsCount')) {
    function ourAdsCount()
    {
        $SocialAdvertisementUser = \App\Models\SocialAdvertisementUser::where('publish', 0)->where('advert_type', 'website')->get();
        return count($SocialAdvertisementUser);
    }
}

if (!function_exists('FeaturedAdUserCount')) {
    function FeaturedAdUserCount()
    {
        $FeaturedAdUser = \App\Models\FeaturedAdUser::where('publish', 1)->whereDate('to', ">", Carbon::now())->orWhere('to', null)->get();
        return count($FeaturedAdUser);
    }
}

if (!function_exists('ContactsCount')) {
    function contactsCount()
    {
        $contacts = \App\Models\Contact::where('status', 0)->get();
        return count($contacts);
    }
}
