<?php

namespace App\Http\Controllers\Security;

//use App\Help\Utility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
    public function allPermissions()
    {
        //dd(auth()->user()->permissions);
        $permissions = Permission::all();
        return view('security.permission.allPermissions', compact('permissions')  , ['title' => _i('Permissions')]);
    }

    // make datatable for permissions
    public function  getDatatablePermission()
    {

        $permission = Permission::select(['id', 'name' ,'created_at', 'updated_at']);

        return DataTables::of($permission)
            ->addColumn('action', function ($permission) {
                return'<button class="btn waves-effect waves-light btn-primary edit text-center" data-id ="'.$permission->id.'" data-name ="'.$permission->name.'" data-toggle="modal" data-target="#edit"  title="'._i("Edit").'"><i class="ti-pencil-alt"></i> </button>' ."&nbsp;&nbsp;&nbsp;".
                    '<a href="'.$permission->id.'/delete" class="btn waves-effect waves-light btn btn-danger text-center" title="'._i("Delete").'"><i class="ti-trash center"></i> </a>';
            })
            ->make(true);
    }

    public function createpermission(){
        return view('security.permission.addPermission');
    }

    public function storePermission(Request $request)
    {
//        $guard_admin = 'admin';

        $rules = [
//            'name' =>  array('required','regex:/^[\p{L}\s-]+$/u', 'max:255', 'unique:permissions') // rules to accept string only
            'name' =>  array('required', 'max:255', 'unique:permissions')
        ];
        $validator = validator()->make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $user = admin()->user();
            $role = Role::where('name','super-admin')->first();
            if(!$role)
            {
                // Create a super-admin role for the admin users
                $role = Role::create(['guard_name' => 'admin', 'name' => 'super-admin']);
                $role->save();
                $user->assignRole($role->name); // attached  user with role
            }
            $permission = Permission::create(['name' => $request->name , 'guard_name' => 'admin']); // create permission
            $permission->save();
            $role->givePermissionTo($permission->name);  // attached role with permission that have same guard name
            $admin_role = Role::where('name','super-admin')->first();
            $admin_role->givePermissionTo($permission->name); // attached "super admin" role with permission
            //$user->givePermissionTo($permission->id); // attached user with permission
            $user->givePermissionTo($permission->name);

            return redirect()->back()->with('success' ,_i('Added Successfully !'));
        }
    }

    // edit permission
    public function editPermission($id)
    {
        $permission = Permission::findOrFail($id);
//        dd(Admin::where('id','=',Auth::guard('admin')->user()->id)->first()->hasPermissionTo('Add-Permission', 'admin'));
        return view('security.permission.edit', compact('permission'));
    }

    // store updated data from function -> editPermission
    public function updatePermission(Request $request)
    {

        $permission = Permission::findOrFail($request->id);

        $rules = [
            'name' => array('required', Rule::unique('permissions')->ignore($permission->id))
        ];

        $validator = validator()->make($request->all() , $rules);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();

        }else{

            $permission->name = $request->input('name');
            $permission->save();
        }
        session()->flash('success','editedSucceflly');
        return redirect('/admin/permission/all')->with('success' ,_i('Updated Successfully !'));
    }

    // delete permission  & delete from role
    public function deletePermission($id)
    {
        $permission = Permission::findOrFail($id);

        $permission->delete();

        session()->flash('success','Deleted succeffly');
        return redirect('/admin/permission/all')
            ->with('success',_i('Deleted Successfully !'));
    }

}
