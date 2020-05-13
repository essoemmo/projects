<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\bannerDatatable;
use App\Models\Banner;
use App\Models\Banner_data;
use App\Models\Content_section;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class bannerController extends Controller
{
    public function index(bannerDatatable $bannerDatatable){
        $title = _i('banner');
        return $bannerDatatable->render('admin.banner.index',compact('title'));
    }

    public function create()
    {
        $title = 'create banner';
        $contentSectios = Content_section::get();
        return view('admin.banner.create',compact('title','contentSectios'));
    }


    public function store(Request $request){
        $v = Validator::make($request->all(), [
            'title' => 'required|max:100|unique:banner_data,title',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:2000',
        ]);
        $acc = $request->all();
        $lang = Language::where('code', 'ar')->first();
        if ($v->fails()) {
            return Response::json(['errors' => $v->errors()]);
        }

        if ($request->hasFile('image')){
                  if (!is_dir(public_path('uploads/banner'))){
                      mkdir(public_path('uploads/banner'));
                  }
            Image::make($request->image)->save(public_path('/uploads/banner/' . $request->image->hashName()));
        }

        $addbanner = Banner::create([
            'section_id' => $request->section_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'image' => $request->image->hashName(),
        ]);

        Banner_data::create([
            'banner_id' => $addbanner->id,
            'title' => $request->title,
            'description' => $request->conteent,
            'lang_id' => $request->language == null ?$lang :$request->language,
            'source_id' => null,
        ]);

        return Response::json(['SUCCESS','id'=>$addbanner->id]);
    }

    public function edit($id){
        $title = 'edit banner';
        $contentSectios = Content_section::get();
        $banner = Banner::
        leftJoin('banner_data','banner.id','=','banner_data.banner_id')
            ->select(['banner.*','banner_data.title','banner_data.description','banner_data.lang_id','banner_data.source_id'])
            ->where('banner.id',$id)->first();

//        dd($banner);
        return view('admin.banner.edit',compact('title','contentSectios','banner'));
    }

    public function update(Request $request,$id){
        $banner_data = Banner_data::where('banner_id',$id)->first();
        $v = Validator::make($request->all(), [
            'title' => [
                'required',
                Rule::unique('banner_data')->ignore($banner_data->id),
            ],
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:2000',
        ]);
        $acc = $request->all();
        $lang = Language::where('code', 'ar')->first();
        if ($v->fails()) {
            return Response::json(['errors' => $v->errors()]);
        }
        $banner = Banner::findOrFail($id);
        if ($request->hasFile('image')){
            if (!is_dir(public_path('uploads/banner'))){
                mkdir(public_path('uploads/banner'));
            }
            Storage::disk('public_uploads')->delete('/banner/'.$banner->image);

            Image::make($request->image)->save(public_path('/uploads/banner/' . $request->image->hashName()));
        }

        $addbanner = Banner::where('id',$id)->update([
            'section_id' => $request->section_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'image' => $request->image ?  $request->image->hashName() : $banner->image,
        ]);

        Banner_data::where('banner_id',$id)->update([
            'banner_id' => $id,
            'title' => $request->title,
            'description' => $request->conteent,
            'lang_id' => $request->language == null ?$lang :$request->language,
            'source_id' => null,
        ]);

        return Response::json(['SUCCESS']);
    }

    public function destroy($id){

        $banner = Banner::findOrFail($id);
        $banner->delete();
        return Response::json(['SUCCESS']);

    }


    public function uploadImages(Request $request,$id){
        $files = [];
        foreach ($request->file as $file){
            $imageName = time().$file->getClientOriginalName();
            $file->move(public_path('uploads/banner/'.$id), $imageName);
            $banner = Banner::findOrFail($id);
            $files[] = $banner->files()->create([
                'fileable_id' => $banner->id,
                'fileable_type' => get_class($banner),
                'image' => '/uploads/banner/'.$id.'/'. $imageName,
                'main' => 0,
                'tag' => $imageName,
            ]);
        }
        return response()->json($files);
    }

    public function deleteImages(Request $request,$id){
        $banner = Banner::findOrFail($id);
        $file = $request->file;

        $exists = $banner->files()->where('fileable_id',$id)->where('fileable_type',get_class($banner))->exists();
        if ($exists){
            $photo = $banner->files()->where('fileable_id',$id)->where('fileable_type',get_class($banner))->where('tag', $file)->where('main',0)->first();
            $image_path = $photo->image;  // Value is not URL but directory file path
            if(File::exists(public_path($image_path))) {
                File::delete(public_path($image_path));
            }
            $photo->delete();
        }
    }


}
