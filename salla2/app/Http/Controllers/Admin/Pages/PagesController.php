<?php

namespace App\Http\Controllers\Admin\Pages;

use App\DataTables\PagesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Pages\Page;
use App\Models\Pages\PageData;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PagesController extends Controller
{
    public function index(PagesDataTable $pages)
    {
        return $pages->render('admin.pages.index');
    }

    public function create()
    {
        $langs = Language::get();
        return view('admin.pages.create', compact('langs'));
    }

    public function store(Request $request)
    {

        $sessionStore = \App\Bll\Utility::getStoreId();
        if($sessionStore== \App\Bll\Utility::$demoId){
            return redirect()->back()->with('flash_message' , _i('Added Successfully'));
        }

        $request['published'] = $request['published'] ?? 0;
        $request['lang_id'] = $request['lang_id'] ?? Language::first()->id;
        $page = Page::create([
         'store_id' => $sessionStore,
         'published' =>  $request['published'],
        ]);


        $page_data = PageData::create([
            'page_id' => $page->id,
            'lang_id' => $request['lang_id'],
            'source_id' => null,
            'title' => $request['title'],
            'content' => $request['content'],
        ]);

        $page->save();

        return redirect()->back()->with('success' ,_i('Saved Successfully !'));
    }

    public function edit($id)
    {
        $langs = Language::get();
        $page = Page::findOrFail($id);
        $page_data = PageData::where('page_id' , $page->id)->where('source_id' , null)->first();
        return view('admin.pages.edit', compact('langs','page','page_data'));
    }

    public function update($id , Request $request)
    {
        //dd($request->all());

        $sessionStore = \App\Bll\Utility::getStoreId();
        if($sessionStore== \App\Bll\Utility::$demoId){
            return redirect()->back()->with('flash_message' , _i('Added Successfully'));
        }

        $request['published'] = $request['published'] ?? 0;
        $request['lang_id'] = $request['lang_id'] ?? Language::first()->id;

        $page = Page::findOrFail($id);
        $page_data = PageData::where('page_id' , $page->id)->where('source_id' , null)->first();

        $page->update([
            'store_id' => $sessionStore,
            'published' =>  $request['published'],
        ]);

        $page_data->update([
            'page_id' => $page->id,
            'lang_id' => $request['lang_id'],
            'source_id' => null,
            'title' => $request['title'],
            'content' => $request['content'],
        ]);

        $page->save();

        return redirect()->back()->with('success' ,_i('Updated Successfully !'));
    }

    public function pagergetLangvalue(Request $request)
    {
       
        $rowData = PageData::where('page_id',$request->transRow)
        ->where('source_id',"=" , null)
        ->first(['title','content']);
        if (!empty($rowData)){
            return \response()->json(['data' => $rowData]);
        }else{
            return \response()->json(['data' => false]);
        }
    }


    public function pagestorelangTranslation(Request $request)
    {

        $rowData = PageData::where('page_id',$request->id)
            ->where('source_id',"!=" , null)
            ->first();
        if ($rowData != null) {

            $rowData->update([
                'title' => $request->title,
                'content' => $request->input('content'),
                'lang_id' => $request->lang_id_data,
            ]);

        }else{
            $parentRow = PageData::where('page_id',$request->id)->where('source_id',null)->first();
            PageData::create([
                'title' => $request->title,
                'content' => $request->input('content'),
                'lang_id' => $request->lang_id_data,
                'page_id' => $request->id,
                'source_id' => $parentRow->id,
            ]);
        }
        return \response()->json("SUCCESS");
    }


    public function delete($id)
    {
        
        $sessionStore = session()->get('StoreId');

        if ($sessionStore == \App\Bll\Utility::$demoId)
            return redirect()->back()->with('success', _i('Deleted Successfully !'));

        $page_data = PageData::where('page_id',$id)->delete();
        $page = Page::destroy($id);
        return redirect()->back()->with('success' ,_i('Deleted Successfully !'));
    }
    
}
