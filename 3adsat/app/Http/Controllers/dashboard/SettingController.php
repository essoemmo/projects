<?php

namespace App\Http\Controllers\dashboard;

//use App\Models\City;
use App\DataTables\HomeDataTable;
//use App\DataTables\homepageDataTable;
use App\Models\Category;
use App\Models\Country;
use App\Models\homepage;
use App\Models\Language;
use App\Models\Setting;
use App\Models\SettingCountryPhone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Intervention\Image\Facades\Image;
use PHPUnit\Framework\Constraint\Count;
use Yajra\DataTables\DataTables;

class SettingController extends Controller
{

//    public function __construct()
//    {
//        $this->middleware(['permission:show-setting'])->only('index');
//        $this->middleware(['permission:update-setting'])->only('update');
//    }


    public function lang($lang) {
        //dd($lang);
        session()->has('adminLang') ? session()->forget('adminLang'):'';
        $lang == 'ar' ? session()->put('adminLang','ar') : session()->put('adminLang','en');
        return Redirect::to(URL::previous());
    }

    public function index(){

        if(settings() != null) {
            $setting = Setting::findOrFail(settings()->id);
        } else {
            $setting = Setting::create([
                'title' => 'Change  name',
                'mantance' => 1,
            ]);
        }

        $countries = Country::leftJoin('country_descriptions','country_descriptions.country_id','countries.id')
            ->where('countries.status',0)
            ->where('country_descriptions.language_id', getLang(session('lang')))
            ->get();
//        dd($setting);
            if (!$setting){
                Setting::create([
                   'title' => 'Change  name',
                   'mantance' => 1,
                ]);
            }
        return view('admin.setting.index' , compact('countries'), ['title' => _i('Setting')]);
    }

    public function update(Request $request){
//        dd('samer');

        $request->validate([
           'title' => 'required',
           'email' => 'required',
           'sales_email' => 'required',
           'contact_email' => 'required',
           'facebook_url' => 'required',
           'instagram_url' => 'required',
           'twitter_url' => 'required',
           'youtube_url' => 'required',
//           'phone1' => 'required',
           //'address' => 'required',
           //'description' => 'required',
           'logo' => 'nullable',
        ]);


        $setting = Setting::findOrFail(settings()->id);
        if ($setting){
            $update = Setting::findOrFail($request->setting_id);
            $update->title = $request->title;
            $update->lang_id = $request->language;
            $update->email = $request->email;
            $update->sales_email = $request->sales_email;
            $update->contact_email = $request->contact_email;
            $update->facebook_url = $request->facebook_url;
            $update->instagram_url = $request->instagram_url;
            $update->twitter_url = $request->twitter_url;
            $update->youtube_url = $request->youtube_url;
            $update->phone1 = $request->phone1;
            $update->address = $request->address;
            $update->description = $request->description;
            $update->mantance = $request->mantance;

            $countries = Country::leftJoin('country_descriptions','country_descriptions.country_id','countries.id')
                ->where('countries.status',0)
                ->where('country_descriptions.language_id', getLang(session('lang')))
                ->get();

            foreach ($countries as $country) {
//                dd($request->get($country->iso_code.'_phone'));
                $exists = SettingCountryPhone::where('country_id', $country->country_id)->exists();
                if($exists == true) {
                    $countryPhone = SettingCountryPhone::where('setting_id',$setting->id)->where('country_id', $country->country_id)->first();
                    $countryPhone->setting_id = $setting->id;
                    $countryPhone->country_id = $country->country_id;
                    $countryPhone->phone = $request->input('phone_' . $country->iso_code);
                    $countryPhone->update();
                } else {
                    $countryPhone = new SettingCountryPhone();
                    $countryPhone->setting_id = $setting->id;
                    $countryPhone->country_id = $country->country_id;
                    $countryPhone->phone = $request->input('phone_' . $country->iso_code);
                    $countryPhone->save();
                }
            }

            if ($request->logo){

                if ($setting->loge != 'default.png'){
                    Storage::disk('public_uploads')->delete('/setting/'.$setting->loge);
                }


                Image::make($request->logo)->save(public_path('/uploads/setting/'.$request->logo->hashName()));
                $update->loge = $request->logo->hashName();
            }
            $update->save();
//            if ($update->save()){
//              $source =  Setting::findOrFail($request->setting_id);
//                $source->source_id = $update->id;
//                $source->save();
//            }
            session()->flash('success',_i('updated Succfully'));
            return redirect()->route('settings-index');
        }else{

            session()->flash('success',_i('updated wrong'));
            return redirect()->back();

        }

    }

    public function homepage(HomeDataTable $homeDataTable)
    {

        $categoriess = \App\Models\Category::where('deleted_at','=',null)->get();

        foreach($categoriess as $cat){
            $categories = \Illuminate\Support\Facades\DB::table('category_descriptions')
                ->where('category_id',$cat->id)
                ->where('language_id',getLang(adminlang()))
                ->pluck('id','name');
            return $homeDataTable->render('admin.setting.homepage.index',compact('categories'));
        }

    }

    public function homepagestore(Request $request){
//        dd($request->all());
//        $request->request->add(['store_id'=>session('StoreId')]);
        $data = $this->validate($request,[
            'category_id' => 'required',
            'sort' => 'required',
            'template' => 'required',
//            'store_id' => 'required',
        ]);
        homepage::create($data);
        return back()->with('success',_i('success save'));
    }
    public function homepageupdate(Request $request,$id){
//        dd($id);
        $homepage  = homepage::findOrFail($id);
        $data = $this->validate($request,[
            'category_id' => 'required',
            'sort' => 'required',
            'template' => 'required',
        ]);
        $homepage->update($data);
        return back()->with('success',_i('success update'));
    }
    public function homepagedelete(Request $request,$id){
        $homepage  = homepage::findOrFail($id);
        $homepage->delete();

        return back()->with('success',_i('success delete'));
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
