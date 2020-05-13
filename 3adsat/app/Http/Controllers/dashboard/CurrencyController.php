<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Countries;
use App\Models\Country;
use App\Models\Currency;
use App\Models\CurrencyConvertor;
use App\Models\Language;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class CurrencyController extends Controller
{
    public function index() {
        $currencies = Currency::all();
        $languages = Language::all() ;
        $countries = Country::all();
        return view('admin.currency.index', compact('currencies' , 'languages','countries'));
    }

    public function store(Request $request) {
        $rules = [
            'title' => ['required','max:150','min:2', 'unique:currencies,title'],
            'code' => ['required','max:150','min:2'],
            'rate' => ['required'],
        ];

        $validator = Validator::make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator);

        $currency = Currency::create([
            'title' => $request->title,
            'lang_id' => $request->lang_id,
            'country_id' => $request->country_id,
            'code' => $request->code,
        ]);

        $country = Country::findOrFail($request->country_id);
        $rate = CurrencyConvertor::create([
            'rate' => $request->rate,
            'code' => $request->code,
            'country_code' => $country->iso_code,
            'last_update' => Carbon::now(),
        ]);
        $currency->save();
        $rate->save();
        return redirect('/admin/panel/currency')->withFlashMessage(_i('Added Successfully !'));
    }

    public function show(Request $request) {
        if($request->ajax()) {
            $currency = Currency::leftJoin('currency_convertor','currency_convertor.code','currencies.code')->where('currencies.id' ,$request->item_id)->first();
            $language = Language::where('id' , $currency->lang_id)->first();
            return response()->json($currency);
        }
    }

    public function update(Request $request,$id) {
        $currency = Currency::findOrFail($id);
        $rules = [
            'title' => ['required','max:150','min:2'],
            'code' => ['required','max:150','min:2'],
        ];

        $validator = Validator::make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator);

        $currency->title = $request->title;
        $currency->lang_id = $request->lang_id;
        $currency->country_id = $request->country_id;
        $currency->code = $request->code;
        $currency->save();

        $country = Country::findOrFail($request->country_id);

        $rate = CurrencyConvertor::where('country_code', $country->iso_code)->first();
        $rate->code = $request->code;
        $rate->rate = $request->rate;
        $rate->country_code = $country->iso_code;
        $rate->last_update = Carbon::now();

        $rate->save();

        return redirect('/admin/panel/currency')->withFlashMessage(_i('edited Successfully !'));
    }

    public function destroy($id)
    {
        $currency = Currency::findOrFail($id);
        $currency->delete();
        return redirect('/admin/panel/currency')->with('flash_message' ,_i('Deleted Successfully !'));
    }

    public function list(Request $request)
    {
        $currencies = Currency::where('lang_id' , $request->lang_id)->pluck("title","id");
        return $currencies;
    }
}
