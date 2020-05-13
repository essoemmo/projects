<?php

//Auth::routes();

Config::set('auth.defines', 'admin');

//Route::group(['prefix'=>'admin','middleware' => ['admin:admin'],'namespace' => 'Security'],function (){
    Route::prefix('admin')->middleware('admin:admin')->namespace('Security')->group(function (){

    /*=============================== permissions & roles section ========================================*/
// permissions
    Route::get('permission/all', 'permissionController@allPermissions');
    Route::get('permission/get_datatable','permissionController@getDatatablePermission');
    Route::post('permission/add', 'permissionController@storePermission')->middleware('permission:Permission-Add');
    Route::put('permission/update', 'PermissionController@updatePermission')->middleware('permission:Permission-Edit');
    Route::any('permission/{id}/delete', 'PermissionController@deletePermission')->middleware('permission:Permission-Delete');

// Roles
    Route::get('role/add', 'RoleController@addRole')->middleware('permission:Role-Add');
    Route::post('role/add', 'RoleController@storeRole')->middleware('permission:Role-Add');

    Route::get('role/all', 'RoleController@getAllRoles')->middleware('permission:Role-Add|Role-Edit|Role-Delete');
    Route::get('role/get_datatable', 'RoleController@getDatatableRoles')->middleware('permission:Role-Add|Role-Edit|Role-Delete');

    Route::get('role/{id}/edit', 'RoleController@editRole')->middleware('permission:Role-Edit');
    Route::post('role/{id}/edit', 'RoleController@updateRole')->middleware('permission:Role-Edit');
    Route::get('role/{id}/delete', 'RoleController@deleteRole')->middleware('permission:Role-Delete');

// admins
    Route::get('admin/all', 'AdminController@showAdmins')->middleware('permission:AdminUser-Add|AdminUser-Edit|AdminUser-Delete');

    Route::get('admin/add', 'AdminController@createAdmin')->middleware('permission:AdminUser-Add');
    Route::post('admin/add', 'AdminController@storeNewAdmin')->middleware('permission:AdminUser-Add');

    Route::get('admin/{id}/edit', 'AdminController@editAdmin')->middleware('permission:AdminUser-Edit');
    Route::post('admin/{id}/edit', 'AdminController@updateAdmin')->middleware('permission:AdminUser-Edit');

    Route::delete('admin/{id}/delete', 'AdminController@deleteAdmin')->name('admin.destroy')->middleware('permission:AdminUser-Delete');
    Route::post('changepassword/{id}', 'AdminController@changePassword');//->middleware('permission:AdminUser-Add|AdminUser-Edit');



    // admin add front users
    Route::get('user/all', 'UserController@showUsers')->middleware('permission:FrontUser-Add|FrontUser-Edit|FrontUser-Delete');

    Route::get('user/add', 'UserController@createUser')->middleware('permission:FrontUser-Add');
    Route::post('user/add', 'UserController@storeNewUser')->middleware('permission:FrontUser-Add');

    Route::get('user/{id}/edit', 'UserController@editUser')->middleware('permission:FrontUser-Edit');
    Route::post('user/{id}/edit', 'UserController@updateUser')->middleware('permission:FrontUser-Edit');

    Route::delete('user/{id}/delete', 'UserController@deleteUser')->name('admin.destroy')->middleware('permission:FrontUser-Delete');


});






//Route::get('/adminpanel/membership/all','Security\Membership\MembershipController@index');
