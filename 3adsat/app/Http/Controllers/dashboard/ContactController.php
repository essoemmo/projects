<?php
/**
 * Created by PhpStorm.
 * User: misr computer
 * Date: 28/05/2019
 * Time: 02:10 �
 */

namespace App\Http\Controllers\dashboard;


use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\CountryDescription;
use App\Models\Front\Contact;
use Yajra\DataTables\DataTables;

class ContactController extends Controller
{


    public function all()
    {
        return view('admin.contact.all');
    }

    // make datatable for contacts
    public function  getDatatableContact()
    {
        $contact = Contact::select(['id', 'name', 'email', 'phone', 'country_id', 'message', 'created_at']);

        return DataTables::of($contact)
            ->editColumn('country_id' , function($contact){
                $country  = Country::where('id' , $contact->country_id)->first();
                $country_description = CountryDescription::where('country_id' , $country['id'])->first();
                return $country_description['name'];
            })
            ->addColumn('action', function ($contact) {
                return '<a href="' . $contact->id . '/show" class="  btn btn-primary" title="'._i("Show").'"><i class="ti-eye"></i> </a>' . "&nbsp;" .
                    '<a href="' . $contact->id . '/delete" class=" waves-effect waves-light btn btn-danger" title="'._i("Delete").'"><i class="ti-trash"></i> </a>' . "&nbsp;";
            })
            ->make(true);
    }


    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        $country  = Country::where('id' , $contact->country_id)->first();
        $country_description = CountryDescription::where('country_id' , $country['id'])->first()['name'];
        return view('admin.contact.show' ,compact('contact','country_description'));
    }

    public function delete($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect('/admin/panel/contact/all')->with('success',_i('Deleted Successfully !'));
    }
}