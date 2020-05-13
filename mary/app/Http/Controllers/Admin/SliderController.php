<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;

class SliderController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:slider-show'])->only('index');
        $this->middleware(['permission:slider-add'])->only('store');
        $this->middleware(['permission:slider-edit'])->only('update');
        $this->middleware(['permission:slider-delete'])->only('destroy');

    }

    public function index()
    {
        return view('admin.setting.slider.index');
    }

    public function get_datatable(){

        $slider = Slider::get();
        return DataTables::of($slider)
            ->addColumn('image', function ($slider) {
                return '<img src="'.asset('uploads/setting/slider/'.$slider->image).'">';
            })
            ->addColumn('delete', 'admin.setting.slider.delete')
            ->addColumn('action', function ($slider) {
                $img = asset('uploads/setting/slider/'.$slider->image);
                if (auth()->user()->can('slider-edit')){
                    return '<a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModaledit" data-id="'.$slider->id.'" data-title="'.$slider->title.'" data-desc="'.$slider->desc.'" data-image="'.$img.'" data-lang="'.$slider->lang_id.'" class="btn-sm" id="edit"><i class="fa fa-edit"></i></a>';

                }else{
                    return '<a class="btn-sm disabled" ><i class="fa fa-edit"></i></a>';

                }
            })
            ->rawColumns([
                'image',
                'action',
                'delete'

            ])
            ->make(true);


    }

    public function store(Request $request)
    {
        $data =$request->validate([
            'title' => 'required',
            'image' => 'required',
            'desc' => 'required',
//            'language' => 'required',
        ]);

        if ($request->image){

            Image::make($request->image)->save(public_path('/uploads/setting/slider/'.$request->image->hashName()));
            $data['image'] = $request->image->hashName();
        }
        $data['lang_id'] = $request->language;
        Slider::create($data);
        session()->flash('success','Slider is added');
        return back();


    }



    public function update(Request $request, Slider $slider)
    {

        $data =$request->validate([
            'title' => 'required',
//            'image' => 'required',
            'desc' => 'required',
        ]);

        $sliders = Slider::FindOrFail($request->id);
        $sliders->title = $request->title;
        $sliders->desc = $request->desc;
        $sliders->lang_id = $request->language;

        if ($request->image){

            if ($sliders->image != 'default.png'){
                Storage::disk('public_uploads')->delete('/setting/slider/'.$sliders->image);
            }


            Image::make($request->image)->save(public_path('/uploads/setting/slider/'.$request->image->hashName()));
            $sliders->image = $request->image->hashName();
        }
        $sliders->save();

        session()->flash('success','Slider is edited');
        return back();
    }


    public function destroy(Slider $slider,$id)
    {
        $slider = Slider::Find($id);
        $slider->delete();

        session()->flash('success','Slider is deleted');
        return back();

    }
}
