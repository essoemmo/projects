<?php

namespace App\Http\Controllers\Admin\Setting;

use App\DataTables\SliderDataTable;
use App\Models\SiteLanguage;
use App\Models\Slider;
use App\Models\SliderTranslation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Slider-Add'])->only('index');
        $this->middleware(['permission:Slider-Add'])->only('store');
        $this->middleware(['permission:Slider-Edit'])->only('update');
        $this->middleware(['permission:Slider-Delete'])->only('delete');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SliderDataTable $sliderDataTable)
    {
        return $sliderDataTable->render('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $langs = SiteLanguage::all();
        return view('admin.slider.create',compact('langs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'image' => 'required|image',
            '*_title' => 'sometimes',
            '*_description' => 'sometimes',
        ]);
        $langs = SiteLanguage::all();
        if($request->publish == null) {
            $request->publish = 0;
        }
        $slider = Slider::create([
            'url'=>$request->url,
            'publish'=>$request->publish,
        ]);
        if ($request->hasFile('image')) {
            $image_path = $slider->image;  // Value is not URL but directory file path

            if(File::exists(public_path($image_path))) {
                File::delete(public_path($image_path));
            }

            if(!is_dir(public_path('uploads/slider/' . $slider->id))) {
                mkdir(public_path('uploads/slider/' . $slider->id), 755, true);
            }
            \Intervention\Image\Facades\Image::make($request->image)
                ->resize(1366, 500)
                ->save(public_path('/uploads/slider/'. $slider->id .'/'.$request->image->hashName()), 100);
        }

        if($request->image != null) {
            $setting_image = '/uploads/slider/'. $slider->id .'/'.$request->image->hashName();
        } else {
            $slider_image = $slider->image;
        }

        $slider->update([
            'image' => $setting_image,
        ]);

        foreach ($langs as $lang){
            $sliderTranslation = new SliderTranslation();
            $sliderTranslation->title = $request->get($lang->locale.'_title');
            $sliderTranslation->description = $request->get($lang->locale.'_description');
            $sliderTranslation->locale = $lang->locale;
            $slider->translations()->save($sliderTranslation);
        }
        return redirect(aurl('sliders'))->with('success',_i('success save'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        $langs = SiteLanguage::all();
        return view('admin.slider.edit',compact('langs','slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);
        $data = $this->validate($request,[
            'image' => 'sometimes|image',
            '*_title' => 'sometimes',
            '*_description' => 'sometimes',
        ]);
        $langs = SiteLanguage::all();
        if($request->publish == null) {
            $request->publish = 0;
        }
        $slider->update([
            'url'=>$request->url,
            'publish'=>$request->publish,
        ]);

        if($request->image){
            if ($request->hasFile('image')) {
                $image_path = $slider->image;  // Value is not URL but directory file path

                if(File::exists(public_path($image_path))) {
                    File::delete(public_path($image_path));
                }

                if(!is_dir(public_path('uploads/slider/' . $slider->id))) {
                    mkdir(public_path('uploads/slider/' . $slider->id), 755, true);
                }
                 \Intervention\Image\Facades\Image::make($request->image)
                    ->resize(1366, 500)
                    ->save(public_path('/uploads/slider/'. $slider->id .'/'.$request->image->hashName()), 100);
            }

            if($request->image != null) {
                $setting_image = '/uploads/slider/'. $slider->id .'/'.$request->image->hashName();
            } else {
                $slider_image = $slider->image;
            }

            $slider->update([
                'image' => $setting_image,
            ]);
        }

        foreach ($langs as $lang){
            if ($slider->translate($lang->locale)){
                $sliderUsTranslation = SliderTranslation::where('locale',$lang->locale)->where('slider_id',$slider->id)->first();
            }else{
                $sliderUsTranslation = new SliderTranslation();
            }
            $sliderUsTranslation->title = $request->get($lang->locale.'_title');
            $sliderUsTranslation->description = $request->get($lang->locale.'_description');
            $sliderUsTranslation->locale = $lang->locale;
            $slider->translations()->save($sliderUsTranslation);
        }
        //return redirect(aurl('sliders'))->with('success',_i('success update'));
        return redirect()->back()->with('success',_i('success update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $image_path = $slider->image;  // Value is not URL but directory file path
        if(File::exists(public_path($image_path))) {
            File::delete(public_path($image_path));
        }
        $sliderTraslation = SliderTranslation::where('slider_id', $slider->id)->delete();
        $slider->delete();
        return redirect(aurl('sliders'))->with('success',_i('success delete'));
    }

    public function change($id) {
        $slider = Slider::findOrFail($id);
        if($slider->publish == 0) {
            $slider->publish = 1;
            $slider->update();
        } elseif($slider->publish == 1) {
            $slider->publish = 0;
            $slider->update();
        }
    }
}
