<?php

namespace App\Http\Controllers;

use App\Communication\CommunicationOperation;
use App\Hr\Course\Course;
use App\Hr\Course\Trainer;
use App\Hr\Employee;
use App\Hr\Volunteer;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Yajra\DataTables\DataTables;

class AdminController extends Controller
{


//    public function __construct() {
//        $this->middleware(['auth', 'isAdmin']); //isAdmin middleware lets only users with aspecific permissions permission to access these routes
//    }

    // index for admin panel
    public function index()
    {
//        $employees = count(Employee::all());
        $courses = count(Course::all());
        $trainers = count(Trainer::all());
     //   $volunteers = count(Volunteer::all());
//        $operations = DB::table('communications')->select(['communications.id', 'communications.title', 'communications.record_number',
//            'communications.created', 'communications.comm_type_id','communications.status'])
//            ->join('comm_operations' ,'communications.id' ,'=' ,'comm_operations.comm_id')
//            ->where('comm_operations.redirect_to_id','=', auth()->user()->id)
//            ->orderBy('comm_operations.comm_id', 'desc')->get();

        return view('admin.home.index' , compact('courses','trainers'));
    }

    public function addPermission()
    {
        return view('admin.permission.addPermission');
    }

    public function storePermission(Request $request)
    {

        $rules = [
//            'name' => 'required|string|unique:roles',
            'name' =>  array('required','regex:/^[\p{L}\s-]+$/u', 'max:255', 'unique:permissions') // rules to accept string only
        ];
        $validator = validator()->make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }else{
            $permission = Permission::create(['name' => $request->name]); // create permission
            $user = auth()->user()->givePermissionTo($permission->id); // attached user with permission

            $role = Role::where('name','super-admin')->first();
            if(!$role)
            {
                // Create a super-admin role for the admin users
                $role = Role::create(['guard_name' => 'web', 'name' => 'super-admin']);
                $role->save();
            }
            $role->givePermissionTo($permission->name);  // attached role with permission that have same guard name

            return redirect()->back()->withFlashMessage(_i('Added Successfully !'));
        }
    }

    // edit permission
    public function editPermission($id)
    {
        $permission = Permission::findById($id);
        return view('admin.permission.edit', compact('permission'));
    }

    // store updated data from function -> editPermission
    public function updatePermission(Request $request , $id)
    {
        $permission = Permission::findById($id);

        $rules = [
             'name' => array('required','regex:/^[\p{L}\s-]+$/u','max:255','min:3', Rule::unique('permissions')->ignore($permission->id))
        ];
        $validator = Validator::make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator);

        $permission->name = $request->input('name');
        $permission->save();
        return redirect('/admin/permissions')->withFlashMessage(_i('Updated Successfully !'));
    }

// delete permission  & delete from role
    public function deletePermission($id)
    {
        $permission = Permission::findOrFail($id);

        //Make it impossible to delete this specific permission
        if ($permission->name == "Administer") {
            return redirect('/admin/permissions')
                ->with('flash_message', 'Cannot delete this Permission!');
        }

        $permission->delete();

        return redirect('/admin/permissions')
            ->with('flash_message','Permission deleted Successfully!');
    }

    //get all permissions
    public function allPermissions()
    {
        $permissions = Permission::all();
        return view('admin.permission.allPermissions', compact('permissions'));
    }

// make datatable for permissions
    public function  getDatatablePermission()
    {
        $permission = Permission::select(['id', 'name', 'created_at', 'updated_at']);

        return Datatables::of($permission)
            ->addColumn('action', function ($permission) {
                return'<a href="permission/'.$permission->id.'/edit" class="btn btn-icon waves-effect waves-light btn-default" title="'._i("Edit").'"><i class="fa fa-edit"></i> </a>' ."&nbsp;&nbsp;&nbsp;".
                '<a href="permission/'.$permission->id.'/delete" class="btn btn-icon waves-effect waves-light btn-pink" title="'._i("Delete").'"><i class="fa fa-remove"></i> </a>';
            })
            ->make(true);
    }



// get all rolles and controll to it
    public function getAllRoles()
    {
        $user = auth()->user();
        $roles = Role::where("name","!=","super-admin")
            ->where('name', "!=" , "registered-users")
            ->where('is_system', 0)
        ->get();
        return view('admin.roles.allRoles', compact('roles', 'user'));
    }

    // make datatable for Roles
    public function  getDatatableRoles()
    {
        $role = Role::where("name","!=","super-admin")
            ->where('name', "!=" , "registered-users")
            ->where('is_system', 0)
            ->select(['id', 'name', 'created_at', 'updated_at']);

        return Datatables::of($role)
            ->addColumn('action', function ($role) {
                return'<a href="role/'.$role->id.'/edit" class="btn btn-icon waves-effect waves-light btn-default" title="'._i("Edit").'"><i class="fa fa-edit"></i> </a>' ."&nbsp;&nbsp;&nbsp;".
                '<a href="role/'.$role->id.'/delete" class="btn btn-icon waves-effect waves-light btn-pink" title="'._i("Delete").'"><i class="fa fa-remove"></i> </a>';
            })

            ->make(true);
    }

    // get all roles associated with this user
    public function getUserRoles()
    {
        $user = auth()->user()->getRoleNames();
        return view('admin.roles.userRoles' , compact('user'));
//        return auth()->user()->getRoleNames();
    }



    // add roles & permissions
    public function addGroup()
    {
//        $permissionNames = auth()->user()->getPermissionNames();
//        $permissionNames = auth()->user()->getAllPermissions();
        $permissionNames = Permission::all();
        return view('admin.roles.addRole', compact('permissionNames'));
    }

    // add role & permissions  as Group
    public function storeGroup(Request $request)
    {
        //dd($request->groups) ;
        $rules = [
            'name' =>  array('required','regex:/^[\p{L}\s-]+$/u', 'max:255', 'unique:roles'), // rule to accept string only
            'groups' => 'required'
        ];
        $validator = validator()->make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }else{
            $role = Role::create(['name' => $request->name]); // create role
// loop for permission from groups[] array
            foreach($request->groups as $key => $value){
                //return $value;
                $role->givePermissionTo($value); // attached role with permission
                $user = auth()->user()->givePermissionTo($value); // attached user with permission  array
            }
            $user = auth()->user()->assignRole($role->id); // attached user with role
            $role->save();
//            return redirect('/admin/allRoles')->withFlashMessage('Added Group Successfully');
            return redirect('/admin/role/'.$role->id.'/edit')->withFlashMessage(_i('Added Successfully !'));
        }
    }

    // edit role
    public function editGroup($id)
    {
        $role = Role::findById($id);
        $role_name = $role->name;
        //dd($role);
        if($role->is_system != 1 && $role_name != "super-admin" && $role_name != "registered-users"){

            $permissions = Permission::all();
            return view('admin.roles.edit' , compact('role' , 'permissions'));

        }else{
            return redirect()->back()->with('danger' ,'Can`t Edit this Role');
        }
    }

    // Update Role
    public function updateGroup(Request $request , $id)
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
        $permissions = $request->input('permissions');
        $role->syncPermissions($permissions);// All permissions[] via role will be removed from this role and replaced by the array given (permissions[])

        $users = $role->users()->get(); // get all users where has this role
//        dd($users);
        foreach($users as $user)
        {
            $user->syncPermissions($permissions); // All permissions[] via role will be removed from the user and replaced by the array given (permissions[])(update user with new permission that updated through role)
        }

        $role->save();
        return redirect('/admin/allRoles')->withFlashMessage(_i('Updated Successfully !'));
    }

    // Delete Role
    public function deleteGroup($id)
    {
        $role = Role::findById($id);
        $role->delete();
        return redirect('/admin/allRoles')->withFlashMessage(_i('Deleted Successfully !'));
    }

// function to show all users
    public function showUsers()
    {
        $users = User::all();
        return view('admin.users.allUsers', compact('users'));
    }

    // make datatable for users
    public function  getDatatableUser()
    {
        $users = User::select(['id', 'first_name', 'last_name', 'email', 'is_active','password', 'created_at', 'updated_at'])->where('email' ,'!=' ,'sys@system.com');

        return Datatables::of($users)
            ->addColumn('action', function ($user) {
                return'<a href="'.url('admin/user/'.$user->id.'/edit').'" class="btn btn-icon waves-effect waves-light btn-default" title="'._i("Edit").'"><i class="fa fa-edit"></i> </a>' ."&nbsp;&nbsp;&nbsp;".
                '<a href="'.url('admin/user/'.$user->id.'/delete').'" class="btn btn-icon waves-effect waves-light btn-pink" title="'._i("Delete").'"><i class="fa fa-remove"></i> </a>';
//                return'<a href="user/'.$user->id.'/edit" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-edit"></i> </a>' ."&nbsp;".
//                '<a href="user/'.$user->id.'/delete" class="btn btn-xs btn-info"><i class="fa fa-remove "></i> </a>';
            })
            ->editColumn('is_active' , function($user){
               $status =  $user->is_active == 1 ? "Active" : "Not Active";
                return $status;
            })
//            ->editColumn('id', 'ID: {{$id}}')
            ->removeColumn('password')
            ->make(true);
    }

    //  admin create new user through view
    public function createUser()
    {
        $roles =  Role::all();
        return view('admin.users.add', compact('roles'));
    }

    //  admin store data of new user
    public function storeNewUser(Request $request, $is_admin = 1 )
    {
        $rules =  [
            'first_name' => ['required', 'string', 'max:255', 'min:3'],
            'last_name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'roles' => ['required'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }else{
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->is_admin = $is_admin;
            // loop for roles from roles[] array
            foreach($request->roles as $key => $value){
                $user = User::find($user->id); // get id of new user
                $user->assignRole($value); // attached new user with role
                $roles[] = $value;     // make array of roles that selected
                $permissions[] = $user->getPermissionsViaRoles($roles);  // make array of permissions via roles that selected before
            }
            $user = $user->givePermissionTo($permissions); // attached new user with permissions that belonges to roles selected before
            $user->save();
            return redirect('/admin/user/'.$user->id.'/edit')->withFlashMessage(_i('Added Successfully !'));
        }

    }


    public function editUser($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        if($user->email != "sys@system.com")
            return view('admin.users.edit', compact('user', 'roles'));
        return redirect('admin/user/all')->withFlashMessage(_i('Dosn`t Access This Account'));

    }

    public function editProfile($id)
    {
        $user = User::find($id);
        return view('admin.users.editProfile', compact('user'));
    }

    public function updateUser(Request $request , $id)
    {
//        return [$request->all()];
        $user = User::findOrFail($id);
        $rules =  [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['sometimes','confirmed'],
            'roles' =>  ['sometimes','array','min:1']
        ];
        if(!is_null($request->password)){
            $rules['password'] = ['confirmed', 'min:6'];
        }
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator);

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');

        if($request->has('roles'))
        {
            $user->syncRoles($request->roles); // All current roles will be removed from the user and replaced by the array given (roles[])
            $permissions[] = $user->getPermissionsViaRoles($request->roles); // get Permissions inherited from the user's roles
            $user->syncPermissions($permissions);// All permissions via roles[] will be removed from the user and replaced by the array given (permissions[])
        }

        if($request->has('password') && $request->input('password') != null)
        {
//            dd($request->input('password'));
            $user->password = bcrypt($request->password);
        }
        $user->save();

        if($request->has('roles'))
            return redirect('/admin/user/'.$user->id.'/edit')->withFlashMessage(_i('Updated Successfully !')); // return if is update admin

        return redirect('/admin/user/profile/'.$user->id.'/edit')->withFlashMessage(_i('Profile Updated Successfully !')); // return if is update profile

    }

    public function update_password(Request $request , $id)
    {
        $user = User::findOrFail($id);
        $rules =  [
            'password' => ['required','confirmed', 'min:6'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator);

        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->back()->withFlashMessage(_i('Updated Successfully !'));
    }

    //  admin delete any user
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if ($id != 1)
        {

            if($user->hasAnyRole(Role::all()) || $user->hasAnyPermission(Permission::all()))
            {
                $roles = $user->getRoleNames(); // get the names of the user's roles
                $permissions = $user->getPermissionsViaRoles($roles); // get Permissions inherited from the user's roles

                foreach($permissions as $permission)
                {
                    $user->revokePermissionTo($permission); // A permission can be revoked from a user:
                }

                foreach($roles as $role)
                {
                    $user->removeRole($role); // A role can be removed from a user
                }

            }
            $user->delete();
            return redirect('/admin/users')->withFlashMessage(_i('Deleted Successfully !'));
        }else{
            return redirect('/admin/users')->withFlashMessage(_i('Can`t Delete This User'));
        }
    }

    public function logOut()
    {
        Auth::logout();
        return redirect('/login');
    }

}
