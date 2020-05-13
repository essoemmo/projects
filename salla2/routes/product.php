<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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


//home
//change language
//Route::get('/set-language/{lang}/{id}', 'HomeController@set')->name('set.language');
//
//$default_front = [
//        'prefix'     => config('boilerplate.app.prefix', 'front.'),
//        'domain'     => '',
//        'middleware' => ['web', 'boilerplatelocale'],
//        'as'         => 'front.',
//    ];
Auth::routes();

Route::group(['prefix' => 'adminpanel', 'middleware' => ['auth:store', 'demoCheck']], function () {
    /*---- product type -------------------*/




//    Route::resource('product/all','ProductsController');
    Route::get('product/all', 'Admin\Product\ProductsController@all_products')->middleware('permission:Product-Add|Product-Edit|Product-Delete');
    Route::get('product/{id}/edit', 'Admin\Product\ProductsController@edit')->middleware('permission:Product-Add|Product-Edit|Product-Delete');
    Route::get('product/{id}/show', 'Admin\Product\ProductsController@show_product')->middleware('permission:Product-Add|Product-Edit|Product-Delete');
    Route::get('product/{id}/img', 'Admin\Product\ProductsController@get_images')->middleware('permission:Product-Add|Product-Edit|Product-Delete');
    Route::delete('product/delete/{id}', 'Admin\Product\ProductsController@delete')->name('productdelete')->middleware('permission:Product-Add|Product-Edit|Product-Delete');
    Route::post('dublicate/{id}', 'Admin\Product\ProductsController@dublicated')->name('product_dublicate')->middleware('permission:Product-Add|Product-Edit|Product-Delete');
    Route::get('get_status', 'Admin\Product\ProductsController@Get_status')->name('get_status')->middleware('permission:Product-Add|Product-Edit|Product-Delete');
    Route::get('hidden', 'Admin\Product\ProductsController@hidden')->name('get_hidden')->middleware('permission:Product-Add|Product-Edit|Product-Delete');
    Route::get('product/customers/{id}', 'Admin\Product\ProductsController@Get_users_product')->name('product.customers')->middleware('permission:Product-Add|Product-Edit|Product-Delete');
    Route::get('product', 'Admin\Product\ProductsController@index')->middleware('permission:Product-Add|Product-Edit|Product-Delete')->name('allProducts');
    Route::post('saveproduct', 'Admin\Product\ProductsController@saveproduct')->middleware('permission:Product-Add|Product-Edit|Product-Delete');
    Route::post('updateproduct', 'Admin\Product\ProductsController@updateproduct')->middleware('permission:Product-Add|Product-Edit|Product-Delete');
    Route::post('saveProductDetails', 'Admin\Product\ProductsController@saveProductDetails')->middleware('permission:Product-Add|Product-Edit|Product-Delete');
    Route::post('saveAllCat', 'Admin\Product\ProductsController@saveAllCat')->middleware('permission:Product-Add|Product-Edit|Product-Delete');
    Route::post('savefeatures', 'Admin\Product\ProductsController@savefeatures')->middleware('permission:Product-Add|Product-Edit|Product-Delete');
    Route::get('product/{feature_id}/featuredel', 'Admin\Product\ProductsController@featuredel')->middleware('permission:Product-Add|Product-Edit|Product-Delete');
    Route::get('getproduct/{id}', 'Admin\Product\ProductsController@getproduct')->middleware('permission:Product-Add|Product-Edit|Product-Delete');
    Route::post('product/imagespost', 'Admin\Product\ProductsController@imagespost')->middleware('permission:Product-Add|Product-Edit|Product-Delete');
    Route::post('imageSubmit', 'Admin\Product\ProductsController@imageSubmit')->middleware('permission:Product-Add|Product-Edit|Product-Delete');
    Route::post('imagesdel', 'Admin\Product\ProductsController@imagesdel')->middleware('permission:Product-Add|Product-Edit|Product-Delete');
    Route::post('product/productdel', 'Admin\Product\ProductsController@productdel')->middleware('permission:Product-Add|Product-Edit|Product-Delete');
    Route::get('product/{cat_id}/catdel', 'Admin\Product\ProductsController@catdel')->middleware('permission:Product-Add|Product-Edit|Product-Delete');
    Route::get('product/get/lang/value', 'Admin\Product\ProductsController@ProductrgetLangvalue')->name('Product_lang_value');
    Route::post('product/lang/store', 'Admin\Product\ProductsController@ProductstorelangTranslation')->name('Product_lang_store');

//    stores
//    Route::Resource('store', 'Admin\Product\StoresController');//->middleware('permission:Store-Add|Store-Edit|Store-Delete');

    Route::get('product/data', 'Admin\Product\ProductsController@getData')->name('get-product-data')->middleware('permission:Product-Add|Product-Edit|Product-Delete');
    Route::get('product/getFeatures', 'Admin\Product\ProductsController@getFeatures')->name('getFeatures')->middleware('permission:Product-Add|Product-Edit|Product-Delete');
    /*----------------- product type -------------------*/
    Route::get('product_type/all', 'Admin\Product\ProductTypeController@all')->middleware('permission:ProductType-Add|ProductType-Edit|ProductType-Delete');//->name("product_type");
    Route::get('product_type/get_datatable', 'Admin\Product\ProductTypeController@datatableProductType')->middleware('permission:ProductType-Add|ProductType-Edit|ProductType-Delete');
    Route::post('product_type/store', 'Admin\Product\ProductTypeController@store')->middleware('permission:ProductType-Add');
    Route::post('product_type/update', 'Admin\Product\ProductTypeController@update')->middleware('permission:ProductType-Edit');
    Route::get('product_type/delete', 'Admin\Product\ProductTypeController@delete')->middleware('permission:ProductType-Delete');


    // samer

    Route::get('get/product/card', 'Admin\Product\ProductTypeController@getCard')->name('get_card')->middleware('permission:Product-Add|Product-Edit|Product-Delete');
    Route::post('product/card', 'Admin\Product\ProductTypeController@postCard')->name('post_card')->middleware('permission:Product-Add|Product-Edit|Product-Delete');
    Route::post('product/del_digital', 'Admin\Product\ProductTypeController@delDigital')->name('del_digital')->middleware('permission:Product-Add|Product-Edit|Product-Delete');
//    Route::post('product/del_card/{id}','Admin\Product\ProductTypeController@delCard')->name('del_card');


    Route::get('get/product/digital', 'Admin\Product\ProductTypeController@getdigital')->name('get_digital')->middleware('permission:Product-Add|Product-Edit|Product-Delete');
    Route::post('product/digital', 'Admin\Product\ProductTypeController@postdigital')->name('post_digital')->middleware('permission:Product-Add|Product-Edit|Product-Delete');

    Route::get('get/product/donate', 'Admin\Product\ProductTypeController@getdonate')->name('get_donate')->middleware('permission:Product-Add|Product-Edit|Product-Delete');
    Route::post('product/donate', 'Admin\Product\ProductTypeController@postdonate')->name('post_donate');//->middleware('permission:Product-Add|Product-Edit|Product-Delete');

    Route::get('shipping', 'Admin\Shipping\ShippingController@index')->middleware('permission:shipping-add');
    Route::post('save_shipping_company', 'Admin\Shipping\ShippingController@save_shipping_company')->middleware('permission:shipping-add');
    Route::post('update_shipping_company/{id}', 'Admin\Shipping\ShippingController@update_shipping_company')->middleware('permission:shipping-add');
    Route::get('get_cities', 'Admin\Shipping\ShippingController@get_cities')->middleware('permission:shipping-add');
    Route::delete('shipping_option/delete', 'Admin\Shipping\ShippingController@delete_shipping_option')->middleware('permission:shipping-add');





//    orders

    Route::get('orders/all', 'Admin\orders\OrdersController@index')->name('admin.orders.index')->middleware('permission:Order-Add|Order-Edit|Order-Delete');
    Route::get('orders/{id}/edit', 'Admin\orders\OrdersController@edit')->middleware('permission:Order-Edit');
    Route::delete('orders/{id}/delete', 'Admin\orders\OrdersController@delete')->name('orders.destroy')->middleware('permission:Order-Delete');
    Route::get('orders', 'Admin\orders\OrdersController@show')->middleware('permission:Order-Edit|Order-Delete');
    Route::post('orders', 'Admin\orders\OrdersController@store')->middleware('permission:Order-Edit');
    Route::post('saveallorders', 'Admin\orders\OrdersController@saveallorders')->name('save-new-Product')->middleware('permission:Order-Add|Order-Edit|Order-Delete');
    Route::post('updateallorders', 'Admin\orders\OrdersController@updateallorders')->name('update-Product')->middleware('permission:Order-Edit|Order-Delete');

    Route::get('orders/{id}/show', 'Admin\orders\OrdersController@showOrder')->name('show_orders')->middleware('permission:Order-Add|Order-Edit|Order-Delete');


    Route::get('get/pays', 'Admin\orders\OrdersController@getPayways')->name('get-pay-banks')->middleware('permission:Order-Add|Order-Edit|Order-Delete');


    Route::post('orders/saveproduct', 'Admin\orders\OrdersController@saveproduct')->middleware('permission:Order-Add|Order-Edit|Order-Delete');
    Route::post('orders/savenewuser', 'Admin\orders\OrdersController@savenewuser')->middleware('permission:Order-Add|Order-Edit|Order-Delete');
    Route::get('orders/refreshproducts', 'Admin\orders\OrdersController@refreshproducts')->middleware('permission:Order-Add|Order-Edit|Order-Delete');


    Route::post('review/order', 'Admin\orders\OrdersController@reviewOrder')->name('review-order')->middleware('permission:Order-Add|Order-Edit|Order-Delete');

    // samer abooda
    Route::get('get/product', 'Admin\orders\OrdersController@getproduct')->name('get-product')->middleware('permission:Order-Add|Order-Edit|Order-Delete');
    Route::get('get/product/single', 'Admin\orders\OrdersController@getproductsingle')->name('get-product-single')->middleware('permission:Order-Add|Order-Edit|Order-Delete');


//    shippings
    Route::group(['namespace' => 'Admin\shippings'], function () {
        /*---- shipping option -------------------*/

        Route::post('getShippingOptions', 'ShippingOptionsController@getShippingOptions')->name('getShippingOptions')->middleware('permission:ShippingOption-Add|ShippingOption-Edit|ShippingOption-Delete');
        Route::post('getCountriesShipping', 'ShippingOptionsController@getCountriesShipping')->middleware('permission:ShippingOption-Add|ShippingOption-Edit|ShippingOption-Delete');

        Route::get('shipping_option/all', 'ShippingOptionsController@index')->middleware('permission:ShippingOption-Add|ShippingOption-Edit|ShippingOption-Delete');
        Route::resource('companies', 'companiesShippingController')->middleware('permission:ShippingCompany-Add|ShippingCompany-Edit|ShippingCompany-Delete');
        Route::get('getcities', 'ShippingOptionsController@getcities')->middleware('permission:ShippingOption-Add');
        Route::get('getcitiesbycountry/{country}', 'ShippingOptionsController@getCitiesByCountry')->middleware('permission:ShippingOption-Add');
        Route::get('getCities', 'ShippingOptionsController@getCities')->name('getCitiesByCountry')->middleware('permission:ShippingOption-Add');
        Route::get('getcitybyid/{city}', 'ShippingOptionsController@getCityById')->middleware('permission:ShippingOption-Add');
        Route::get('shipping_option/create', 'ShippingOptionsController@create')->middleware('permission:ShippingOption-Add');
        Route::post('shipping_option/store', 'ShippingOptionsController@store')->middleware('permission:ShippingOption-Add');
        Route::get('shipping_option/{id}/edit', 'ShippingOptionsController@edit')->middleware('permission:ShippingOption-Edit');
        Route::put('shipping_option/{id}/update', 'ShippingOptionsController@update')->middleware('permission:ShippingOption-Edit');
        Route::delete('shipping_option/{id}/delete', 'ShippingOptionsController@delete')->name('shipping_option.destroy')->middleware('permission:ShippingOption-Delete');


    });


//    transaction
    Route::get('transactionType/all', 'Admin\transaction\TransactionTypesController@index')->middleware('permission:TransactionType-Add|TransactionType-Edit|TransactionType-Delete');
    Route::get('transactionType/add', 'Admin\transaction\TransactionTypesController@create')->middleware('permission:TransactionType-Add');
    Route::put('transactionType/{id}/edit', 'Admin\transaction\TransactionTypesController@edit')->middleware('permission:TransactionType-Edit');
    Route::post('transactionType/store', 'Admin\transaction\TransactionTypesController@store')->name('transactionType.store')->middleware('permission:TransactionType-Add');
    Route::any('transactionType/destroy', 'Admin\transaction\TransactionTypesController@destroy')->name('transactionType.destroy')->middleware('permission:TransactionType-Delete');
    /*---- category -------------------*/
//    Route::get('category/all', 'Admin\category\CategoryController@all')->middleware('permission:ProductCategory-Add|ProductCategory-Edit|ProductCategory-Delete');
//    Route::get('category/getall/{store}', 'Admin\category\CategoryController@getall')->middleware('permission:ProductCategory-Add');
//    Route::get('category/get_datatable', 'Admin\category\CategoryController@getDatatableCategory')->middleware('permission:ProductCategory-Add|ProductCategory-Edit|ProductCategory-Delete');
    Route::get('category/create', 'Admin\category\CategoryController@create')->middleware('permission:ProductCategory-Add');
//    Route::post('category/store', 'Admin\category\CategoryController@store')->middleware('permission:ProductCategory-Add');
//    Route::get('category/{cat_id}/edit', 'Admin\category\CategoryController@edit')->middleware('permission:ProductCategory-Edit');
//    Route::post('category/{cat_id}/update', 'Admin\category\CategoryController@update')->middleware('permission:ProductCategory-Edit');
//    Route::get('category/{cat_id}/delete', 'Admin\category\CategoryController@delete')->middleware('permission:ProductCategory-Delete');
//    Route::get('sub_category/{sub_cat_id}/delete', 'Admin\category\CategoryController@delete_sub_category')->middleware('permission:ProductCategory-Delete');

    Route::get('product_status', 'Admin\Product\ProductFilterController@product_status')->middleware('permission:Product-Add|Product-Edit|Product-Delete');
    Route::get('product_type', 'Admin\Product\ProductFilterController@product_type')->middleware('permission:Product-Add|Product-Edit|Product-Delete');
    Route::get('product_category', 'Admin\Product\ProductFilterController@product_category')->middleware('permission:ProductCategory-Add');


    Route::get('product/syncInstagram',
        'InstagramController@redirectTo')->name('syncInstagram');

    Route::get('product/callback', 'InstagramController@Callback')->name('instagram.callback');

    Route::get('arrangeProducts', 'Admin\Product\ProductServiceController@arrangeProducts')->name('arrangeProducts');
    Route::get('arrangeProducts/change', 'Admin\Product\ProductServiceController@arrangeProductsChange')->name('arrangeProductsChange');
    Route::post('arrangeProducts/save_sort', 'Admin\Product\ProductServiceController@arrangeProductsSave')->name('saveSort');

    Route::get('productsInventory', 'Admin\Product\ProductServiceController@productsInventory')->name('productsInventory');

    Route::post('deleteAllProducts', 'Admin\Product\ProductServiceController@deleteAllProducts')->name('deleteAllProducts');

    Route::get('productsImport', 'Admin\Product\ProductServiceController@productsImport')->name('productsImport');
    Route::get('productsImportDownload', 'Admin\Product\ProductServiceController@productsImportDownload')->name('productsImportDownload');
    Route::post('productsImport', 'Admin\Product\ProductServiceController@productsImportSave')->name('productsImportSave');

    Route::get('productsExportExcel', 'Admin\Product\ProductServiceController@productsExportExcel')->name('productsExportExcel');
    Route::get('productsExportCVS', 'Admin\Product\ProductServiceController@productsExportCVS')->name('productsExportCVS');

    // product seo
    Route::get('productSeo', 'Admin\Setting\SeoController@getProductSeo')->name('getProductSeo');

    Route::post('repeatproduct', 'Admin\Product\ProductsController@clone')->name('repeatproduct');

});

