<?php


namespace App\Http\Controllers\dashboard;


use App\Http\Controllers\Controller;
use App\Models\Front\Newsletter;
use App\Models\Front\Subscribers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
//use Maatwebsite\Excel\Excel;
//use Excel;
use Maatwebsite\Excel\Facades\Excel;

class NewsLettersController extends Controller
{

    // make datatable for news letters
    public function  getDatatableNewsLetters()
    {
        $newsLetters = Newsletter::select(['id', 'email', 'created_at', 'updated_at']);

        return DataTables::of($newsLetters)->make(true);
    }

    public function all()
    {
        return view('admin.news-letters.index');
    }


    public function addSubscriber(Request $request)
    {
        $rules = [
            'email' => ['required', 'string', 'email', 'max:100', 'unique:newsletters'],
        ];

        $validator = Validator::make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator);

        $subscriber = Newsletter::create([
            'email' => $request->email
        ]);

        $subscriber->save();

        return redirect('/admin/newsletters/all')->withFlashMessage(_i('Added Successfully !'));
    }

    public function editSubscriber($id, Request $request)
    {
        $subscriber = Newsletter::find($id);
        $rules = [
            'email' => ['required', 'max:100','min:3', Rule::unique('newsletters')->ignore($subscriber->id)]
        ];

        $validator = Validator::make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator);

        $subscriber->email = $request->email;
        $subscriber->save();
        return redirect('/admin/newsletters/all')->withFlashMessage(_i('Updated Successfully !'));

    }

    public function delete(Request $request)
    {
        $subscriber = Newsletter::find($request->id);
        $subscriber->delete();
        return redirect('/admin/newsletters/all')->with('success',_i('Deleted Successfully !'));
    }



    public function expotNewsLettersExcel()
    {
//        return (new Subscribers)->download('subscribers.xlsx');
//        return (new Subscribers)->store('subscribers.xlsx', 's3', null, 'private');
//        return (new Subscribers)->download('subscribers.xlsx');
//        return (new Subscribers)->store('subscribers', 's3');
//        return new Subscribers();
//        return Excel::download(new Subscribers(), 'subscribers.xlsx');

        return Excel::download(new Subscribers(), 'subscribers.xlsx');
//        Excel::store(new Subscribers(2018), 'subscribers.xlsx', 's3');


    }


}