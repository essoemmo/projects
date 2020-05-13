<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\DataTables\converstionsDataTable;

class converstionsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:show-converstions'])->only('show');
        $this->middleware(['permission:delete-converstions'])->only('destroy');


    }
    public function index(converstionsDataTable $converstionsDataTable){
//        dd($converstionsDataTable);
        return $converstionsDataTable->render('admin.massage.index' , ['title' => _i('converstions')]);

    }

    public function show($id){
        $title = 'massege';
       return view('admin.massage.show',compact('id','title'));
    }


    public function destroy($id){
   $mess = Message::findOrFail($id);
        $mess->delete();

       session()->flash('success',_i('deleted successfly'));
       return back();

    }


}
