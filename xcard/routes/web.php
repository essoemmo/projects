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
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function() { //...

    Route::get('forgetPassword','Front\ForgetPassController@forgetPassword');
    Route::post('forgetPassword','Front\ForgetPassController@forgetPasswordPost')->name('forgetPassword');
    Route::get('resetPassword/{token}','Front\ForgetPassController@resetPassword');
    Route::post('resetPassword/{token}','Front\ForgetPassController@resetPasswordPost');

    Route::get('/', 'Front\WelcomeController@index')->name('home');
    Route::get('user/register', 'Auth\RegisterController@getRegister')->name('getRegister');
    Route::post('/user/register', 'Auth\RegisterController@storeRegister')->name('userRegister');

    Route::get('user/login', 'Auth\LoginController@getLogin')->name('getLogin');
    Route::post('user/login', 'Auth\LoginController@UserLogin')->name('userLogin');

    Route::get('/login/redirect/{provider}', 'Front\SocialController@redirect');
    Route::get('/login/{provider}', 'Front\SocialController@callback');


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

    Route::get('/cart' , 'Front\CartController@cart')->name('cart');
    Route::post('/add-to-cart' , 'Front\CartController@addToCart')->name('addCart');
    Route::post('/update-cart' , 'Front\CartController@update')->name('updateCart');
    Route::post('/remove-form-cart/{id}' , 'Front\CartController@remove')->name('removeCart');
    Route::get('/buyNow/{id}' , 'Front\CartController@buyNow')->name('buyNow');

    Route::post('/payment/register', 'Front\PaymentController@userRegister')->name('payment_register');

    Route::get('/payment', 'Front\PaymentController@index')->name('payment');

    Route::get('search', 'Front\SearchController@search')->name('search');
    Route::get('search_sort', 'Front\SearchController@search_sort');
    Route::get('advSearch', 'Front\SearchController@advSearch')->name('advSearch');

    #------------ blogs-------------------------------------------#
    Route::get('blogCats/all', 'Front\BlogController@blogCats'); // return all blog category
    Route::get('blogCat/{id}', 'Front\BlogController@blogCat'); // return blogs under blogcategory by id
    Route::get('blog/{id}', 'Front\BlogController@blog'); // return blog details through id
    #------------ articles-------------------------------------------#
    Route::get('articleCats/all', 'Front\ArticleController@blogCats'); // return all blog category
    Route::get('articleCat/{id}', 'Front\ArticleController@blogCat'); // return blogs under blogcategory by id
    Route::get('article/{id}', 'Front\ArticleController@blog'); // return blog details through id


    Route::group(['middleware' => 'auth:web'], function() {
        Route::any('logout', 'Front\WelcomeController@logout')->name('logout');

        Route::get('profile','Front\UserController@profile')->name('userProfile');
        Route::post('profile','Front\UserController@store')->name('userProfile.store');

        Route::get('orders','Front\UserController@orders')->name('orders');
        Route::get('orderDetails/{id}','Front\UserController@orderDetails')->name('orderDetails');

        Route::get('/payment', 'Front\PaymentController@index')->name('payment');

        Route::post('saveOrder', 'Front\PaymentController@saveOrder')->name('saveOrder');
        Route::any('postPay', 'Front\PaymentController@postPay')->name('postPay');
        Route::get('payOnline', 'Front\PaymentController@pay')->name('payOnline');

        Route::get('invoice','Front\PaymentController@invoice')->name('invoice');
        Route::get('confirm','Front\PaymentController@confirm')->name('confirm');

    });

});
