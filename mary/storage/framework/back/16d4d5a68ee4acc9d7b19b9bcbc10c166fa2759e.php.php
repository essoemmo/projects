<?php

namespace App\Http\Controllers\Admin\Security;

//use App\Help\Utility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class   permissionController extends Controller
{
    public function allPermissions()
    {
        $permissions = Permission::all();
        return view('security.permission.allPermissions', compact('permissions')  , ['title' => _i('Permissions')]);
    }

    // make datatable for permissions
    public function  getDatatablePermission()
    {
        $permission = Permission::select(['id', 'name' ,'created_at', 'updated_at']);

        return DataTables::of($permission)
            ->addColumn('action', function ($permission) {
                return'<button class="btn btn-icon waves-effect waves-light btn-primary edit" data-id ="'.$permission->id.'" data-name ="'.$permission->name.'" data-toggle="modal" data-target="#edit"  title="'._i("Edit").'"><i class="fa fa-edit"></i> </button>' ."&nbsp;&nbsp;&nbsp;".
                    '<a href="'.$permission->id.'/delete" class="btn btn-icon waves-effect waves-light btn btn-danger" title="'._i("Delete").'"><i class="fa fa-trash"></i> </a>';
            })
            ->make(true);
    }

    public function createpermission(){
        return view('security.permission.addPermission');
    }

    public function storePermission(Request $request)
    {
        $guard_admin = 'admin';

        $rules = [
            'name' =>  array('required', 'max:255', 'unique:permissions') // rules to accept string only
        ];
        $validator = validator()->make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{

            if(auth()->user()->guard == $guard_admin)
            {

                $user = auth()->user();
                $role = Role::where('name','super-admin')->first();
                if(!$role)
                {
                    // Create a super-admin role for the admin users
                    $role = Role::create(['guard_name' => 'web', 'name' => 'super-admin']);
                    $role->save();
//                    Admin::where('id',auth()->guard($guard_admin)->id())->where('guard', $guard_admin)->first()->assignRole($role->name);
                    $user->assignRole($role->name); // attached  user with role
                }

                $permission = Permission::create(['name' => $request->name , 'guard_name' => 'web']); // create permission
                $permission->save();

                $role->givePermissionTo($permission->name);  // attached role with permission that have same guard name
                $user->givePermissionTo($permission->id); // attached user with permission

            }

            session()->flash('success','Added Successfully !');
            return redirect()->back()->withFlashMessage(_i('Added Successfully !'));
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
        return redirect('/admin/permission/all')->withFlashMessage(_i('Updated Successfully !'));
    }

    // delete permission  & delete from role
    public function deletePermission($id)
    {
        $permission = Permission::findOrFail($id);

        $permission->delete();

        session()->flash('success','Deleted succeffly');
        return redirect('/admin/permission/all')
            ->with('flash_message',_i('Deleted Successfully !'));
    }

}
