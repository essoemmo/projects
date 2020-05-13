<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\models\Category;
use App\models\Subcat;
use App\models\Subcategory;
use App\models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class UploadController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read_uploads')->only(['index']);
        $this->middleware('permission:create_uploads')->only(['create', 'store']);
        $this->middleware('permission:update_uploads')->only(['edit', 'update']);
        $this->middleware('permission:delete_uploads')->only(['destroy']);

    }

    public function index(Request $request){

        if ($request->ajax()) {


            $data = Upload::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    if(auth()->user()->hasPermission('update_uploads')){
                        $btn = '<a href="'.route('uploads.edit',$row->id).'" class="btn btn-warning btn-sm edit"><i class="fa fa-edit"></i></a>';

                    }else{
                        $btn = '<a href="#" class="btn btn-warning btn-sm disabled"><i class="fa fa-edit"></i></a>';
                    }

                    if(auth()->user()->hasPermission('delete_uploads')){
                        $btn = $btn.'
                     <form action="'.route('uploads.destroy',$row->id).'" id="delform" method="post" style="display: inline-block">
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

        return view('admin.uploads.index');
    }

    public function create(){
        $upload = Upload::create([]);
        $categories = Category::get();
        return view('admin.uploads.create',compact('upload','categories'));
    }
    public function store(Request $request){

//        dd($request->upload_id);
       $upload = Upload::findOrFail($request->upload_id);

       $upload->update([
          'name' => $request->name,
          'uploadNumber' => $request->uploadNumber,
          'category_id' => $request->category_id,
          'subCat' => $request->sub_category_id,
          'subnewCat' => $request->sub_cat_id,
       ]);
           session()->flash('success','تمت الاضافة بنجاح');
          return redirect()->route('uploads.index');

    }


    public function edit($id){
        $upload = Upload::findOrFail($id);
        $categories = Category::get();
        return view('admin.uploads.edit',compact('upload','categories'));

    }

    public function update(Request $request,$id){
        $upload = Upload::findOrFail($id);

        $upload->update([
            'name' => $request->name,
            'uploadNumber' => $request->uploadNumber,
            'category_id' => $request->category_id,
            'subCat' => $request->sub_category_id,
            'subnewCat' => $request->sub_cat_id,
        ]);
        session()->flash('success','تمت التعديل بنجاح');
        return redirect()->route('uploads.index');
    }

    public function destroy($id){

        $upload = Upload::findOrFail($id);
            $path = public_path("uploads/files/$id");

        if (is_dir($path)){
            $this->rmdir_recursive($path);
        }

        $imgs = \App\models\File::where('fileable_id',$id)->get();
        foreach ($imgs as $img){
            $img->delete();
        }

            $upload->delete();

        return response()->json(['status'=>'success','data'=>$upload]);
    }

    function rmdir_recursive($dir) {
        foreach(scandir($dir) as $file) {
            if ('.' === $file || '..' === $file) continue;
            if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
            else unlink("$dir/$file");
        }
        rmdir($dir);
    }


    public function getCategory(Request $request)
    {

      if ($request->has('subCat')){
          $category = Subcat::where('SubCat_id',$request->subCat)->get();

          if ($category->count() > 0){
              return response()->json(['status'=>'success','data'=>$category]);
          }else{
              return response()->json(['status'=>'failed']);

          }

      }else{
          $category = Subcategory::where('category_id',$request->id)->get();

          if ($category->count() > 0){
              return response()->json(['status'=>'success','data'=>$category]);
          }else{
              return response()->json(['status'=>'failed']);

          }
      }


    }



    public function uploadImages(Request $request,$id){
        $files = [];
        foreach ($request->file as $file){
            $imageName = $file->getClientOriginalName();
            $file->move(public_path('uploads/files/'.$id), $imageName);
            $upload = Upload::findOrFail($id);
            $files[] = $upload->files()->create([
                'fileable_id' => $upload->id,
                'fileable_type' => get_class($upload),
                'files' => '/uploads/files/'.$id.'/'. $imageName,
                'main' => 0,
                'tag' => $imageName,
            ]);
        }
        return response()->json($files);
    }

    public function deleteImages(Request $request,$id){
        $upload = Upload::findOrFail($id);
        $file = $request->file;

        $exists = $upload->files()->where('fileable_id',$id)->where('fileable_type',get_class($upload))->exists();

        if ($exists){
            $photo = $upload->files()->where('fileable_id',$id)->where('fileable_type',get_class($upload))->where('tag', $file)->where('main',0)->first();
//            $photo = $upload->files()->where('fileable_id',$id)->where('fileable_type',get_class($upload))->where('main',0)->first();

            $image_path = $photo->files;  // Value is not URL but directory file path
//                dd(public_path($image_path));

            if(File::exists(public_path($image_path))) {
                File::delete(public_path($image_path));
            }
            $photo->delete();
        }
    }


}
