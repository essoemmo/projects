<?php
/**
 * Created by PhpStorm.
 * User: misr computer
 * Date: 28/05/2019
 * Time: 02:10 �
 */

namespace App\Http\Controllers\Admin;


use App\Models\Contact;
use App\Models\countries;
use App\Http\Controllers\Controller;
use App\DataTables\ContactDataTable;

class ContactController extends Controller
{


    public function index(ContactDataTable $contact)
    {

        return $contact->render('admin.contact.all');
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        $country = countries::leftJoin('countries_data','countries_data.country_id','countries.id')
            ->select('countries.id as id','countries_data.title as title','countries_data.lang_id')
             ->where('countries_data.lang_id' , getLang(session('adminlang')))
            ->first();
       // $country = countries::where('id' , $contact->country_id)->first();
        return view('admin.contact.show' ,compact('contact' , 'country'));
    }

    public function delete($id)
    {
        $sessionStore = session()->get('StoreId');
        if($sessionStore == \App\Bll\Utility::$demoId){
            return redirect()->back()->with('flash_message' , _i('Deleted Successfully'));
        }

        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect('/adminpanel/contact/all')->with('success',_i('Deleted Successfully !'));
    }
}