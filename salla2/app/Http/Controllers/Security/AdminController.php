<?php

namespace App\Http\Controllers\Security;

use App\admin;
use App\DataTables\StoreUsersDataTable;
use App\Models\RoleStore;
use App\StoreUser;
use App\StoreUsers;
use App\User;
use App\DataTables\AdminsDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;


use App\Help\Utility;

class AdminController extends Controller
{
    // index for admin panel
    public function index()
    {
//       echo Utility::Store;

    }


    // function to show all admins
    public function showUsers(AdminsDataTable $admins)
    {
        return $admins->render('security.users.allUsers', ['type' => _('Admins')]);
    }

    // make datatable for users


    //  admin create new user through view
    public function createUser()
    {

        $guard_store = Utility::Store;
        $roles = RoleStore::leftJoin('roles', 'roles.id', 'role_store.role_id')
            ->select('roles.id as id', 'roles.name as name', 'role_store.store_id', 'roles.guard_name')
            ->where('guard_name', $guard_store)->where('role_store.store_id', \App\Bll\Utility::getStoreId())->get();

        // $roles =  Role::where('guard','web')->where('store_id', \App\Bll\Utility::getStoreId())->get();

        if (request()->is('adminpanel/store_user/add')) { // ordinary user
            $redirect_url = "store_user";
            $type = _i('User');
            return view('security.users.add', compact('roles', 'redirect_url', 'type'));
        } else { // admins
            $redirect_url = "user";
            $type = _i('Admin');
            return view('security.users.add', compact('roles', 'redirect_url', 'type'));
        }
    }

    //  admin store data of new user
    public function storeNewUser(Request $request)
    {
        $guard_store = Utility::Store;
        $storeId = \App\Bll\Utility::getStoreId();
        $rules = [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            // 'email' => 'unique:users,email,NULL,id,store_id,'.$storeId .'required','string', 'email', 'max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            //'roles' => ['required'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $sessionStore = session()->get('StoreId');
            if ($sessionStore == \App\Bll\Utility::$demoId) {
                return redirect()->back()->with('flash_message', _i('Added Successfully'));
            }


//            dd(request()->is('adminpanel/store_user/add'));
            if (request()->is('adminpanel/user/add')) { //admin
                $user = StoreUser::create([
                    'name' => $request->name,
                    'lastname' => $request->lastname,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'guard' => $guard_store,
                    'store_id' => $storeId
                ]);
                // loop for roles from roles[] array
                foreach ($request->roles as $key => $value) {
                    $user = StoreUser::find($user->id); // get id of new user
                    $role = Role::find($value);
                    $user->assignRole($role); // attached new user with role
                    $roles[] = $role;     // make array of roles that selected
                    $permissions[] = $user->getPermissionsViaRoles($roles);  // make array of permissions via roles that selected before
                }
                $user = $user->givePermissionTo($permissions); // attached new user with permissions that belonges to roles selected before
                $user->save();

            } else { //// ordinary user

                $user = User::create([
                    'name' => $request->name,
                    'lastname' => $request->lastname,
                    'email' => $request->email,
                    // 'phone' => $request->phone,
                    'guard' => "web",
                    'password' => Hash::make($request->password),
                    'store_id' => $storeId
                ]);
                // loop for roles from roles[] array
//                foreach($request->roles as $key => $value){
//                    $user = User::find($user->id); // get id of new user
//                    $user->assignRole($value); // attached new user with role
//                    $roles[] = $value;     // make array of roles that selected
//                    $permissions[] = $user->getPermissionsViaRoles($roles);  // make array of permissions via roles that selected before
//                }
//                $user = $user->givePermissionTo($permissions); // attached new user with permissions that belonges to roles selected before
//                $user->save();
            }
            return redirect()->back()->with('success', _i('Added Successfully !'));
        }

    }


    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $guard_store = Utility::Store;
        $roles = RoleStore::leftJoin('roles', 'roles.id', 'role_store.role_id')
            ->select('roles.id as id', 'roles.name as name', 'role_store.store_id', 'roles.guard_name')
            ->where('guard_name', $guard_store)->where('role_store.store_id', \App\Bll\Utility::getStoreId())->get();
        //$roles = Role::all();
        if (request()->is('adminpanel/store_user/' . $user->id . '/edit')) {
            $user = User::findOrFail($id);
            $redirct_url = "store_user";
            $type = _i('User');
            return view('security.users.edit', compact('user', 'roles', 'redirct_url', 'type'));

        } else {
            $user = StoreUser::findOrFail($id);

            $redirct_url = "user";
            $type = _i('Admin');
            return view('security.users.edit', compact('user', 'roles', 'redirct_url', 'type'));
        }
    }


    public function updateUser(Request $request, $id)
    {
//        dd(request());
//        return [$request->all()];
        $storeId = \App\Bll\Utility::getStoreId();

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            //'email' => ['unique:users,email,NULL,id,store_id,'.$storeId.$id ,'required', 'string', 'email', 'max:255'],
            'password' => ['sometimes', 'confirmed'],
            'roles' => ['sometimes', 'min:1']
        ];
        if (!is_null($request->password)) {
            $rules['password'] = ['confirmed', 'min:6'];
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $sessionStore = session()->get('StoreId');
            if ($sessionStore == \App\Bll\Utility::$demoId) {
                return redirect()->back()->with('flash_message', _i('Updated Successfully'));
            }

            $user = User::findOrFail($id);
            if (request()->is('adminpanel/store_user/' . $user->id . '/edit')) {

                $user->name = $request->input('name');
                $user->lastname = $request->lastname;
                $user->email = $request->input('email');

//                if($request->has('roles'))
//                {
////            DB::table('model_has_roles')->where('model_id',$user->id)->delete();
////            $user->syncRoles(intval($request->roles)); // All current roles will be removed from the user and replaced by the array given (roles[])
////            $permissions[] = $user->getPermissionsViaRoles(intval($request->roles)); // get Permissions inherited from the user's roles
////            $user->syncPermissions($permissions);// All permissions via roles[] will be removed from the user and replaced by the array given (permissions[])
//
//                    $user->syncRoles($request->roles); // All current roles will be removed from the user and replaced by the array given (roles[])
//                    $permissions[] = $user->getPermissionsViaRoles($request->roles); // get Permissions inherited from the user's roles
//                    $user->syncPermissions($permissions);// All permissions via roles[] will be removed from the user and replaced by the array given (permissions[])
//                }

                if ($request->has('password') && $request->input('password') != null) {
//            dd($request->input('password'));
                    $user->password = bcrypt($request->password);
                }
                $user->save();

                return redirect('/adminpanel/store_user/' . $user->id . '/edit')->with('success', _i('Updated Successfully !')); // return if is update admin

            } else {
                $user = StoreUser::findOrFail($id);

                $user->name = $request->input('name');
                $user->lastname = $request->lastname;
                $user->email = $request->input('email');

                if ($request->has('roles')) {
//            DB::table('model_has_roles')->where('model_id',$user->id)->delete();
//            $user->syncRoles(intval($request->roles)); // All current roles will be removed from the user and replaced by the array given (roles[])
//            $permissions[] = $user->getPermissionsViaRoles(intval($request->roles)); // get Permissions inherited from the user's roles
//            $user->syncPermissions($permissions);// All permissions via roles[] will be removed from the user and replaced by the array given (permissions[])

                    $user->syncRoles($request->roles); // All current roles will be removed from the user and replaced by the array given (roles[])
                    $permissions[] = $user->getPermissionsViaRoles($request->roles); // get Permissions inherited from the user's roles
                    $user->syncPermissions($permissions);// All permissions via roles[] will be removed from the user and replaced by the array given (permissions[])
                }

                if ($request->has('password') && $request->input('password') != null) {
//            dd($request->input('password'));
                    $user->password = bcrypt($request->password);
                }
                $user->save();

                return redirect('/adminpanel/user/' . $user->id . '/edit')->with('success', _i('Updated Successfully !')); // return if is update admin
            }


        }
    }

    public function editProfile($id)
    {
        $user = Admin::find($id);
        return view('security.users.editProfile', compact('user'));
    }

    //  admin delete any user
    public function deleteUser($id)
    {
        $sessionStore = session()->get('StoreId');
        if ($sessionStore == \App\Bll\Utility::$demoId) {
            return redirect()->back()->with('flash_message', _i('Deleted Successfully'));
        }

        $user = User::findOrFail($id);

        if ($id != User::all()->first()->id) {

            if ($user->hasAnyRole(Role::all()) || $user->hasAnyPermission(Permission::all())) {
                $roles = $user->getRoleNames(); // get the names of the user's roles
                $permissions = $user->getPermissionsViaRoles($roles); // get Permissions inherited from the user's roles

                foreach ($permissions as $permission) {
                    $user->revokePermissionTo($permission); // A permission can be revoked from a user:
                }

                foreach ($roles as $role) {
                    $user->removeRole($role); // A role can be removed from a user
                }

            }
            $user->delete();
            return redirect()->back()->with('success', _i('Deleted Successfully !'));
        } else {
            return redirect('/adminpanel/user/all')->withFlashMessage(_i('Can`t Delete This User'));
        }
    }


    public function updatePassword(Request $request)
    {

        $sessionStore = session()->get('StoreId');
        if ($sessionStore == \App\Bll\Utility::$demoId) {
            return redirect()->back()->with('flash_message', _i('Updated Successfully'));
        }

        $id = auth()->guard()->user()->id;
        $user = Admin::findOrFail($id);
        $rules = [
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator);

        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect()->back()->withFlashMessage(_i('Password Changed Successfully !'));

    }


}
