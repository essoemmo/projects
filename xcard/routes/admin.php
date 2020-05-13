<?php



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ //...

        Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

            Config::set('auth.defines', 'admin');

            Route::get('login','AdminLoginController@login')->name('AdminLogin');

            Route::post('login','AdminLoginController@doLogin')->name('postLogin');

            // start Forget Password
            Route::get('forgetPassword','AdminLoginController@forgetPassword');
            Route::post('forgetPassword','AdminLoginController@forgetPasswordPost');
            Route::get('resetPassword/{token}','AdminLoginController@resetPassword');
            Route::post('resetPassword/{token}','AdminLoginController@resetPasswordPost');

            // End Forget Password

            Route::group(['middleware' => 'admin:admin'], function() {
                Route::get('/','DashboardController@home')->name('main');
                Route::get('/lang/{lang}','DashboardController@lang');
                Route::get('/profile','DashboardController@editProfile');
                Route::post('/profile','DashboardController@updateProfile');

                Route::any('logout','AdminLoginController@logout');

                // Setting Routes
                Route::get('/setting' , 'Setting\SettingController@showSetting');
                Route::post('/setting/store' , 'Setting\SettingController@storeSetting')->name('setting.store');
                Route::resource('site_languages' , 'Setting\SiteLanguageController')->except(['show']);
                Route::resource('countries' , 'Setting\CountryController')->except(['show']);
                Route::resource('currency', 'Setting\CurrencyController')->except(['show']);
                Route::resource('game_languages' , 'GameLanguagesController');
                Route::resource('game_details' , 'GameDetailsController')->except(['show']);

                //    sliders
                Route::resource('sliders' , 'Setting\SliderController');
                Route::get('sliders/{id}/change' , 'Setting\SliderController@change');
                Route::resource('regions' , 'RegionsController');
                Route::resource('genres' , 'GenresController');
                Route::resource('platforms' , 'PlatFormController')->except(['show']);
//                Route::put('platform/update/{id}','PlatFormController@update_platform');


                // ========================== content management ==================================//
                Route::resource('content_management', 'Setting\ContentManagementController')->except(['show']);
                Route::get('content/sort', 'Setting\ContentManagementController@sort');

                Route::resource('section_products','Setting\ContentSectionProductController')->except(['show','delete']);



                //    categories
                Route::resource('categories' , 'CategoryController');
                Route::resource('products', 'ProductController');


                Route::post('products/requirements/{id}' , 'ProductController@requirements')->name('products.requirements');
                Route::post('products/languages/{id}' , 'ProductController@languages')->name('products.languages');
                Route::post('products/details/{id}' , 'ProductController@details')->name('products.details');
                Route::post('products/genre/{id}' , 'ProductController@genre')->name('products.genre');
                Route::post('products/codes/{id}' , 'ProductController@codes')->name('products.codes');

                Route::post('products/upload/image/{id}' , 'ProductController@uploadImages');
                Route::post('products/delete/image/{id}' , 'ProductController@deleteImages');

                Route::post('products/upload/video/{id}' , 'ProductController@uploadVideos');
                Route::post('products/delete/video/{id}' , 'ProductController@deleteVideos');

                Route::resource('works_on' , 'WorksOnController')->except(['show']);
                Route::post('work/update/{id}','WorksOnController@update_work');



                Route::resource('tags' , 'blog\TagController');
                Route::resource('blog_categories' , 'blog\blogCategoryController');
                Route::get('mainChecked' , 'blog\blogCategoryController@check_main');
                Route::resource('blog' , 'blog\BlogController');
                Route::get('newsLetter' , 'NewsLetterController@index')->middleware('permission:NewsLetter-Add');


                Route::resource('banks', 'payment\BankController')->except(['show','create']);
                Route::resource('online_payment', 'payment\OnlineController')->except(['show','create','edit','update','delete']);

                Route::resource('orders','OrderController');
                Route::get('orders/{id}/delete' , 'OrderController@destroy');
                Route::get('orders/{id}/change' , 'OrderController@change');
                Route::get('orders/{id}/sendCodes' , 'OrderController@sendCodes');

                Route::get('orderReport' , 'reports\OrderReportController@index');
                Route::get('orderReport/dt' , 'reports\OrderReportController@datatable');

                Route::get('purchasedProductsReport' , 'reports\PurchasedProductsReportController@index');
                Route::get('purchasedProductsReport/dt' , 'reports\PurchasedProductsReportController@datatable');

                Route::get('customerOrderReport' , 'reports\CustomerOrdersReportController@index');
                Route::get('customerOrderReport/dt' , 'reports\CustomerOrdersReportController@datatable');
                Route::get('customerOrderReport/{id}/show' , 'reports\CustomerOrdersReportController@show');

            });

        });

});
