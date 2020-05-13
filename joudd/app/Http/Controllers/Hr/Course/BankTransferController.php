<?php
/**
 * Created by PhpStorm.
 * User: misr computer
 * Date: 14/07/2019
 * Time: 10:50 �
 */

namespace App\Http\Controllers\Hr\Course;


use App\Hr\Course\Bank_transfer;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;


use Session;
class BankTransferController extends  Controller
{

    public function index()
    {
        $languages = Language::all();
        return view('admin.hr.course.bank_transfer' , compact('languages'));

    }

    public function getDatatableBankTransfer()
    {
        $banks = Bank_transfer::select(['id','title','description','created_at' ,'lang_id']);

        return DataTables::of($banks )
            ->editColumn('lang_id', function($query) {
                $language = Language::where('id' , $query->lang_id)->first();
                return $language->title ;
            })
            ->addColumn('action', function ($b ) {
                return $this->generateHtmlEdit_Delete([$b->id,$b->title,$b->description,$b->lang_id],$b->id);
            })
            ->make(true);
    }

    public function add(Request $request)
    {
        $rules = [
            'title' => ['required', 'max:50','min:3', 'unique:bank_transfers'],
        ];

        $validator = validator()->make($request->all() , $rules);

        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $bank = Bank_transfer::create([
            'title' => $request->title,
            'lang_id' => $request->lang_id,
            'description' => $request->description,
        ]);

        $bank->save();

        return redirect()->back()->withFlashMessage(_i('Added Successfully !'));
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $bank= Bank_transfer::findOrFail($id);

        $rules = [
            'title' => ['required', 'max:50','min:3', Rule::unique('bank_transfers')->ignore($bank->id)],
        ];

        $validator = validator()->make($request->all() , $rules);

        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $bank->title = $request->input('title');
        $bank->lang_id = $request->input('lang_id');
        $bank->description = $request->input('description');
        $bank->save();
        return redirect()->back()->withFlashMessage(_i('Updated Successfully !'));
//        return redirect('/adminpanel/course/bank_transfer/all')->with('status', 'Profile updated!');

    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $bank = Bank_transfer::findOrFail($id);
        $bank->delete();
        return redirect()->back()->withFlashMessage(_i('Deleted Successully !'));
    }

}
