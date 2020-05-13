<?php


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () { //...

    Route::get('admin/read_message/{id_message}', 'MessageController@read_message');
    Route::post('admin/send_message', 'MessageController@adminSendMessage')->name('adminSendMessage');

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

        Config::set('auth.defines', 'admin');

        Route::get('login', 'AdminLoginController@login')->name('AdminLogin');

        Route::post('login', 'AdminLoginController@doLogin')->name('postLogin');

        // start Forget Password
        Route::get('forgetPassword', 'AdminLoginController@forgetPassword');
        Route::post('forgetPassword', 'AdminLoginController@forgetPasswordPost');
        Route::get('resetPassword/{token}', 'AdminLoginController@resetPassword');
        Route::post('resetPassword/{token}', 'AdminLoginController@resetPasswordPost');

        // End Forget Password

        Route::group(['middleware' => 'admin:admin'], function () {
            Route::get('/', 'DashboardController@home')->name('main');
            Route::get('/lang/{lang}', 'DashboardController@lang');
            Route::get('/profile', 'DashboardController@editProfile');
            Route::post('/profile', 'DashboardController@updateProfile');

            Route::any('logout', 'AdminLoginController@logout');

            // Setting Routes
            Route::get('/setting', 'Setting\SettingController@showSetting');
            Route::post('/setting/store', 'Setting\SettingController@storeSetting')->name('setting.store');
            Route::resource('site_languages', 'Setting\SiteLanguageController')->except(['show']);
            Route::resource('countries', 'Setting\CountryController')->except(['show']);
            Route::resource('cities', 'Setting\CityController')->except(['show']);
            Route::resource('currency', 'Setting\CurrencyController')->except(['show']);
            Route::resource('footer', 'Setting\FooterController')->except(['show']);

            // user setting routes
            Route::get('/userSetting', 'Setting\UserSettingController@showUserSetting');
            Route::post('/userSetting', 'Setting\UserSettingController@storeUserSetting')->name('userSetting.store');

            //    sliders
            Route::resource('sliders', 'Setting\SliderController');
            Route::get('sliders/{id}/change', 'Setting\SliderController@change');
            Route::get('sliders/sort/{id}', 'Setting\SliderController@sort');
            //    banners
            Route::resource('banners', 'Setting\BannerController');
            Route::get('banners/{id}/change', 'Setting\BannerController@change');
            Route::get('banners/sort/{id}', 'Setting\BannerController@sort');
            //    special members
            Route::resource('featured_users', 'FeaturedUserController');
            Route::get('featured_users/{id}/change', 'FeaturedUserController@change');


            // ========================== content management ==================================//
            Route::resource('content_management', 'Setting\ContentManagementController')->except(['show']);
            Route::get('content/sort', 'Setting\ContentManagementController@sort');

            Route::resource('section_products', 'Setting\ContentSectionProductController')->except(['show', 'delete']);

            // ========================== new urls ==================================//
            Route::resource('social_links', 'SocialLinkController')->except(['show']);
            Route::resource('account_content', 'AccountContentController')->except(['show']);
            Route::resource('points', 'PointsController')->except(['show']);
            Route::resource('featured_ad', 'FeaturedAdController')->except(['show', 'create', 'edit', 'delete']);
            Route::resource('social_advert', 'SocialAdvertisementController')->except(['show', 'create', 'edit', 'delete']);
//            Route::resource('rating_levels', 'RatingLevelController')->except(['show']);
//            Route::put('rating_level/{id}', 'RatingLevelController@update_rate')->name('rate_update');

            //    categories
            Route::resource('categories', 'CategoryController');
            Route::resource('products', 'ProductController');


            Route::resource('tags', 'blog\TagController');
            Route::resource('blog_categories', 'blog\blogCategoryController');
            Route::get('mainChecked', 'blog\blogCategoryController@check_main');
            Route::resource('blog', 'blog\BlogController');
            Route::get('newsLetter', 'NewsLetterController@index')->middleware('permission:NewsLetter-Add');


            Route::resource('banks', 'payment\BankController')->except(['show', 'create']);
            Route::resource('online_payment', 'payment\OnlineController')->except(['show', 'create', 'edit', 'update', 'delete']);

            Route::resource('orders', 'OrderController');
            Route::get('orders/{id}/delete', 'OrderController@destroy');
            Route::get('orders/{id}/change', 'OrderController@change');
            Route::get('orders/{id}/sendCodes', 'OrderController@sendCodes');

            Route::resource('site_ads', 'SiteAdsController');
            Route::get('site_ads/{id}/change', 'SiteAdsController@change');

            Route::resource('famous_ads', 'FamousAdsController');
            Route::get('famous_ads/{id}/change', 'FamousAdsController@change');

            Route::resource('ourAccountsAds', 'ourAccountsAdsController');
            Route::get('ourAccountsAds/{id}/change', 'ourAccountsAdsController@change');

            Route::get('orderReport', 'reports\OrderReportController@index');
            Route::get('orderReport/dt', 'reports\OrderReportController@datatable');

            Route::get('purchasedProductsReport', 'reports\PurchasedProductsReportController@index');
            Route::get('purchasedProductsReport/dt', 'reports\PurchasedProductsReportController@datatable');

            Route::get('customerOrderReport', 'reports\CustomerOrdersReportController@index');
            Route::get('customerOrderReport/dt', 'reports\CustomerOrdersReportController@datatable');
            Route::get('customerOrderReport/{id}/show', 'reports\CustomerOrdersReportController@show');

            /* ============== Contacts  ============== */
            Route::get('contact/all', 'ContactController@index');
            Route::get('contact/{id}/show', 'ContactController@show');
            Route::delete('contact/{id}/delete', 'ContactController@delete')->name('contact.destroy');

            Route::resource('email_setup', 'EmailSetupController')->except(['show', 'create', 'delete']);
            Route::resource('notify_setup', 'NotifySetupController')->except(['show', 'create', 'delete']);

            Route::resource('openTicket', 'OpenTicketController')->except(['show', 'create', 'edit']);
            Route::resource('priority', 'PriorityController')->except(['show', 'create', 'edit']);

            Route::post('send', 'ContactController@send')->name('send_notification');

            Route::get('sendUsers', 'Setting\UserSettingController@sendUsersNoti');
            Route::post('sendUsers', 'Setting\UserSettingController@sendUsersNotiStore')->name('sendUsersNotiStore');


        });

    });

});
