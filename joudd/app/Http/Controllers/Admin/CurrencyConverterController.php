<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class CurrencyConverterController extends Controller
{
    public function index() {
        $currencies = \App\Models\CurrencyConvertor::all();
       
        return view('admin.currency.convert', compact('currencies'));
    }

    public function store(Request $request) {
        $rules = [
            'title' => ['required','max:150','min:2', 'unique:currencies,title'],
        ];

        $validator = Validator::make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator);

        $currency = Currency::create([
            'title' => $request->title,
            'lang_id' => $request->lang_id,
            'country_id' => $request->country_id,
        ]);
        $currency->save();
        return redirect('/admin/currency')->withFlashMessage(_i('Added Successfully !'));
    }

    public function show(Request $request) {
        if($request->ajax()) {
            $currency = Currency::findOrfail($request->item_id);
            $language = Language::where('id' , $currency->lang_id)->first();
//            $currency->lang_value = $language['title'];
//            $currency->lang_id = $language['title'];
            return response()->json($currency);
        }
    }

    public function update(Request $request,$id) {
        $currency = Currency::findOrFail($id);
        $rules = [
            'title' => ['required','max:150','min:2', Rule::unique('currencies')->ignore($currency->id)],
        ];

        $validator = Validator::make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator);

        $currency->title = $request->title;
        $currency->lang_id = $request->lang_id;
        $currency->country_id = $request->country_id;
        $currency->save();
        return redirect('/admin/currency')->withFlashMessage(_i('edited Successfully !'));
    }

    public function destroy($id)
    {
        $currency = Currency::findOrFail($id);
        $currency->delete();
        return redirect('/admin/currency')->with('flash_message' ,_i('Deleted Successfully !'));
    }

    public function list(Request $request)
    {
        $currencies = Currency::where('lang_id' , $request->lang_id)->pluck("title","id");
        return $currencies;
    }
}
