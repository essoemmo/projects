<?php

namespace App\Http\Controllers\Admin\transaction;

use App\DataTables\transactionTypeDataTable;
use App\Http\Controllers\Controller;
use App\Models\product\transaction_types;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TransactionTypesController extends Controller
{
    public function index(transactionTypeDataTable $transactionType){
        return $transactionType->render('admin.transaction.transactionType.index');
    }
    public function create(){
        return view('admin.transaction.transactionType.create');
    }
    public function store(Request $request){
        $request->request->add(['store_id' => session('StoreId')]);
        $data = $this->validate($request,[
            'title' => 'required',
            'code' => 'sometimes',
            'main' => 'required',
            'status' => 'required',
            'store_id' => 'required',
        ]);
        $sessionStore = session()->get('StoreId');
        if($sessionStore == \App\Bll\Utility::$demoId){
            return redirect()->back()->with('flash_message' , _i('Added Successfully'));
        }
        $type = transaction_types::create($data);
        $type->lang_id = getLang(session('adminlang'));
        $type->save();
        return redirect()->back()->with('flash_message','success add');
    }
    public function edit(Request $request,$id){
        $transaction_types = transaction_types::findOrFail($id);
        $data = $this->validate($request,[
            'title' => 'required|'.Rule::unique('transaction_types')->ignore($transaction_types->id),
            'code' => 'sometimes',
            'main' => 'required',
            'status' => 'required',
        ]);
        $sessionStore = session()->get('StoreId');
        if($sessionStore == \App\Bll\Utility::$demoId){
            return redirect()->back()->with('flash_message' , _i('Updated Successfully'));
        }
        $transaction_types->update($data);
        return redirect()->back()->with('flash_message',_i('success update'));
    }
    public function destroy(Request $request){

        $sessionStore = session()->get('StoreId');
        if($sessionStore == \App\Bll\Utility::$demoId){
            return redirect()->back()->with('flash_message' , _i('Deleted Successfully'));
        }

        $id = $request->id;
        $transaction_types = transaction_types::findOrFail($id);
        $transaction_types->delete();
        return redirect()->back()->with('flash_message',_i('success delete'));
    }
}
