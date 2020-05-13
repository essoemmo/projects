<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function(){
//    return redirect(url('/'.app()->getLocale()));
//});

Route::get('/', 'Front\HomeController@setHome');

Route::get('{lang}/lang', 'Front\HomeController@lang');

Route::group(['prefix' => '{locale}',
    'where' => ['locale' => '[a-zA-Z]{2}'],
    'middleware' => ['notSubDomain', 'setlocale']], function () {

    Route::group(['middleware' => ['notLoggedIn']], function () {
        //Route::get('lang', 'Front\HomeController@lang');
        Route::get('webLogin', 'Auth\LoginController@loginweb')->name('webLogin');
        Route::post('webLogin', 'Auth\LoginController@webLogin');
        Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('registerurl');
        Route::post('signupmember', 'Security\Membership\MembershipController@AddMember')->name('addmem');
        Route::post('verify_email', 'Auth\RegisterController@verify_email')->name('master.resend_verify');
        Route::post('signup', 'Auth\RegisterController@register')->name('front.signUp');
        Route::get('reset/password', 'Auth\ResetPasswordController@reset')->name('password-reset');
        Route::post('reset/password', 'Auth\ResetPasswordController@sendReset')->name('reset-pass');
        Route::get('change/password', 'Auth\ResetPasswordController@changePass')->name('reset-site');
        Route::put('change/password/final', 'Auth\ResetPasswordController@changePassput')->name('chaneg-pass');
        Route::get('try_demo', 'Auth\LoginController@try_demo')->name('try_demo');
        Route::get('verify/{id}', 'Auth\RegisterController@verfy')->name('front.verify');

        Route::get('/success', 'Auth\RegisterController@success')->name('payment.success');
        Route::get('/fail', 'Auth\RegisterController@fail')->name('payment.fail');
    });


    Route::get('prices', 'Front\HomeController@prices');
    Route::get('contact', 'Front\ContactController@contactForm');
    Route::post('contact', 'Front\ContactController@storeContact')->name('addcontact');


    Route::get('/', 'Front\HomeController@home')->name("front_home");
    Route::get('stores', 'Front\HomeController@AllStores');
    Route::post('/execute_payment', 'Auth\RegisterController@execute_payment')->name('execute_payment');


    /*     * ********************** blogs ********************************* */
    Route::get('blog_cats', 'Front\BlogsController@all_blog_cats');
    Route::get('blog_cat/{id}', 'Front\BlogsController@single_blog_cat');
    Route::get('blog/{id}', 'Front\BlogsController@single_blog');


//Route::get('webLogin','LoginController@loginweb')->name('webLogin');
});
