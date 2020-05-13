<?php

namespace App\Http\Controllers\Security;

use App\Admin;
use App\Http\Controllers\Controller;
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
        $user = admin()->user();
        $roles = Role::all();
        return view('security.roles.allRoles', compact('roles', 'user'));
    }

    // make datatable for Roles
    public function  getDatatableRoles()
    {
        $role = Role::select(['id', 'name', 'created_at', 'updated_at'])->where('name',"!=", 'super-store');

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
        $permissionNames = admin()->user()->permissions; // return collection of permission objects
        return view('security.roles.addRole' ,compact('permissionNames'));
    }

    // add role & permissions  as Group
    public function storeRole(Request $request)
    {
        $rules = [
            'name' =>  array('required','regex:/^[\p{L}\s-]+$/u', 'max:255', 'unique:roles'), // rule to accept string only
        ];
        $validator = validator()->make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $role = Role::create(['guard_name' => 'admin' ,'name' => $request->name]); // create role
// loop for permission from groups[] array
            foreach($request->groups as $key => $value){
                //return $value;
                $role->givePermissionTo($value); // attached role with permission
//                $user = auth()->user()->givePermissionTo($value); // attached user with permission  array
            }
//            $user = auth()->guard('admin')->user()->assignRole($role->id); // attached user with role
            $role->save();
            return redirect()->back()->with('success',_i('Added Successfully !'));
        }
    }

    // edit role
    public function editRole($id)
    {
//        dd(Role::findById($id);
        $permissionNames  = Permission::all()->where('type',"!=", 'pkg');
        $role = Role::findOrFail($id);

        if($role->name == 'super-store'){
            return redirect()->back()->with('danger' , _i('Can`t Edit this Role !'));
        }else{

            //        $permissions = Permission::where('guard_name', $role->guard_name)->get(); // get permissions via role where permission guard_name = role->guard_name
//        $permissionNames = auth()->user()->permissions; // return collection of permission objects

            return view('security.roles.edit' , compact('role','permissionNames'));
        }

    }

    // Update Role
    public function updateRole(Request $request , $id)
    {
        $role = Role::findOrFail($id);
        $rules = [
            'name' => array('required','regex:/^[\p{L}\s-]+$/u', Rule::unique('roles')->ignore($role->id)),
            'permissions' =>  ['required','array','min:1'],
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator);

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
        return redirect('/admin/role/'.$role->id.'/edit')->with('success',_i('Updated Successfully !'));
    }

    // Delete Role
    public function deleteRole($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect('/admin/role/all')->with('success' ,_i('Deleted Successfully !'));

    }



}
