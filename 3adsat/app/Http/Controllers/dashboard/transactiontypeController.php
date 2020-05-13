<?php

namespace App\Http\Controllers\dashboard;

use App\DataTables\TransactionTypeDataTable;
use App\Models\transaction_types;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class transactiontypeController extends Controller
{

    public $lang = "en_US";
    public $language_id;

    /**
     * Create a new controller instance.
     */
    public function __construct() {
        $this->middleware(function ($request, $next) {
            // fetch session and use it in entire class with constructor
            $this->language_id = checknotsessionlang();

            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TransactionTypeDataTable $transactionTypeDataTable)
    {
        return $transactionTypeDataTable->render('admin.transactionType.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.transactionType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'title' => 'required|unique:transaction_types',
            'code' => 'sometimes',
            'main' => 'required',
            'status' => 'required',
        ]);
        transaction_types::create($data);
        return redirect()->back()->with('flash_message','success add');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = transaction_types::findOrFail($id);
        return view('admin.transactionType.edit',compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transaction_types = transaction_types::findOrFail($id);
        $data = $this->validate($request,[
            'title' => 'required|'.Rule::unique('transaction_types')->ignore($transaction_types->id),
            'code' => 'sometimes',
            'main' => 'required',
            'status' => 'required',
        ]);
        $transaction_types->update($data);
        return redirect()->back()->with('flash_message',_i('success update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction_types = transaction_types::findOrFail($id);
        $transaction_types->delete();
        return redirect()->back()->with('flash_message',_i('success delete'));
    }
}
