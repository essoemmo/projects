<?php


namespace App\Http\Controllers\Master;


use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Settings\Setting;
use App\Models\Settings\SettingsData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;


class SettingsController extends Controller
{

    public function getlang(Request $request)
    {
        $lang = Language::where('id',$request->lang_id)->first();
        if ($lang){
            return Response::json($lang->title);
        }
    }

    public function index()
    {
        //dd( getLang(session('MasterLang')));
        $setting = Setting::leftJoin('settings_data','settings_data.setting_id','settings.id')
            ->select('settings.*','settings_data.setting_id','settings_data.title','settings_data.description'
                ,'settings_data.lang_id', 'settings_data.source_id')
            //->where('settings_data.lang_id', getLang(session('MasterLang')))
            ->where('settings_data.source_id', null)
            ->where('settings.store_id',null)->first();
       // dd($setting);
        $languages = Language::get();
       // $langs = Language::where('id','!=', getLang(session('MasterLang')))->get();
        if($setting == null){
            $langs = Language::where('id','!=', getLang(session('MasterLang')))->get();
        }else{
            $langs = Language::where('id','!=', $setting['lang_id'])->get();
        }
        //dd($langs);
        return view('master.settings.index', compact('setting','langs','languages'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $rules = [
            'title' => 'required|string',
          //  'logo' => 'sometimes|image|mimes:jpeg,jpg,png,bmp,gif,svg'
        ];
        $validator = validator()->make($request->all() , $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $setting = Setting::where('store_id',null)->first();
            //$lang = $request->lang_id ?? getLang(session('MasterLang')) ;
            $lang = ($request->lang_id != null) ? $request->lang_id: getLang(session('MasterLang')) ;
            if(!$setting) // create
            {
                $setting = Setting::create([
                    'email' => $request->email,
                    'phone1' => $request->phone1,
                    'phone2' => $request->phone2,
                    'facebook_url' => $request->facebook_url,
                    'instagram_url' => $request->instagram_url,
                    'twitter_url' => $request->twitter_url,
                    'work_time' => $request->work_time,
                    'address' => $request->address,
                    //'description' => $request->description,
                    //'lang_id'=> $lang,
                    'store_id'=> null,
                ]);
                SettingsData::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'setting_id' => $setting->id,
                    'lang_id' => $lang,
                    'source_id' => null,
                ]);
                if ($request->logo)
                {
                    $image = $request->file('logo');
                    $fileName = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('uploads/settings/site_settings/'.$setting->id);
                    $image->move($destinationPath, $fileName);
                    $setting->logo = '/uploads/settings/site_settings/'. $setting->id .'/'. $fileName;
                    $setting->save();
                }
                return redirect('master/settings')->with('success' , _i('Added Successfully !'));

            }else{ // update

                $setting->update([
                    'email' => $request->email,
                    'phone1' => $request->phone1,
                    'phone2' => $request->phone2,
                    'facebook_url' => $request->facebook_url,
                    'instagram_url' => $request->instagram_url,
                    'twitter_url' => $request->twitter_url,
                    'work_time' => $request->work_time,
                    'address' => $request->address,
                    //'description' => $request->description,
                    //'lang_id'=> getLang(session('lang')),
                    //'store_id'=> null,
                ]);
                $setting_data = SettingsData::where('setting_id',$setting->id)->first();
                $setting_data->update([
                    'title' => $request->title,
                    'description' => $request->description,
                    'lang_id' => $lang,
                    //'setting_id' => $setting->id,
                ]);
                if ($request->logo)
                {
                    $image_path = $setting->logo;
                    if (File::exists(public_path($image_path))) {
                        File::delete(public_path($image_path));
                    }
                    $image = $request->file('logo');
                    $fileName = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('uploads/settings/site_settings/'.$setting->id);
                    $image->move($destinationPath, $fileName);
                    $setting->logo = '/uploads/settings/site_settings/'. $setting->id .'/'. $fileName;
                    $setting->save();
                }
                return redirect()->back()->with('success' , _i('Updated Successfully !'));
            }
        }
    }

    public function getLangvalue(Request $request){
        //dd($request->lang_id);
        $rowData = SettingsData::where('setting_id',$request->transRowId)
            //->where('lang_id',$request->lang_id)
            ->where('source_id',"!=" , null)
            ->first(['title','description']);
        if (!empty($rowData)){
            return \response()->json(['data' => $rowData]);
        }else{
            return \response()->json(['data' => false]);

        }
    }


    public function storelangTranslation(Request $request){
        //dd($request->all());
        $rowData = SettingsData::where('setting_id',$request->id)
            //->where('lang_id',$request->lang_id_data)
            ->where('source_id' ,"!=",null)
            ->first();

        if ($rowData!==null) {
            $rowData->update([
                'title' => $request->title,
                'description' => $request->description,
                'lang_id' => $request->lang_id_data
            ]);

        }else{
            $parentRow = SettingsData::where('setting_id',$request->id)->where('source_id' , null)->first();
           // dd($parentRow);
            SettingsData::create([
                'title' => $request->title,
                'description' => $request->description,
                'lang_id' => $request->lang_id_data,
                'setting_id' => $request->id,
                'source_id' => $parentRow->id,
            ]);
        }
        return \response()->json("SUCCESS");
    }
}
