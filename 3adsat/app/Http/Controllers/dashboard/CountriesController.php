<?php

namespace App\Http\Controllers\dashboard;

use App\DataTables\CountryDataTable;
use App\Http\Controllers\Controller;
use Auth, DB, Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Sebastienheyd\Boilerplate\Models\Role;
use Yajra\DataTables\DataTables;
use App\Models\Country;
use App\Models\CountryDescription;
use App\Models\CountryLanguage;
use App\Models\Language;
use App\Models\PaymentMethod;
use App\Models\PaymentMethodDescription;

class CountriesController extends Controller
{
    public $lang = "en_US";
    public $language_id;
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            // fetch session and use it in entire class with constructor
            $this->language_id = checknotsessionlang();

            return $next($request);
        });
    }


    public function index(CountryDataTable $countryDataTable)
    {
        return $countryDataTable->render('admin.countries.index');
    }


    public function create()
    {
        $languages = Language::getEnabledLanguages();
        return view('admin.countries.create', ['languages' => $languages]);
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $rules = [
            'name.*' => 'required|string|min:2',
            'iso_code' => 'string|min:2',
            'image' => 'required|image|mimes:jpeg,jpg,png,bmp,gif,svg|max:2048'
        ];
        $messages = [
            'name.*.required' => _i('Name is required'),
            'name.*.min' => _i('The Name must be at least :min characters.'),
        ];

        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
                $row = new Country();
                $row->iso_code = $input['iso_code'];
                $row->default_country = $input['default_country'];
                $row->status = $input['status'];


                //upload the image

                $image = $request->file('image');
                $fileName = "";
                if ($image && $file = $image->isValid()) {
                    $destinationPath = public_path('images/countries');
                    if (!is_dir($destinationPath)) {
                        mkdir($destinationPath, 0766, true);
                    }
                    $imageName = $image->getClientOriginalName();
                    $extension = $image->getClientOriginalExtension();
                    $fileName = md5($imageName. time()).'.'.$extension;
                    $image->move($destinationPath, $fileName);
                    $row->image = $fileName;
                }


                $row->save();
                $rowId = $row->id;
                if (!empty($rowId)) {

                    //get the last inserted id
                    $rowData = Country::latest()->first();
                    //insert translations
                    foreach($input['name'] as $key => $value)
                    {
                        $rowTranslation = new CountryDescription();
                        $rowTranslation->country_id = $rowId;
                        $rowTranslation->language_id = $key;
                        $rowTranslation->name = $value;

                        $rowTranslation->save();
                    }

                    //insert assigned languages
                    $language_ids = $input['language_ids'];
                    foreach ($language_ids as $langId) {
                        $countryLanguage = new CountryLanguage();
                        $countryLanguage->country_id = $rowId;
                        $countryLanguage->language_id = $langId;
                        $countryLanguage->save();
                    }
                }

                return redirect()->route('countries.edit', $rowId);
        }
    }

    /**
     * Show the form for editing the specified country.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::findOrFail($id);
        $languages = Language::getEnabledLanguages();
        $countryLanguages = CountryLanguage::where('country_id', '=', $id)->get();
        $rowTranslation = CountryDescription::getAllById($id);
        $languageIds = $rowTranslation->pluck('language_id')->toArray();

        return view('admin.countries.edit', compact('country','languages','countryLanguages','rowTranslation','languageIds'));
    }


    public function update(Request $request, $id)
    {
        $rowData = Country::findOrFail($id);

        $input = $request->all();
        $rules = [
            'name.*' => 'required|string|min:2',
            'iso_code' => 'string|min:2',
            'image' => 'image|mimes:jpeg,jpg,png,bmp,gif,svg|max:2048'
        ];
        $messages = [
            'name.*.required' => _i('Name is required'),
            'name.*.min' => _i('The Name must be at least :min characters.'),
        ];

        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            session()->flash('success',_i('There is a required field, please check again.'));
            return back();

        } else {
                $rowData->iso_code = $input['iso_code'];
                $rowData->default_country = $input['default_country'];
                $rowData->status = $input['status'];

                     //Image
                $image = $request->file('image');
                $fileName = $rowData->image;
                if ($image && $file = $image->isValid()) {
                    $destinationPath = public_path('images/countries');
                    if (!is_dir($destinationPath)) {
                        mkdir($destinationPath, 0766, true);
                    }
                    $imageName = $image->getClientOriginalName();
                    $extension = $image->getClientOriginalExtension();
                    $fileName = md5($imageName. time()).'.'.$extension;
                    $image->move($destinationPath, $fileName);
                    //old
                    if(!empty($rowData->image)){
                        //delete old image
                        $file = public_path('images/countries/').$rowData->image;
                        @unlink($file);
                    }
                    //new
                    $rowData->image = $fileName;
                }

                $rowData->save();
                //Translations
                foreach($input['name'] as $key => $value)
                {
                    $transId = $input['id'][$key];
                    if(!empty($transId)) { //if this is an existing translation, update it
                        $rowTranslation = CountryDescription::find($transId);
                    } else {
                        //insert new translation
                        $rowTranslation = new CountryDescription();
                    }

                    $rowTranslation->country_id = $id;
                    $rowTranslation->language_id = $key;
                    $rowTranslation->name = $value;
                    $rowTranslation->save();
                }
                //country assigned languages
                $language_ids = $input['language_ids'];
                foreach ($language_ids as $langId) {
                    //save newly added languages and remove old rows
                    $languageExists = CountryLanguage::where('country_id', $id)->get();
                    $languagesArr = $languageExists->pluck('language_id')->toArray();
                    if (!in_array($langId, $languagesArr)) {
                        $countryLanguage = new CountryLanguage();
                        $countryLanguage->country_id = $id;
                        $countryLanguage->language_id = $langId;

                        $countryLanguage->save();
                    }
                    //check for old country languages and delete what was deleted from the form
                    $diff = array_diff($languagesArr, $language_ids);

                    if (!empty($diff)) {
                        foreach ($diff as $item) {
                            CountryLanguage::where('country_id', $id)->where('language_id', $item)->delete();
                        }
                    }

                    //  $languagesArr = CountryLanguage::where('country_id', $id)->where('language_id', $langId)->get()->pluck('language_id')->toArray();
                    // if (!in_array($langId, $languagesArr)) {
                    //     $countryLanguage = new CountryLanguage();
                    //     $countryLanguage->country_id = $id;
                    //     $countryLanguage->language_id = $langId;

                    //     $countryLanguage->save();
                    // }

                    // $diff = array_diff($languagesArr, $language_ids);
                    // if (!empty($diff)) {
                    //     foreach ($diff as $item) {
                    //         # code...
                    //     }
                    // }
                }

                session()->flash('success',_i('The country has been correctly modified.'));
                return redirect()->route('countries.edit', $rowData);
        }
    }

    /**
     * Remove the specified country from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the country by the ID
        $rowData = Country::find($id);
        // Find all the assigned products
        $assignedItemsNum = DB::table('product_price')->
        leftJoin('products','products.id','=','product_price.country_id')->
            where('product_price.country_id',$id)->
        select(['product_price.*'])->
        count();


        if (!empty($assignedItemsNum)) {
            session()->flash('success',_i(' Warning: This country cannot be deleted as it is currently assigned to '.$assignedItemsNum.' products!'));
            return back();
        } else {
            $rowData->delete();
            //delete all associated rows in other tables
            CountryDescription::where('country_id',$id)->delete();
            session()->flash('success',_i('success'.$assignedItemsNum));
            return back();


        }
    }

    public function list(Request $request)
    {
        $countries = Country::leftJoin('country_descriptions','country_descriptions.country_id','countries.id')->where('country_descriptions.language_id' , $request->lang_id)->pluck("name","countries.id");
        return $countries;
    }
}
