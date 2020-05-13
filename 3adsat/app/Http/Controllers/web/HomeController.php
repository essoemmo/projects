<?php

namespace App\Http\Controllers\web;

use App\Hr\Course\Co_category;
use App\Models\Article\Artcl_category;
use App\Models\Article\Article;
use App\Models\Article\Article_data;
use App\Models\Contact;
use App\Models\Content\ContentSection;
use App\Models\Language;
use App\Models\Manufacturer;
use Carbon\Carbon;
use Darryldecode\Cart\Cart;
use http\Cookie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Xinax\LaravelGettext\Facades\LaravelGettext;

class HomeController extends Controller {

//    public function getLangs()
//    {
//        $getLangs = Language::all();
//        return response()->json($getLangs);
//    }
//
//    public function changeLang($locale=null, Request $request)
//    {
//        if($request->lang_code != null)
//        {
//            $locale = $request->lang_code;
//        }
//        $language = \App\Models\Language::where('code',$locale)->first();
//        Request()->session()->put('language', $language->id);
//        LaravelGettext::setLocale($language->code);
//
//        return Redirect::to(URL::previous());
//    }

    public function privacy() {
        return view('web.privacy');
    }

    public function common() {
        return view('web.common');
    }

    public function lang($lang) {
        session()->has('lang') ? session()->forget('lang') : '';
        $lang == 'ar' ? session()->put('lang', 'ar') : session()->put('lang', 'en');
        //dd(getLang(session('lang')));
        return Redirect::to(URL::previous());
    }

    public function index(Request $request) {

//      dd($request->cookie('code'));
        if ($request->cookie('code') != null) {
            $country_id = $request->cookie('code');
        } else {
            $ip = new \App\Bll\IP();
            $ip->getInfo();
            $iso = \App\Models\Country::where("iso_code", $ip->country_code)->first();
            if ($iso == null)
                $iso = DB::table('countries')->first();
            $country_id = $iso->iso_code;
               $minutes = 586415;
        \Illuminate\Support\Facades\Cookie::queue(\Illuminate\Support\Facades\Cookie::make('code', $country_id, $minutes));
        }
        $country = DB::table('countries')->where('iso_code', $country_id)->first();
        //dd($country);
        $lang = DB::table('languages')->where('code', lang())->first();

        $convert = getRate($country->iso_code);

        if (!session('language')) {
            $slider = DB::table('sliders')
                    ->leftJoin('country_slider', 'sliders.id', '=', 'country_slider.slider_id')
//    ->leftJoin('countries','countries.iso_code','=',$country_id)
                    ->where('country_slider.country_id', $country->id)
                    ->where('sliders.source_id', null)
                    ->select(['sliders.*', 'country_slider.slider_id', 'country_slider.country_id'])
                    ->get();
        } else {
            $slider = DB::table('sliders')
                    ->leftJoin('country_slider', 'sliders.id', '=', 'country_slider.slider_id')
//    ->leftJoin('countries','countries.iso_code','=',$country_id)
                    ->where('country_slider.country_id', $country->id)
                    ->where('sliders.lang_id', $lang->id)
                    ->select(['sliders.*', 'country_slider.slider_id', 'country_slider.country_id'])
                    ->get();
        }

        $manufacturers = \App\Models\Manufacturer::orderBy('sort_order', 'asc')->get();
        $langs = Language::all();

//        homepage products
        $content = ContentSection::orderBy('order', 'asc')->where('type', 'home')
                ->leftJoin('section_country', 'content_sections.id', '=', 'section_country.section_id')
                ->leftJoin('content_sections_data', 'content_sections.id', '=', 'content_sections_data.section_id')
                ->where('section_country.country_id', $country->id)
                ->where('content_sections_data.lang_id', checknotsessionlang())
                ->select('content_sections.id', 'content_sections.columns', 'content_sections.title')
                ->groupBy('content_sections.id')
                ->get();

        return view('web.home', compact('langs', 'slider', 'manufacturers', 'convert', 'content', 'country'));
    }

    public function getcountrycode($code) {

        $minutes = 586415;
        \Illuminate\Support\Facades\Cookie::queue(\Illuminate\Support\Facades\Cookie::make('code', $code, $minutes));
//        dd($cookies);
        return \redirect()->back();
    }

    public function article_categories() {
        $categories = Artcl_category::where('published', 1)
                        ->where('lang_id', getLang(session('lang')))
                        ->orderBy('id', 'desc')->paginate(6);
        return view('web.articles.article_categories', compact('categories'));
    }

    public function article_cat($cat_id) {
//        dd(getLang(session('lang')));
//        $category = Artcl_category::findOrFail($cat_id);
        $category = Artcl_category::where('id', $cat_id)->where('lang_id', getLang(session('lang')))->first();
//        dd($category);
        if (!$category) {
            $category = Artcl_category::where('source_id', $cat_id)->where('lang_id', getLang(session('lang')))->first();
        }
        if (!$category) { // if article cat => $cat_id & not lang_id
            $cat = Artcl_category::where('id', $cat_id)->first();
            $category = Artcl_category::where('id', $cat->source_id)->where('lang_id', getLang(session('lang')))->first();
        }
        if ($category == null) {
            return view('not_found');
        }

        $articles = Article::where('category_id', $category->id)->where('published', 1)
                        ->where('lang_id', getLang(session('lang')))
                        ->orderBy('id', 'desc')->paginate(6);
        if (count($articles) < 1) {
            $articles = Article::where('category_id', $category->source_id)->where('published', 1)
                            ->where('lang_id', getLang(session('lang')))
                            ->orderBy('id', 'desc')->paginate(6);
        }

        return view('web.articles.articles', compact('articles', 'category'));
    }

    public function article($article_id) {
        //dd(getLang(session('lang')));
        $article = Article::where('id', $article_id)->where('lang_id', getLang(session('lang')))->first();
        if (!$article) {
            $article = Article::where('source_id', $article_id)->where('lang_id', getLang(session('lang')))->first();
        }
        if (!$article) { // if source id => $article_id and not lang_id
            $article = Article::where('id', $article_id)->first(); //->where('lang_id' ,getLang(session('lang')))
            if ($article->source_id != null) {
                $article = Article::where('id', $article->source_id)->where('lang_id', getLang(session('lang')))->first();
            }
        }
        if ($article == null) {
            return view('not_found');
        }
//        dd($article);
//        $category = Artcl_category::where('id' , $article->category_id)->where('lang_id' , getLang(session('lang')) )->first();
        $category = Artcl_category::where('id', $article->category_id)->where('lang_id', getLang(session('lang')))->first();
        //dd($category);
        if (!$category) {
            $category = Artcl_category::where('source_id', $article->category_id)->where('lang_id', getLang(session('lang')))->first();
        }
        if ($category == null) {
            return view('not_found');
        }

        $articles = Article::where('category_id', $article->category_id)
                ->where('id', '!=', $article->id)
                ->where('lang_id', getLang(session('lang')))
                ->where('published', 1)
                ->limit(4)
                ->get();

        return view('web.articles.single_article', compact('article', 'category', 'articles'));
    }

    public function logout() {
        if (\auth()->check()) {

            \auth()->logout();
            \session()->flash('success', 'GoodBay!!');
            return redirect()->route('homepage');
        }
    }

    public function manufacturers($id) {
        if (request()->cookie('code') != null) {
            $countries = DB::table('countries')
                            ->where('iso_code', request()->cookie('code'))->first();
        } else {
            $countries = DB::table('countries')
                    ->first();
        }
        $products = DB::table('product_categories')
                        ->leftJoin('products', 'products.id', '=', 'product_categories.product_id')
                        ->leftJoin('product_descriptions', 'products.id', '=', 'product_descriptions.product_id')
                        ->leftJoin('product_images', 'products.id', '=', 'product_images.product_id')
                        ->leftJoin('product_price', 'products.id', '=', 'product_price.product_id')
                        ->select(['products.*',
                            'product_descriptions.name as namedesc',
                            'product_descriptions.language_id',
                            'product_images.image as proimage',
                            'product_price.price as proprice',
                            'product_price.country_id as procountry',
                            'product_price.discount as discount',
                            'product_price.quantity as quantity',
                        ])
                        ->where('product_descriptions.language_id', '=', getLang(lang()))
                        ->where('product_price.country_id', '=', $countries->id)
                        ->where('products.manufacturer_id', '=', $id)
                        ->groupBy('products.id')->paginate(12);
        $manufacturer = Manufacturer::findOrFail($id);
        $country = DB::table('countries')->where('iso_code', $countries->iso_code)->first();
        $convert = getRate($country->iso_code);
        return view('web.manufacturers.show', compact('products', 'manufacturer', 'country', 'convert'));
    }

}
