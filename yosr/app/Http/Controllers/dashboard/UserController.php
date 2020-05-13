<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read_users')->only(['index']);
        $this->middleware('permission:create_users')->only(['create', 'store']);
        $this->middleware('permission:update_users')->only(['edit', 'update']);
        $this->middleware('permission:delete_users')->only(['destroy']);

    }

    public function index(Request $request){

        if ($request->ajax()) {


            $data = User::WhereRoleIs('admin')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    if (auth()->user()->hasPermission('update_users')) {
                        $btn = '<a  href="'.route('users.edit',$row->id).'" class="btn btn-warning btn-sm edit"><i class="fa fa-edit"></i></a>';
                    }else{
                        $btn = '<a  href="#" class="btn btn-warning btn-sm edit disabled"><i class="fa fa-edit"></i></a>';
                    }

                    if (auth()->user()->hasPermission('update_users')) {
                        $btn = $btn.'
                     <form action="'.route('users.destroy',$row->id).'" id="delform" method="post" style="display: inline-block">
                        <input type="hidden" name="_method" value="delete">
                    <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></button>
                    </form>';
                    }else{
                        $btn = '<button type="button" class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i></button>';
                    }

                    return $btn;
                })

                ->rawColumns(['action'])
                ->make(true);

        }

        return view('admin.users.index');
    }

    public function create(){
            $roles = Role::WhereRoleNot(['super_admin','admin'])->get();
        return view('admin.users.create',compact('roles'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'role_id' => 'required',
        ]);

        $request->merge(['password' => bcrypt($request->password)]);
        $user = User::create($request->all());

        $user->attachRoles(['admin',$request->role_id]);
        session()->flash('success', 'تمت الاضافة بنجاح');
        return redirect()->route('users.index');
    }

    public function edit($id){
        $roles = Role::WhereRoleNot(['super_admin','admin'])->get();
        $rows = User::findOrFail($id);
        return view('admin.users.edit',compact('roles','rows'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($user->id),
            ],
//            'password' => 'required|confirmed',
            'role_id' => 'required',
        ]);

//        $request->merge(['password' => bcrypt($request->password)]);
        $user->update($request->all());
        $user->syncRoles(['admin', $request->role_id]);
        session()->flash('success', 'edited');
        return back();
    }

    public function destroy(Request $request,$id){


        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['status'=>'success','data'=>$user]);
    }



}
