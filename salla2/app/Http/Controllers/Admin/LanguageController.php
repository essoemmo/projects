<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\languageDataTable;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Up;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(languageDataTable $language)
    {
        return $language->render('admin.languages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.languages.create');
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
            'title'=>'required',
            'code'=>'required',
            'flag'=>'sometimes',
        ]);
        if($request->hasFile('flag')){
            $data['flag'] = Up::upload([
                'request' => 'flag',
                'path'=>'languages',
                'upload_type' => 'single'
            ]);
        }
        Language::create($data);
        return redirect()->back()->with(session()->flash('flash_message',_i('Added successfully')));
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
        $lang = Language::findOrFail($id);
        return view('admin.languages.edit',compact('lang'));
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
        $lang = Language::findOrFail($id);
        $data = $this->validate($request,[
            'title'=>'required',
            'code'=>'required',
            'flag'=>'sometimes',
        ]);
        if($request->hasFile('flag')){
            $data['flag'] = Up::upload([
                'request' => 'flag',
                'path'=>'languages',
                'upload_type' => 'single',
                'delete_file'=> $lang->flag
            ]);
        }
        $lang->update($data);
        return redirect()->back()->with(session()->flash('flash-message',_i('Modified successfully')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lang = Language::findOrFail($id);
        $lang->delete();
        return redirect(url('adminpanel/languages'))->with(session()->flash('flash-message',_i('Deletion successful')));
    }
}
