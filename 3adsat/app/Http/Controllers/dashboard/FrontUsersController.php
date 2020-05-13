<?php


namespace App\Http\Controllers\dashboard;

use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FrontUsersController extends Controller
{
    public function index(UsersDataTable $user)
    {
        return $user->render('admin.users.index' , ['title' => _i('Users')]);
    }

    public function create()
    {
        $title = 'Create user';
        return view('admin.users.create',compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'mobile' => 'required',
//            'gender' => 'required',
            'password' => 'required|confirmed',
        ]);
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
//        $user->gender = $request->gender;
        $user->guard	 = 'web';
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->back()->with('success' ,_i('Added Successfully !'));
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $title = 'edit user';
        $user = User::findOrFail($id);
        return view('admin.users.edit',compact('user','title'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($id),
            ],            'mobile' => 'required',
//            'gender' => 'required',
            'password' => 'nullable|confirmed',
        ]);
        $user = User::findOrFail($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
//        $user->gender = $request->gender;
        $user->guard = 'web';
        if ($request->password == null){
            $request->except(['password','password_confirmation']);
        }else{
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->back()->with('success' , _i('updated Successfully !'));
    }


    public function destroy($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success' ,_i('Deleted Successfully !'));
    }
}