<?php

namespace App\Http\Controllers\web\store;

use App\Bll\Utility;
use App\Comment;
use App\Events\NewMessage;
use App\Http\Controllers\Controller;
use App\Message;
use App\Models\Article\Artcl_category;
use App\Models\Article\Article;
use App\Models\Article\ArticleCategory;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Content_section;
use App\Models\Pages\Page;
use App\Models\product\features;
use App\Models\product\order_products;
use App\Models\product\product_details;
use App\Models\product\product_photos;
use App\Models\product\products;
use App\Models\product\stores;
use App\Models\rating\rating;
use App\Models\rating\userRating;
use App\Models\Settings\Setting;
use App\Models\Settings\Slider;
use App\Models\Shipping\shippingCompanies;
use App\Notifications\ReviweNotification;
use App\User;
use App\Visitor;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Notification;
use Xinax\LaravelGettext\Facades\LaravelGettext;

//use App\Models\Article\Artcl_category;

class HomeController extends Controller
{

    public function home()
    {
         
        // get store url
        $input = route('store.home', app()->getLocale());
        // remove www
        $domain = preg_replace('#^https?://#', '', rtrim($input, '/'));
        $storeName = request()->getScheme() . ':' . '//' . $domain;

        //get seo data
        SEOMeta::setTitle(Utility::storeSeo(\App\Bll\Utility::getStoreId(), \App\Bll\Utility::getSetting()->id, get_class(\App\Bll\Utility::getSetting())) ? Utility::storeSeo(\App\Bll\Utility::getStoreId(), \App\Bll\Utility::getSetting()->id, get_class(\App\Bll\Utility::getSetting()))['meta_title'] : '');
        SEOMeta::setDescription(Utility::storeSeo(\App\Bll\Utility::getStoreId(), \App\Bll\Utility::getSetting()->id, get_class(\App\Bll\Utility::getSetting())) ? Utility::storeSeo(\App\Bll\Utility::getStoreId(), \App\Bll\Utility::getSetting()->id, get_class(\App\Bll\Utility::getSetting()))['meta_description'] : '');
        SEOMeta::setCanonical($storeName);
        SEOMeta::addMeta(
            'article:published_time',
            'property');
        SEOMeta::addMeta(
            'article:section',
            'property');
        //with facebook
        OpenGraph::setDescription(Utility::storeSeo(\App\Bll\Utility::getStoreId(), \App\Bll\Utility::getSetting()->id, get_class(\App\Bll\Utility::getSetting())) ? Utility::storeSeo(\App\Bll\Utility::getStoreId(), \App\Bll\Utility::getSetting()->id, get_class(\App\Bll\Utility::getSetting()))['meta_description'] : '');
        OpenGraph::setTitle(Utility::storeSeo(\App\Bll\Utility::getStoreId(), \App\Bll\Utility::getSetting()->id, get_class(\App\Bll\Utility::getSetting())) ? Utility::storeSeo(\App\Bll\Utility::getStoreId(), \App\Bll\Utility::getSetting()->id, get_class(\App\Bll\Utility::getSetting()))['meta_title'] : '');
        OpenGraph::setUrl($storeName);
        OpenGraph::addProperty('type', 'store');
        OpenGraph::addProperty('locale', app()->getLocale());
        OpenGraph::addProperty('locale:alternate', ['ar', 'en']);
        OpenGraph::addImage(['url' => asset(\App\Bll\Utility::getStoreSettigs()->logo), 'size' => 300]);
        OpenGraph::addImage(asset(\App\Bll\Utility::getStoreSettigs()->logo), ['height' => 300, 'width' => 300]);
        // twitter
        TwitterCard::setTitle(Utility::storeSeo(\App\Bll\Utility::getStoreId(), \App\Bll\Utility::getSetting()->id, get_class(\App\Bll\Utility::getSetting())) ? Utility::storeSeo(\App\Bll\Utility::getStoreId(), \App\Bll\Utility::getSetting()->id, get_class(\App\Bll\Utility::getSetting()))['meta_title'] : '');
        TwitterCard::setSite('@#');


        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
//        $ip=$_SERVER['REMOTE_ADDR'];
        //dd($ip);

        if ($ip != '127.0.0.1' && config("app.env") != "local") {
            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            Visitor::firstOrCreate([
                'ip' => $_SERVER['REMOTE_ADDR'],
                'country' => $ipdat->geoplugin_countryName,
                'store_id' => \App\Bll\Utility::getStoreId(),
            ])->save();
        }
        $store = stores::where(['id' => \App\Bll\Utility::getStoreId()])->first();
        if ($store == null) {

            abort(404);
        }
 
        $shippingcompanies = shippingCompanies::where('store_id', $store->id)->get();
        $sliders = Slider::where('published', '=', 1)->where('store_id', $store->id)->get();

        $brands = Brand::where('published', '=', 1)->where('store_id', $store->id)->orderByDesc('id')->limit(12)->get();

        $category = Category::where('lang_id', getLang(session('lang')))->where('store_id', $store->id)->get();

        $setting1 = Setting::
        leftJoin('settings_data', 'settings.id', '=', 'settings_data.setting_id')
            ->select('settings_data.id as id',
                'settings_data.title as title',
                'settings_data.lang_id as lang_id',
                'settings.logo as logo',
                'settings.facebook_url as facebook_url',
                'settings.twitter_url as twitter_url',
                'settings.instagram_url as instagram_url')
            ->where('store_id', session()->get('StoreId'))->where('settings_data.lang_id', \App\Bll\Utility::storeLang())->get();

        $products = DB::table('products')
            ->where('store_id', $store->id)
            ->where('products.max_count', '>', 0)
            ->join('product_details', 'product_details.product_id', '=', 'products.id')
            ->join('product_photos', 'product_photos.product_id', '=', 'products.id')
//            ->where('product_photos.main', 1)
            // ->where('product_details.lang_id', getLang(LaravelGettext::getLocale()))
            ->orderBy('products.id', 'desc')
            ->select('products.*', 'products.price', 'product_details.title', 'product_details.description', 'product_details.lang_id',
                'product_details.source_id', 'product_photos.photo', 'product_photos.tag')
            ->limit(8)
            ->get();
        //  dd($products);
        $latest_products = DB::table('products')
            ->where('store_id', $store->id)
            ->where('products.max_count', '>', 0)
            ->join('product_details', 'product_details.product_id', '=', 'products.id')
            ->join('product_photos', 'product_photos.product_id', '=', 'products.id')
            ->where('product_photos.main', 1)
            ->where('product_details.lang_id', getLang(LaravelGettext::getLocale()))
            ->orderBy('products.id', 'desc')
            ->select('products.*', 'products.price', 'product_details.title', 'product_details.description', 'product_details.lang_id',
                'product_details.source_id', 'product_photos.photo', 'product_photos.tag')
            ->limit(3)
            ->get();  
//        $articles = DB::table('articles')->where('published' , 1)->paginate(12);
        if (!empty(banner(5)->category_id)) {
            $category = Category::where('id', banner(5)->category_id)->where('store_id', $store->id)->where('lang_id', 1)->first();
            $category_products = DB::table('categories_products')
                ->leftJoin('products', 'products.id', 'categories_products.product_id')
                ->join('product_details', 'product_details.product_id', '=', 'products.id')
                ->join('product_photos', 'product_photos.product_id', '=', 'products.id')
                ->where('product_photos.main', 1)
                ->where('products.store_id', $store->id)
                ->where('product_details.lang_id', getLang(LaravelGettext::getLocale()))
                ->where('category_id', $category->id)
                ->orderBy('products.id', 'desc')
                ->limit(8)
                ->get();

      
            if(Utility::getTemplateCode()=="shade")
            {        $categories = Category::where('lang_id', getLang(LaravelGettext::getLocale()))->where('store_id', $store->id)->latest()->paginate(20);

              return view('store.categories.categories', compact('sliders', 'brands', 'products', 'category_products', 'latest_products','categories'));

            }
            return view('store.home', compact('sliders', 'brands', 'products', 'category_products', 'latest_products'));
        }

        $contentSection = Content_section::
        where([
            ['store_id', $store->id],
        ])->with(['contentTitle' => function ($q) {
            $q->where('lang_id', '=', getLang(session('lang')));
        }])->with(['content_data' => function ($query) {
            $query->where('lang_id', '=', getLang(session('lang')));
        }])->get();

//        dd($contentSection);
        //        $contentSection = Content_section::
        //        leftJoin('content_sections_data','content_sections.id','=','content_sections_data.section_id')
        //            ->where([
        //                ['store_id',$id],
        //                ['lang_id',getLang(session('lang'))],
        //            ])
        //            ->select('content_sections.*','content_sections_data.lang_id','content_sections_data.content')
        //        ->groupBy('id')->get();
        //        dd($contentSection);

        $content = Content_section::orderBy('order', "asc")->where('type', 'home')->where('store_id', \App\Bll\Utility::getStoreId())->get();
        //dd($content);
       
 if(Utility::getTemplateCode()=="shade")
            {
             //$categories = Category::where('lang_id', getLang(session('lang')))->where('store_id', $store->id)->get();
        $categories = Category::where('lang_id', getLang(LaravelGettext::getLocale()))->where('store_id', $store->id)->latest()->paginate(20);

             return view('store.categories.categories', compact('sliders', 'shippingcompanies', 'store', 'categories',
            'category', 'brands', 'setting1', 'products', 'latest_products', 'contentSection', 'content'));

            }
        return view('store.home', compact('sliders', 'shippingcompanies', 'store', 'categories',
            'category', 'brands', 'setting1', 'products', 'latest_products', 'contentSection', 'content'));
    }

    public function ratingProduct()
    {

        // $product = products::findOrFail($id);
        // dd($product);
        // $rating = rating::where('product_id', $pro)->first();

        $store = stores::where(['id' => \App\Bll\Utility::getStoreId()])->first();
        if ($store == null) {

            abort(404);
        }

        $storeOptions = Utility::storeOptions(\App\Bll\Utility::getStoreId())->first();
        if ($storeOptions != null) {
            if ($storeOptions->product_outStock == 1) {
                $products_orders = order_products::
                leftJoin('orders', 'orders.id', '=', 'order_products.order_id')
                    ->leftJoin('products', 'products.id', '=', 'order_products.product_id')
                    ->leftJoin('product_details', 'products.id', '=', 'product_details.product_id')
                    ->leftJoin('product_photos', 'products.id', '=', 'product_photos.product_id')
                    ->select('orders.ordernumber as number', 'order_products.price as price', 'order_products.count as count', 'product_details.title as productname', 'product_photos.photo as image', 'product_details.description as description', 'products.id as id')
                    ->where('product_photos.main', 1)
                    ->where('orders.store_id', $store->id)
                    ->where('orders.user_id', auth()->guard('web')->user()->id)
                    ->where('product_details.lang_id', getLang(session('lang')))
                    ->get();
            } else {
                $products_orders = order_products::
                leftJoin('orders', 'orders.id', '=', 'order_products.order_id')
                    ->leftJoin('products', 'products.id', '=', 'order_products.product_id')
                    ->leftJoin('product_details', 'products.id', '=', 'product_details.product_id')
                    ->leftJoin('product_photos', 'products.id', '=', 'product_photos.product_id')
                    ->select('orders.ordernumber as number', 'order_products.price as price', 'order_products.count as count', 'product_details.title as productname', 'product_photos.photo as image', 'product_details.description as description', 'products.id as id')
                    ->where('product_photos.main', 1)
                    ->where('products.max_count', '>', 0)
                    ->where('orders.store_id', $store->id)
                    ->where('orders.user_id', auth()->guard('web')->user()->id)
                    ->where('product_details.lang_id', getLang(session('lang')))
                    ->get();
            }
        } else {
            $products_orders = order_products::
            leftJoin('orders', 'orders.id', '=', 'order_products.order_id')
                ->leftJoin('products', 'products.id', '=', 'order_products.product_id')
                ->leftJoin('product_details', 'products.id', '=', 'product_details.product_id')
                ->leftJoin('product_photos', 'products.id', '=', 'product_photos.product_id')
                ->select('orders.ordernumber as number', 'order_products.price as price', 'order_products.count as count', 'product_details.title as productname', 'product_photos.photo as image', 'product_details.description as description', 'products.id as id')
                ->where('product_photos.main', 1)
                ->where('products.max_count', '>', 0)
                ->where('orders.store_id', $store->id)
                ->where('orders.user_id', auth()->guard('web')->user()->id)
                ->where('product_details.lang_id', getLang(session('lang')))
                ->get();
        }


        return view('store.rating.index', compact('products_orders'));
    }


    public function rating(Request $request)
    {
        if ($request->ajax()) {
            $user = User::findOrFail($request->user);
            $exists = rating::where('product_id', $request->product)->exists();
            if ($exists) {
                $rating = rating::where('product_id', $request->product)->first();
                $exuserRating = userRating::where('rating_id', $rating['id'])->where('user_id', $request->user)->where('store_id', $request->store)->where('approve', 1)->exists();
                if (!$exuserRating) {
                    $user->ratings()->attach($rating['id'], ['rating' => $request->stars, 'store_id' => $request->store]);
                } else {
                    $user->ratings()->updateExistingPivot($rating['id'], ['rating' => $request->stars]);
                }
            } else {
                $rating = rating::create(['product_id' => $request->product]);
                $user->ratings()->attach($rating['id'], ['rating' => $request->stars]);
            }

            $userRating = userRating::where('rating_id', $rating['id'])->where('user_id', $request->user)->where('store_id', $request->store)->where('rating', $request->stars)->where('approve', 0)->first();
            //dd($userRating);
            return response()->json($userRating);
            //view('store.rating.index')->with('userRating', json_decode($userRating, true));
        }
    }


    public function article_categories()
    {
        $store = stores::findOrFail(\App\Bll\Utility::getStoreId());

        $setting1 = Setting::
        leftJoin('settings_data', 'settings.id', '=', 'settings_data.setting_id')
            ->select('settings_data.id as id',
                'settings_data.title as title',
                'settings_data.lang_id as lang_id',
                'settings.logo as logo',
                'settings.facebook_url as facebook_url',
                'settings.twitter_url as twitter_url',
                'settings.instagram_url as instagram_url')
            ->where('store_id', session()->get('StoreId'))->where('settings_data.lang_id', \App\Bll\Utility::storeLang())->get();

        $categories = \App\Models\Article\ArticleCategory::leftJoin('article_category_data', 'article_category_data.category_id', 'article_category.id')
            ->select('article_category.*', 'article_category_data.title')
            ->where('article_category_data.lang_id', getLang(app()->getLocale()))
            ->where('article_category.published', 1)
            ->where('article_category.store_id', \App\Bll\Utility::getStoreId())
            ->orderBy('article_category.id', 'desc')->paginate(6);


        return view('store.article.article_categories', compact('categories', 'store', 'setting1'));
    }

    public function article_cat($locale = null, $cat_id)
    {
        $store = stores::findOrFail(\App\Bll\Utility::getStoreId());
        $setting1 = Setting::
        leftJoin('settings_data', 'settings.id', '=', 'settings_data.setting_id')
            ->select('settings_data.id as id',
                'settings_data.title as title',
                'settings_data.lang_id as lang_id',
                'settings.logo as logo',
                'settings.facebook_url as facebook_url',
                'settings.twitter_url as twitter_url',
                'settings.instagram_url as instagram_url')
            ->where('store_id', session()->get('StoreId'))->where('settings_data.lang_id', \App\Bll\Utility::storeLang())->get();

        $category = ArticleCategory::leftJoin('article_category_data', 'article_category_data.category_id', 'article_category.id')
            ->select('article_category_data.lang_id', 'article_category_data.title')
            ->where('article_category_data.lang_id', getLang(session('lang')))
            ->where('article_category.id', $cat_id)
            ->where('article_category.store_id', \App\Bll\Utility::getStoreId())
            ->first();

        $articles = Article::leftJoin('articles_data', 'articles_data.article_id', 'articles.id')
            ->select('articles.*', 'articles_data.article_id', 'articles_data.lang_id', 'articles_data.source_id',
                'articles_data.title', 'articles_data.content')
            ->where('articles.category_id', $cat_id)
            ->where('articles_data.lang_id', getLang(session('lang')))
            ->where('articles.published', 1)
            ->where('articles.store_id', Utility::getStoreId())
            ->orderBy('articles.id', 'desc')->paginate(6);

        return view('store.article.articles', compact('articles', 'store', 'setting1', 'category'));
    }

    public function article($locale = null, $article_id)
    {
        $store = stores::findOrFail(\App\Bll\Utility::getStoreId());

        $setting1 = Setting::
        leftJoin('settings_data', 'settings.id', '=', 'settings_data.setting_id')
            ->select('settings_data.id as id',
                'settings_data.title as title',
                'settings_data.lang_id as lang_id',
                'settings.logo as logo',
                'settings.facebook_url as facebook_url',
                'settings.twitter_url as twitter_url',
                'settings.instagram_url as instagram_url')
            ->where('store_id', session()->get('StoreId'))->where('settings_data.lang_id', \App\Bll\Utility::storeLang())->get();


        $article = Article::leftJoin('articles_data', 'articles_data.article_id', 'articles.id')
            ->select('articles.*', 'articles_data.article_id', 'articles_data.lang_id', 'articles_data.source_id',
                'articles_data.title', 'articles_data.content', 'articles.category_id')
            ->where('articles.id', $article_id)
            ->where('articles_data.lang_id', getLang(session('lang')))
            ->where('articles.store_id', \App\Bll\Utility::getStoreId())
            ->where('articles.published', 1)
            ->first();

        if ($article == null) {
            return view('store_notFound');
        }

        $category = ArticleCategory::leftJoin('article_category_data', 'article_category_data.category_id', 'article_category.id')
            ->select('article_category_data.lang_id', 'article_category_data.title', 'article_category.id')
            ->where('article_category.id', $article->category_id)
            ->where('article_category_data.lang_id', getLang(session('lang')))
            ->first();

        if ($category == null) {
            return view('store_notFound');
        }

        $articles = Article::leftJoin('articles_data', 'articles_data.article_id', 'articles.id')
            ->select('articles.*', 'articles_data.article_id', 'articles_data.lang_id', 'articles_data.source_id',
                'articles_data.title', 'articles.category_id')
            ->where('articles.category_id', $article->category_id)
            ->where('articles.id', "!=", $article_id)
            ->where('articles_data.lang_id', getLang(session('lang')))
            ->where('articles.published', 1)
            ->take(4)->get();
//        if ($category == null) {
//            return view('not_found');
//        }


        return view('store.article.single-article', compact('article', 'setting1', 'store', 'category', 'articles'));
    }

    public function page($locale = null, $page_id)
    {

        $found = Page::where('id', $page_id)->first();
        if ($found != null) {
            $page = Page::leftJoin('pages_data', 'pages_data.page_id', 'pages.id')
                ->where('pages.store_id', Utility::getStoreId())
                ->where('pages.id', $page_id)
                ->where('pages_data.lang_id', getLang(app()->getLocale()))
                ->select('pages.*', 'pages_data.title as title', 'pages_data.content as content')->first();
            if ($page != null) {
                return view('store.article.page', compact('found', 'page'));
            } else {
                return view('store_notFound');
            }
        } else {
            return view('store.article.page', compact('found'));
        }
    }

    public function all_products()
    {

        $store = stores::findOrFail(\App\Bll\Utility::getStoreId());

        $storeOptions = Utility::storeOptions(\App\Bll\Utility::getStoreId())->first();
        if ($storeOptions != null) {
            if ($storeOptions->product_outStock == 1) {
                $products = DB::table('products')
                    ->where('store_id', $store->id)
//                    ->where('products.max_count', '>', 0)
                    ->join('product_details', 'product_details.product_id', '=', 'products.id')
                    ->join('product_photos', 'product_photos.product_id', '=', 'products.id')
                    ->where('product_photos.main', 1)
                    ->where('product_details.lang_id', getLang(LaravelGettext::getLocale()))
                    ->orderBy('products.id', 'desc')
                    ->select('products.*', 'product_details.title', 'product_photos.photo')
                    ->paginate(12);
            } else {
                $products = DB::table('products')
                    ->where('store_id', $store->id)
                    ->where('products.max_count', '>', 0)
                    ->join('product_details', 'product_details.product_id', '=', 'products.id')
                    ->join('product_photos', 'product_photos.product_id', '=', 'products.id')
                    ->where('product_photos.main', 1)
                    ->where('product_details.lang_id', getLang(LaravelGettext::getLocale()))
                    ->orderBy('products.id', 'desc')
                    ->select('products.*', 'product_details.title', 'product_photos.photo')
                    ->paginate(12);
            }
        } else {
            $products = DB::table('products')
                ->where('store_id', $store->id)
                ->where('products.max_count', '>', 0)
                ->join('product_details', 'product_details.product_id', '=', 'products.id')
                ->join('product_photos', 'product_photos.product_id', '=', 'products.id')
                ->where('product_photos.main', 1)
                ->where('product_details.lang_id', getLang(LaravelGettext::getLocale()))
                ->orderBy('products.id', 'desc')
                ->select('products.*', 'product_details.title', 'product_photos.photo')
                ->paginate(12);
        }

//        dd($products);

        return view('store.product.products', compact('products'));
    }

    public function single_product($locale = null, $pro)
    {
        $store = stores::findOrFail(\App\Bll\Utility::getStoreId());
        $storeOptions = Utility::storeOptions(\App\Bll\Utility::getStoreId())->first();
        if ($storeOptions != null) {
            if ($storeOptions->product_outStock == 1) {
                $product = products::where("id", $pro)->where("store_id", \App\Bll\Utility::getStoreId())->first();
            } else {
                $product = products::where("id", $pro)->where("store_id", \App\Bll\Utility::getStoreId())->where('max_count', '>', 0)->first();
            }
        } else {
            $product = products::where("id", $pro)->where("store_id", \App\Bll\Utility::getStoreId())->where('max_count', '>', 0)->first();
        }

        $input = route('store.home', app()->getLocale());
        // remove www
        $domain = preg_replace('#^https?://#', '', rtrim($input, '/'));
        $storeName = request()->getScheme() . ':' . '//' . $domain;

        //get seo data
        SEOMeta::setTitle(Utility::storeSeo(\App\Bll\Utility::getStoreId(), $product->id, get_class($product)) ? Utility::storeSeo(\App\Bll\Utility::getStoreId(), $product->id, get_class($product))['meta_title'] : '');
        SEOMeta::setDescription(Utility::storeSeo(\App\Bll\Utility::getStoreId(), $product->id, get_class($product)) ? Utility::storeSeo(\App\Bll\Utility::getStoreId(), $product->id, get_class($product))['meta_description'] : '');
        SEOMeta::setCanonical($storeName);
        SEOMeta::addMeta(
            'article:published_time',
            'property');
        SEOMeta::addMeta(
            'article:section',
            'property');
        //with facebook
        OpenGraph::setDescription(Utility::storeSeo(\App\Bll\Utility::getStoreId(), $product->id, get_class($product)) ? Utility::storeSeo(\App\Bll\Utility::getStoreId(), $product->id, get_class($product))['meta_description'] : '');
        OpenGraph::setTitle(Utility::storeSeo(\App\Bll\Utility::getStoreId(), $product->id, get_class($product)) ? Utility::storeSeo(\App\Bll\Utility::getStoreId(), $product->id, get_class($product))['meta_title'] : '');
        OpenGraph::setUrl(route('product_url', [app()->getLocale(), $product->id]));
        OpenGraph::addProperty('type', 'product');
        OpenGraph::addProperty('locale', app()->getLocale());
        OpenGraph::addProperty('locale:alternate', ['ar', 'en']);
        OpenGraph::addImage(['url' => asset($product->mainPhoto()), 'size' => 300]);
        OpenGraph::addImage(asset($product->mainPhoto()), ['height' => 300, 'width' => 300]);
        // twitter
        TwitterCard::setTitle(Utility::storeSeo(\App\Bll\Utility::getStoreId(), $product->id, get_class($product)) ? Utility::storeSeo(\App\Bll\Utility::getStoreId(), $product->id, get_class($product))['meta_title'] : '');
        TwitterCard::setSite('@#');

        if ($product == null)
            abort(404);
        $features = features::where('product_id', $product->id)->get();
//        dd($features);
        $rating = rating::where('product_id', $pro)->first();
        $product_details = product_details::where('product_id', $product->id)->where('lang_id', getLang(LaravelGettext::getLocale()))->first();
        //        $product_type = Product_type::where('id', $product->product_type)->where('lang_id', getLang(LaravelGettext::getLocale()))->first();

        $product_photos = product_photos::where('product_id', $product->id)->get();
        //        $similar_products = products::where('product_type' ,$product_type->id)->orderBy(DB::raw('RAND()'))->take(6)->get();
        // $similar_products = products::where('max_count', '>', 0)->where('store_id', $store->id)->orderBy('id', 'desc')->take(6)->get();

        $similar_productss = DB::table('categories_products')->where('product_id', $product->id)->pluck('category_id')->toArray();

        $storeOptions = Utility::storeOptions(\App\Bll\Utility::getStoreId())->first();
        if ($storeOptions != null) {
            if ($storeOptions->product_outStock == 1) {
                $similar_products = DB::table('categories_products')->whereIn('category_id', $similar_productss)
                    ->leftJoin('products', 'categories_products.product_id', '=', 'products.id')
                    ->leftJoin('product_details', 'product_details.product_id', '=', 'products.id')
                    ->leftJoin('product_photos', 'product_photos.product_id', '=', 'products.id')
                    ->select('products.*', 'products.price as pricepro', 'product_details.title as titlepro', 'product_details.description as descriptionpro', 'product_details.lang_id',
                        'product_details.source_id', 'product_photos.photo as photopro', 'product_photos.tag')
                    ->groupBy('products.id')
                    ->where('store_id', \App\Bll\Utility::getStoreId())
                    ->where('products.id', '!=', $product->id)
                    ->get();
            } else {
                $similar_products = DB::table('categories_products')->whereIn('category_id', $similar_productss)
                    ->leftJoin('products', 'categories_products.product_id', '=', 'products.id')
                    ->leftJoin('product_details', 'product_details.product_id', '=', 'products.id')
                    ->leftJoin('product_photos', 'product_photos.product_id', '=', 'products.id')
                    ->select('products.*', 'products.price as pricepro', 'product_details.title as titlepro', 'product_details.description as descriptionpro', 'product_details.lang_id',
                        'product_details.source_id', 'product_photos.photo as photopro', 'product_photos.tag')
                    ->groupBy('products.id')
                    ->where('store_id', \App\Bll\Utility::getStoreId())
                    ->where('products.id', '!=', $product->id)
                    ->where('products.max_count', '>', 0)
                    ->get();
            }
        } else {
            $similar_products = DB::table('categories_products')->whereIn('category_id', $similar_productss)
                ->leftJoin('products', 'categories_products.product_id', '=', 'products.id')
                ->leftJoin('product_details', 'product_details.product_id', '=', 'products.id')
                ->leftJoin('product_photos', 'product_photos.product_id', '=', 'products.id')
                ->select('products.*', 'products.price as pricepro', 'product_details.title as titlepro', 'product_details.description as descriptionpro', 'product_details.lang_id',
                    'product_details.source_id', 'product_photos.photo as photopro', 'product_photos.tag')
                ->groupBy('products.id')
                ->where('store_id', \App\Bll\Utility::getStoreId())
                ->where('products.id', '!=', $product->id)
                ->where('products.max_count', '>', 0)
                ->get();
        }

        //dd($similar_products);

        $single_products = [];
        foreach ($similar_products as $single) {
            $single_product_details = product_details::where('product_id', $single->id)->whereHas('product', function ($query) {
                $query->where('max_count', '<=', 0);
            })->where('lang_id', getLang(LaravelGettext::getLocale()))->first();

//            $single_product_type = Product_type::where('id', $single->product_type)->where('lang_id', getLang(LaravelGettext::getLocale()))->first();

            $single_product_main_photo = product_photos::where('product_id', $single->id)->where('main', 1)->first();
            $single_product = [
                'product_id' => $single->id,
                'product_price' => $single->price,
                'discount' => $single->discount,
                'product_title' => $single_product_details['title'],
//              'product_type' => $single_product_type->title,
                'product_photo' => $single_product_main_photo['photo'],
            ];

            $single_products[] = $single_product;
        }
        if (auth()->user() !== null) {
            $auth_user_comment = Comment::whereProductsId($product->id)->whereUserId(auth()->user()->id)->first();
        } else {
            $auth_user_comment = null;
        }
        return view('store.product.single-product', compact('features', 'rating', 'store', 'product', 'product_details', 'product_photos', 'similar_products', 'single_products', 'auth_user_comment'));
    }


    public function categories()
    {
        $store = stores::findOrFail(\App\Bll\Utility::getStoreId());
        $categories = Category::where('lang_id', getLang(LaravelGettext::getLocale()))->where('store_id', $store->id)->latest()->paginate(20);
        return view('store.categories.categories', compact('categories'));
    }

    public function category_product($locale = null, $id)
    {

        $store = stores::findOrFail(\App\Bll\Utility::getStoreId());
        $category = Category::findOrFail($id);
        $children = $category->children->where('lang_id', getLang(LaravelGettext::getLocale()))->pluck('id')->toArray();
        $storeOptions = Utility::storeOptions(\App\Bll\Utility::getStoreId())->first();
        if ($storeOptions != null) {
            if ($storeOptions->product_outStock == 1) {
                $category_products = products::whereHas('categories', function ($query) use ($id, $children) {
                    $query->where('category_id', $id)->OrWhereIn('category_id', $children);
                })
                    ->leftJoin('categories_products', 'categories_products.product_id', 'products.id')
                    ->where('store_id', $store->id)
                    ->join('product_details', 'product_details.product_id', '=', 'products.id')
                    ->join('product_photos', 'product_photos.product_id', '=', 'products.id')
                    ->where('product_photos.main', 1)
                    ->where('product_details.lang_id', getLang(app()->getLocale()))
                    ->orderBy('categories_products.sort', 'asc')
                    ->select('products.id as product_id', 'products.price', 'products.discount', 'product_details.title', 'product_photos.photo', 'products.currency_code')
                    ->paginate(12);
            } else {
                $category_products = products::whereHas('categories', function ($query) use ($id, $children) {
                    $query->where('category_id', $id)->OrWhereIn('category_id', $children);
                })
                    ->leftJoin('categories_products', 'categories_products.product_id', 'products.id')
                    ->where('store_id', $store->id)
                    ->where('products.max_count', '>', 0)
                    ->join('product_details', 'product_details.product_id', '=', 'products.id')
                    ->join('product_photos', 'product_photos.product_id', '=', 'products.id')
                    ->where('product_photos.main', 1)
                    ->where('product_details.lang_id', getLang(app()->getLocale()))
                    ->orderBy('categories_products.sort', 'asc')
                    ->select('products.id as product_id', 'products.price', 'products.discount', 'product_details.title', 'product_photos.photo', 'products.currency_code')
                    ->paginate(12);
            }
        } else {
            $category_products = products::whereHas('categories', function ($query) use ($id, $children) {
                $query->where('category_id', $id)->OrWhereIn('category_id', $children);
            })
                ->leftJoin('categories_products', 'categories_products.product_id', 'products.id')
                ->where('store_id', $store->id)
                ->where('products.max_count', '>', 0)
                ->join('product_details', 'product_details.product_id', '=', 'products.id')
                ->join('product_photos', 'product_photos.product_id', '=', 'products.id')
                ->where('product_photos.main', 1)
                ->where('product_details.lang_id', getLang(app()->getLocale()))
                ->orderBy('categories_products.sort', 'asc')
                ->select('products.id as product_id', 'products.price', 'products.discount', 'product_details.title', 'product_photos.photo', 'products.currency_code')
                ->paginate(12);
        }

        return view('store.categories.category_product', compact('category_products'));
    }

    public function sendComment(Request $request)
    {
        $data = $this->validate($request, [
            'comment' => 'required',
        ]);
        //$rating = rating::where('product_id', $request->id)->first();
        //$userRating = userRating::where('rating_id', $rating['id'])->where('user_id', auth()->id())->first();
        if (auth()->user() !== null) {
            $request->merge(['user_id' => auth()->user()->id]);
        }
        $request->merge(['published' => 0]);
        $comment = Comment::create($request->all());

        if (auth()->user() != null) {
            $username = auth()->user();
        } else {
            $username = 'Visitor';
        }
        $sessionStore = session()->get('StoreId');

        $store = stores::where('id', $sessionStore)->first();
        $adminStore = User::where('id', $store->owner_id)->first();

        $details = [

            'comment_id' => $comment->id,
            'comment' => $comment->comment,
            'username' => $username,
        ];

        Notification::send($adminStore, new ReviweNotification($details));

        return response()->json($comment);
    }


    function addToFavorite(Request $request)
    {
        if ($request->ajax()) {
            $productId = $request->productId;
            $user = auth()->user();
            $product = products::findOrFail($productId);
            $user->toggleFavorite($product);
            return response()->json($product->isFavorited());
        }
    }

    public function favorite(Request $request)
    {
        $user = auth()->user();
        if (auth()->check()) {
            $products = $user->favorite(products::class)->where("store_id", Utility::getStoreId());

            return view('store.favorite.index', compact('products', 'product'));
        }
    }

    public function category($id)
    {
        // dd(session()->all());
        $sid = session()->get("StoreId");
        $store = stores::where(['id' => $sid])->first();
        $category = Category::where('id', $id)->where('store_id', $store->id)->first();
        $children = $category->children->where('lang_id', getLang(LaravelGettext::getLocale()))->pluck('id')->toArray();

        $storeOptions = Utility::storeOptions(\App\Bll\Utility::getStoreId())->first();
        if ($storeOptions != null) {
            if ($storeOptions->product_outStock == 1) {
                $products = products::whereHas('categories', function ($query) use ($id, $children) {
                    $query->where('category_id', $id)->OrWhereIn('category_id', $children);
                })
                    ->where('store_id', $store->id)
                    ->join('product_details', 'product_details.product_id', '=', 'products.id')
                    ->join('product_photos', 'product_photos.product_id', '=', 'products.id')
                    ->where('product_photos.main', 1)
                    ->where('product_details.lang_id', getLang(LaravelGettext::getLocale()))
                    ->orderBy('products.id', 'desc')
                    ->select('products.id as product_id', 'products.price', 'products.discount', 'product_details.title', 'product_photos.photo')
                    ->paginate(12);
            } else {
                $products = products::whereHas('categories', function ($query) use ($id, $children) {
                    $query->where('category_id', $id)->OrWhereIn('category_id', $children);
                })
                    ->where('store_id', $store->id)
                    ->where('products.max_count', '>', 0)
                    ->join('product_details', 'product_details.product_id', '=', 'products.id')
                    ->join('product_photos', 'product_photos.product_id', '=', 'products.id')
                    ->where('product_photos.main', 1)
                    ->where('product_details.lang_id', getLang(LaravelGettext::getLocale()))
                    ->orderBy('products.id', 'desc')
                    ->select('products.id as product_id', 'products.price', 'products.discount', 'product_details.title', 'product_photos.photo')
                    ->paginate(12);
            }
        } else {
            $products = products::whereHas('categories', function ($query) use ($id, $children) {
                $query->where('category_id', $id)->OrWhereIn('category_id', $children);
            })
                ->where('store_id', $store->id)
                ->where('products.max_count', '>', 0)
                ->join('product_details', 'product_details.product_id', '=', 'products.id')
                ->join('product_photos', 'product_photos.product_id', '=', 'products.id')
                ->where('product_photos.main', 1)
                ->where('product_details.lang_id', getLang(LaravelGettext::getLocale()))
                ->orderBy('products.id', 'desc')
                ->select('products.id as product_id', 'products.price', 'products.discount', 'product_details.title', 'product_photos.photo')
                ->paginate(12);
        }


        return view('store.search_result', compact('products', 'setting1', 'store'));
    }

// public function single_article($id)
// {
//     $store =  stores::findOrFail(\App\Bll\Utility::getStoreId());
//     $article = Article::findOrFail($id);
//     $article_data = Article_data::where('source_id', $article->id)->where('store_id', $store->id)->where('lang_id', getLang(LaravelGettext::getLocale()))->first();
//     $artice_category_id = $article->category_id;

//     $same_articles = Article::where('lang_id', getLang(LaravelGettext::getLocale()))->where('store_id', $store->id)->where('category_id', $artice_category_id)->take(5)->orderByRaw('RAND()')->get();

//     return view('store.article.single-article', compact('article', 'article_data', 'same_articles'));
// }

    public function lang($lang)
    {
        // dd($lang , app()->getLocale() ,session()->get('lang') ,  LaravelGettext::getLocale() , url()->previous());
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
        return redirect($redir);

//        session()->has('lang') ? session()->forget('lang') : '';
//        $lang == 'es_AR' ? session()->put('lang', 'es_AR') : session()->put('lang', 'en_US');
//        return back();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('store.home', app()->getLocale());
    }

    public function send(Request $request)
    {
        $messages = Message::create([
            'from' => auth()->user()->id,
            'to' => $request->contact_id,
            'text' => $request->text['data']['text'],
        ]);
        broadcast(new NewMessage($messages));
        return response()->json($messages);
    }

    public function storeMaintenance()
    {
        return view('store.maintenance');
    }

}
