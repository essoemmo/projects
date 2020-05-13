<?php


namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\countries;
use App\Models\Settings\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Language;


class ContactController extends  Controller
{

    public function contactForm()
    {

        $salla_settings = Setting::leftJoin('settings_data','settings_data.setting_id','settings.id')
            ->select('settings.*','settings_data.setting_id','settings_data.title','settings_data.description'
                ,'settings_data.lang_id', 'settings_data.source_id')
        ->where('settings_data.lang_id', getLang(session('lang')))
        ->where('settings.store_id',null)->first();

        $countries = countries::leftJoin('countries_data','countries_data.country_id','countries.id')
            ->select('countries.id as id','countries_data.title','countries_data.lang_id')
            ->where('countries_data.lang_id' , getLang(session('lang')))->get();

        return view('front.contact' , compact('salla_settings','countries'));
    }


    public function storeContact(Request $request)
    {
        //dd($request->all());
        $rules= [
            'name' => ['required', 'string', 'max:150', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:100'],
            'country_id' => [ 'sometimes','string', 'max:100'],
            //'phone' => [ 'sometimes', 'max:15'],
            'message' => ['required', 'string', 'min:3'],
            // 'g-recaptcha-response' => 'required|captcha',
        ];
        $validator = validator()->make($request->all() ,$rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country_id' => $request->country_id,
            'message' => $request->message,
            'store_id' => null,
        ]);
        $contact->save();

                return response()->json('success');
    }

}
