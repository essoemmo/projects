<?php

namespace App\Http\Controllers\dashboard;

use App\Models\CountrySlider;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;

class SliderController extends Controller
{

    public function index()
    {
        return view('admin.setting.slider.index');
    }


    public function get_datatable(){

        $slider = Slider::get();
        return DataTables::of($slider)
            ->addColumn('image', function ($slider) {
                return '<img src="'.asset('uploads/setting/slider/'.$slider->image).' " height="100px;" >';
            })
            ->addColumn('delete', 'admin.setting.slider.delete')
            ->addColumn('action', function ($slider) {
                $img = asset('uploads/setting/slider/'.$slider->image);
//                if (auth()->user()->can('slider-edit')){
//                    return '<a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModaledit" data-id="'.$slider->id.'" data-title="'.$slider->title.'" data-desc="'.$slider->desc.'" data-image="'.$img.'" data-lang="'.$slider->lang_id.'" class="btn-sm" id="edit"><i class="fa fa-edit"></i></a>';
                    return '<a href="slider/'.$slider->id.'/edit" class=" btn btn-primary" id="edit"><i class="ti-pencil-alt"></i></a>';

            })
            ->rawColumns([
                'image',
                'action',
                'delete'

            ])
            ->make(true);
    }

    public function create(){

        $country = DB::table('country_descriptions')->where('language_id',checknotsessionlang())->get();

        return view('admin.setting.slider.create',compact('country'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'image' => 'required',
            'sort_order' => 'required',
            //'link' => 'required',
           // 'status' => 'required',
//            'language' => 'required',
        ]);

        if ($request->image){
            Image::make($request->image)->save(public_path('/uploads/setting/slider/'.$request->image->hashName()));
            $data['image'] = $request->image->hashName();
        }
        if($request->link){
            $data['link'] = $request->link;
        }
        if($request->status){
            $data['status'] = $request->status;
        }else{
            $data['status'] = 0;
        }
        $data['lang_id'] = $request->language;
        $result =  Slider::create($data);
        foreach ($request->country as $country_id) {
            $countrySlider = new CountrySlider();
            $countrySlider->slider_id = $result->id;
            $countrySlider->country_id = $country_id;
            $countrySlider->save();
        }
        session()->flash('success', _i('Slider is added'));
        return back();
    }

    public function edit($id){
        $country = DB::table('country_descriptions')->where('language_id',checknotsessionlang())->get();
        $slider = DB::table('sliders')
            ->where('id',$id)
            ->first();
        return view('admin.setting.slider.edit',compact('slider','country'));
    }

    public function update(Request $request,$id)
    {
        $data =$request->validate([
            'title' => 'required',
            //'image' => 'required',
            'sort_order' => 'required',
           // 'link' => 'required',
            //'status' => 'required',
        ]);

        $sliders = Slider::FindOrFail($id);
        $sliders->title = $request->title;
        $sliders->lang_id = $request->language;
        $sliders->sort_order = $request->sort_order;
        $sliders->status = $request->status;
        $sliders->link = $request->link;

        if ($request->image){

            if ($sliders->image != 'default.png'){
                Storage::disk('public_uploads')->delete('/setting/slider/'.$sliders->image);
            }


            Image::make($request->image)->save(public_path('/uploads/setting/slider/'.$request->image->hashName()));
            $sliders->image = $request->image->hashName();
        }
        $sliders->save();

        if ($sliders->save()){
            $cout = \Illuminate\Support\Facades\DB::table('country_slider')
                ->where('slider_id',$id)
                ->delete();
            foreach ($request->country as $country_id) {
                $countrySlider = new CountrySlider();
                $countrySlider->slider_id = $sliders->id;
                $countrySlider->country_id = $country_id;

                $countrySlider->save();
            }
        }

        session()->flash('success', _i('Slider is edited'));
        return back();
    }


    public function destroy(Slider $slider,$id)
    {


        $slider = Slider::Find($id);


        if ($slider->delete()){
            CountrySlider::where('slider_id',$slider->id)->delete();
        }

        session()->flash('success', _i('Slider is deleted'));
        return back();

    }
}
