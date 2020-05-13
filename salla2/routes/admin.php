<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Route::get("fix",function(){
//    $storeId=17;
//     \Illuminate\Support\Facades\DB::insert("insert into categories(store_id,title,description,number,parent_id,lang_id) select {$storeId},title,description,number,parent_id,lang_id  from categories where store_id is null and parent_id is null");
//        $codes = \App\Models\ProductTypeCodeData::all();
//        foreach ($codes as $code) {
//            $id = \App\Models\Product_type::create(['store_id' => $storeId,
//                'type_code' => $code->product_types_cod_id])->id;
//            \App\Models\ProductTypeData::create(["product_types_id" => $id,
//                "lang_id" => $code->lang_id,
//                "title" => $code->title,
//                "description" => $code->description]);
//        }
//});
//Route::view('/', 'admin.layout.layout');
//Route::view('/', 'admin.layout.layout');
Auth::routes();
//Route::get('adminpanel/test',function (){
//    return bcrypt('123456');
//});
Route::get('/adminpanel/login', 'Auth\LoginController@showAdminLoginForm');
Route::post('/adminpanel/login', 'Auth\LoginController@adminLogin');
Route::get('adminlang/{lang}', 'Admin\AdminController@lang');

Route::get('send_sms', 'SendSmsController@send');

//    Route::view('/home', 'home')->middleware('auth');
Route::group(['prefix' => 'adminpanel', 'middleware' => ['auth:store', 'demoCheck']], function () {

//      Route::get("test",function(){
//        $perms = ["Slider-Add", "Slider-Edit", "Slider-Delete",
//                "Role-Add", "Role-Edit", "Role-Delete",
//                "Settings-Add",
//                "Brand-Add","Brand-Edit","Brand-Delete",
//                "Contact-Show","Contact-Add","Contact-Edit","Contact-Delete"];
//
//            foreach ($perms as $item) {
//                $permission = \Spatie\Permission\Models\Permission::where("name", $item)->first();
//                if ($permission !== null)
//                    auth()->user()->givePermissionTo($permission->id);
//            }
//    });
    Route::get('design', 'Admin\DesignController@index')->middleware('permission:Design');
    Route::post('design/save_options', 'Admin\DesignController@save_options')->middleware('permission:Design');
    Route::post('design/save_menu_link', 'Admin\DesignController@save_menu_link')->middleware('permission:Design');
    Route::post('design/delete_custom_option', 'Admin\DesignController@delete_custom_option')->middleware('permission:Design');
    Route::post('design/change', 'Admin\DesignController@change_design')->middleware('permission:Design');
    Route::get('salla_store', 'Admin\SallaStoreController@index')->middleware('permission:Store-Controll');
    Route::post('template/buy', 'Admin\SallaStoreController@buy_template')->middleware('permission:Design');
    Route::post('execute_payment_admin_template', 'Admin\SallaStoreController@execute_payment_admin_template')->name('execute_payment_admin_template')->middleware('permission:Design');
    /*---- premium membership ------*/
    Route::get('membership/{id}', 'Admin\SallaStoreController@membership_details')->middleware('permission:Store-Controll');
    Route::post('membership/buy', 'Admin\SallaStoreController@buy_membership')->middleware('permission:Store-Controll');
    Route::post('execute_payment_admin_membership', 'Admin\SallaStoreController@execute_payment_admin_membership')->name('execute_payment_admin_membership')->middleware('permission:Store-Controll');

    //orders
    Route::get('orders/offline/all', 'Admin\transaction\TransactionsController@offline_orders')->middleware('permission:Transactions-Show');
    Route::get('orders/offline/{id}/show', 'Admin\transaction\TransactionsController@show_offline')->middleware('permission:Transactions-Show');
    Route::get('orders/offline/{id}/accept', 'Admin\transaction\TransactionsController@accept')->middleware('permission:Transactions-Show');
    Route::get('orders/offline/{id}/refused', 'Admin\transaction\TransactionsController@refused')->middleware('permission:Transactions-Show');

    Route::get('orders/online/all', 'Admin\transaction\TransactionsController@online_orders')->middleware('permission:Transactions-Show');
    Route::get('orders/online/{id}/show', 'Admin\transaction\TransactionsController@show_online')->middleware('permission:Transactions-Show');

    // ========================== content management ==================================//

    Route::resource('content_management', 'Admin\ContentController')->middleware('permission:Content-Add|Content-Edit|Content-Delete');
    Route::get('content/sort', 'Admin\ContentController@sort')->middleware('permission:Content-Add|Content-Edit');
    Route::resource('section_products', 'Admin\ContentSectionProductController')->except(['show', 'delete'])->middleware('permission:Content-Add|Content-Edit|Content-Delete');
    Route::resource('section_banners', 'Admin\ContentSectionBannerController')->except(['show', 'delete'])->middleware('permission:Brand-Add|Brand-Edit|Brand-Delete');

    Route::get('get_stores', 'Security\StoreController@get_stores')->middleware('permission:Stores-Show');


// profile
    Route::get('profile', 'Admin\AdminController@profile');
    Route::post('profile/update', 'Admin\AdminController@update_profile');
    Route::post('profile/update_password', 'Admin\AdminController@update_password');

    Route::get('logout', 'HomeController@logout');

    Route::get('/', 'Admin\DashboardController@index')->name('storedashboard');//->middleware('permission:Show-Adminpanel');
//    register
    Route::get('/adminpanel/register', 'Auth\RegisterController@showAdminRegisterForm');
    Route::post('/adminpanel/register', 'Auth\RegisterController@createAdmin');
//    settings
    Route::get('get/lang', 'Admin\SettingsController@getlang')->name('all_langs');

//    ticket
    Route::resource('ticket', 'Admin\ticket\TicketController')->middleware('permission:Ticket-Add|Ticket-Edit|Ticket-Delete');
    Route::get('ticket/completed/complate', 'Admin\ticket\TicketController@complatemark')->middleware('permission:Ticket-Add|Ticket-Edit|Ticket-Delete');
    Route::get('ticket/completed/index', 'Admin\ticket\TicketController@completed')->middleware('permission:Ticket-Add|Ticket-Edit|Ticket-Delete');

//    ticket setting
    Route::Resource('ticketSetting/category', 'Admin\ticket\TicketCategoryController')->middleware('permission:TicketCategory-Add|TicketCategory-Edit|TicketCategory-Delete');
    Route::Resource('ticketSetting/priority', 'Admin\ticket\TicketPrioritiesController')->middleware('permission:TicketPriority-Add|TicketPriority-Edit|TicketPriority-Delete');

    Route::Resource('ticketSetting/agent', 'Admin\ticket\TicketAgentController')->middleware('permission:TicketAgent-Add|TicketAgent-Edit|TicketAgent-Delete');
    Route::get('ticketSetting/agent/users/checked', 'Admin\ticket\TicketAgentController@checked')->middleware('permission:TicketAgent-Add|TicketAgent-Edit|TicketAgent-Delete');
    Route::get('ticketSetting/agent/users/paginate', 'Admin\ticket\TicketAgentController@paginate')->middleware('permission:TicketAgent-Add|TicketAgent-Edit|TicketAgent-Delete');
//      comments
    Route::post('comments', 'Admin\ticket\TicketCommentsController@store')->name('comments.store')->middleware('permission:Comment-Show');

//    chat system
    Route::post('/showChatModal', 'Admin\ChatController@showChatModal')->name('showChatModal')->middleware('permission:Chat-Show');


    Route::get('/chat', 'Admin\chat\ContactsController@chat')->middleware('permission:Chat-Show');
    Route::get('/contacts', 'Admin\chat\ContactsController@get')->middleware('permission:Chat-Show');
    Route::get('/conversation/{id}', 'Admin\chat\ContactsController@conversation')->middleware('permission:Chat-Show');
    Route::post('/conversation/send', 'Admin\chat\ContactsController@send')->middleware('permission:Chat-Show');


//    Route::get('/contacts', 'Admin\chat\ContactsController@get');
//    Route::get('/conversation/{id}', 'Admin\chat\ContactsController@conversation');
//    Route::post('/conversation/send', 'Admin\chat\ContactsController@send');


//    -------------------languages---------------------
    Route::resource('languages', 'Admin\LanguageController')->middleware('permission:Language-Add|Language-Edit|Language-Delete');

    /*   ------------------- Articles --------------------- */
    Route::group(['namespace' => 'Admin\Articles'], function () {

        Route::get('articles', 'ArticlesController@index')->middleware('permission:Article-Add|Article-Edit|Article-Delete');
        Route::get('articles/create', 'ArticlesController@create')->middleware('permission:Article-Add');
        Route::post('articles/store', 'ArticlesController@store')->middleware('permission:Article-Add');
        Route::get('articles/{id}/edit', 'ArticlesController@edit')->middleware('permission:Article-Edit');
        Route::post('articles/{id}/update', 'ArticlesController@update')->middleware('permission:Article-Edit');
        Route::get('articles/get/lang/value', 'ArticlesController@getLangvalue')->middleware('permission:Article-Add|Article-Edit|Article-Delete');
        Route::post('articles/lang/store', 'ArticlesController@storelangTranslation')->middleware('permission:Article-Add|Article-Edit|Article-Delete');
        Route::delete('articles/{id}', 'ArticlesController@delete')->name('articles.destroy')->middleware('permission:Article-Delete');

        /* --------- Artcl categories ------- */
        Route::get('artcle_category/all', 'ArticleCategoryController@index')->middleware('permission:ArticleCategory-Add|ArticleCategory-Edit|ArticleCategory-Delete');
        Route::get('article_cat/create', 'ArticleCategoryController@create')->middleware('permission:ArticleCategory-Add');
        Route::post('article_cat/store', 'ArticleCategoryController@store')->middleware('permission:ArticleCategory-Add');
        Route::get('article_cat/{id}/edit', 'ArticleCategoryController@edit')->middleware('permission:ArticleCategory-Edit');
        Route::post('article_cat/{id}/update', 'ArticleCategoryController@update')->middleware('permission:ArticleCategory-Edit');
        Route::delete('article_cat/{id}', 'ArticleCategoryController@delete')->name('artcl_categories.destroy')->middleware('permission:ArticleCategory-Delete');
        Route::get('get_categories', 'ArticleCategoryController@get_categories')->middleware('permission:ArticleCategory-Add|ArticleCategory-Edit|ArticleCategory-Delete');
        Route::get('article_cat/get/lang/value', 'ArticleCategoryController@getLangvalue')->middleware('permission:ArticleCategory-Add|ArticleCategory-Edit|ArticleCategory-Delete');
        Route::post('article_cat/lang/store', 'ArticleCategoryController@storelangTranslation')->middleware('permission:ArticleCategory-Add|ArticleCategory-Edit|ArticleCategory-Delete');


    });

    /*-----------------pages---------------*/

    Route::get('pages', 'Admin\Pages\PagesController@index')->middleware('permission:Page-Add|Page-Edit|Page-Delete');
    Route::get('pages/create', 'Admin\Pages\PagesController@create')->middleware('permission:Page-Add');
    Route::post('pages/store', 'Admin\Pages\PagesController@store')->middleware('permission:Page-Add');
    Route::get('pages/{id}/edit', 'Admin\Pages\PagesController@edit')->middleware('permission:Page-Edit');
    Route::post('pages/{id}/update', 'Admin\Pages\PagesController@update')->middleware('permission:Page-Edit');
    Route::delete('pages/{id}', 'Admin\Pages\PagesController@delete')->name('pages.destroy')->middleware('permission:Page-Delete');
    Route::get('pages/get/lang/value', 'Admin\Pages\PagesController@pagergetLangvalue')->name('page_lang_value');
    Route::post('pages/lang/store', 'Admin\Pages\PagesController@pagestorelangTranslation')->name('page_lang_store');

    /*   ------------------- Features --------------------- */
    Route::group(['namespace' => 'Admin\Product'], function () {

        Route::get('features/all', 'FeaturesController@index')->middleware('permission:Feature-Add|Feature-Edit|Feature-Delete');
        Route::get('features/{id}/show', 'FeaturesController@show')->middleware('permission:Feature-Edit');
        Route::delete('features/{id}/destroy', 'FeaturesController@destroy')->name('feature.destroy')->middleware('permission:Feature-Delete')->name('feature.destroy');
        Route::delete('features/{id}/delete', 'FeaturesController@delete')->name('feature.delete')->middleware('permission:Feature-Delete');


    });


    /* ------------------------ site settings --------------------------  */

    Route::get('settings', 'Admin\SettingsController@index')->middleware('permission:Settings-Add')->name('admin.setting');

    Route::get('settings/get', 'Admin\SettingsController@get_settings')->middleware('permission:Settings-Add');

   // Route::get('shipping/get', 'Admin\ShippingController@index')->middleware('permission:shipping-add');

    Route::get('chat/get', 'Admin\ChatController@index')->middleware('permission:chat-add');

    Route::post('chat/choose', 'Admin\ChatController@choose')->middleware('permission:chat-add');


    Route::get('settings/slider/datatable', 'Admin\SettingsController@getDatatableSlider')->name('allsliders')->middleware('permission:Slider-Add|Slider-Edit|Slider-Delete'); //return datatable
    Route::post('settings/store', 'Admin\SettingsController@store_settings')->middleware('permission:Slider-Add');
    Route::post('settings/slider/store', 'Admin\SettingsController@store_slider')->middleware('permission:Slider-Add');
    Route::get('settings/slider/{id}/edit', 'Admin\SettingsController@edit_slider')->middleware('permission:Slider-Edit');
    Route::post('settings/slider/{id}/update', 'Admin\SettingsController@update_slider')->middleware('permission:Slider-Edit');
    Route::delete('settings/slider/{id}/delete', 'Admin\SettingsController@slider_destroy')->name('slider.destroy');
    Route::get('settings/sliders', 'Admin\SettingsController@get_sliders')->name('silder.setting')->middleware('permission:Slider-Add|Slider-Edit|Slider-Delete');
    Route::get('sliders/get/lang/value', 'Admin\SettingsController@slidergetLangvalue')->name('silder_lang_value')->middleware('permission:Slider-Add');
    Route::post('sliders/lang/store', 'Admin\SettingsController@sliderstorelangTranslation')->name('silder_lang_store')->middleware('permission:Slider-Add');

    Route::post('settings/domain/store', 'Admin\SettingsController@store_domain')->middleware('permission:domain');

    //brand
    Route::get('settings/brand/get_datatable', 'Admin\BrandController@getDatatablebrands')->name('allbrands')->middleware('permission:Brand-Add|Brand-Edit|Brand-Delete');
    Route::resource('brands', 'Admin\BrandController')->middleware('permission:Brand-Add|Brand-Edit|Brand-Delete');
    Route::get('brands/get/lang/value', 'Admin\BrandController@brandgetLangvalue')->name('brand_lang_value');
    Route::post('brands/lang/store', 'Admin\BrandController@brandstorelangTranslation')->name('brand_lang_store');
    //banner
    Route::get('settings/banner/get_datatable', 'Admin\SettingsController@getDatatablebanners')->name('allbanners');
    Route::post('settings/banner/store', 'Admin\SettingsController@store_banner')->middleware('permission:Brand-Add');
    Route::get('settings/banner/{id}/edit', 'Admin\SettingsController@edit_banner')->middleware('permission:Brand-Edit');
    Route::post('settings/banner/{id}/update', 'Admin\SettingsController@update_banner')->middleware('permission:Brand-Edit');
    Route::delete('settings/banner/{id}/delete', 'Admin\SettingsController@banner_destroy')->name('banner.destroy')->middleware('permission:Brand-Delete');
    Route::get('settings/banners', 'Admin\SettingsController@get_banners')->name('banner-setting')->middleware('permission:Banner-Add|Banner-Edit|Banner-Delete');
    Route::get('banners/get/lang/value', 'Admin\SettingsController@getLangvalue')->name('banner_lang_value')->middleware('permission:Brand-Add');
    Route::post('banners/lang/store', 'Admin\SettingsController@storelangTranslation')->name('banner_lang_store')->middleware('permission:Brand-Add');

    //Currencies
    Route::get('settings/currency/get_datatable', 'Admin\SettingsController@getDatatablecurrency')->name('allcurrency');
    Route::post('settings/currency/store', 'Admin\SettingsController@store_currency');//->middleware('permission:Brand-Add');
    Route::get('settings/currency/{id}/edit', 'Admin\SettingsController@edit_currency');//->middleware('permission:Brand-Edit');
    Route::post('settings/currency/{id}/update', 'Admin\SettingsController@update_currency');//->middleware('permission:Brand-Edit');
    Route::delete('settings/currency/{id}/delete', 'Admin\SettingsController@currency_destroy')->name('currency.destroy');//->middleware('permission:Brand-Delete');
    Route::get('settings/currency', 'Admin\SettingsController@get_currency')->name('currency-setting');//->middleware('permission:Banner-Add|Banner-Edit|Banner-Delete');
    Route::get('currency/get/lang/value', 'Admin\SettingsController@currencygetLangvalue')->name('currency_lang_value')->middleware('permission:Brand-Add');
    Route::post('currency/lang/store', 'Admin\SettingsController@currencystorelangTranslation')->name('currency_lang_store')->middleware('permission:Brand-Add');


//    comments
    Route::get('comments', 'Admin\CommentsController@index')->middleware('permission:Comment-Show');
    Route::put('comments/{id}/approved', 'Admin\CommentsController@approved')->name('commentsUpdate')->middleware('permission:Comment-Show');
    Route::delete('comments/{id}', 'Admin\CommentsController@delete')->name('comments.destroy')->middleware('permission:Comment-Show');
    Route::post('comments/{id}/reply', 'Admin\CommentsController@reply')->name('comments.reply')->middleware('permission:Comment-Show');


    /* ============== Contacts  ============== */

    Route::get('contact/all', 'Admin\ContactController@index')->middleware('permission:Contact-Show');
    Route::get('contact/{id}/show', 'Admin\ContactController@show')->middleware('permission:Contact-Show');
    Route::delete('contact/{id}/delete', 'Admin\ContactController@delete')->name('contact.destroy')->middleware('permission:Contact-Show');

    /* ============== reports  ============== */

    Route::resource('reports', 'Admin\ReportController')->middleware('permission:reports');
    Route::post('dayFilter', 'Admin\ReportController@dayFilter')->name('DayFilter')->middleware('permission:reports');
    Route::post('weekFilter', 'Admin\ReportController@weekFilter')->name('WeekFilter')->middleware('permission:reports');
    Route::post('monthFilter', 'Admin\ReportController@monthFilter')->name('MonthFilter')->middleware('permission:reports');
    Route::post('yearFilter', 'Admin\ReportController@yearFilter')->name('YearFilter')->middleware('permission:reports');

// ==================== bank transfer ========================//
    Route::resource('transferBank', 'Admin\Product\BankTransferController')->middleware('permission:BankTransfer-Add|BankTransfer-Edit|BankTransfer-Delete');

    // ========================Celebrate=======================   //
    Route::resource('celebrates', 'Admin\CelebrateController');


    Route::resource('settings/discount_code', 'Admin\DiscountCodeController')->except(['show', 'create', 'edit'])->middleware('permission:Discount');
    Route::get('settings/discount_code/get_types', 'Admin\DiscountCodeController@get_types');
    Route::get('settings/offer', 'Admin\DiscountCodeTargetController@index')->name('store.offers')->middleware('permission:offers');
    Route::get('settings/offer/create', 'Admin\DiscountCodeTargetController@create')->middleware('permission:offers');
    Route::post('settings/offer/store', 'Admin\DiscountCodeTargetController@store')->middleware('permission:offers');
    Route::get('settings/offer/{id}/edit', 'Admin\DiscountCodeTargetController@edit')->middleware('permission:offers');
    Route::post('settings/offer/{id}/update', 'Admin\DiscountCodeTargetController@update')->middleware('permission:offers');
    Route::delete('settings/offer/{id}', 'Admin\DiscountCodeTargetController@delete')->middleware('permission:offers');

    Route::get('campaign', 'Admin\CampaignController@index')->middleware('permission:campaign');
    Route::get('campaign/create', 'Admin\CampaignController@create')->middleware('permission:campaign');;
    Route::post('campaign/store', 'Admin\CampaignController@store')->middleware('permission:campaign');;
    Route::get('campaign/{id}/edit', 'Admin\CampaignController@edit')->middleware('permission:campaign');;
    Route::post('campaign/{id}/update', 'Admin\CampaignController@update')->middleware('permission:campaign');

    Route::post('campaign/store_marketing_users', 'Admin\CampaignController@store_marketing_users')->middleware('permission:campaign');
    Route::post('campaign/delete_marketing_users', 'Admin\CampaignController@delete_marketing_users')->middleware('permission:campaign');
    Route::delete('campaign/{id}', 'Admin\CampaignController@delete')->name('campaign.delete')->middleware('permission:campaign');


    Route::get('store_user/{id}/orders', 'Admin\UserOrderController@showUserOrder');
    Route::post('store_user/{id}/sendSMS', 'Admin\UserOrderController@smsStore')->name('UserSentSMS');
    Route::post('store_user/send', 'Admin\UserOrderController@sendStore')->name('UserSend');

    Route::get('groupFilter', 'Admin\UserOrderController@groupFilter')->name('groupFilter')->middleware('permission:GroupFilter');

    Route::get('genderFilter', 'Admin\UserOrderController@genderFilter')->name('genderFilter')->middleware('permission:GinderFilter');

    Route::get('cityFilter', 'Admin\UserOrderController@cityFilter')->name('cityFilter')->middleware('permission:CityFilter');

    Route::get('purchaseFilter', 'Admin\UserOrderController@purchaseFilter')->name('purchaseFilter')->middleware('permission:PurchaseFilter');

    Route::post('Active/user/{id}', 'Admin\UserOrderController@ActiveUser')->name('activeusers')->middleware('permission:PurchaseFilter');

    Route::get('/abandoned_carts', 'AbandonedCartsController@index')->middleware("permission:Abandon-Cart");
    Route::get('/abandoned_carts/{id?}', 'AbandonedCartsController@show')->name('aban-cart')->middleware("permission:Abandon-Cart");
    Route::post('/abandoned_carts/update_price', 'AbandonedCartsController@update_price')->name('update_price')->middleware("permission:Abandon-Cart");

    Route::get('store_user', 'Admin\UserOrderController@showStoreUsers')->middleware("permission:Users-Group");

    Route::post('create_group', 'Admin\UserOrderController@createGroup')->middleware("permission:Users-Group")->name('createGroup');

    Route::get('store_user/add', 'Security\AdminController@createUser')->middleware("permission:Users-Group");
    Route::post('store_user/add', 'Security\AdminController@storeNewUser')->middleware("permission:Users-Group");

    Route::get('store_user/{id}/edit', 'Security\AdminController@editUser')->middleware("permission:Controll-Users");
    Route::post('store_user/{id}/edit', 'Security\AdminController@updateUser')->middleware("permission:Controll-Users");

    Route::delete('store_user/{id}/delete', 'Security\AdminController@deleteUser')->middleware("permission:Controll-Users");


    Route::post('myfatoorah', 'Admin\orders\OrdersController@myfatoorah_admin')->name('myfatoorah_admin')->middleware("permission:Controll-Invoices");
    Route::post('execute_payment_admin', 'Admin\orders\OrdersController@execute_payment_admin')->name('execute_payment_admin')->middleware("permission:Controll-Invoices");
    Route::get('myfatoorah/finish', 'Admin\orders\OrdersController@myfatoorahFinish')->name('myfatoorah_admin.finish')->middleware("permission:Controll-Invoices");

    Route::get('connectServices', 'Admin\SettingsController@connectServices')->name('connectServices');

    //setting store options
    Route::get('storeOptions', 'Admin\Setting\StoreOptionController@index')->name('storeOptions.index')->middleware("permission:Controll-Maintenance");
    Route::post('storeOptions/maintenance/{id}', 'Admin\Setting\StoreOptionController@storeMaintenance')->name('storeOptions.storeMaintenance')->middleware("permission:Controll-Maintenance");
    Route::post('storeOptions/options/{id}', 'Admin\Setting\StoreOptionController@storeOptions')->name('storeOptions.storeOptions')->middleware("permission:Controll-Maintenance");

    //setting account control
    Route::get('accountControl', 'Admin\Setting\AccountControlController@index')->name('accountControl.index')->middleware('permission:Store-Controll');
    Route::post('accountControl/change', 'Admin\Setting\AccountControlController@change_setting')->middleware('permission:Store-Controll');


    //setting data recovery
    Route::get('dataRecovery', 'Admin\Setting\DataRecoveryController@index')->name('dataRecovery.index')->middleware('permission:Data-Recovery');
    Route::get('dataRecovery/products', 'Admin\Setting\DataRecoveryController@getProducts')->name('dataRecovery.products')->middleware('permission:Data-Recovery');
    Route::post('dataRecovery/products', 'Admin\Setting\DataRecoveryController@restoreProduct')->name('dataRecovery.restoreProduct')->middleware('permission:Data-Recovery');
    Route::get('dataRecovery/orders', 'Admin\Setting\DataRecoveryController@getOrders')->name('dataRecovery.orders')->middleware('permission:Data-Recovery');
    Route::post('dataRecovery/orders', 'Admin\Setting\DataRecoveryController@restoreOrder')->name('dataRecovery.restoreOrder')->middleware('permission:Data-Recovery');

    // setting seo
    Route::get('seo', 'Admin\Setting\SeoController@StoreSeo')->name('seo.index')->middleware("permission:Controll-Seo");
    Route::post('seo/setting', 'Admin\Setting\SeoController@settingStore')->name('seo.storeSetting')->middleware("permission:Controll-Seo");
    Route::post('seo/product', 'Admin\Setting\SeoController@productStore')->name('seo.storeProduct')->middleware("permission:Controll-Seo");

    // Tax prep

    Route::get('tax', 'Admin\Setting\TaxController@index')->name('taxPrep');//->middleware("permission:Controll-Seo");
    Route::post('tax/store', 'Admin\Setting\TaxController@storeTax')->name('TaxStore');//->middleware("permission:Controll-Seo");
    Route::post('updateTaxStatus', 'Admin\Setting\TaxController@updateTaxStatus')->name('updateTaxStatus');//->middleware("permission:Controll-Seo");;
    Route::post('updateTaxStatusnumb', 'Admin\Setting\TaxController@updateTaxStatusnumb')->name('updateTaxStatusnumb');//->middleware("permission:Controll-Seo");;
    Route::post('taxnumb/store/{id}', 'Admin\Setting\TaxController@storeTaxNumb')->name('TaxNumbStore');//->middleware("permission:Controll-Seo");
    Route::post('taxnoptions/store/{id}', 'Admin\Setting\TaxController@storeOptions')->name('Taxoptions');//->middleware("permission:Controll-Seo");
    Route::get('taxs/all', 'Admin\Setting\TaxController@getDatatabletaxs')->name('alltaxs');//->middleware("permission:Controll-Seo");;
    Route::post('taxs/update', 'Admin\Setting\TaxController@update_taxs')->name('updatetaxs');//->middleware('permission:Brand-Edit');
    Route::delete('taxs/delete/{id}', 'Admin\Setting\TaxController@taxs_destroy')->name('taxs.destroy');//->middleware('permission:Brand-Delete');

    // setting sms name reservation
    Route::get('sms', 'Admin\Setting\SmsController@index')->name('sms.index');//->middleware("permission:Control-Sms");
    Route::get('sms/generateDocs', 'Admin\Setting\SmsController@generateDocs')->name('sms.generateDocs');//->middleware("permission:Control-Sms");
    Route::post('sms/store', 'Admin\Setting\SmsController@store')->name('sms.store');//->middleware("permission:Control-Sms");

});

