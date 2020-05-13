<?php


namespace App\Http\Controllers\web\store;

use App\Bll\Utility;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\countries;
use App\Models\Settings\Setting;
use Illuminate\Http\Request;

class ContactController extends Controller
{


    public function showContactForm()
    {

        //dd(\App\Bll\Utility::getStoreId());
        $setting = Setting::leftJoin('settings_data','settings_data.setting_id','settings.id')
            ->select('settings.*','settings_data.setting_id','settings_data.title','settings_data.description'
                ,'settings_data.lang_id', 'settings_data.source_id')
            ->where('settings_data.lang_id', getLang(session('lang')))
            ->where('settings.store_id',\App\Bll\Utility::getStoreId())->first();

        $countries = countries::leftJoin('countries_data','countries_data.country_id','countries.id')
            ->select('countries.id as id','countries_data.title','countries_data.lang_id')
            ->where('countries_data.lang_id' , getLang(session('lang')))->get();

        return view('store.contact' , compact('countries','setting'));
    }

    public function storeContact(Request $request)
    {
        $rules= [
            'name' => ['required', 'string', 'max:150', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:100'],
            //'country_id' => [ 'required','string', 'max:100'],
            //'phone' => [ 'string', 'max:15'],
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
            'store_id' => Utility::getStoreId(),
        ]);
        $contact->save();
        return  redirect()->back()->with('success' , _i('Your message has been sent successfully'));
    }

}