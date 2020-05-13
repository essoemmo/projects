<?php


namespace App\Http\Controllers\Admin;


use App\DataTables\SlidersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Settings\Banner;
use App\Models\Settings\Currency;
use App\Models\Settings\PriceSettings;
use App\Models\Settings\Setting;
use App\Models\Settings\Slider;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class SettingsController extends Controller
{

    public function lang($lang) {
        //dd($lang);
        session()->has('adminLang') ? session()->forget('adminLang'):'';
        $lang == 'ar' ? session()->put('adminLang','ar') : session()->put('adminLang','en');
        return Redirect::to(URL::previous());
    }

    public function get_settings()
    {
        $site_settings = Setting::first();
        return view('admin.settings.index' ,compact('site_settings'));
    }

    public function store_settings(Request $request)
    {

        $rules = [
            'logo' => 'sometimes|image|mimes:jpeg,jpg,png,bmp,gif,svg'
        ];


        $validator = validator()->make($request->all() , $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
//            dd(request());

            $settings = Setting::first();
            if($settings == null){
                $image = $request->file('logo');

                if ($image && $file = $image->isValid()) {
                    $destinationPath = public_path('uploads/settings/site_settings');
//                    if (!is_dir($destinationPath)) {
//                        mkdir($destinationPath, 777, true);
//                    }

                    $fileName = $image->getClientOriginalName();
                    $image->move($destinationPath, $fileName);
                    $request->logo = $fileName;
                }

                $settings = Setting::create([
                    'email' => $request->email,
                    'logo' => $request->logo,
                    'phone1' => $request->phone1,
                    'phone2' => $request->phone2,
                    'facebook_url' => $request->facebook_url,
                    'instagram_url' => $request->instagram_url,
                    'twitter_url' => $request->twitter_url,
                    'youtube_url' => $request->youtube_url,
                    'work_time' => $request->work_time,
                    'address' => $request->address,
                    'lang_id' => 1

                ]);
                $settings->save();
                return redirect()->back()->with('flash_message' , _i('Added Successfully !'));
            }else{

                if ($request->has('logo'))
                {
                    $image = $request->file('logo');
                    if ($image && $file = $image->isValid()) {
                          if(!empty($settings->logo)){
                            //delete old image
                            $file = public_path('uploads/settings/site_settings/').$settings->logo;
                            @unlink($file);
                        }
                        $destinationPath = public_path('uploads/settings/site_settings');
//                        if (!is_dir($destinationPath)) {
//                            mkdir($destinationPath, 777, true);
//                        }

                        $fileName = $image->getClientOriginalName();
                        $image->move($destinationPath, $fileName);
                        $request->logo = $fileName;

                      
                    }
                    $settings->logo = $request->logo;
                }

                $settings->email = $request->email;
                $settings->phone1 = $request->phone1;
                $settings->phone2 = $request->phone2;
                $settings->facebook_url = $request->facebook_url;
                $settings->instagram_url = $request->instagram_url;
                $settings->twitter_url = $request->twitter_url;
                $settings->youtube_url = $request->youtube_url;
                $settings->work_time  = $request->work_time;
                $settings->address = $request->address;
                $settings->save();
                return redirect()->back()->with('flash_message' , _i('Updated Successfully !'));
            }

        }


    }



    public  function price_setting()
    {
        $price_setting = PriceSettings::first();
        return view('admin.settings.price_setting' ,compact('price_setting'));
    }

    public function price_setting_store(Request $request)
    {
        $price_setting = PriceSettings::first();
        if($price_setting == null)
        {
            $price_setting = PriceSettings::create([
                'type' => $request->type,
                'price' => $request->price,
            ]);
            $price_setting->save();
            return redirect()->back()->with('flash_message' , _i('Added Successfully !'));

        }else{

            $price_setting->type = $request->type;
            $price_setting->price = $request->price;
            $price_setting->save();
            return redirect()->back()->with('flash_message' , _i('Updated Successfully !'));
        }

    }

}
