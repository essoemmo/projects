<?php


namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Middleware\lang;
use App\Models\countries;
use App\Models\Country;
use App\Models\Front\Contact;
use App\Models\SettingCountryPhone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{


    public function showContactForm()
    {
        //dd(getLang(session('lang')));
        $countries = Country::join('country_descriptions' ,'country_descriptions.country_id' ,'countries.id')
            ->where('country_descriptions.language_id' , getLang(session('lang')))
            ->get();
       // dd($countries);
        if(request()->cookie('code') != null){
            $countries_cookie = \Illuminate\Support\Facades\DB::table('countries')
                ->where('iso_code',request()->cookie('code'))->first();
        }else{
            $countries_cookie = \Illuminate\Support\Facades\DB::table('countries')
                ->first();
        }

        $country = DB::table('countries')->where('iso_code', $countries_cookie->iso_code)->first();
        $phone = SettingCountryPhone::where('country_id', $country->id)->where('setting_id', settings()->id)->first();
        return view('web.contact' , compact('countries','phone'));
    }

    public function storeContact(Request $request)
    {
        $rules= [
            'name' => ['required', 'string', 'max:150', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:100'],
//            'country_id' => [ 'required','string', 'max:100'],
//            'phone' => [ 'string', 'max:15'],
            'message' => ['required', 'string', 'min:3'],
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
        ]);
        $contact->save();
        return  redirect()->back()->with('success' , _i('Your message has been sent successfully'));
    }

}
