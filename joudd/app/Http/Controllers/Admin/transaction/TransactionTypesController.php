<?php

namespace App\Http\Controllers\Admin\transaction;

use App\DataTables\transactionTypeDataTable;
use App\Http\Controllers\Controller;
use App\Models\Admin\EducationLevel;
use App\Models\Countries;
use App\Models\Language;
use App\Models\transaction_types;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class TransactionTypesController extends Controller
{
    public function index(){
        $languages  = Language::all();
        return view('admin.transaction.transactionType.index' ,compact('languages'));
    }

    public function get_datatable()
    {
        $transaction_types = transaction_types::select(['id','title','code','created_at' ,'lang_id'])->orderByDesc('id');


        return DataTables::of($transaction_types )
            ->editColumn('lang_id' , function ($transaction_types) {
                $language = Language::where('id' ,$transaction_types->lang_id)->first();
                return $language["title"];
            })
            ->addColumn('action', function ($p ) {
                return $this->generateHtmlEdit_Delete([$p->id,$p->title,$p->lang_id,$p->code],$p->id);
            })
            ->make(true);
    }

    public function store(Request $request){
        //$request->request->add(['variable' => 'value']); //add value to request
        $request->request->add(['lang_id' => $request->lang_id]); //add request
        $data = $this->validate($request,[
            'title' => 'required|unique:transaction_types',
            'code' => 'sometimes',
            'lang_id' => 'sometimes',
        ]);
        transaction_types::create($data);
        return redirect()->back()->with('flash_message' , _i('Added Successfully !'));
    }
    public function update(Request $request){
        $id = $request->id;
        $transaction_types = transaction_types::findOrFail($id);

        $request->request->add(['lang_id' => $request->lang_id]); //add request
        $data = $this->validate($request,[
            'title' => 'required|'.Rule::unique('transaction_types')->ignore($transaction_types->id),
            'code' => 'sometimes',
            'lang_id' => 'sometimes',
        ]);

        $transaction_types->update($data);
        return redirect()->back()->with('flash_message' , _i('Updated Successfully !'));
    }
    public function destroy(Request $request){
        $id = $request->id;
        $transaction_types = transaction_types::findOrFail($id);
        $transaction_types->delete();
        return redirect()->back()->with('flash_message' , _i('Deleted Successfully !'));
    }
}
