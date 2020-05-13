<?php

Route::prefix('admin/panel')->group(function (){

    Route::get('login', 'AdminAuth@login')->name('getlogin');
    Route::post('login', 'AdminAuth@doLogin')->name('postLogin');

    Route::get('forgetPassword','AdminAuth@forgetPassword');
    Route::post('forgetPassword','AdminAuth@forgetPasswordPost');
    Route::get('resetPassword/{token}','AdminAuth@resetPassword');
    Route::post('resetPassword/{token}','AdminAuth@resetPasswordPost');


    Route::group(['middleware'=>['authadmin','admin']], function () {

        Route::get('/', 'dashboardController@index')->name('dashboard');
        /*user controller*/
        Route::resource('users','userController');
        Route::resource('front_users','FrontUsersController');
        /*setting*/
        Route::get('settings','SettingController@index')->name('settings-index');
        Route::any('settings/update','SettingController@update')->name('settings-update');
        /*slider*/
        Route::get('slider/','SliderController@index');
        Route::get('slider/get_datatable','SliderController@get_datatable');
        Route::get('slider/create','SliderController@create')->name('sliders.create');
        Route::post('slider/store','SliderController@store')->name('slider-store');
        Route::get('slider/{id}/edit','SliderController@edit')->name('slider-edit');
        Route::delete('slider/delete/{id}','SliderController@destroy')->name('slider.destroy');
        Route::put('slider/update/{id}','SliderController@update')->name('slider-update');

        #=========================categories===============================#
        Route::resource('categories','categoriesController')->except(['show']);
        Route::any('categories/delete/{id}','categoriesController@destroy')->name('categories-destroy');
        Route::get('categories/datatable','categoriesController@datatable')->name('get-category-datatable');


        #=========================productController===============================#

        Route::resource('products','productController')->except(['show']);
        Route::get('products/datatable','productController@getproductdatatable')->name('get-product-datatable');
        Route::any('products/{id}/destroy','productController@destroy')->name('products-destroy');

        Route::any('products/getOption', ['as' => 'products.getOption', 'uses' => 'productController@getOption']);
        Route::any('products/getParentValues', ['as' => 'products.getParentValues', 'uses' => 'productController@getParentValues']);

        Route::any('products/deleteProductAttribute', ['as' => 'products.deleteProductAttribute', 'uses' => 'productController@deleteProductAttribute']);
        Route::any('products/deleteProductDiscount', ['as' => 'products.deleteProductDiscount', 'uses' => 'productController@deleteProductDiscount']);
        Route::any('products/deleteProductImage', ['as' => 'products.deleteProductImage', 'uses' => 'productController@deleteProductImage']);
        Route::any('products/deleteProductColor', ['as' => 'products.deleteProductColor', 'uses' => 'productController@deleteProductColor']);
        Route::any('products/deleteProductOption', ['as' => 'products.deleteProductOption', 'uses' => 'productController@deleteProductOption']);
        Route::any('products/deleteCountryProduct', ['as' => 'products.deleteCountryProduct', 'uses' => 'productController@deleteCountryProduct']);

        Route::any('products/deleteProductOptionValue', ['as' => 'products.deleteProductOptionValue', 'uses' => 'productController@deleteProductOptionValue']);


        Route::any('getAttributes','productController@getAttributes');
        Route::any('getOptions','productController@getOptions');

        Route::get('stockStatus/all','StockStatusController@index');
        Route::post('stockStatus/store','StockStatusController@store');
        Route::post('stockStatus/update','StockStatusController@update');
        Route::delete('stockStatus/delete','StockStatusController@destroy')->name('stockStatus.destroy');

        #===============================sphers======================================#

        Route::resource('spheres', 'SphereController')->except(['show']);
        Route::any('spheres/{id}/delete', 'SphereController@destroy')->name('spheres-destroy');
        Route::get('spheres/datatable','SphereController@getspheresdatatable')->name('get-spheres-datatable');

        #================================cylinder=====================================#
        Route::resource('cylinder', 'CylinderController')->except(['show']);
        Route::any('cylinder/{id}/delete', 'CylinderController@destroy')->name('cylinder-destroy');
        Route::get('cylinder/datatable','CylinderController@getcylinderdatatable')->name('get-cylinder-datatable');

        #==================================axis======================================#
        Route::resource('axis', 'AxisController')->except(['show']);
        Route::any('axis/{id}/delete', 'AxisController@destroy')->name('axis-destroy');
        Route::get('axis/datatable','AxisController@getaxisdatatable')->name('get-axis-datatable');
        #==================================Lens======================================#
        Route::resource('lens', 'LensController')->except(['show']);
        Route::any('lens/{id}/delete', 'LensController@destroy')->name('lens-destroy');
        Route::get('lens/datatable','LensController@getaxisdatatable')->name('get-lens-datatable');
        #=============================attributegroups==============================#
        Route::resource('attributegroups', 'AttributeGroupController')->except(['show']);
        Route::any('attributegroups/{id}/delete', 'AttributeGroupController@destroy')->name('attributegroups-destroy');
        Route::get('attributegroups/datatable','AttributeGroupController@getattributegroupsdatatable')->name('get-attributegroups-datatable');

        #=============================attribute==============================#
        Route::resource('attributes', 'AttributesController')->except(['show']);
        Route::any('attribute/{id}/delete', 'AttributesController@destroy')->name('attribute-destroy');
        Route::get('attribute/datatable','AttributesController@getattributedatatable')->name('get-attribute-datatable');

        #=============================manufacturers==============================#
        Route::resource('manufacturers', 'ManufacturersController')->except(['show']);
        Route::any('manufacturers/{id}/delete', 'ManufacturersController@destroy')->name('manufacturers-destroy');
        Route::get('manufacturers/datatable','ManufacturersController@getmanufacturersdatatable')->name('get-manufacturers-datatable');

        /* ============== Contacts  ============== */
        Route::get('/contact/all', 'ContactController@all'); //->middleware('permission:Contact-Show|Contact-Delete');
        Route::get('/contact/all/getDatatable', 'ContactController@getDatatableContact'); //->middleware('permission:Contact-Show|Contact-Delete'); //get database contact
        Route::get('/contact/{id}/show', 'ContactController@show'); //->middleware('permission:Contact-Show');
        Route::get('/contact/{id}/delete', 'ContactController@delete'); //->middleware('permission:Contact-Delete');

        /* =============== news letters =========== */

        Route::get('/newsletters/all', 'NewsLettersController@all');//->middleware('permission:NewsLetters-Edit|NewsLetters-Delete'); //get all news letters
        Route::get('/newsletters/get_datatable', 'NewsLettersController@getDatatableNewsLetters'); //->middleware('permission:NewsLetters-Edit|NewsLetters-Delete');
        Route::get('/newsletters/export', 'NewsLettersController@expotNewsLettersExcel'); //->middleware('permission:NewsLetters-Edit|NewsLetters-Delete'); //export all news letters as excel


        /*   ------------------- Articles --------------------- */
        Route::get('/article/all', 'Article\ArticleController@index'); //->middleware('permission:Article-Add|Article-Edit|Article-Delete');
        Route::get('/article/datatable', 'Article\ArticleController@datatableArticles'); //->middleware('permission:Article-Add|Article-Edit|Article-Delete');
        Route::get('/article/create', 'Article\ArticleController@create'); //->middleware('permission:Article-Add');
        Route::post('/article/store', 'Article\ArticleController@store'); //->middleware('permission:Article-Add');
        Route::get('/article/{id}/edit', 'Article\ArticleController@edit'); //->middleware('permission:Article-Edit');
        Route::post('/article/{id}/update', 'Article\ArticleController@update'); //->middleware('permission:Article-Edit');
        Route::delete('/article/{id}/delete', 'Article\ArticleController@delete')->name('article.destroy'); //->middleware('permission:Article-Delete');
        /* --------- Artcl categories ------- */
        Route::get('/artcle_category/all', 'Article\Artcl_categoriesController@index'); //->middleware('permission:ArticleCategory-Add|ArticleCategory-Edit|ArticleCategory-Delete');
        Route::get('/artcle_category/datatable', 'Article\Artcl_categoriesController@getDatatableArticleCats'); //->middleware('permission:ArticleCategory-Add|ArticleCategory-Edit|ArticleCategory-Delete');
        Route::get('/artcle_category/create', 'Article\Artcl_categoriesController@create'); //->middleware('permission:ArticleCategory-Add');
        Route::post('/artcle_category/store', 'Article\Artcl_categoriesController@store'); //->middleware('permission:ArticleCategory-Add');
        Route::get('/artcle_category/{id}/edit', 'Article\Artcl_categoriesController@edit'); //->middleware('permission:ArticleCategory-Edit');
        Route::post('/artcle_category/{id}/update', 'Article\Artcl_categoriesController@update'); //->middleware('permission:ArticleCategory-Edit');
        Route::delete('/artcle_category/{id}/delete', 'Article\Artcl_categoriesController@delete')->name('artcl_categories.destroy'); //->middleware('permission:ArticleCategory-Delete');

        Route::get('artcle_category/list' , 'Article\Artcl_categoriesController@list'); //->middleware('permission:ArticleCategory-Add|ArticleCategory-Edit|ArticleCategory-Delete');
        /* --------- product rate ------- */
        Route::get('rating/datatable' , 'Rating\RatingController@datatableRating'); //->middleware('permission:Rating-Show|Rating-Delete');
        Route::get('rating/all' , 'Rating\RatingController@allRating'); //->middleware('permission:Rating-Show|Rating-Delete');
        Route::get('rating/{id}/show' , 'Rating\RatingController@showRate'); //->middleware('permission:Rating-Show|Rating-Delete');
        Route::get('rating/{rate_id}/delete/{user_id}' , 'Rating\RatingController@destroy')->name('rate.destroy'); //->middleware('permission:Rating-Delete');
        Route::get('rating/approve/{rate_id}/{user_id}' , 'Rating\RatingController@approveRate'); //->middleware('permission:Rating-Show|Rating-Delete');

        // ==================== bank transfer ========================//
        Route::resource('transferBank','BankTransferController');
        Route::resource('transactionType','transactiontypeController');
        Route::resource('shipping_company','ShippingCompanyController');
        Route::resource('shipping_option','ShippingOptionController');
        Route::get('getcities', 'ShippingOptionController@getcities');
        Route::get('getCountriesShipping', 'ShippingOptionController@getCountriesShipping');
        Route::get('getShippingOptions', 'ShippingOptionController@getShippingOptions');
        Route::resource('orders','OrderController');
        Route::get('orders/{id}/change' , 'OrderController@change');
        Route::get('orders/{id}/print' , 'OrderController@pdf');

        Route::get('/discount','DiscountCodeController@index');
        Route::post('/discount','DiscountCodeController@store')->name('discount.store');
        Route::put('/discount/{id}','DiscountCodeController@update');
        Route::delete('/discount/{id}/delete','DiscountCodeController@destroy')->name('discount.destroy');

        Route::get('/currency','CurrencyController@index');
        Route::post('/currency/store','CurrencyController@store');
        Route::get('/currency/show','CurrencyController@show')->name('currencyShow');
        Route::POST('/currency/{id}/update','CurrencyController@update');
        Route::delete('/currency/{id}/delete','CurrencyController@destroy')->name('currency-delete');

        Route::get('country/list' , 'CountriesController@list');
        Route::get('currency/list' , 'CurrencyController@list');
        Route::get('country/list' , 'CountriesController@list');

        Route::any('logout','AdminAuth@logout');

        Route::get('orderReport' , 'OrderReportController@index');
        Route::get('orderReport/dt' , 'OrderReportController@datatable');

        Route::get('purchasedProductsReport' , 'PurchasedProductsReportController@index');
        Route::get('purchasedProductsReport/dt' , 'PurchasedProductsReportController@datatable');

        Route::get('customerOrderReport' , 'CustomerOrdersReportController@index');
        Route::get('customerOrderReport/dt' , 'CustomerOrdersReportController@datatable');
        Route::get('customerOrderReport/{id}/show' , 'CustomerOrdersReportController@show');

        Route::resource('section_products','ContentSectionProductController')->except(['show','delete']);



        Route::get('settings/homepage/','SettingController@homepage');
    Route::get('settings/homepage/all','SettingController@homepageTable');
    Route::post('settings/homepage/store','SettingController@homepagestore')->name('homepage.store');
    Route::put('settings/homepage/{id}/update','SettingController@homepageupdate')->name('homepage.update');
    Route::delete('settings/homepage/delete/{id}','SettingController@homepagedelete')->name('homepage.delete');


    // country crud

    Route::resource('countries', 'CountriesController')->except('show');
    Route::any('countries/destroy/{id}', 'CountriesController@destroy')->name('countries-destroy');
//    Route::any('countries/datatable','CountriesController@Countrydatatable')->name('countries-datatable');

        Route::get('city/get_datatable' , 'CitiesController@get_datatable');
        Route::get('city/all' , 'CitiesController@index');
        Route::post('city/store' , 'CitiesController@store');
        Route::post('city/update' , 'CitiesController@update');
        Route::get('city/delete' , 'CitiesController@destroy')->name('city.destroy');

    // ========================== languages ==================================//
    Route::get('/lang/{lang}','SettingController@lang'); //->middleware('permission:Language-Change'); // set language adminLang

    Route::get('languages', 'LangController@getLangs')->name('admin.languages');
    Route::get('change_language', 'LangController@changeLang')->name('change_language');

    // ========================== translate ==================================//
    Route::get('translate','translation\TranslationController@index')->name('translation.index');
    Route::post('translate','translation\TranslationController@store')->name('translation.store');
    Route::get('translation/{id}','translation\TranslationController@show')->name('translation.show');

    // ========================== content management ==================================//
    Route::resource('content_management', 'Basic\ContentManagementController');
    Route::get('content/sort', 'Basic\ContentManagementController@sort');

    });







    // Route::get('/article_cat' , function(){
    //     return view('admin2.articles.artcl_category.create');
    // });

});
// Route::get('test2' , function(){
//     return view('admin.layout.index2');
// });



?>
