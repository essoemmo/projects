<?php
/**
 * Created by PhpStorm.
 * User: misr computer
 * Date: 28/05/2019
 * Time: 02:10 �
 */

namespace App\Http\Controllers\Admin;


use App\Models\Contact;
use App\Http\Controllers\Controller;

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
        $contact = Contact::select(['id', 'name', 'email', 'title', 'message', 'created_at']);

        return DataTables::of($contact)
            ->addColumn('action', function ($contact) {
                return '<a href="' . $contact->id . '/show" class="btn btn-icon waves-effect waves-light btn btn-primary" title="'._i("Show").'"><i class="fa fa-eye"></i> </a>' . "&nbsp;" .
                    '<a href="' . $contact->id . '/delete" class="btn btn-icon waves-effect waves-light btn btn-danger" title="'._i("Delete").'"><i class="fa fa-trash"></i> </a>' . "&nbsp;";
            })
            ->make(true);
    }


    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contact.show' ,compact('contact'));
    }

    public function delete($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect('/admin/contact/all')->withFlashMessage(_i('Deleted Successfully !'));
    }
}