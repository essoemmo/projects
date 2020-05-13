<?php

//Auth::routes();

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

//Route::group(['prefix'=>'admin','middleware' => ['admin:admin'],'namespace' => 'Security'],function (){
Route::prefix('master')->middleware('auth:admin')->namespace('Master\Security')->group(function () {

    /* =============================== permissions & roles section ======================================== */
// permissions
    Route::get('permission/all', 'PermissionController@allPermissions')->middleware('permission:MasterPermission-Add'); //->middleware('permission:MasterAll-Permission','auth:admin');
    Route::get('permission/get_datatable', 'PermissionController@getDatatablePermission');
    Route::post('permission/add', 'PermissionController@storePermission')->middleware('permission:MasterPermission-Add');
    Route::put('permission/update', 'PermissionController@updatePermission')->middleware('permission:MasterPermission-Edit');
    Route::any('permission/{id}/delete', 'PermissionController@deletePermission')->middleware('permission:MasterPermission-Delete');
    Route::get('permission/{langId}', 'RoleController@getPermissions')->middleware('permission:MasterPermission-Add');

// Roles
    Route::get('role/add', 'RoleController@addRole')->middleware('permission:MasterRole-Add');
    Route::post('role/add', 'RoleController@storeRole')->middleware('permission:MasterRole-Add');

    Route::get('role/all', 'RoleController@getAllRoles')->middleware('permission:MasterRole-Add');
    Route::get('role/get_datatable', 'RoleController@getDatatableRoles')->middleware('permission:MasterRole-Add'); //->middleware('permission:MasterAll-Role','auth:admin')

    Route::get('role/{id}/edit', 'RoleController@editRole')->middleware('permission:MasterRole-Edit');
    Route::post('role/{id}/edit', 'RoleController@updateRole')->middleware('permission:MasterRole-Edit');
    Route::get('role/{id}/delete', 'RoleController@deleteRole')->middleware('permission:MasterRole-Delete');

// admins
    Route::get('admin/all', 'AdminController@showAdmins')->middleware('permission:MasterUser-Add'); //->middleware('permission:MasterAll-User');

    Route::get('admin/add', 'AdminController@createAdmin')->middleware('permission:MasterUser-Add');
    Route::post('admin/add', 'AdminController@storeNewAdmin')->middleware('permission:MasterUser-Add');

    Route::get('admin/{id}/edit', 'AdminController@editAdmin')->middleware('permission:MasterUser-Edit');
    Route::post('admin/{id}/edit', 'AdminController@updateAdmin')->middleware('permission:MasterUser-Edit');

    Route::delete('admin/{id}/delete', 'AdminController@deleteAdmin')->name('admin_master.destroy')->middleware('permission:MasterUser-Delete');
    /* ------------------------------------------------  security end ----------------------------------------------------------------------- */

    Route::post('changepassword/{id}', 'AdminController@changePassword'); //->middleware('permission:AdminUser-Add|AdminUser-Edit');
    // admin add front users
    Route::get('user/all', 'UserController@showUsers')->middleware('permission:MasterStore-Show');

    Route::get('user/{id}/edit', 'UserController@editUser')->middleware('permission:MasterStore-Show');
});

/// admin

Route::group(['prefix' => 'master', 'namespace' => 'Master'], function () {
    //Route::get('/', 'HomeController@test');

    Config::set('auth.defines', 'admin');

    Route::get('login', 'Auth\LoginController@login')->name('MasterLogin');
    Route::post('login', 'Auth\LoginController@doLogin')->name('PostLogin');
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/home', 'HomeController@index')->name('Master')->middleware('permission:MasterSiteSetting-Add');
        Route::get('settings', 'SettingsController@index')->middleware('permission:MasterSiteSetting-Add');
        Route::post('settings', 'SettingsController@store')->middleware('permission:MasterSiteSetting-Add');
        Route::get('settings/get/lang/value', 'SettingsController@getLangvalue')->middleware('permission:MasterLanguage-Controll');
        Route::post('settings/lang/store', 'SettingsController@storelangTranslation')->middleware('permission:MasterLanguage-Controll');
        Route::get('get/lang', 'SettingsController@getlang')->name('masterall_lang')->middleware('permission:MasterLanguage-Controll'); // get lang name used to translate

        Route::get('country/get_datatable', 'CountryController@getDatatablecountries')->middleware('permission:MasterCountry-Controll');
        Route::get('country/all', 'CountryController@get_country')->middleware('permission:MasterCountry-Controll');
        Route::get('country/create', 'CountryController@create')->middleware('permission:MasterCountry-Controll');
        Route::post('country/store', 'CountryController@store')->middleware('permission:MasterCountry-Controll');
        Route::get('country/{id}/edit', 'CountryController@edit')->middleware('permission:MasterCountry-Controll');
        Route::put('country/{id}/update', 'CountryController@update')->middleware('permission:MasterCountry-Controll');
        Route::delete('country/{id}/delete', 'CountryController@destroy')->name('country.destroy')->middleware('permission:MasterCountry-Controll');
        Route::get('country/get/lang/value', 'CountryController@countrygetLangvalue')->name('country_lang_value');
        Route::post('country/lang/store', 'CountryController@countrystorelangTranslation')->name('country_lang_store');

        Route::get('cities/get_datatable', 'CityController@getDatatablecities')->middleware('permission:MasterCity-Controll');
        Route::get('cities/all', 'CityController@get_city')->name('city-data')->middleware('permission:MasterCity-Controll');
        Route::post('cities/store', 'CityController@store')->name('city-data-store')->middleware('permission:MasterCity-Controll');
        Route::post('cities/update', 'CityController@update')->name('city-data-update')->middleware('permission:MasterCity-Controll');
        Route::get('cities/{id}/edit', 'CityController@edit')->middleware('permission:MasterCity-Controll');
        Route::delete('cities/{id}/delete', 'CityController@destroy')->name('city-delete')->middleware('permission:MasterCity-Controll');
        Route::get('cities/get/lang/value', 'CityController@citygetLangvalue')->name('city_lang_value');
        Route::post('cities/lang/store', 'CityController@citystorelangTranslation')->name('city_lang_store');


        Route::get('lang/{lang}', 'HomeController@masterLang')->middleware('permission:MasterLanguage-Controll');
        Route::any('logout', 'Auth\LoginController@logout');
        Route::get('/profile', 'HomeController@editProfile');
        Route::post('/profile', 'HomeController@updateProfile');
        Route::post('changepassword/{id}', 'HomeController@changePassword');

        // stores
        Route::get('store/all', 'StoreController@index')->middleware('permission:MasterStore-Show');
        Route::get('store/{id}/show', 'StoreController@show')->middleware('permission:MasterStore-Show');
        Route::post('store/change_status', 'StoreController@change_status');//->middleware('permission:MasterStore-Show');
        //celebrate
        Route::get('celebrates/all', 'CelebrateController@index')->middleware('permission:MasterCelebrates-Show');
        // membership
        Route::get('membership', 'Membership\MembershipController@index')->middleware('permission:MasterMembership-Add|MasterMembership-Edit|MasterMembership-Delete');
        Route::get('membership/add', 'Membership\MembershipController@create')->middleware('permission:MasterMembership-Add');
        Route::post('membership/store', 'Membership\MembershipController@store')->middleware('permission:MasterMembership-Add');
        Route::get('membership/{id}/edit', 'Membership\MembershipController@edit')->middleware('permission:MasterMembership-Edit');
        Route::post('membership/{id}/update', 'Membership\MembershipController@update')->middleware('permission:MasterMembership-Edit');
        Route::delete('membership/{id}', 'Membership\MembershipController@delete')->middleware('permission:MasterMembership-Delete');

        Route::get('membership/category/list', 'Membership\MembershipController@category_list')->middleware('permission:MasterMembership-Add|MasterMembership-Edit|MasterMembership-Delete');
        Route::get('membership/options/list', 'Membership\MembershipController@options_list')->middleware('permission:MasterMembership-Add|MasterMembership-Edit|MasterMembership-Delete');

        Route::get('membership/get/lang/value', 'Membership\MembershipController@getLangvalue')->middleware('permission:MasterMembership-Add|MasterMembership-Edit|MasterMembership-Delete');
        Route::post('membership/lang/store', 'Membership\MembershipController@storelangTranslation')->middleware('permission:MasterMembership-Add|MasterMembership-Edit|MasterMembership-Delete');
        Route::post('membership/cat/delete', 'Membership\MembershipController@deleteCategory')->name('catDelete')->middleware('permission:MasterMembership-Add|MasterMembership-Edit|MasterMembership-Delete');

        //templates
        Route::get('templates', 'TemplatesController@index')->middleware('permission:MasterTemplates-Controll');
        Route::get('templates/{id}/show', 'TemplatesController@show')->middleware('permission:MasterTemplates-Controll');
        Route::post('templates/{id}/update', 'TemplatesController@update')->middleware('permission:MasterTemplates-Controll');
        Route::get('templates/get/lang/value', 'TemplatesController@getLangvalue')->middleware('permission:MasterTemplates-Controll');
        Route::post('templates/lang/store', 'TemplatesController@storelangTranslation')->middleware('permission:MasterTemplates-Controll');


        // ========================== content management ==================================//
        Route::resource('content_management', 'ContentController')->middleware('permission:MasterContent-Add|MasterContent-Edit|MasterContent-Delete');
        Route::get('content/sort', 'ContentController@sort')->middleware('permission:MasterContent-Add|MasterContent-Edit');
        /* ============== Contacts  ============== */
        Route::get('contact/all', 'ContactController@index')->middleware('permission:MasterContact-Show');
        Route::get('contact/{id}/show', 'ContactController@show')->middleware('permission:MasterContact-Show');
        Route::delete('contact/{id}/delete', 'ContactController@delete')->name('master_contact.destroy')->middleware('permission:MasterContact-Show');
        //Sample
        Route::get('samples/get_datatable', 'Samples\SampleController@getDatatableSamples')->middleware('permission:MasterSamples-Controll');
        Route::get('samples/all', 'Samples\SampleController@get_samples')->name('sample-all')->middleware('permission:MasterSamples-Controll');
        Route::post('samples/store', 'Samples\SampleController@store_sample')->middleware('permission:MasterSamples-Controll');
        Route::get('samples/{id}/edit', 'Samples\SampleController@edit_sample')->middleware('permission:MasterSamples-Controll');
        Route::post('samples/{id}/update', 'Samples\SampleController@update_sample')->middleware('permission:MasterSamples-Controll');
        Route::delete('samples/{id}/delete', 'Samples\SampleController@sample_destroy')->name('sample.destroy')->middleware('permission:MasterSamples-Controll');
        Route::get('samples/get/lang/value', 'Samples\SampleController@samplegetLangvalue')->name('sample_lang_value');
        Route::post('samples/lang/store', 'Samples\SampleController@samplestorelangTranslation')->name('sample_lang_store');
        /* =============================== articles management ======================================== */
        Route::get('articles', 'Articles\ArticlesController@index')->middleware('permission:MasterArticles-Controll');
        Route::get('articles/create', 'Articles\ArticlesController@create')->middleware('permission:MasterArticles-Controll');
        Route::post('articles/store', 'Articles\ArticlesController@store')->middleware('permission:MasterArticles-Controll');
        Route::get('articles/{id}/edit', 'Articles\ArticlesController@edit')->middleware('permission:MasterArticles-Controll');
        Route::post('articles/{id}/update', 'Articles\ArticlesController@update')->middleware('permission:MasterArticles-Controll');
        Route::get('articles/get/lang/value', 'Articles\ArticlesController@getLangvalue')->middleware('permission:MasterArticles-Controll');
        Route::post('articles/lang/store', 'Articles\ArticlesController@storelangTranslation')->middleware('permission:MasterArticles-Controll');
        Route::delete('articles/{id}', 'Articles\ArticlesController@delete')->name('articles.destroy')->middleware('permission:MasterArticles-Controll');


        Route::get('article_cat', 'Articles\ArticleCategoryController@index')->middleware('permission:MasterArticlesCategory-Controll');
        Route::get('article_cat/create', 'Articles\ArticleCategoryController@create')->middleware('permission:MasterArticlesCategory-Controll');
        Route::post('article_cat/store', 'Articles\ArticleCategoryController@store')->middleware('permission:MasterArticlesCategory-Controll');
        Route::get('article_cat/{id}/edit', 'Articles\ArticleCategoryController@edit')->middleware('permission:MasterArticlesCategory-Controll');
        Route::post('article_cat/{id}/update', 'Articles\ArticleCategoryController@update')->middleware('permission:MasterArticlesCategory-Controll');
        Route::get('article_cat/get/lang/value', 'Articles\ArticleCategoryController@getLangvalue')->middleware('permission:MasterArticlesCategory-Controll');
        Route::post('article_cat/lang/store', 'Articles\ArticleCategoryController@storelangTranslation')->middleware('permission:MasterArticlesCategory-Controll');
        Route::delete('article_cat/{id}', 'Articles\ArticleCategoryController@delete')->name('article_cat.destroy')->middleware('permission:MasterArticlesCategory-Controll');
        Route::get('get_categories', 'Articles\ArticleCategoryController@get_categories')->middleware('permission:MasterArticlesCategory-Controll');


        Route::resource('chat', 'Chat\ChatController');


        Route::get('seoMaster', 'Seo\SeoController@index')->name('seoMaster.index');
        Route::post('seoMaster', 'Seo\SeoController@store')->name('seoMaster.store');

        Route::get('sms_reservations', 'Sms\SmsReservationController@index')->name('SmsReservation.index');
        Route::get('sms_reservations/{id}', 'Sms\SmsReservationController@show')->name('SmsReservation.show');
        Route::get('sms_reservations/approve/{id}', 'Sms\SmsReservationController@approve')->name('SmsReservation.approve');
//        Route::post('seoMaster', 'Seo\SeoController@store')->name('seoMaster.store');


        //->middleware('permission:ProductCategory-Add');

        //default categories
//        Route::get('cat', 'Category\CategoryController@create'); //->middleware('permission:ProductCategory-Add');
//        Route::get('cat/{cat_id}/del', 'Category\CategoryController@del'); //->middleware('permission:Product-Add|Product-Edit|Product-Delete');
//        Route::post('cat/save', 'Category\CategoryController@saveAll'); //->middleware('permission:Product-Add|Product-Edit|Product-Delete');
    });


});
