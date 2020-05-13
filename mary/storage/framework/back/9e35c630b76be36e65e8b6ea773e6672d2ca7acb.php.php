<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;

class SettingController extends Controller
{

    public function index(){
        $setting = Setting::first();
            if (!$setting){
                Setting::create([
                   'title' => 'Change  name',
                   'mantance' => 1,
                ]);
            }
        return view('admin.setting.index' , ['title' => _i('Setting')]);
    }

    public function update(Request $request){
        $request->validate([
           'title' => 'required',
           'email' => 'required',
           'facebook_url' => 'required',
           'instagram_url' => 'required',
           'twitter_url' => 'required',
           'phone1' => 'required',
           'address' => 'required',
           'description' => 'required',
           'logo' => 'nullable',
        ]);

        $setting = Setting::first();
        if ($setting){
            $update = Setting::findOrFail($request->setting_id);
            $update->title = $request->title;
            $update->lang_id = $request->language;
            $update->email = $request->email;
            $update->facebook_url = $request->facebook_url;
            $update->instagram_url = $request->instagram_url;
            $update->twitter_url = $request->twitter_url;
            $update->phone1 = $request->phone1;
            $update->address = $request->address;
            $update->description = $request->description;
            $update->register_msg = $request->register_msg;
            $update->mantance = $request->mantance;
            $update->TitleTopSearch = $request->TitleTopSearch;
            $update->descriptionOnSearch = $request->descriptionOnSearch;
            $update->Titleactivemember = $request->Titleactivemember;
            $update->descrptionactivemember = $request->descrptionactivemember;
            $update->Titleactivemember2 = $request->Titleactivemember2;
            $update->descrptionactivemember2 = $request->descrptionactivemember2;
            if ($request->logo){

                if ($setting->loge != 'default.png'){
                    Storage::disk('public_uploads')->delete('/setting/'.$setting->loge);
                }


                Image::make($request->logo)->save(public_path('/uploads/setting/'.$request->logo->hashName()));
                $update->loge = $request->logo->hashName();
            }
            $update->save();
            if ($update->save()){
              $source =  Setting::findOrFail($request->setting_id);
                $source->source_id = $update->id;
                $source->save();
            }
            session()->flash('success',_i('updated Succfully'));
            return redirect()->route('settings-index');
        }else{

            session()->flash('success',_i('updated wrong'));
            return redirect()->back();

        }

    }























//    public function cityindex()
//    {
//        $city = City::all();
//        return view('Admin.setting.city', compact('city'));
//    }
//
//    // make datatable for permissions
//    public function  getDatatableCity()
//    {
//        $city =DB::table('cities_data')->select(['id', 'name' ,'created_at', 'updated_at']);
//        return DataTables::of($city)
////            ->editColumn('name', function(City $cities) {
////                return 'Hi ' . $user->name . '!';
////            })
//            ->addColumn('action', function ($city) {
//                return'<button class="btn btn-icon waves-effect waves-light btn-primary edit" data-id ="'.$city->id.'" data-name ="'.$city->name.'" data-toggle="modal" data-target="#edit"  title="'._i("Edit").'"><i class="fa fa-edit"></i> </button>' ."&nbsp;&nbsp;&nbsp;".
//                    '<a href="'.$city->id.'/delete" class="btn btn-icon waves-effect waves-light btn btn-danger" title="'._i("Delete").'"><i class="fa fa-trash"></i> </a>';
//            })
//            ->make(true);
//    }
//
//    public function store(Request $request)
//    {
//        $request->validate([
//            'nationalty' => 'required',
//            'cityname' => 'required',
//        ],[
//            'title.required'=>_i('title required'),
//        ]);
//
//        $addCity = new City();
//        $addCity->nationalty_id = $request->nationalty;
//        $addCity->save();
//        if ($addCity->save()){
//        $nationlangid = DB::table('nationalies_data')->where('nationalty_id',$request->nationalty)->first();
//            DB::table('cities_data')->insert([
//               'name' => $request->cityname,
//               'city_id' => $addCity->id,
//                'lang_id' => $nationlangid->lang_id,
//            ]);
//        }
//        session()->flash('success',_i('Add Succfully'));
//        return redirect()->route('city.index');
//    }


}
