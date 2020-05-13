<?php

namespace App\Http\Controllers\Admin;

use App\Language;
use App\Models\Bill;
use App\Models\Currency;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.bills.all');
    }

    public function get_datatable()
    {
        $query = Bill::select(['id','user_id','status', 'title', 'description','total','currency_id']);
//        dd($query);
        return DataTables::of($query)
            ->addColumn('action', function ($query) {
                return '<a href="../../admin/bills/' . $query->id . '/edit" class="btn btn-icon waves-effect waves-light btn btn-primary" title="'._i("Edit").'"><i class="fa fa-edit"></i> </a>' . "&nbsp;" .
                    '<a href="../../admin/bills/' . $query->id . '/delete" class="btn btn-icon waves-effect waves-light btn btn-danger" title="'._i("Delete").'"><i class="fa fa-remove"></i> </a>' . "&nbsp;" ;
            })
            ->editColumn('user_id', function($query ) {
                $user = User::findOrFail($query->user_id);
                return $user->email;
//
            })
            ->editColumn('status', function($query ) {
                if ($query->status == 1) {
                    return _i('Paid');
                } elseif($query->status == 2) {
                    return _i('pending');
                } else {
                    return _i('cancel');
                }
//
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('type','applicant')->get();
        $langs = Language::all();
        return view('admin.bills.add',compact('users','langs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => ['required','max:150','min:2'],
            'description' => ['required','max:150','min:2'],
            'user_id' => ['required'],
            'currency_id' => ['required'],
            'amount' => ['required'],
        ];

        $validator = Validator::make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator);

        $bill = Bill::create([
            'title' => $request->title,
            'user_id' => $request->user_id,
            'currency_id' => $request->currency_id,
            'total' => $request->amount,
            'description' => $request->description,
            'status' => 2,
        ]);

        $bill->save();
        return redirect('/admin/bills/all')->withFlashMessage(_i('Added Successfully !'));
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
        $bill = Bill::findOrFail($id);
        $users = User::where('type','applicant')->get();
        $currencies = Currency::where('source_id', null)->get();
        return view('admin.bills.edit',compact('bill','users','currencies'));
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
        $bill = Bill::findOrFail($id);
//        dd($bill,$request->all());
        $rules = [
            'title' => ['required','max:150','min:2'],
            'description' => ['required','max:150','min:2'],
            'user_id' => ['required'],
            'currency_id' => ['required'],
            'amount' => ['required'],
        ];

        $validator = Validator::make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator);

        $bill->title = $request->title;
        $bill->title = $request->title;
        $bill->user_id = $request->user_id;
        $bill->currency_id = $request->currency_id;
        $bill->total = $request->amount;
        $bill->description = $request->description;
        $bill->update();
        return redirect('/admin/bills/all')->withFlashMessage(_i('edited Successfully !'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bill = Bill::findOrFail($id);
        $bill->delete();
        return redirect('/admin/bills/all')->with('flash_message' ,_i('Deleted Successfully !'));
    }
}
