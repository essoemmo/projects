<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\models\Category;
use App\models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SubCatController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = Subcategory::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<button class="btn btn-warning btn-sm edit" data-toggle="modal" data-target="#edit_category" data-MainCat ="'.$row->Category->id.'" data-catid="'.$row->id.'" data-name="'.$row->name.'"><i class="fa fa-edit"></i></button>';
                    $btn = $btn.'
                     <form action="'.route('subcategories.destroy',$row->id).'" id="delform" method="post" style="display: inline-block">
                        <input type="hidden" name="_method" value="delete">
                    <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></button>
                    </form>';

                    return $btn;
                })

                ->rawColumns(['action'])
                ->make(true);

        }
        $category = Category::get();
        return view('admin.categories.subMain.index',compact('category'));
    }


    public function store(Request $request){

        $v = Validator::make($request->all(), [
            'name' => 'required|max:100',
        ]);

        if ($v->fails()) {
            return Response::json(['errors' => $v->errors()]);
        }


        $category = Subcategory::create([
            'name' => $request->name,
            'category_id' => $request->catId,
        ]);

        return response()->json(['status'=>'success','data'=>$category]);
    }

    public function update(Request $request){


        $category = Subcategory::findOrFail($request->catId);
        $v = Validator::make($request->all(), [
            'name' => 'required|max:100',
        ]);

        if ($v->fails()) {
            return Response::json(['errors' => $v->errors()]);
        }


        $category->update([
            'name' => $request->name,
            'category_id' => $request->cat_id,
        ]);

        return response()->json(['status'=>'success','data'=>$category]);
    }

    public function destroy(Request $request,$id){


        $category = Subcategory::findOrFail($id);
        $category->delete();
        return response()->json(['status'=>'success','data'=>$category]);
    }

}
