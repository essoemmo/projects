<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Models\Phone;
use App\Models\Setting;
use App\Models\SettingTranslation;
use App\Models\SiteLanguage;
use App\Models\Social_link;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:SiteSetting-Add'])->only('showSetting');
        $this->middleware(['permission:SiteSetting-Add'])->only('StoreSetting');

    }
    public function showSetting() {

        $setting = Setting::first();
        $langs = SiteLanguage::all();
        if($setting != null) {
            $slinks = Social_link::where('setting_id', $setting->id)->get();
            return view('admin.setting.show',compact('setting','langs','slinks'));
        } else {
            return view('admin.setting.show',compact('setting','langs'));
        }
    }

    public function storeSetting(Request $request) {
//            dd($request->all());
        $data = $this->validate(    $request,[
            'logo' => 'sometimes|image',
            'footer_logo' => 'sometimes|image',
            '*_title' => 'sometimes',
            '*_description' => 'sometimes',
            '*_address' => 'sometimes',
            'email' => 'required',
            'work_time' => 'sometimes',
        ]);
        $langs = SiteLanguage::all();
        $setting = Setting::first();
        if($setting == null){
            $setting = Setting::create([
                'email' => $request->email,
                'work_time' => $request->work_time,
            ]);

            if ($request->hasFile('logo')) {
                $image_path = $setting->logo;  // Value is not URL but directory file path

                if(File::exists(public_path($image_path))) {
                    File::delete(public_path($image_path));
                }

                if(!is_dir(public_path('uploads/setting/' . $setting->id))) {
                    mkdir(public_path('uploads/setting/' . $setting->id), 755, true);
                }
                \Intervention\Image\Facades\Image::make($request->logo)
                    ->resize(211, 75, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save(public_path('/uploads/setting/'. $setting->id .'/'.$request->logo->hashName()));
            }

            if ($request->hasFile('footer_logo')) {
                $image_path = $setting->footer_logo;  // Value is not URL but directory file path

                if(File::exists(public_path($image_path))) {
                    File::delete(public_path($image_path));
                }

                if(!is_dir(public_path('uploads/setting/' . $setting->id))) {
                    mkdir(public_path('uploads/setting/' . $setting->id), 755, true);
                }
                \Intervention\Image\Facades\Image::make($request->footer_logo)
                    ->resize(211, 75, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save(public_path('/uploads/setting/'. $setting->id .'/'.$request->footer_logo->hashName()));

            }

            if($request->logo != null) {
                $setting_logo = '/uploads/setting/'. $setting->id .'/'.$request->logo->hashName();
            } else {
                $setting_logo = $setting->logo;
            }

            if($request->footer_logo != null) {
                $setting_footer_logo = '/uploads/setting/'. $setting->id .'/'.$request->footer_logo->hashName();
            } else {
                $setting_footer_logo = $setting->footer_logo;
            }

            $setting->update([
                'logo' => $setting_logo,
                'footer_logo' => $setting_footer_logo
            ]);

            foreach ($langs as $lang){
                $setting_trans = new SettingTranslation();
                $setting_trans->title = $request->get($lang->locale.'_title');
                $setting_trans->description = $request->get($lang->locale.'_description');
                $setting_trans->address = $request->get($lang->locale.'_address');
                $setting_trans->locale = $lang->locale;
                $setting->translations()->save($setting_trans);
            }
            if($request->phone != null){
                for($ii = 0; $ii < count($request->phone) ; $ii++) {
                    $phone = $request->phone[$ii];
                    $setting->phones()->create([
                        'phone'=>$phone,
                        'phoneable_id' => $setting->id,
                        'phoneable_type' => get_class($setting)
                    ]);
                }
            }

            if($request->s_title != null){
                for($ii = 0; $ii < count($request->s_title) ; $ii++) {
                    $s_title = $request->s_title[$ii];
                    $s_link = $request->s_link[$ii];
                    $setting_id = $setting->id;
                    Social_link::create([
                        'title' => $s_title,
                        'url' => $s_link,
                        'setting_id'=>$setting_id,
                    ]);
                }
            }

        }else{

            $langs = SiteLanguage::all();

            $setting->email = $request->email;
            $setting->work_time = $request->work_time;
            $setting->update();

            if ($request->hasFile('logo')) {
                $image_path = $setting->logo;  // Value is not URL but directory file path

                if(File::exists(public_path($image_path))) {
                    File::delete(public_path($image_path));
                }

                if(!is_dir(public_path('uploads/setting/' . $setting->id))) {
                    mkdir(public_path('uploads/setting/' . $setting->id), 755, true);
                }
                \Intervention\Image\Facades\Image::make($request->logo)
                    ->resize(211, 75, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save(public_path('/uploads/setting/'. $setting->id .'/'.$request->logo->hashName()));
            }

            if ($request->hasFile('footer_logo')) {
                $image_path_footer = $setting->footer_logo;  // Value is not URL but directory file path

                if(File::exists(public_path($image_path_footer))) {
                    File::delete(public_path($image_path_footer));
                }

                if(!is_dir(public_path('uploads/setting/' . $setting->id))) {
                    mkdir(public_path('uploads/setting/' . $setting->id), 755, true);
                }
                \Intervention\Image\Facades\Image::make($request->footer_logo)
                    ->resize(211, 75, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save(public_path('/uploads/setting/'. $setting->id .'/'.$request->footer_logo->hashName()));

            }

            if($request->logo != null) {
                $setting_logo = '/uploads/setting/'. $setting->id .'/'.$request->logo->hashName();
            } else {
                $setting_logo = $setting->logo;
            }

            if($request->footer_logo != null) {
                $setting_footer_logo = '/uploads/setting/'. $setting->id .'/'.$request->footer_logo->hashName();
            } else {
                $setting_footer_logo = $setting->footer_logo;
            }

            $setting->update([
                'logo' => $setting_logo,
                'footer_logo' => $setting_footer_logo
            ]);

            foreach ($langs as $lang){
                if ($setting->translate($lang->locale)){
                    $setting_trans = SettingTranslation::where('locale',$lang->locale)->where('setting_id',$setting->id)->first();
                }else{
                    $setting_trans = new SettingTranslation();
                }
                $setting_trans = SettingTranslation::where('locale',$lang->locale)->where('setting_id',$setting->id)->first();
                $setting_trans->title = $request->get($lang->locale.'_title');
                $setting_trans->description = $request->get($lang->locale.'_description');
                $setting_trans->address = $request->get($lang->locale.'_address');
                $setting_trans->locale = $lang->locale;
                $setting->translations()->save($setting_trans);
            }


            if($setting->id != null){
                Phone::where('phoneable_id',$setting->id)->delete();
                for($ii = 0; $ii < count($request->phone) ; $ii++) {
                    $phone = $request->phone[$ii];
                    $setting->phones()->create([
                        'phone'=>$phone,
                        'phoneable_id' => $setting->id,
                        'phoneable_type' => get_class($setting)
                    ]);
                }
            }

            if($setting->id != null){
                Social_link::where('setting_id', $setting->id)->delete();
                for($ii = 0; $ii < count($request->s_title) ; $ii++) {
                    $s_title = $request->s_title[$ii];
                    $s_link = $request->s_link[$ii];
                    $setting_id = $setting->id;
                    Social_link::create([
                        'title' => $s_title,
                        'url' => $s_link,
                        'setting_id'=>$setting_id,
                    ]);
                }
            }
        }
        return redirect()->back()->with('success' , _i('Updated Successfully !'));
    }
}
