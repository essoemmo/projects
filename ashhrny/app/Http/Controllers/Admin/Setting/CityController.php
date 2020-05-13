<?php


namespace App\Http\Controllers\Admin\Setting;


use App\DataTables\CityDataTable;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\CityTranslation;
use App\Models\Country;
use App\Models\SiteLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CityController extends  Controller
{

    public function __construct()
    {
        $this->middleware(['permission:City-Add'])->only('index');
        $this->middleware(['permission:City-Add'])->only('store');
        $this->middleware(['permission:City-Edit'])->only('update');
        $this->middleware(['permission:City-Delete'])->only('delete');

    }

    public function index(CityDataTable $cityDataTable){

        $countries = Country::query()->select('countries_translations.title as title' ,'countries.id as id' )
            ->leftJoin('countries_translations','countries_translations.country_id','=','countries.id')
            ->where('locale',App::getLocale())->get();
        $langs = SiteLanguage::all();
        return $cityDataTable->render('admin.city.index' , compact('langs','countries'));
    }


    public function store(Request $request)
    {
        $rules = [
            '*_title' => 'sometimes',
        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $city = City::create(['country_id' => $request->country_id]);

        $langs = SiteLanguage::all();
        foreach ($langs as $lang){
            $cityTranslation = CityTranslation::create([
                'title' => $request->get($lang->locale.'_title'),
                'locale' => $lang->locale,
            ]);
            $city->translations()->save($cityTranslation);
        }
        return response()->json(true);
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            $city = City::findOrFail($id);
            $rules = [
                '*_title' => ['sometimes'],
            ];
            $validator = validator()->make($request->all() , $rules);
            if($validator->fails())
                return redirect()->back()->withErrors($validator)->withInput();
            $city->update([
                'country_id' => $request->country_id,
            ]);

            $langs = SiteLanguage::all();
            foreach ($langs as $lang){
                if ($city->translate($lang->locale)){
                    $cityTranslation = CityTranslation::where('locale',$lang->locale)->where('city_id',$city->id)->first();
                }else{
                    $cityTranslation = new CityTranslation();
                }
                $cityTranslation->title = $request->get($lang->locale.'_title');
                $cityTranslation->locale = $lang->locale;
                $city->translations()->save($cityTranslation);
            }
            return response()->json(true);
        }

    }

    public function destroy($id)
    {
        $city =  City::findOrFail($id);
        $cityTraslation = CityTranslation::where('city_id', $city->id)->delete();
        $city->delete();
        return redirect(aurl('cities'))->with('success',_i('success delete'));
    }


}