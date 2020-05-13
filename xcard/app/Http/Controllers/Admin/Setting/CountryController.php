<?php


namespace App\Http\Controllers\Admin\Setting;

use App\DataTables\CountryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\CountryTranslations;
use App\Models\Platform;
use App\Models\PlatformTranslation;
use App\Models\SiteLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class CountryController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Country-Add'])->only('index');
        $this->middleware(['permission:Country-Add'])->only('store');
        $this->middleware(['permission:Country-Edit'])->only('update');
        $this->middleware(['permission:Country-Delete'])->only('delete');

    }

    public function index(CountryDataTable $countryDataTable) //platform_id
    {
        $langs = SiteLanguage::all();
        return $countryDataTable->render('admin.country.index' , compact('langs'));
    }

    public function store(Request $request)
    {
        $rules = [
            '*_title' => 'sometimes',
            'code'=> 'required|unique:countries'
        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $country = Country::create(['code' => $request->code]);
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $request->logo->move(public_path('uploads/country/'.$country->id), $filename);
            $country->logo = '/uploads/country/'. $country->id .'/'. $filename;
            $country->save();
        }
        $langs = SiteLanguage::all();
        foreach ($langs as $lang){
            $countryTranslation = CountryTranslations::create([
                'title' => $request->get($lang->locale.'_title'),
                'locale' => $lang->locale,
            ]);
            $country->translations()->save($countryTranslation);
        }
        return response()->json(true);
    }

    public function update(Request $request, $id)
    {
         //dd($request->file('logo'));
        if ($request->ajax()) {
            $country =  Country::findOrFail($id);
            $rules = [
                '*_title' => ['sometimes'],
                'code'=> [ Rule::unique('countries')->ignore($id)],
            ];
            $validator = validator()->make($request->all() , $rules);
            if($validator->fails())
                return redirect()->back()->withErrors($validator)->withInput();
            $country->update([
                'code' => $request->code,
            ]);

            if ($request->hasFile('logo')) {
                $image_path = $country->logo;  // Value is not URL but directory file path
                if (File::exists(public_path($image_path))) {
                    File::delete(public_path($image_path));
                }
                $image = $request->file('logo');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $request->logo->move(public_path('uploads/country/' . $country->id), $filename);
                $country->logo = '/uploads/country/' . $country->id . '/' . $filename;
                $country->save();
            }

            $langs = SiteLanguage::all();
            foreach ($langs as $lang){
                if ($country->translate($lang->locale)){
                    $countryTranslation = CountryTranslations::where('locale',$lang->locale)->where('country_id',$country->id)->first();
                }else{
                    $countryTranslation = new CountryTranslations();
                }
                $countryTranslation->title = $request->get($lang->locale.'_title');
                $countryTranslation->locale = $lang->locale;
                $country->translations()->save($countryTranslation);
            }
            return response()->json(true);
        }

    }

    public function destroy($id)
    {
        $country =  Country::findOrFail($id);
        $image_path = $country->logo;  // Value is not URL but directory file path
        if(File::exists(public_path($image_path))) {
            File::delete(public_path($image_path));
        }
        $countryTraslation = CountryTranslations::where('country_id', $country->id)->delete();
        $country->delete();
        return redirect(aurl('countries'))->with('success',_i('success delete'));
    }
}
