<?php


namespace App\Http\Controllers\Admin\Setting;


use App\DataTables\BannerDataTable;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Banner-Add'])->only('index');
        $this->middleware(['permission:Banner-Add'])->only('store');
        $this->middleware(['permission:Banner-Edit'])->only('update');
        $this->middleware(['permission:Banner-Delete'])->only('delete');
    }

    public function index(BannerDataTable $bannerDataTable)
    {
        return $bannerDataTable->render('admin.banner.index');
    }

    public function store(Request $request)
    {
        if($request->publish == null) {
            $request->publish = 0;
        }
        $banner = Banner::create([ //image
            'url' => $request->url,
            'publish' => $request->publish,
        ]);
        if($request->sort == null){
            // if $request dont have sort
            $last_banner = Banner::orderBy('sort', 'desc')->first(); // get last order value
            if(!$last_banner) {
                $sort = 1;
            }else{
                $sort = $last_banner['sort'] + 1;}
            $banner->sort = $sort;
            $banner->save();
        }else{
            // if request have sort
            $sort_found = Banner::where('sort' ,$request['sort'])->first(); // check if request->sort found or not
            $last_banner = Banner::orderBy('sort', 'desc')->first(); // get last order value
            if(!$sort_found){
                $banner->sort = $request['sort'];
                $banner->save();
            }else{ // if sort found
                $sort_found->sort = $last_banner->sort + 1;
                $sort_found->save();
                $banner->sort = $request->sort;
                $banner->save();
            }
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/banners/'.$banner->id), $filename);
            $banner->image = '/uploads/banners/'. $banner->id .'/'. $filename;
            $banner->save();
        }
        return response()->json(true);
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        if($request->publish == null) {
            $request->publish = 0;
        }
        $banner->update([
            'url'=>$request->url,
            'publish'=>$request->publish,
        ]);

        /// if request dont have sort get last sort and save slider else (if sort value found save to slider & alternate between found slider else save request value )
        if($request->sort != null)
        {
            // if request have sort
            $sort_found = Banner::where('sort' ,$request['sort'])->where('id' ,"!=" , $id)->first(); // check if request->sort found or not
            $last_banner = Banner::orderBy('sort', 'desc')->first(); // get last order value
            if(!$sort_found){
                $banner->sort = $request['sort'];
                $banner->save();
            }else{ // if sort found
                $sort_found->sort = $banner->sort ;
                $sort_found->save();
                $banner->sort = $request->sort;
                $banner->save();
            }
        }

        if ($request->hasFile('image')) {
            $image_path = $banner->image;  // Value is not URL but directory file path
            if (File::exists(public_path($image_path))) {
                File::delete(public_path($image_path));
            }
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/banners/' . $banner->id), $filename);
            $banner->image = '/uploads/banners/' . $banner->id . '/' . $filename;
            $banner->save();
        }

     return response()->json(true);
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $imagePath = $banner->image;
        if(File::exists(public_path($imagePath))){
            File::delete(public_path($imagePath));
        }
        $banner->delete();
        return redirect(aurl('banners'))->with('success',_i('success delete'));
    }


    public function change($id) {
        $banner = Banner::findOrFail($id);
        if($banner->publish == 0) {
            $banner->publish = 1;
            $banner->update();
        } elseif($banner->publish == 1) {
            $banner->publish = 0;
            $banner->update();
        }
    }

    public function sort($id ,Request $request)
    {
        // dd($request->all());
        $banner = Banner::findOrFail($id);
        $old_sort = $banner->sort;
        // sort to high
        if($request->row_sort_hightId){ //
            if($old_sort != 1){
                $new_sort = $banner['sort'] - 1 ;
                $replace_banner = Banner::where('sort' , $new_sort)->first();
                if($replace_banner){
                    $replace_banner->sort = $old_sort;
                    $replace_banner->save();
                }
                $banner->sort = $new_sort;
                $banner->save();
                return response()->json(true);
            }
        }
        if($request->row_sort_bottomId){
            // sort to high
            $new_sort = $banner['sort'] + 1 ;
            $replace_banner = Banner::where('sort' , $new_sort)->first();
            if($replace_banner){
                $replace_banner->sort = $old_sort;
                $replace_banner->save();
            }
            $banner->sort = $new_sort;
            $banner->save();
            return response()->json(true);
        }

    }



}