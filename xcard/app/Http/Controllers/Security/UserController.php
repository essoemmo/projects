<?php


namespace App\Http\Controllers\Security;


use App\Admin;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{



    // function to show all users
    public function showUsers()
    {
        if (request()->ajax()) {
            $users = User::query()->where('guard' , 'web');

            return DataTables::eloquent($users)
                ->order(function ($query) {
                    $query->orderBy('id', 'asc');
                })

                ->addColumn('name', function ($query) {
                    return $query['first_name'] .' '.$query['last_name'] ;
                })
                ->addColumn('edit', function ($query) {
                    return '<a href="../user/'.$query->id.'/edit" class="btn btn-success"><i class="ti-pencil-alt"></i> ' ._i('Edit') .'</a>';
                })
                ->addColumn('delete', 'security.users.btn.delete')
                ->rawColumns([
                    'edit',
                    'delete',
                ])
                ->make(true);
        }
        return view('security.users.index');
    }


    //  admin create new user through view
    public function createUser()
    {
        return view('security.users.add');
    }

    //  admin store data of new user
    public function storeNewUser(Request $request )
    {
        $rules =  [
            'first_name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'guard' => "web",
                'password' => Hash::make($request->password),
            ]);
            $user->assignRole('registered-users');
            $user->save();
            return redirect()->back()->with('success' ,_i('Added Successfully !'));
        }
    }


    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('security.users.edit', compact('user'));
    }


    public function updateUser(Request $request , $id)
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

            $user->save();

            return redirect()->back()->with( 'success',_i('Updated Successfully !')); // return if is update admin

        }
    }
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/admin/user/all')->with('success', _i('Deleted Successfully !'));
    }

}