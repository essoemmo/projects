<?php

namespace App\Http\Controllers\Admin;

use App\Models\Countries;
use App\Models\Currency;
use App\Models\CurrencyConvertor;
use App\Models\Language;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class CurrencyController extends Controller {

    public function index() {
        $currencies = Currency::where("code", "!=", "usd")->get();
        $languages = Language::all();
        $countries = Countries::all();
        return view('admin.currency.all', compact('currencies', 'languages', 'countries'));
    }

    public function store(Request $request) {
        $rules = [
            'title' => ['required', 'max:150', 'min:2', 'unique:currencies,title'],
            'code' => ['required', 'max:150', 'min:2'],
            'rate' => ['required'],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator);

        $currency = Currency::create([
                    'title' => $request->title,
                    'lang_id' => $request->lang_id,
                    'country_id' => $request->country_id,
                    'code' => $request->code,
        ]);

        $this->saveRate($request);

        $currency->save();

        return redirect('/admin/currency')->withFlashMessage(_i('Added Successfully !'));
    }

    private function saveRate($request) {
        $country = Countries::findOrFail($request->country_id);
        $rate = CurrencyConvertor::whereCode($request->code)->first();
        if ($rate == null) {
            $rate = CurrencyConvertor::create([
                        'rate' => $request->rate,
                        'code' => $request->code,
                        'country_code' => $country->code,
                       
                        'last_update' => Carbon::now(),
            ]);
        } else {
            $rate->country_code =$country->code;
            $rate->rate =$request->rate;
        }
        $rate->save();
    }

    public function show(Request $request) {
        if ($request->ajax()) {
            $currency = Currency::leftJoin('currency_convertor', 'currency_convertor.code', 'currencies.code')->where('currencies.id', $request->item_id)->first();
            $language = Language::where('id', $currency->lang_id)->first();
//            $currency->lang_value = $language['title'];
//            $currency->lang_id = $language['title'];
            return response()->json($currency);
        }
    }

    public function update(Request $request, $id) {

        $currency = Currency::findOrFail($id);
        $rules = [
            'title' => ['required', 'max:150', 'min:2', Rule::unique('currencies')->ignore($currency->id)],
            'code' => ['required', 'max:150', 'min:2'],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator);

        $currency->title = $request->title;
        $currency->lang_id = $request->lang_id;
        $currency->country_id = $request->country_id;
        $currency->code = $request->code;
    //    dd($currency);
        $currency->save();
        $this->saveRate($request);
        return redirect('/admin/currency')->withFlashMessage(_i('edited Successfully !'));
    }

    public function destroy($id) {
        $currency = Currency::findOrFail($id);
        $currency->delete();
        return redirect('/admin/currency')->with('flash_message', _i('Deleted Successfully !'));
    }

    public function list(Request $request) {
        $currencies = Currency::where('lang_id', $request->lang_id)->pluck("title", "id");
        return $currencies;
    }

}
