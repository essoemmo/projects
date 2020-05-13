<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

use Illuminate\Support\Facades\Route;

Route::get('testt', 'Front\HomeController@test');
Route::get('storeMaintenance', 'web\store\HomeController@storeMaintenance')->name('storeMaintenance');


Route::group(['middleware' => ['isSubDomain', 'lang', 'demoCheck', 'storeMaintenance']], function () {
    // Route::auth();
    // Routes
    // dd(0);

    Route::get('{lang}/store/lang', 'web\store\HomeController@lang');
    /* ====================== this route used to return locale language ====================== */
//    Route::get('/', function () {
//       // return redirect(app()->getLocale());
//        return redirect(url(app()->getLocale()).'/home');
//    });

//    Route::get('/home', function () {
//        return redirect(url(app()->getLocale()).'/home');
//    });


    Route::group([
        'prefix' => '{locale}',
        'where' => ['locale' => '[a-zA-Z]{2}'],
        'middleware' => 'setlocale'
    ], function () {


        /* ====================== user change password ====================== */
        Route::put('/user/update_password', 'web\store\UserController@updatePassword')->name('update-new'); // show form => update password


        Route::post('sendComment', 'web\store\HomeController@sendComment')->name('sendcomment2');
        Route::post('send', 'web\store\HomeController@send2')->name('send2');
        Route::post('rating', 'web\store\HomeController@rating2')->name('rating2');

//    Route::get('login', [
//        'as' => 'login',
//        'uses' => 'Auth\LoginController@showLoginForm',
//        'middleware' => \App\Http\Middleware\isSubDomain::class
//    ]);
        Route::get('store/login', 'Auth\store\LoginController@showLoginForm')->name('signin');
        Route::post('store/login', 'Auth\store\LoginController@login')->name('store_login');
        Route::get('store/register', 'Auth\store\RegisterController@showRegistrationForm')->name('register');
        Route::get('store/logout', 'web\store\HomeController@logout')->name('store_logout');
        Route::post('store/register', 'Auth\store\RegisterController@register')->name('store_register');
        Route::get('store/cart', 'web\store\CartController@cart')->name('store.cart');
        Route::post('store/add-to-cart', 'web\store\CartController@addToCart')->name('store_add_cart');
        Route::get('/search', 'web\store\SearchController@search')->name('store_search');
        Route::get('store/category/{id}', 'web\store\HomeController@category_product')->name('store_category_product');
        // Route::get('store/category/{id}', 'web\store\HomeController@category')->name('store_category_product');
        Route::post('store/subscribe/newsletters', 'web\store\NewsLetterController@userSubscribeNewsLetters')->name('user_subscribe'); // user subscribe news letters
        Route::post('store/notsubscribe', 'web\store\NewsLetterController@deleteSubscriber')->name('user_subscribe_delete'); // delete subscriber from news letters
        Route::get('store/blog_cats', 'web\store\HomeController@article_categories'); // all article categories
        Route::get('store/blog_cat/{cat_id}', 'web\store\HomeController@article_cat'); // all article under custom category
        Route::get('store/blog/{article_id}', 'web\store\HomeController@article'); // all article under custom category
        Route::get('store/page/{page_id}', 'web\store\HomeController@page');
// check out routes
        Route::get('store/checkout', 'web\store\checkOutController@checkout')->name('store.checkout');
        Route::get('store/myfatoorah/finish', 'web\store\checkOutController@myfatoorahFinish')->name('myfatoorah.finish');
        Route::get('store/get-city-list', 'web\store\checkOutController@getCityList');
        Route::get('store/getBankDetails', 'web\store\checkOutController@getBankDetails');
        Route::post('store/getShipCost', 'web\store\checkOutController@getShipCost');
        Route::get('/home', 'web\store\HomeController@home')->name('store.home');

        Route::get('sitemap.xml', 'Front\SiteMapController@StoreSiteMap')->name('storeSiteMap');
        Route::get('sitemap.xml/products', 'Front\SiteMapController@StoreProducts');
        Route::get('sitemap.xml/categories', 'Front\SiteMapController@StoreCategories');

        // verify email
        Route::get('verify/{id}', 'Auth\store\RegisterController@verify')->name('store.verify');

        Route::group(['prefix' => 'store'], function () {
            //Route::get('lang', 'web\store\HomeController@lang');

            Route::get('product/{pro}', 'web\store\HomeController@single_product')->name("product_url");
            Route::get('/login/redirect/{provider}', 'web\store\SocialController@redirect');
            Route::get('/login/{provider}', 'web\store\SocialController@callback');
            Route::get('product', 'web\store\HomeController@all_products')->name("products_all");
            Route::get('/categories', 'web\store\HomeController@categories');

            Route::get('/contact', 'web\store\ContactController@showContactForm')->name('store_contact_url');
            Route::post('/contact', 'web\store\ContactController@storeContact')->name('store_contact');

            Route::get('/check-features-option', 'web\store\CheckController@checkFeaturesOption')->name('checkFeaturesOption');
            Route::post('/update-cart', 'web\store\CartController@update')->name('store_update_cart');
            Route::post('/update-cart-features', 'web\store\CartController@updateFeatures')->name('store_update_cart_features');
            Route::post('/remove-form-cart/{id}', 'web\store\CartController@remove')->name('store_remove_cart');

            Route::group(['middleware' => 'auth:web'], function () {
                Route::post('send', 'web\store\HomeController@send');
                Route::post('sendComment', 'web\store\HomeController@sendComment')->name('sendcomment');
                Route::post('addToFavorite', 'web\store\HomeController@addToFavorite')->name('addfavorite');
                Route::get('/favorite', 'web\store\HomeController@favorite')->name('favorite');
                Route::get('/profile', 'web\store\UserController@showProfileForm')->name('profile');
                Route::post('/profile', 'web\store\UserController@profile')->name('myprofile');
                Route::get('/myofflineorders', 'web\store\UserController@myOfflineOrders')->name('myofflineorders');
                Route::get('/myorders', 'web\store\UserController@myOrders')->name('myorders');
                Route::get('/myorders/show/{id}', 'web\store\UserController@showorder')->name('myorders.show');

                Route::post('/getDiscount', 'web\store\checkOutController@getDiscount')->name('getDiscount');

                Route::get('/ratingProducts', 'web\store\HomeController@ratingProduct')->name('ratingpro');
                Route::post('rating', 'web\store\HomeController@rating')->name('rating');

                Route::get('get-shippingOption-list', 'web\store\checkOutController@getShippingOptionList');

                Route::get('bank-details', 'web\store\checkOutController@bankDetails');
                Route::post('myfatoorah', 'web\store\checkOutController@myfatoorah')->name('myfatoorah');
                Route::post('execute_payment_cart', 'web\store\checkOutController@execute_payment')->name('execute_payment_cart');

                Route::post('saveallorders', 'web\store\checkOutController@saveallorders');
                Route::get('invoice', 'web\store\checkOutController@invoice')->name('invoice');
                Route::get('confirm', 'web\store\checkOutController@confirm');
            });

            /* ====================== user reset password ====================== */
            Route::get('/reset_password', 'web\store\UserResetPassword@showEmailForm')->name('resetpass'); // show email form => forget password
            Route::post('/reset_password', 'Auth\store\ForgotPasswordController@postEmailForm')->name('resetpasssend'); // data email form => forget password

            Route::get('/password/update', 'web\store\UserResetPassword@showUpdatePasswordForm'); // show form => update password
            Route::post('/password/update', 'Auth\store\ForgotPasswordController@updatePassword'); // data form => update password
            // Route::get('article/{id}' , 'web\store\HomeController@single_article');
            Route::get('/article_categories', 'web\store\HomeController@article_categories'); // all article categories
            Route::get('/article_cat/{cat_id}', 'web\store\HomeController@article_cat'); // all article under custom category
            Route::get('/article/{article_id}', 'web\store\HomeController@article'); // all article under custom category

        });
    });
});
