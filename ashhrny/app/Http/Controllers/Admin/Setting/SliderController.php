<?php

namespace App\Http\Controllers\Admin\Setting;

use App\DataTables\SliderDataTable;
use App\Models\SiteLanguage;
use App\Models\Slider;
use App\Models\SliderTranslation;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Slider-Add'])->only('index');
        $this->middleware(['permission:Slider-Add'])->only('store');
        $this->middleware(['permission:Slider-Edit'])->only('update');
        $this->middleware(['permission:Slider-Delete'])->only('delete');
    }


    public function index(SliderDataTable $sliderDataTable)
    {
        return $sliderDataTable->render('admin.slider.index');
    }

    public function create()
    {
        $langs = SiteLanguage::all();
        $users = User::where('user_type' ,"normal")->orWhere('user_type' , "famous")->get();
        $last_slider = Slider::orderBy('sort', 'desc')->first(); // get last order value
        if(!$last_slider) {
            $sort = 1;
        }else{
            $sort = $last_slider['sort'] + 1;}

        return view('admin.slider.create',compact('langs','users' ,'sort'));
    }


    public function store(Request $request)
    {
        $data = $this->validate($request,[
            '*_title' => 'sometimes',
        ]);
        $langs = SiteLanguage::all();
        if($request->publish == null) {
            $request->publish = 0;
        }


        $slider = Slider::create([
            'user_id'=>$request->user_id,
            'publish'=>$request->publish,
            //'sort'=>$request->sort,
            'alt_image'=>$request->alt_image,
        ]);
/// if request dont have sort get last sort and save slider else (if sort value found save to slider & alternate between found slider else save request value )
        if($request->sort == null){
        // if $request dont have sort
            $last_slider = Slider::orderBy('sort', 'desc')->first(); // get last order value
            if(!$last_slider) {
                $sort = 1;
            }else{
                $sort = $last_slider['sort'] + 1;}
            $slider->sort = $sort;
            $slider->save();
        }else{
        // if request have sort
            $sort_found = Slider::where('sort' ,$request['sort'])->first(); // check if request->sort found or not
            $last_slider = Slider::orderBy('sort', 'desc')->first(); // get last order value
            if(!$sort_found){
                $slider->sort = $request['sort'];
                $slider->save();
            }else{ // if sort found
                $sort_found->sort = $last_slider->sort + 1;
                $sort_found->save();
                $slider->sort = $request->sort;
                $slider->save();
            }
        }

        foreach ($langs as $lang){
            $sliderTranslation = new SliderTranslation();
            $sliderTranslation->title = $request->get($lang->locale.'_title');
            $sliderTranslation->locale = $lang->locale;
            $slider->translations()->save($sliderTranslation);
        }
        return redirect(aurl('sliders'))->with('success',_i('success save'));
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        $langs = SiteLanguage::all();
        $users = User::where('user_type' ,"normal")->orWhere('user_type' , "famous")->get();
        return view('admin.slider.edit',compact('langs','slider','users'));
    }

    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);
        $data = $this->validate($request,[
            '*_title' => 'sometimes',
        ]);
        $langs = SiteLanguage::all();
        if($request->publish == null) {
            $request->publish = 0;
        }
        $slider->update([
            'user_id'=>$request->user_id,
            'publish'=>$request->publish,
            'alt_image'=>$request->alt_image,
        ]);

        /// if request dont have sort get last sort and save slider else (if sort value found save to slider & alternate between found slider else save request value )
        if($request->sort == null){
            // if $request dont have sort
            $last_slider = Slider::orderBy('sort', 'desc')->first(); // get last order value
            if(!$last_slider) {
                $sort = 1;
            }else{
                $sort = $last_slider['sort'] + 1;}
            $slider->sort = $sort;
            $slider->save();
        }else{
            // if request have sort
            $sort_found = Slider::where('sort' ,$request['sort'])->where('id' ,"!=" , $id)->first(); // check if request->sort found or not
            $last_slider = Slider::orderBy('sort', 'desc')->first(); // get last order value
            if(!$sort_found){
                $slider->sort = $request['sort'];
                $slider->save();
            }else{ // if sort found
                $sort_found->sort = $slider->sort;
                $sort_found->save();
                $slider->sort = $request->sort;
                $slider->save();
            }
        }

        foreach ($langs as $lang){
            if ($slider->translate($lang->locale)){
                $sliderUsTranslation = SliderTranslation::where('locale',$lang->locale)->where('slider_id',$slider->id)->first();
            }else{
                $sliderUsTranslation = new SliderTranslation();
            }
            $sliderUsTranslation->title = $request->get($lang->locale.'_title');
            $sliderUsTranslation->locale = $lang->locale;
            $slider->translations()->save($sliderUsTranslation);
        }
        return redirect()->back()->with('success',_i('success update'));
    }


    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
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

    public function sort($id ,Request $request)
    {
       // dd($request->all());
        $slider = Slider::findOrFail($id);
        $old_sort = $slider->sort;
        // sort to high
        if($request->row_sort_hightId){ //
            if($old_sort != 1){
                $new_sort = $slider['sort'] - 1 ;
                $replace_slider = Slider::where('sort' , $new_sort)->first();
                if($replace_slider){
                    $replace_slider->sort = $old_sort;
                    $replace_slider->save();
                }
                $slider->sort = $new_sort;
                $slider->save();
                return response()->json(true);
            }
        }
        if($request->row_sort_bottomId){
            // sort to high
            $new_sort = $slider['sort'] + 1 ;
            $replace_slider = Slider::where('sort' , $new_sort)->first();
            if($replace_slider){
                $replace_slider->sort = $old_sort;
                $replace_slider->save();
            }
            $slider->sort = $new_sort;
            $slider->save();
            return response()->json(true);
        }

    }
}
