<?php


namespace App\Http\Controllers\Admin\Setting;


use App\DataTables\CurrencyDataTable;
use App\Http\Controllers\Controller;
use App\Models\Country;

use App\Models\Currency;
use App\Models\CurrencyTranslation;
use App\Models\Front\CurrencyConvertor;
use App\Models\SiteLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;
use PHPUnit\Framework\Constraint\Count;

class CurrencyController extends Controller
{


    public function __construct()
    {
        $this->middleware(['permission:Currency-Add'])->only('index');
        $this->middleware(['permission:Currency-Add'])->only('store');
        $this->middleware(['permission:Currency-Edit'])->only('update');
        $this->middleware(['permission:Currency-Delete'])->only('delete');

    }
    public function index(CurrencyDataTable $currencyDataTable)
    {
        return $currencyDataTable->render('admin.currency.index');
    }

    public function create()
    {
        $langs = SiteLanguage::all();
        $countries = Country::query()
        ->select('countries_translations.title as title' ,'countries.id as id' ,'countries.logo' ,'countries.code')
            ->leftJoin('countries_translations','countries_translations.country_id','=','countries.id')
            ->where('locale',App::getLocale())->get();
       // dd($countries);

        return view('admin.currency.create',compact('langs','countries'));
    }

    public function store(Request $request)
    {
        $rules = [
            '*_title' => 'sometimes',
        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $langs = SiteLanguage::all();
        $country = Country::findOrFail($request['country_id']);

        $currency = Currency::create([
            'country_id' => $request['country_id'],
        ]);
        $currency->save();
        $currency_converter = CurrencyConvertor::create([
            'code' => $country['code'],
            'rate' => $request['rate'],
        ]);

        foreach ($langs as $lang){
            $currencyTranslation = new CurrencyTranslation();
            $currencyTranslation->title = $request->get($lang->locale.'_title');
            $currencyTranslation->code = $request->get($lang->locale.'_code');
            $currencyTranslation->locale = $lang->locale;
            $currencyTranslation->currency_id = $currency['id'];
            $currency->translations()->save($currencyTranslation);
        }
        return redirect(aurl('currency'))->with('success',_i('success save'));
    }


    public function edit($id)
    {
        $currency = Currency::findOrFail($id);
        $langs = SiteLanguage::all();
        $countries = Country::query()
            ->select('countries_translations.title as title' ,'countries.id as id' ,'countries.logo' ,'countries.code')
            ->leftJoin('countries_translations','countries_translations.country_id','=','countries.id')
            ->where('locale',App::getLocale())->get();
        $currency_country = Country::where('id' , $currency['country_id'])->first();
        $currency_convertor = CurrencyConvertor::where('code' , $currency_country['code'])->first();
        return view('admin.currency.edit',compact('langs','currency','countries','currency_convertor'));
    }

    public function update(Request $request, $id)
    {
        $currency = Currency::findOrFail($id);
        $country = Country::where('id' , $currency['country_id'])->first();
        $currency_convertor = CurrencyConvertor::where('code' , $country['code'])->first();
        $rules = [
            '*_title' => 'sometimes',
        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $langs = SiteLanguage::all();

        $currency->update([
            'country_id' => $request['country_id'],
        ]);

        $new_country = Country::where('id' , $currency['country_id'])->first();

        $currency_convertor->code = $new_country['code'];
        $currency_convertor->rate = $request['rate'];
        $currency_convertor->save();

        foreach ($langs as $lang){
            if ($currency->translate($lang->locale)){
                $currencyTranslation = CurrencyTranslation::where('locale',$lang->locale)->where('currency_id',$currency->id)->first();
            }else{
                $currencyTranslation = new CurrencyTranslation();
            }
            $currencyTranslation->title = $request->get($lang->locale.'_title');
            $currencyTranslation->code = $request->get($lang->locale.'_code');
            $currencyTranslation->locale = $lang->locale;
            $currency->translations()->save($currencyTranslation);
        }
        return redirect()->back()->with('success',_i('success update'));
    }

    public function destroy($id)
    {
        $currency = Currency::findOrFail($id);
        $currencyTraslation = CurrencyTranslation::where('currency_id', $currency->id)->delete();
        $currency->delete();
        return redirect(aurl('currency'))->with('success',_i('success delete'));
    }


}
