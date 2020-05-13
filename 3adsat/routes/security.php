<?php
Route::group(['prefix' => 'admin/panel', 'middleware' => 'admin'], function () {
    Route::get('permission/all', 'permissionController@allPermissions')->middleware('permission:Permission-Add|Permission-Edit|Permission-Delete');
    Route::get('permission/get_datatable','permissionController@getDatatablePermission');

    Route::get('permission/add','permissionController@createpermission');
    Route::post('permission/add', 'permissionController@storePermission')->middleware('permission:Permission-Add');

    Route::get('permission/{id}/edit', 'PermissionController@editPermission')->middleware('permission:Permission-Delete');
    Route::put('permission/update', 'PermissionController@updatePermission')->middleware('permission:Permission-Edit');

    Route::any('permission/{id}/delete', 'PermissionController@deletePermission')->middleware('permission:Permission-Delete');

    /*roles*/

    Route::get('role/add', 'RoleController@addRole')->middleware('permission:Role-Add');
    Route::post('role/add', 'RoleController@storeRole')->middleware('permission:Role-Add');

    Route::get('role/all', 'RoleController@getAllRoles')->middleware('permission:Role-Add|Role-Edit|Role-Delete');
    Route::get('role/get_datatable', 'RoleController@getDatatableRoles')->middleware('permission:Role-Add|Role-Edit|Role-Delete');

    Route::get('role/{id}/edit', 'RoleController@editRole')->middleware('permission:Role-Edit');
    Route::post('role/{id}/edit', 'RoleController@updateRole')->middleware('permission:Role-Edit');
    Route::get('role/{id}/delete', 'RoleController@deleteRole')->middleware('permission:Role-Delete');

    /*Role controller*/
});
/*permission controller*/

?>