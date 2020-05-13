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

//sitemap
Route::get('/sitemap.xml', 'SiteMapController@index');
Route::get('/sitemap.xml/products', 'SiteMapController@products');
Route::get('/sitemap.xml/categories', 'SiteMapController@categories');
Route::get('/sitemap.xml/brands', 'SiteMapController@brands');

Route::get('/products/{name}', 'web\ProductController@showName')->name('productDetailsByName');

Route::get('/', 'web\HomeController@index')->name('homepage');
Route::get('/privacy', 'web\HomeController@privacy');
Route::get('/common', 'web\HomeController@common');
Route::get('/manufacturers/{id}', 'web\HomeController@manufacturers');

Route::get('/register','Auth\RegisterController@register');
Route::post('/register','Auth\RegisterController@postregister')->name('postregister');


Route::get('/login','Auth\LoginController@getlogin')->name('getweblogin');
Route::post('/login','Auth\LoginController@loginpost');


Route::post('logout','web\HomeController@logout')->name('logout');



/*login sochial media*/
Route::get('/auth/redirect/{provider}', 'web\SocialController@redirect');
Route::get('/callback/{provider}', 'web\SocialController@callback');

/*search route*/
Route::get('/search', 'web\searchController@search')->name('search');



#----------------- articles--------------------#
Route::get('/article_categories', 'web\HomeController@article_categories'); // all article categories
Route::get('/article_cat/{cat_id}', 'web\HomeController@article_cat'); // all article under custom category
Route::get('/article/{article_id}', 'web\HomeController@article'); // all article under custom category

#-------------- favourites -------------------------- #
Route::post('addToFavorite', 'web\FavouriteController@addToFavorite');

#==========================category=======================#
Route::get('/category/{id}', 'web\CategoriesController@show')->name('category');

#===========================product========================#
Route::get('/product/{id}', 'web\ProductController@show')->name('productDetails');

Route::get('forgetPassword','web\ForgetPassController@forgetPassword');
Route::post('forgetPassword','web\ForgetPassController@forgetPasswordPost');
Route::get('resetPassword/{token}','web\ForgetPassController@resetPassword');
Route::post('resetPassword/{token}','web\ForgetPassController@resetPasswordPost');

Route::get('/cart' , 'web\CartController@cart')->name('cart');
Route::post('/add-to-cart' , 'web\CartController@addToCart');
Route::post('/update-cart' , 'web\CartController@update');
Route::post('/remove-form-cart/{id}' , 'web\CartController@remove');

Route::group(['middleware' => 'auth','web'], function() {
    Route::get('/checkout' , 'web\checkOutController@checkout')->name('checkout');
    Route::get('get-city-list','web\checkOutController@getCityList');
    Route::get('get-shippingOption-list','web\checkOutController@getShippingOptionList');
    Route::get('getBankDetails','web\checkOutController@getBankDetails');
    Route::post('/getShipCost' , 'web\checkOutController@getShipCost');
    Route::post('/getDiscount' , 'web\checkOutController@getDiscount');

    Route::post('saveallorders','web\checkOutController@saveallorders');
    Route::get('invoice','web\checkOutController@invoice');
    Route::get('confirm','web\checkOutController@confirm');
    /* ============================ order details  =============================== */
    Route::get('orderDetails/{id}','web\UserController@orderDetails')->name('orderDetails');

    /* ============================ profile  section =============================== */
    Route::get('/profile' , 'web\UserController@showProfileForm')->name('profile');
    Route::get('/user_order' , 'web\UserController@myOrders');
    Route::post('/profile' , 'web\UserController@profile');
    Route::post('/update_password' , 'web\UserController@update_password');
});
#============================review-rate========================#
Route::post('send/rate','web\ProductController@rate')->name('rate-review');




Route::get('change_language', 'web\HomeController@changeLang')->name('web_change_language');
//Route::get('change_language', 'web\HomeController@changeLang')->name('web_change_language');
Route::get('lang/{lang}','web\HomeController@lang'); // set language



#=================================getcountry code================================#
Route::get('change/country/{code}', 'web\HomeController@getcountrycode')->name('get-country-code');

/* ====================================== newsletter ==========================*/
Route::post('/user/subscribe/newsletters', 'web\NewsLetterController@userSubscribeNewsLetters'); // user subscribe news letters
Route::post('/user/notsubscribe', 'web\NewsLetterController@deleteSubscriber'); // delete subscriber from news letters

/* ====================================== contacts ==========================*/
Route::get('/contact' , 'web\ContactController@showContactForm');
Route::post('/contact' , 'web\ContactController@storeContact');
