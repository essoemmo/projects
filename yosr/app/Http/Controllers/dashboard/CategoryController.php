<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_categories')->only(['index']);
        $this->middleware('permission:create_categories')->only(['create', 'store']);
        $this->middleware('permission:update_categories')->only(['edit', 'update']);
        $this->middleware('permission:delete_categories')->only(['destroy']);

    }

    public function index(Request $request)
    {

        if ($request->ajax()) {


        $data = Category::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    if (auth()->user()->hasPermission('update_categories')){
                        $btn = '<button class="btn btn-warning btn-sm edit" data-toggle="modal" data-target="#edit_category" data-catid="'.$row->id.'" data-name="'.$row->name.'"><i class="fa fa-edit"></i></button>';
                    }else{
                        $btn = '<button class="btn btn-warning btn-sm disabled"><i class="fa fa-edit"></i></button>';
                    }


                    if (auth()->user()->hasPermission('delete_categories')){
                        $btn = $btn.'
                     <form action="'.route('categories.destroy',$row->id).'" id="delform" method="post" style="display: inline-block">
                        <input type="hidden" name="_method" value="delete">
                    <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></button>
                    </form>';
                    }else{
                        $btn = '<button class="btn btn-warning btn-sm disabled"><i class="fa fa-trash"></i></button>';
                    }


                    return $btn;
                })

                ->rawColumns(['action'])
                ->make(true);

        }

        return view('admin.categories.main.index');
    }


    public function store(Request $request){

        $v = Validator::make($request->all(), [
            'name' => 'required|max:100',
        ]);

        if ($v->fails()) {
            return Response::json(['errors' => $v->errors()]);
        }


        $category = Category::create([
            'name' => $request->name,
        ]);

        return response()->json(['status'=>'success','data'=>$category]);
    }

    public function update(Request $request){


        $category = Category::findOrFail($request->catId);
        $v = Validator::make($request->all(), [
            'name' => 'required|max:100',
        ]);

        if ($v->fails()) {
            return Response::json(['errors' => $v->errors()]);
        }


        $category->update([
            'name' => $request->name,
        ]);

        return response()->json(['status'=>'success','data'=>$category]);
    }

    public function destroy(Request $request,$id){


        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json(['status'=>'success','data'=>$category]);
    }

}
