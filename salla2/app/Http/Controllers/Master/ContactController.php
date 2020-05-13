<?php


namespace App\Http\Controllers\Master;


use App\DataTables\ContactDataTable;
use App\Help\Utility;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\countries;

class ContactController extends Controller
{

    public function index(ContactDataTable $contact)
    {
        //dd(auth()->user()->guard == Utility::Store);
        return $contact->render('master.contact.all');
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        $country = countries::leftJoin('countries_data','countries_data.country_id','countries.id')
            ->select('countries.id as id','countries_data.title as title','countries_data.lang_id')
            ->where('countries_data.source_id' , null)
            ->where('countries.id' , $contact->country_id)
            //->where('countries_data.lang_id' , getLang(session('MasterLang')))
            ->first();
        return view('master.contact.show' ,compact('contact' , 'country'));
    }

    public function delete($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect('/master/contact/all')->with('success', _i('Deleted Successfully !'));
    }
}
