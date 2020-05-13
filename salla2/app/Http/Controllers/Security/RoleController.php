<?php

namespace App\Http\Controllers\Security;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\RoleStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;
use App\Help\Utility;

class RoleController extends Controller
{


// get all rolles and controll to it
    public function getAllRoles()
    {
        $user = Utility::store()->user();
        $roles = Role::all();
        return view('security.roles.allRoles', compact('roles', 'user'));
    }

    // make datatable for Roles
    public function  getDatatableRoles()
    {
        $guard_store = Utility::Store;
        $role = RoleStore::leftJoin('roles','roles.id','role_store.role_id')
            ->select('roles.id as id' , 'roles.name as name','role_store.store_id','roles.guard_name','roles.created_at','roles.updated_at')
            ->where('guard_name' ,$guard_store)->where('role_store.store_id' ,\App\Bll\Utility::getStoreId()) ;
       // $role = Role::select(['id', 'name', 'created_at', 'updated_at'])->where('name',"!=", 'super-store')->where('guard_name' ,$guard_store);

        return DataTables::of($role)
            ->addColumn('action', function ($role) {
                return'<a href="'.$role->id.'/edit" class="btn waves-effect waves-light btn-primary" title="'._i("Edit").'"><i class="ti-pencil-alt"></i> </a>' ."&nbsp;&nbsp;&nbsp;".
                '<a href="'.$role->id.'/delete" class="btn waves-effect waves-light btn-danger" title="'._i("Delete").'"><i class="ti-trash"></i> </a>';
            })
            ->make(true);
    }


    // add roles & permissions
    public function addRole()
    {
       // dd(\App\Bll\Utility::storeLang() , \Xinax\LaravelGettext\Facades\LaravelGettext::getLocale());
        $permissionNames = Utility::store()->user()->permissions; // return collection of permission objects
       // dd($permissionNames);
        $langs = Language::get();
        return view('security.roles.addRole' ,compact('permissionNames','langs'));
    }

    // add role & permissions  as Group
    public function storeRole(Request $request)
    {
        $guard_store = Utility::Store;
        $rules = [
            //'name' =>  array('required','regex:/^[\p{L}\s-]+$/u', 'max:255', 'unique:roles'), // rule to accept string only
            'name' => 'unique:roles,name,NULL,id,guard_name,'.$guard_store ,'regex:/^[\p{L}\s-]+$/u', 'max:255' // name is unique with same guard

        ];
        $validator = validator()->make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{

            $sessionStore = session()->get('StoreId');
            if($sessionStore== \App\Bll\Utility::$demoId){
                return redirect()->back()->with('flash_message' , _i('Added Successfully'));
            }


            $role = Role::create(['guard_name' => $guard_store ,'name' => $request->name]); // create role
// loop for permission from groups[] array
            foreach($request->groups as $key => $value){
                //return $value;
                $role->givePermissionTo($value); // attached role with permission
//                $user = auth()->user()->givePermissionTo($value); // attached user with permission  array
            }
//            $user = auth()->guard('admin')->user()->assignRole($role->id); // attached user with role
            $role->save();
            $role_store = RoleStore::create([
               'role_id' => $role->id,
               'store_id' => \App\Bll\Utility::getStoreId(),
            ]);
            return redirect()->back()->with('success',_i('Added Successfully !'));
        }
    }

    // edit role
    public function editRole($id)
    {
//        dd(Role::findById($id);
        $permissionNames  = Utility::store()->user()->permissions;
      
        $role = Role::findOrFail($id);
        $langs = Language::get();

        if($role->name == 'super'){
            return redirect()->back()->with('danger' , _i('Can`t Edit this Role !'));
        }else{

            //        $permissions = Permission::where('guard_name', $role->guard_name)->get(); // get permissions via role where permission guard_name = role->guard_name
//        $permissionNames = auth()->user()->permissions; // return collection of permission objects

            return view('security.roles.edit' , compact('role','permissionNames','langs'));
        }

    }

    // Update Role
    public function updateRole(Request $request , $id)
    {
        $role = Role::findOrFail($id);
        $guard_store = Utility::Store;
        $rules = [
            //'name' => array('required','regex:/^[\p{L}\s-]+$/u', Rule::unique('roles')->ignore($role->id)),
            'name' => ['unique:roles,name,NULL,id,guard_name,'.$guard_store.$id ,'regex:/^[\p{L}\s-]+$/u', 'max:255'] ,// unique name with same guard => "store" ignore this->id
            'permissions' =>  ['required','array','min:1'],
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator);

        $sessionStore = session()->get('StoreId');
        if($sessionStore== \App\Bll\Utility::$demoId){
            return redirect()->back()->with('flash_message' , _i('Update Successfully'));
        }


        $role->name = $request->input('name');
//        $role->guard_name = $request->input('guard_name');
        $permissions = $request->input('permissions');
        $role->syncPermissions($permissions);// All permissions[] via role will be removed from this role and replaced by the array given (permissions[])

        $users = $role->users()->get(); // get all users where has this role
//        dd($users);
        foreach($users as $user)
        {
            $user->syncPermissions($permissions); // All permissions[] via role will be removed from the user and replaced by the array given (permissions[])(update user with new permission that updated through role)
        }

        $role->save();
        return redirect('/adminpanel/role/'.$role->id.'/edit')->with('success',_i('Updated Successfully !'));
    }

    // Delete Role
    public function deleteRole($id)
    {
        $sessionStore = session()->get('StoreId');
        if($sessionStore== \App\Bll\Utility::$demoId){
            return redirect()->back()->with('flash_message' , _i('Deleted Successfully'));
        }

        $role = Role::findOrFail($id);
        $role->delete();
        $role_store = RoleStore::where('role_id',$id)->delete();
        return redirect('/adminpanel/role/all')->with('success' ,_i('Deleted Successfully !'));

    }

    public function getPermissions($langId)
    {
        $permissions = Utility::store()->user()->permissions;
       // $permissions = Permission::where('guard_name' , "admin")->get();
        foreach ($permissions as $per)
        {
            $permission_data = Permission::join('permission_data','permission_data.permission_id','permissions.id')
                ->select('permissions.id as id','permission_data.title as title','permission_data.lang_id as lang_id')
                ->where('permissions.id', $per->id)
                ->where('permission_data.lang_id', $langId)
                ->first();
            $perms[] = $permission_data;
        }
        return $perms;
    }



}
