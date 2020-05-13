<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::group(['prefix' => 'adminpanel', 'middleware' => ['auth:store', 'demoCheck'], 'namespace' => 'Security'], function () {

    /*=============================== permissions & roles section ========================================*/

    // permissions
    Route::get('permission/all', 'PermissionController@allPermissions')->middleware('permission:Permission-Add|Permission-Edit|Permission-Delete');
    Route::get('permission/get_datatable', 'PermissionController@getDatatablePermission')->middleware('permission:Permission-Add|Permission-Edit|Permission-Delete');
    Route::post('permission/add', 'PermissionController@storePermission')->middleware('permission:Permission-Add');
    Route::put('permission/update', 'PermissionController@updatePermission')->middleware('permission:Permission-Edit');
    Route::any('permission/{id}/delete', 'PermissionController@deletePermission')->middleware('permission:Permission-Delete');
    Route::get('permission/{langId}', 'RoleController@getPermissions');

// Roles
    Route::get('role/add', 'RoleController@addRole')->middleware('permission:Role-Add');
    Route::post('role/add', 'RoleController@storeRole')->middleware('permission:Role-Add');

    Route::get('role/all', 'RoleController@getAllRoles')->middleware('permission:Role-Add|Role-Edit|Role-Delete');
    Route::get('role/get_datatable', 'RoleController@getDatatableRoles')->middleware('permission:Role-Add|Role-Edit|Role-Delete');

    Route::get('role/{id}/edit', 'RoleController@editRole')->middleware('permission:Role-Edit');
    Route::post('role/{id}/edit', 'RoleController@updateRole')->middleware('permission:Role-Edit');
    Route::get('role/{id}/delete', 'RoleController@deleteRole')->middleware('permission:Role-Delete');

});
// admins
Route::group(['prefix' => 'adminpanel', 'middleware' => 'auth:store'], function () {
    Route::get('user/all', 'Security\AdminController@showUsers')->middleware('permission:AdminUser-Add|AdminUser-Edit|AdminUser-Delete');
    Route::get('user/getDatatable', 'Security\AdminController@getDatatableUser')->middleware('permission:AdminUser-Add|AdminUser-Edit|AdminUser-Delete'); //get database user

    Route::get('user/add', 'Security\AdminController@createUser')->middleware('permission:AdminUser-Add');
    Route::post('user/add', 'Security\AdminController@storeNewUser')->middleware('permission:AdminUser-Add');

    Route::get('user/{id}/edit', 'Security\AdminController@editUser')->middleware('permission:AdminUser-Edit');
    Route::post('user/{id}/edit', 'Security\AdminController@updateUser')->middleware('permission:AdminUser-Edit');

    Route::delete('user/{id}/delete', 'Security\AdminController@deleteUser')->middleware('permission:AdminUser-Delete')->name('users.destroy');


    // admin add users store
//    Route::get('store_user/all', 'Security\AdminController@showStoreUsers');//->middleware('permission:StoreUser-Add|StoreUser-Edit|StoreUser-Delete');
//
//    Route::get('store_user/add', 'Security\AdminController@createUser');//->middleware('permission:StoreUser-Add');
//    Route::post('store_user/add', 'Security\AdminController@storeNewUser');//->middleware('permission:StoreUser-Add');
//
//    Route::get('store_user/{id}/edit', 'Security\AdminController@editUser');//->middleware('permission:StoreUser-Edit');
//    Route::post('store_user/{id}/edit', 'Security\AdminController@updateUser');//->middleware('permission:StoreUser-Edit');
//
//    Route::delete('store_user/{id}/delete', 'Security\AdminController@deleteUser');//->name('users.destroy')->middleware('permission:StoreUser-Delete');

});

/*=============================== membership section ========================================================*/

//    Route::group(['prefix'=>'adminpanel','namespace' => 'Security\Membership','middleware'=>'auth:admin'], function() {
//        // memberships
//        Route::get('membership/all','MembershipController@index')->middleware('permission:Membership-Add|Membership-Edit|Membership-Delete');
//        Route::get('membership/datatable','MembershipController@datatableMembership')->middleware('permission:Membership-Add|Membership-Edit|Membership-Delete');
//        Route::get('membership/create','MembershipController@create')->middleware('permission:Membership-Add');
//        Route::post('membership/store','MembershipController@store')->middleware('permission:Membership-Add');
//        Route::get('membership/{id}/edit','MembershipController@edit')->middleware('permission:Membership-Edit');
//        Route::put('membership/update/{id}','MembershipController@update')->middleware('permission:Membership-Edit');
//        Route::delete('membership/delete/{id}','MembershipController@delete')->name('member.destroy')->middleware('permission:Membership-Delete');
//
//        // user membership
//        Route::get('membership/user_membership/all','UserMembershipController@index')->middleware('permission:UserMembership-Add|UserMembership-Edit|UserMembership-Delete');
//        Route::get('membership/user_membership/datatable','UserMembershipController@datatableUserMembership')->middleware('permission:UserMembership-Add|UserMembership-Edit|UserMembership-Delete');
//        Route::get('membership/user_membership/create','UserMembershipController@create')->middleware('permission:UserMembership-Add');
//        Route::post('membership/user_membership/store','UserMembershipController@store')->middleware('permission:UserMembership-Add');
//        Route::get('membership/user_membership/{id}/edit','UserMembershipController@edit')->middleware('permission:UserMembership-Edit');
//        Route::post('membership/user_membership/{id}/update','UserMembershipController@update')->middleware('permission:UserMembership-Edit');
//        Route::get('membership/user_membership/{id}/delete','UserMembershipController@delete')->name('user_membership.destroy')->middleware('permission:UserMembership-Delete');
//        Route::get('membership/user_membership/get_membership','UserMembershipController@get_membership')->name('get_membership');
//
//        // membership permissions
//        Route::get('membership/membership_perms/create','MembershipPermsController@create')->middleware('permission:MembershipPermissions-Add');
//        Route::post('membership/membership_perms/store','MembershipPermsController@store')->middleware('permission:MembershipPermissions-Add');
//
//        Route::get('membership/membership_perms/{id}/edit','MembershipPermsController@edit')->middleware('permission:MembershipPermissions-Edit');
//        Route::post('membership/membership_perms/{id}/update','MembershipPermsController@update')->middleware('permission:MembershipPermissions-Edit');
//
//        Route::get('membership/membership_perms/all','MembershipPermsController@index')->middleware('permission:MembershipPermissions-Add|MembershipPermissions-Edit|MembershipPermissions-Delete');
//        Route::get('membership/membership_perms/datatable','MembershipPermsController@datatableMemberPer')->middleware('permission:MembershipPermissions-Add|MembershipPermissions-Edit|MembershipPermissions-Delete');
//
//    });


//Route::get('/adminpanel/membership/all','Security\Membership\MembershipController@index');
