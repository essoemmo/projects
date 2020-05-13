<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\contactdatatables;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:remove-contact'])->only('destroy');
    }

    public function index(contactdatatables $contact)
    {
        return $contact->render('admin.setting.contact.index' , ['title' => _i('contact')]);
    }

    public function destroy($id){
        Contact::findOrFail($id)->delete();
        session()->flash('success',_i('remove Done'));
        return back();
    }
}
