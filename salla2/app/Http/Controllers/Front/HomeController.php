<?php

namespace App\Http\Controllers\Front;

use App\Bll\Utility;
use App\Http\Controllers\Controller;
use App\MembershipOptionsCategoryData;
use App\MembershipOptionsData;
use App\Models\Content_section;
use App\Models\product\stores;
use App\Models\Settings\Counter;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Xinax\LaravelGettext\Facades\LaravelGettext;

class HomeController extends Controller {

    public function test() {
        $minutes = 525948;
        //cookie('lan', session('lang'), $minutes);
//        dd(\request()->cookie('lan'));
        //Cookie::queue(Cookie::make('lan', session('lang') , $minutes));
        //dd(\request()->cookie('lan'));
//        dd( cookie('lan'));
        //dd(request()->cookie());
        //dd(request()->cookie('lan'));
        //Cookie::queue(Cookie::forget('lan'));
        //dd( Cookie::get('lan'));
        //return view('front.article');
    }

    public function setHome() {
        $locale = Cookie::get('lang');
        //  dd($locale);
        if ($locale == null) {
            $locale = "ar";
        }
        session()->put('lang', $locale);
        app()->setLocale($locale);
        \LaravelGettext::setLocale($locale);
        return redirect (app()->getLocale());
    }

    public function home() {
        // dd(app()->getLocale());
        //
        //dd(session('lang') , app()->getLocale() );
        SEOMeta::setTitle(Utility::storeSeo(Utility::getStoreId(), Utility::getMasterSettigs()->id, get_class(Utility::getMasterSettigs())) ? Utility::storeSeo(Utility::getStoreId(), Utility::getMasterSettigs()->id, get_class(Utility::getMasterSettigs()))['meta_title'] : '');
        SEOMeta::setDescription(Utility::storeSeo(Utility::getStoreId(), Utility::getMasterSettigs()->id, get_class(Utility::getMasterSettigs())) ? Utility::storeSeo(Utility::getStoreId(), Utility::getMasterSettigs()->id, get_class(Utility::getMasterSettigs()))['meta_description'] : '');
        SEOMeta::setCanonical(route('front_home', app()->getLocale()));
        SEOMeta::addMeta(
                'article:published_time',
                'property');
        SEOMeta::addMeta(
                'article:section',
                'property');
        //with facebook
        OpenGraph::setDescription(Utility::storeSeo(Utility::getStoreId(), Utility::getMasterSettigs()->id, get_class(Utility::getMasterSettigs())) ? Utility::storeSeo(Utility::getStoreId(), Utility::getMasterSettigs()->id, get_class(Utility::getMasterSettigs()))['meta_description'] : '');
        OpenGraph::setTitle(Utility::storeSeo(Utility::getStoreId(), Utility::getMasterSettigs()->id, get_class(Utility::getMasterSettigs())) ? Utility::storeSeo(Utility::getStoreId(), Utility::getMasterSettigs()->id, get_class(Utility::getMasterSettigs()))['meta_title'] : '');
        OpenGraph::setUrl(route('product_url', [app()->getLocale(), Utility::getMasterSettigs()->id]));
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('locale', app()->getLocale());
        OpenGraph::addProperty('locale:alternate', ['ar', 'en']);
        OpenGraph::addImage(['url' => asset(Utility::getMasterSettigs()->logo), 'size' => 300]);
        OpenGraph::addImage(asset(Utility::getMasterSettigs()->logo), ['height' => 300, 'width' => 300]);
        // twitter
        TwitterCard::setTitle(Utility::storeSeo(Utility::getStoreId(), Utility::getMasterSettigs()->id, get_class(Utility::getMasterSettigs())) ? Utility::storeSeo(Utility::getStoreId(), Utility::getMasterSettigs()->id, get_class(Utility::getMasterSettigs()))['meta_title'] : '');
        TwitterCard::setSite('@#');

        $locale = Cookie::get('lang');
        //  dd($locale);
        if ($locale == null) {
            $locale = "ar";
        }

        session()->put('lang', $locale);
        app()->setLocale($locale);
        \LaravelGettext::setLocale($locale);
//dd(Utility::getStoreId());
        $counter = Counter::all()->take(3);

        //   $memberships = \App\Models\Membership\Membership::all()->where('is_active', '=', 1)->take(3);
        $memberships = \App\Models\Membership\Membership::join("memberships_data", "memberships.id", "=", "memberships_data.membership_id")
                        ->where('lang_id', getLang(session('lang')))->where('is_active', '=', 1)->get();


        $sliders = \App\Models\Settings\Slider::leftJoin('sliders_data', 'sliders_data.slider_id', 'sliders.id')
                        ->select('sliders.*', 'sliders_data.slider_id', 'sliders_data.lang_id', 'sliders_data.source_id',
                                'sliders_data.name as title', 'sliders_data.description')
                        ->whereNull('store_id')->where('published', 1)->get();


//        $exsliders = DB::table('sliders')->orderBy('id', 'desc')->where('store_id', null)
//            ->where('published', 1)->where('status', 1)->get();
//                        $category = Artcl_category::where('published',1)->where('store_id', null)->first();
        //                        // dd($category);
        //                        $articles_category = Article_category::
        //                            join('articles' , 'articles.id' ,'=','article_category.article_id')
        //                            ->join('artcl_categories' ,'artcl_categories.id','=','article_category.category_id')
        //                            ->where('articles.published' , 1)
        //                            ->where('articles.store_id',null)
        //                            ->where('article_category.category_id' ,$category['id'])
        //                            ->select('articles.id as artcl_id','articles.title as artcl_title' , 'articles.content as artcl_content' , 'articles.img_url as artcl_img' ,
        //                                'artcl_categories.title as cat_title' )
        //                            ->get();
        // dd($articles_category );

        $meberoptiondata = MembershipOptionsData::
                        join('membership_options', 'membership_options.option_id', '=', 'membership_options_data.option_id')
                        ->join('memberships', 'memberships.id', '=', 'membership_options.membership_id')
                        ->select('membership_options_data.id as id', 'membership_options_data.title as title', 'membership_options_data.option_id as option_id'
                        )->where('lang_id', getLang(session('lang')))->get();

        $categorydata = MembershipOptionsCategoryData::all()->where('lang_id', getLang(session('lang')))->all();

        $membership_options = \App\Models\Membership\MembershipOptions::all();

        $optiondata = MembershipOptionsData::
                        join('membership_options_master', 'membership_options_master.id', '=', 'membership_options_data.option_id')
                        ->join('membership_options_category', 'membership_options_category.id', '=', 'membership_options_master.category_id')
                        ->select('membership_options_data.id as id', 'membership_options_data.title as title', 'membership_options_data.option_id as option_id', 'membership_options_master.category_id as category_id'
                        )->where('lang_id', getLang(session('lang')))->get();

        $content = Content_section::orderBy('order', "asc")->where('type', 'home')->where('store_id', null)->get();


        //dd(app()->getLocale());
        return view('front.home', compact('memberships', 'sliders', 'counter',
                        'meberoptiondata', 'categorydata', 'optiondata', 'membership_options', 'content'));
    }

    public function prices(Request $request) {

        if (session()->has('memebr_id')) {
            session()->forget('memebr_id');
        }

        $memberships = \App\Models\Membership\Membership::join("memberships_data", "memberships.id", "=", "memberships_data.membership_id")
                ->select(
                        'memberships.*',
                        'memberships_data.title as title', 'memberships_data.description')
                ->where('lang_id', getLang(session('lang')))
                ->where('is_active', '=', 1)
                ->get();
        //dd($memberships);
        $categorydata = MembershipOptionsCategoryData::all()->where('lang_id', getLang(session('lang')))->all();

        $optiondata = MembershipOptionsData::
                        join('membership_options_master', 'membership_options_master.id', '=', 'membership_options_data.option_id')
                        ->join('membership_options_category', 'membership_options_category.id', '=', 'membership_options_master.category_id')
                        ->select('membership_options_data.id as id', 'membership_options_data.title as title', 'membership_options_data.option_id as option_id', 'membership_options_master.category_id as category_id'
                        )->where('lang_id', getLang(session('lang')))->get();

        // dd(getLang(session('lang')));

        $membership_options = \App\Models\Membership\MembershipOptions::all();
        return view('front.prices', [
            'memberships' => $memberships,
            'categorydata' => $categorydata,
            'optiondata' => $optiondata,
            "membership_options" => $membership_options,
        ]);
    }

    public function lang($lang) {

        $old = app()->getLocale();
        if (Cookie::get('lang') != null) {
            Cookie::queue(Cookie::forget('lang'));
            session()->forget('lang');
        }
        Cookie::queue(Cookie::make('lang', $lang, 525948));
        session()->put('lang', $lang);
        app()->setLocale($lang);
        LaravelGettext::setLocale($lang);

        $url = url()->previous();
        $redir = str_replace($old, session()->get('lang'), $url);
//dd($redir , $old , $lang);
        //$redir = str_replace('/'.app()->getLocale(), '/'.$lang, $url);
//        $url_explode = explode("/",$url);
//        $url_explode[3] = $lang;
//        //dd($url ,$url_explode ,$url_explode[3]);
//        $redir = implode('/',$url_explode);
//        dd($redir , $lang);

        return redirect($redir);

        //return redirect(url(URL::previous()));
        // return redirect(url('/'.app()->getLocale()));
    }

    public function to($path, $extra = [], $secure = null) {
        // First we will check if the URL is already a valid URL. If it is we will not
        // try to generate a new one but will simply return the URL as is, which is
        // convenient since developers do not always have to check if it's valid.
        if ($this->isValidUrl($path)) {
            return $path;
        }

        $segments = array_filter(explode('/', $path));

        $first_segment = Arr::get($segments, 0);

        $locale = \Request::getLocale();

        // Get locale from url first segment
        if (in_array($first_segment, $this->locales)) {
            unset($segments[0]);
            $locale = $first_segment;
        }

        // Get locale from passed extra param
        if (isset($extra['locale'])) {
            $locale = $extra['locale'];
            unset($extra['locale']);
        }

        // Remove default locale
        if ($locale == $this->default_locale)
            $locale = null;

        // Build new path if locale is present
        $path = implode('/', array_merge([$locale], $segments));

        return parent::to($path, $extra, $secure);
    }

    public function AllStores() {

        $stores = stores::leftJoin('users', 'users.id', '=', 'stores.owner_id')
                ->select('stores.id as id', 'stores.domain as domain', 'stores.title as title')
                ->where('users.is_active', '=', 1)
                ->where('stores.is_active', '=', 1)
//            ->where('lang_id', getLang(session('lang')))
                ->get();
        return view('front.stores', compact('stores'));
    }

}
