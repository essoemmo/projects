<?php

namespace App\Http\Controllers\Admin\Setting;

use App\DataTables\SiteLanguagesDataTable;
use App\Models\SiteLanguage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class SiteLanguageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:SiteLanguage-Add'])->only('index');
        $this->middleware(['permission:SiteLanguage-Add'])->only('store');
        $this->middleware(['permission:SiteLanguage-Edit'])->only('update');
        $this->middleware(['permission:SiteLanguage-Delete'])->only('delete');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SiteLanguagesDataTable $siteLanguagesDataTable)
    {
        return $siteLanguagesDataTable->render('admin.site_languages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()){
            $lang = SiteLanguage::create([
                'title'=>$request->title,
                'locale'=>$request->locale_title,
            ]);
            if ($request->hasFile('flag')) {
                $flag = $request->file('flag');
                $filename = time() . '.' . $flag->getClientOriginalExtension();
                $request->flag->move(public_path('uploads/site_languages/'.$lang->id), $filename);

                $lang->flag = '/uploads/site_languages/'. $lang->id .'/'. $filename;
                $lang->save();
            }
            return response()->json(true);
        }
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
        //
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
//        dd($request->all());
        if ($request->ajax()) {
//            dd($request->title);
            $lang = SiteLanguage::findOrFail($id);
            $lang->update([
                'title' => $request->title,
                'locale_title' => $request->locale_title,
            ]);
            if ($request->hasFile('flag')) {
                $image_path = $lang->flag;  // Value is not URL but directory file path
                if (File::exists(public_path($image_path))) {
                    File::delete(public_path($image_path));
                }
                $flag = $request->file('flag');
                $filename = time() . '.' . $flag->getClientOriginalExtension();
                $request->flag->move(public_path('uploads/site_languages/' . $lang->id), $filename);

                $lang->flag = '/uploads/site_languages/' . $lang->id . '/' . $filename;
                $lang->save();
            }

            return response()->json(true);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lang = SiteLanguage::findOrFail($id);
        $lang->delete();
        return back()->with('success','success delete');
    }
}
