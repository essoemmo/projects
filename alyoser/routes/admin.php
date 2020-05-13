<?php

/*reset email*/

Route::get('forgetPassword','adminAuthController@forgetPassword')->name('adminLogin-forget');
Route::post('forgetPassword','adminAuthController@forgetPasswordPost')->name('adminLogin-post-forget');
Route::get('resetPassword/{token}','adminAuthController@resetPassword')->name('reset-password-admin');
Route::post('resetPassword/{token}','adminAuthController@resetPasswordPost')->name('reset-password-admin-post');

Route::group(['prefix' => app()->getLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],
    function()
    {
        Route::prefix('dashboard')->middleware(['auth','role:super_admin|admin'])->group(function (){


            Route::get('/','dashboardController@index')->name('dashboard');

            //user controller

            Route::resource('users','UserController')->except(['show']);

            //categoies controller

            Route::resource('categories','CategoryController')->except(['show']);

            //subCategory controller

            Route::resource('subcategories','SubCatController')->except(['show']);

            //subCat controller

            Route::resource('subcats','SubNewCatController')->except(['show']);


            //roles controller

            Route::resource('roles','RoleController')->except(['show']);

            //upload controller

            Route::resource('uploads','UploadController')->except(['show']);
            Route::get('get/category','UploadController@getCategory')->name('get-category');
            Route::post('upload/file/{id}','UploadController@uploadImages')->name('upload-files');
            Route::post('upload/file/delete/{id}' , 'UploadController@deleteImages')->name('delete-file');

            // reports

            Route::get('reports','ReportController@index')->name('reports.index');
            Route::get('reports/data/{id}','ReportController@show')->name('reports.show');

            Route::get('reports/print','ReportController@printdata')->name('reports.print');
            Route::post('reports/send/email','ReportController@sendEmail')->name('send-email');

            // filter report
            Route::get('reports/day/{day}','ReportController@index')->name('reports.day');
            Route::get('download-zip/{id}', 'ReportController@downloadZip')->name('download-zip');

        });
    });



?>
