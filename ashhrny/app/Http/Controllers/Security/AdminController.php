<?php

namespace App\Http\Controllers\Security;

use App\admin;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{

    // function to show all users
    public function showAdmins()
    {
        if (request()->ajax()) {
            $admins = Admin::query()->where('guard', 'admin');

            return DataTables::eloquent($admins)
                ->order(function ($query) {
                    $query->orderBy('id', 'asc');
                })
                ->addColumn('name', function ($query) {
                    return $query['first_name'] . ' ' . $query['last_name'];
                })
                ->addColumn('edit', function ($query) {
                    return '<a href="../admin/' . $query->id . '/edit" class="btn btn-success"><i class="ti-pencil-alt"></i> ' . _i('Edit') . '</a>';
                })
                ->addColumn('delete', 'security.admins.btn.delete')
                ->rawColumns([
                    'edit',
                    'delete',
                ])
                ->make(true);
        }
        return view('security.admins.allUsers');
    }


    //  admin create new user through view
    public function createAdmin()
    {
        $roles = Role::all();
        return view('security.admins.add', compact('roles'));
    }

    //  admin store data of new user
    public function storeNewAdmin(Request $request)
    {
        //dd($request->role);
        $rules = [
            'first_name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role' => ['required'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $user = Admin::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'guard' => "admin",
                'password' => Hash::make($request->password),
            ]);

            // new method to attach new admin with role and permission
            $role = Role::where('id', $request->role)->first();
            $permissions = $role->load('permissions');   // load all permissions belongs to role
            $user->assignRole($role['id']);
            //dd($permissions->permissions);
            foreach ($permissions->permissions as $perm) {
                $user->givePermissionTo($perm['name']);
                $user->save();
            }
            $user->save();

            // loop for roles from roles[] array
//            foreach($request->roles as $key => $value){
//                $user = User::find($user->id); // get id of new user
//                $user->assignRole($value); // attached new user with role
//                $roles[] = $value;     // make array of roles that selected
//                $permissions[] = $user->getPermissionsViaRoles($roles);  // make array of permissions via roles that selected before
//            }
//            $user = $user->givePermissionTo($permissions); // attached new user with permissions that belonges to roles selected before
//            $user->save();
            return redirect()->back()->with('success', _i('Added Successfully !'));
        }
    }


    public function editAdmin($id)
    {
        $user = Admin::findOrFail($id);
        $roles = Role::all();
        return view('security.admins.edit', compact('user', 'roles'));
    }


    public function updateAdmin(Request $request, $id)
    {
        $user = Admin::findOrFail($id);
        $rules = [
            'first_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            //'password' => ['sometimes', 'confirmed'],
            'roles' => ['sometimes', 'min:1']
        ];
//        if (!is_null($request->password)) {
//            $rules['password'] = ['confirmed', 'min:6'];
//        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {


            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->mobile = $request->input('mobile');

            if ($request->has('roles')) {
//            DB::table('model_has_roles')->where('model_id',$user->id)->delete();
//            $user->syncRoles(intval($request->roles)); // All current roles will be removed from the user and replaced by the array given (roles[])
//            $permissions[] = $user->getPermissionsViaRoles(intval($request->roles)); // get Permissions inherited from the user's roles
//            $user->syncPermissions($permissions);// All permissions via roles[] will be removed from the user and replaced by the array given (permissions[])

                $user->syncRoles($request->roles); // All current roles will be removed from the user and replaced by the array given (roles[])
                $permissions[] = $user->getPermissionsViaRoles($request->roles); // get Permissions inherited from the user's roles
                $user->syncPermissions($permissions);// All permissions via roles[] will be removed from the user and replaced by the array given (permissions[])
            }

//                if($request->has('password') && $request->input('password') != null)
//                {
//                    $user->password = bcrypt($request->password);
//                }
            $user->save();

            return redirect('/admin/admin/' . $user->id . '/edit')->with('success', _i('Updated Successfully !')); // return if is update admin

        }
    }


    //  admin delete any user
    public function deleteAdmin($id)
    {
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
            return redirect('/admin/admin/all')->with('success', _i('Can`t Delete This User'));
        }
    }


    public function changePassword(Request $request, $id)
    {
        //$id = auth()->guard()->user()->id;
        $user = User::findOrFail($id);
        $rules = [
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator);

        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect()->back()->with('success', _i('Password Changed Successfully !'));

    }


}
