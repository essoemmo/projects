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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () { //...


    Route::get('/clear-cache', function () {
        Artisan::call('config:cache');
        return "Cache is cleared";
    });

    Route::get('suspended', 'Front\WelcomeController@suspended')->name('suspended');
    Route::get('forgetPassword', 'Front\ForgetPassController@forgetPassword');
    Route::post('forgetPassword', 'Front\ForgetPassController@forgetPasswordPost')->name('forgetPassword');
    Route::get('resetPassword/{token}', 'Front\ForgetPassController@resetPassword');
    Route::post('resetPassword/{token}', 'Front\ForgetPassController@resetPasswordPost');

    Route::get('/', 'Front\WelcomeController@index')->name('home');
    Route::get('/social_search', 'Front\SearchController@socialSearch');
    Route::get('/search', 'Front\SearchController@search');
//    Route::get('/',  function (){
//        return view('front.layout.index');
//    })->name('home');

    Route::get('/register', 'Auth\RegisterController@getRegister')->name('getRegister');
    Route::post('/user/register', 'Auth\RegisterController@storeRegister')->name('userRegister');

    Route::get('/login', 'Auth\LoginController@getLogin')->name('getLogin');
    Route::post('user/login', 'Auth\LoginController@UserLogin')->name('userLogin');

    Route::get('/login/redirect/{provider}', 'Front\SocialController@redirect')->name('social_login');
    Route::get('/login/{provider}', 'Front\SocialController@callback')->name('get_social_login');


    Route::get('lang/{lang}', 'Front\WelcomeController@lang'); // set language
    Route::post('/user/subscribe/newsletters', 'Front\WelcomeController@userSubscribeNewsLetters')->name('newsLetter'); // user subscribe news letters
    Route::post('/user/notsubscribe', 'Front\WelcomeController@deleteSubscriber')->name('notsubscribe'); // delete subscriber from news letters

    Route::get('change_country', 'Front\ChangeController@changeCountry');

    Route::get('/cat_list', 'Front\CategoryController@cat_list');
    Route::get('/products_list', 'Front\CategoryController@products_list');
    Route::get('/product_details', 'Front\CategoryController@product_details');

    Route::get('/quick_purchase', 'Front\CategoryController@quick_purchase');
    Route::get('/categories', 'Front\CategoryController@categories');
    Route::get('/parent_cat/{id}', 'Front\CategoryController@category_parent');
    Route::get('/category/{id}', 'Front\CategoryController@category_products');
    Route::get('/category_sort/{id}', 'Front\CategoryController@category_products_sort');

    Route::get('/products', 'Front\ProductController@products');
    Route::get('/products_sort', 'Front\ProductController@products_sort');
    Route::get('/product/{id}', 'Front\ProductController@singleProduct');
    Route::post('/product/rate', 'Front\ProductController@rateProduct')->name('store_product_rate');

    Route::get('/cart', 'Front\CartController@cart')->name('cart');
    Route::post('/add-to-cart', 'Front\CartController@addToCart')->name('addCart');
    Route::post('/update-cart', 'Front\CartController@update')->name('updateCart');
    Route::post('/remove-form-cart/{id}', 'Front\CartController@remove')->name('removeCart');
    Route::get('/buyNow/{id}', 'Front\CartController@buyNow')->name('buyNow');

    Route::post('/payment/register', 'Front\PaymentController@userRegister')->name('payment_register');

    Route::get('/payment', 'Front\PaymentController@index')->name('payment');


    #------------ blogs-------------------------------------------#
    Route::get('blogCats/all', 'Front\BlogController@blogCats'); // return all blog category
    Route::get('blogCat/{id}', 'Front\BlogController@blogCat'); // return blogs under blogcategory by id
    Route::get('blog/{id}', 'Front\BlogController@blog'); // return blog details through id
    #------------ articles-------------------------------------------#
    Route::get('articleCats/all', 'Front\ArticleController@blogCats'); // return all blog category
    Route::get('articleCat/{id}', 'Front\ArticleController@blogCat'); // return blogs under blogcategory by id
    Route::get('article/{id}', 'Front\ArticleController@blog'); // return blog details through id

    Route::get('/verify/{id}', 'Front\UserController@verify')->name('verify');
    Route::get('/resend_code/{id}', 'Front\UserController@resendCode')->name('resend_code');
    Route::get('/user/verify', 'Front\UserController@verifyUser')->name('verifyUser');

    Route::get('/joinOurAccounts', 'Front\UserController@joinOurAccounts')->name('joinOurAccounts');

    Route::get('showProfile/{id}', 'Front\UserController@showProfile')->name('showProfile');

    #------------ contact-------------------------------------------#
    Route::get('contact_us', 'Front\WelcomeController@contact_us');
    Route::post('contact_us', 'Front\WelcomeController@store_contact_us')->name('store.contact');

    Route::get('openTicket', 'Front\OpenTicketController@openTicket')->name('openTicket');
    Route::get('submitTicket/{id}', 'Front\OpenTicketController@submitTicket')->name('submitTicket');


    Route::group(['middleware' => 'auth:web'], function () {
        Route::any('logout', 'Front\WelcomeController@logout')->name('logout');

        Route::get('/after_register', 'Front\UserController@afterRegister')->name('afterRegister');

        Route::get('getCallCode', 'Front\UserController@getCallCode')->name('getCallCode');
        Route::get('getCityList', 'Front\UserController@getCityList')->name('getCityList');


        Route::get('profile', 'Front\UserController@profile')->name('userProfile');
        Route::post('profile', 'Front\UserController@store')->name('userProfile.store');
        Route::post('updatePassword', 'Front\UserController@updatePassword')->name('updatePassword');
        Route::post('/user/send_message', 'MessageController@userSend')->name('send_message');

        Route::get('continueRegister/{type}', 'Front\UserController@continueRegister')->name('continueRegister');

        Route::get('accounts', 'Front\UserController@userAccounts')->name('userAccounts');
        Route::post('accounts', 'Front\UserController@userAccountsStore')->name('accounts.store');
        Route::post('accounts/update', 'Front\UserController@userAccountsUpdate')->name('accounts.update');
        Route::get('defaultUrl', 'Front\UserController@changeUrl')->name('changeUrl');

        Route::get('celebrityAds', 'Front\UserController@celebrityAds')->name('celebrityAds');
        Route::post('celebrityAds', 'Front\PaymentController@celebrityAdsStore')->name('celebrityAds.store');
        Route::get('celebrityAds/famousFees', 'Front\PaymentController@famousFees')->name('famousFees');

        Route::get('featuredAd', 'Front\UserController@featuredAd')->name('featuredAd');
        Route::get('adInOurAccounts', 'Front\UserController@adInOurAccounts')->name('adInOurAccounts');
        Route::post('ourAccountAds', 'Front\PaymentController@ourAccountAdsStore')->name('ourAccountAds.store');

        Route::get('myPoints', 'Front\UserController@myPoints')->name('myPoints');

        Route::get('featurePrice', 'Front\UserController@featurePrice')->name('featurePrice');

        Route::get('/payment', 'Front\PaymentController@index')->name('payment');

        Route::post('saveOrder', 'Front\PaymentController@saveOrder')->name('saveOrder');

        Route::post('userAdRate', 'Front\UserController@userAdRate')->name('userAdRate');

        Route::get('myAds', 'Front\UserController@myAds')->name('myAds');
        Route::post('advertise', 'Front\UserController@advertise')->name('advertise');

        Route::get('notify', 'Front\UserNotificationController@usernotify')->name('userNotify');
        Route::get('notify_read/{id}', 'Front\UserNotificationController@userReadNotify')->name('userReadNotify');
        Route::get('notify_delete/{id}', 'Front\UserNotificationController@userDeleteNotify')->name('userDeleteNotify');

    });

});
