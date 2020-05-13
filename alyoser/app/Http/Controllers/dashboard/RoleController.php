<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\models\Category;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_roles')->only(['index']);
        $this->middleware('permission:create_roles')->only(['create', 'store']);
        $this->middleware('permission:update_roles')->only(['edit', 'update']);
        $this->middleware('permission:delete_roles')->only(['destroy']);

    }

    public function index(Request $request){

        if ($request->ajax()) {


            $data = Role::whereRoleNot(['super_admin','admin'])
                ->with('permissions')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    if (auth()->user()->hasPermission('update_roles')){
                        $btn = '<a  href="'.route('roles.edit',$row->id).'" class="btn btn-warning btn-sm edit"><i class="fa fa-edit"></i></a>';
                    }else{
                        $btn = '<a  href="" class="btn btn-warning btn-sm edit disabled"><i class="fa fa-edit"></i></a>';
                    }

                    if (auth()->user()->hasPermission('delete_roles')){
                        $btn = $btn.'
                     <form action="'.route('roles.destroy',$row->id).'" id="delform" method="post" style="display: inline-block">
                        <input type="hidden" name="_method" value="delete">
                    <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></button>
                    </form>';
                    }else{
                        $btn = '<button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i></button>';
                    }



                    return $btn;
                })

                ->rawColumns(['action'])
                ->make(true);

        }

        return view('admin.roles.index');
    }

    public function create(){
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles',
            'permissions' => 'required|array|min:1',
        ]);

        $role = Role::create($request->all());
        $role->attachPermissions($request->permissions);
        session()->flash('success', 'تمت الاضافة بنجاح');
        return redirect()->route('roles.index');
    }


    public function edit($id){
        $role = Role::findOrFail($id);
        return view('admin.roles.edit',compact('role'));
    }


    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $request->validate([
            'name' => [
                'required',
                Rule::unique('roles')->ignore($id),
            ],
            'permissions' => 'required|array|min:1',
        ]);

        $role->update($request->all());
        $role->syncPermissions($request->permissions);
        session()->flash('success', 'edited');
        return back();
    }

    public function destroy($id){
        $role = Role::findOrFail($id);
        $role->delete();
        return response()->json(['status'=>'success']);


    }

}
