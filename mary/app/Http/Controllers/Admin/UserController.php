<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AdminDataTable;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class userController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:add-admin'])->only('store');
        $this->middleware(['permission:delete-admin'])->only('destroy');
        $this->middleware(['permission:update-admin'])->only('update');

    }


    public function home()
    {
        $male= User::where('gender','male')->count();
        $female = User::where('gender','female')->count();
        return view('admin.home',compact('male','female'));
    }


    public function index(AdminDataTable $admin)
    {

        return $admin->render('admin.admins.index' , ['title' => _i('Users')]);
    }


    public function create()
    {
        $title = 'Create user';
        return view('admin.admins.create',compact('title'));
    }


    public function store(Request $request)
    {
            $request->validate([
               'username' => 'required',
               'fullname' => 'required',
               'email' => 'required|email|unique:users',
               'mobile' => 'required',
               'gender' => 'required',
               'password' => 'required|confirmed',
                'roles'    =>'required',
            ]);
          $user = new User();
          $user->username = $request->username;
          $user->fullname = $request->fullname;
          $user->email = $request->email;
          $user->mobile = $request->mobile;
          $user->gender = $request->gender;
          $user->guard	 = 'admin';
          $user->password = bcrypt($request->password);
          $user->save();

          if ($user->save()){
//              foreach($request->roles as $key => $value){
//                  $user = \App\Models\User::find($user->id); // get id of new user
//                  $user->assignRole($value); // attached new user with role
//                  $roles[] = $value;     // make array of roles that selected
//                  $permissions[] = $user->getPermissionsViaRoles($roles);  // make array of permissions via roles that selected before
//              }
              $user->assignRole($request->roles);
              $roles = $request->roles;
              $permissions[] = $user->getPermissionsViaRoles($roles);  // make array of permissions via roles that selected before
              $user = $user->givePermissionTo($permissions);
          }

        return redirect()->back()->withFlashMessage(_i('Added Successfully !'));

    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $title = 'edit user';

        $roles = Role::all();
        $user = User::findOrFail($id);
        return view('admin.admins.edit',compact('user','roles','title'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required',
            'fullname' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($id),
            ],            'mobile' => 'required',
            'gender' => 'required',
            'password' => 'nullable|confirmed',
            'roles'    =>'required',
        ]);
        $user =User::findOrFail($id);
        $user->username = $request->username;
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->gender = $request->gender;
        $user->guard = 'admin';
        if ($request->password == null){
          $request->except(['password','password_confirmation']);
        }else{
            $request->password = bcrypt($request->password);
        }
        $user->save();

        if ($user->save()){

            if($request->has('roles'))
            {
                $user->syncRoles($request->roles); // All current roles will be removed from the user and replaced by the array given (roles[])
                $permissions[] = $user->getPermissionsViaRoles($request->roles); // get Permissions inherited from the user's roles
                $user->syncPermissions($permissions);// All permissions via roles[] will be removed from the user and replaced by the array given (permissions[])
            }
        }

        return redirect()->back()->withFlashMessage(_i('updated Successfully !'));
    }


    public function destroy($id)
    {
        $user = \App\Models\User::findOrFail($id);

        if ($id != User::all()->first()->id)
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
            return redirect()->back()->withFlashMessage(_i('Deleted Successfully !'));
        }else{
            return redirect()->route('users.index')->withFlashMessage(_i('Can`t Delete This User'));
        }
    }
}
