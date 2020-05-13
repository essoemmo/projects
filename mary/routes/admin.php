<?php

Route::group(['prefix'=>'admin'], function (){

    Config::set('auth.default','admin');

        Route::get('login', 'AdminAuth@login')->name('getlogin');
        Route::post('login', 'AdminAuth@doLogin')->name('postLogin');

    Route::get('forgetPassword','AdminAuth@forgetPassword');
    Route::post('forgetPassword','AdminAuth@forgetPasswordPost');
    Route::get('resetPassword/{token}','AdminAuth@resetPassword');
    Route::post('resetPassword/{token}','AdminAuth@resetPasswordPost');

    Route::group(['middleware'=>['authAdmin','admin']], function () {

        Route::get('/','userController@home')->name('adminHome');

        /*user controller*/
            Route::resource('users','userController');

                /*setting*/
                    Route::get('settings','SettingController@index')->name('settings-index');
                    Route::any('settings/update','SettingController@update')->name('settings-update');

                /*content managment*/

                    Route::resource('contentManagement','contentManagementController')->except(['show']);
                    Route::get('contentManagement/sort','contentManagementController@sort');

                    /*banner management*/
                    Route::resource('banner','bannerController')->except(['show']);
                      Route::post('banner/upload/image/{id}' , 'bannerController@uploadImages');
                      Route::post('banner/delete/image/{id}' , 'bannerController@deleteImages');

                  /*slider*/
                    Route::get('slider/','SliderController@index');
                    Route::post('slider/store','SliderController@store')->name('slider-store');
                    Route::delete('slider/delete/{id}','SliderController@destroy')->name('slider.destroy');
                    Route::put('slider/update/','SliderController@update')->name('slider-update');
                    Route::get('slider/get_datatable','SliderController@get_datatable');


//                 Route::get('settings/city','SettingController@cityindex')->name('city.index');
//                 Route::get('city/get_datatable','SettingController@getDatatableCity')->name('city.getDatatableCity');
//                 Route::post('city/add','SettingController@store')->name('city.store');


                 /*membership controller*/
                  Route::resource('memberships','membershipController');
                  Route::resource('memberships-details','membershipDetailsController');
                  Route::put('update/membership','membershipController@update')->name('edit-membership');

                  /*banks controller*/
                     Route::resource('banks','bankController')->except(['show']);


        /*category controller*/
                 Route::resource('categories','CategoryController');
                 Route::put('update/categories','CategoryController@update')->name('edit-category');

                  /*material_status*/
                 Route::resource('material_status','materialStatus');
                 Route::put('update/material/status','materialStatus@update')->name('edit-material_status');


                /*features/option/optionGroup*/
                Route::resource('Features','FeaturesController')->except(['show']);
                Route::put('update/Features','FeaturesController@update')->name('edit-Features');

                /*option*/
                 Route::get('Features/option/new','FeaturesController@getOption')->name('get-Option');
                 Route::get('Features/option','FeaturesController@indexOption')->name('index-Option');
                 Route::get('Features/option/edit','FeaturesController@edit')->name('edit-Option');
                 Route::put('Features/option/update','FeaturesController@updateOption')->name('update-Option');
                 Route::post('Features/option/store','FeaturesController@storeOption')->name('store-Option');
                 Route::delete('Features/option/delete/{id}','FeaturesController@deleteOption')->name('destroy-Option');

                 Route::delete('Features/option/delete/','FeaturesController@remove')->name('remove-from-model');
                 Route::get('get/lang','FeaturesController@getlang')->name('getlang');

                    /*member*/
                 Route::resource('members','MemberController');
                  Route::post('members/upload/image/{id}' , 'MemberController@uploadImages');
                  Route::post('members/delete/image/{id}' , 'MemberController@deleteImages');
                  Route::post('album/category','MemberController@addalbum')->name('album-category');
                  Route::put('active/member','MemberController@activemember')->name('active-user');


                 Route::get('block/user','MemberController@indexblock')->name('block-member');
                 Route::post('block/user/store','MemberController@storeexpiredate')->name('block-member-store');
                 Route::get('user/date','MemberController@getDate')->name('get-date');


                Route::get('user/type','MemberController@indexusertype')->name('type-member');
                Route::get('user/type/create','MemberController@createusertype')->name('type-member-new');
                Route::post('user/type/store','MemberController@storeusertype')->name('type-member-store');
                Route::get('user/type/{id}/edit','MemberController@editusertype')->name('type-member-edit');
                Route::put('user/type/{id}','MemberController@updateusertype')->name('type-member-update');
                Route::delete('user/type/{id}','MemberController@destroyusertype')->name('type-member-destroy');


                 Route::get('user/setting','MemberController@indexuserSetting')->name('setting-member');
                 Route::get('user/setting/create','MemberController@createuserSetting')->name('setting-member-new');
                 Route::post('user/setting/store','MemberController@storeuserSetting')->name('setting-member-store');
                 Route::get('user/setting/{id}/edit','MemberController@edituserSetting')->name('setting-member-edit');
                 Route::put('user/setting/{id}','MemberController@updateuserSetting')->name('setting-member-update');
                 Route::delete('user/setting/{id}','MemberController@destroyuserSetting')->name('setting-member-destroy');


                    /*conversation*/
                Route::resource('converstions','converstionsController');
                Route::get('converstions/massege/{id}','converstionsController@show')->name('converstions-mass');


                  Route::get('get/country','MemberController@getCountry')->name('getCountry');
                 Route::get('get/city','MemberController@getCity')->name('getCity');
                 Route::get('get/statue','MemberController@getstatue')->name('statue');
                 Route::get('massege/memebr/{id}','MemberController@massmember')->name('show-memebr-massege');
                 Route::get('message/member/get_datatable/{id}','MemberController@message_get_datatable');
                 Route::patch('massege/memebr/delete','MemberController@deletemass')->name('remove-massege-member');


                 /*sms mangement*/
                    Route::resource('sms','smsController');
                    Route::put('sms','smsController@change')->name('change-status');



        /*storeis*/
               Route::resource('Stories','StoriesController');
               Route::put('Stories/update','StoriesController@update')->name('edit-stories');

                    /*articles*/
                Route::resource('categoryArticle','categoryArticleController');
                  Route::put('update/categoryArticle','categoryArticleController@update')->name('edit-categoryArticle');

              Route::resource('articles','articlesController');
                  Route::put('update/articles','articlesController@update')->name('edit-articles');
                  Route::get('get/lang/articles','articlesController@getlangArticle')->name('getlangarticl');

                /*massege user */

                /*Best member*/
                Route::resource('Bestmember','BestMemberController');

                /*acrive member*/
                Route::resource('Activemember','ActiveMemberController');
                /*endbest member*/


               Route::get('massege/users','ContactController@index');
               Route::delete('massege/users/delete/{id}','ContactController@destroy')->name('contact-destroy');

                /*Subscriped*/
                Route::get('new/letter','NewsLetters@index');
                Route::delete('new/letter/delete/{id}','NewsLetters@delete');

                Route::get('export', 'NewsLetters@export')->name('export');
                Route::get('importExportView', 'NewsLetters@importExportView');
                Route::post('import', 'NewsLetters@import')->name('import');


        // ========================== languages ==================================//
                Route::get('languages', 'LangController@getLangs')->name('admin.languages');
                Route::get('change_language', 'LangController@changeLang');

                // ========================== translate ==================================//
                Route::get('translate','translation\TranslationController@index')->name('translation.index');
                Route::post('translate','translation\TranslationController@store')->name('translation.store');
                Route::get('translation/{id}','translation\TranslationController@show')->name('translation.show');

                Route::any('logout','AdminAuth@logout');
    });

//    Route::get('lang/{locale?}', [
//        'as'=>'lang',
//        'uses'=>'LangController@changeLang'
//    ]);


});
