<?php

namespace App\Http\Controllers\Admin;

use App\Models\Settings\About;
use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class aboutController extends Controller
{


    // make datatable for users
    public function  getDatatableAbout()
    {
        $query = About::select(['id', 'title','descrption' ,'created_at']);

        return DataTables::of($query)
            ->addColumn('action', function ($p ) {
                return $this->generateHtmlEdit_Delete_About([$p->id,$p->title,$p->descrption],$p->id);
            })
            ->rawColumns([
                'action',
            ])
            ->make(true);
    }


    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'descrption' => 'required',
        ];

        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $about =  About::create([
            'title' => $request->title,
            'descrption' => $request->descrption,
        ]);
        $about->save();
        return redirect()->back()->with('flash_message' , _i('Added Successfully !'));
    }



    public function update(Request $request )
    {
//dd($request);
        $id = $request->input('id');
        $request->validate([
            'title' => 'required',
            'descrption' => 'required',
        ]);

        $about = About::findOrFail($id);
        $about->title = $request->title;
        $about->descrption = $request->descrption;
        $about->save();
        return redirect()->back()->with('flash_message', _i('Updated Successfully !'));
    }


    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $about = About::findOrFail($id);
        $about->delete();
        return redirect()->back()->with('flash_message' ,  _i('Deleted Successfully !'));
    }
}
