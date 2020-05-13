<?php

namespace App\Http\Controllers\Admin\blog;

use App\DataTables\tagDataTable;
use App\Models\SiteLanguage;
use App\Models\Tag;
use App\Models\tags;
use App\Models\TagTranslation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class TagController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Tag-Add'])->only('index');
        $this->middleware(['permission:Tag-Add'])->only('create');
        $this->middleware(['permission:Tag-Edit'])->only('edit');
        $this->middleware(['permission:Tag-Delete'])->only('delete');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(tagDataTable $tagDataTable)
    {
        return $tagDataTable->render('admin.tag.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $langs = SiteLanguage::all();
        return view('admin.tag.create',compact('langs'));
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
            '*_title' => 'sometimes',
        ]);

        $langs = SiteLanguage::all();

        $tag = Tag::create();

        foreach ($langs as $lang){
            $tagTranslation = new TagTranslation();
            $tagTranslation->title = $request->get($lang->locale.'_title');
            $tagTranslation->meta_title = $request->get($lang->locale.'_meta_title');
            $tagTranslation->meta_description = $request->get($lang->locale.'_meta_description');
            $tagTranslation->meta_keywords = $request->get($lang->locale.'_meta_keywords');
            $tagTranslation->locale = $lang->locale;
            $tag->translations()->save($tagTranslation);
        }

        return redirect(aurl('tags'))->with('success',_i('success save'));

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
        $tag = Tag::findOrFail($id);
        $langs = SiteLanguage::all();
        return view('admin.tag.edit',compact('langs','tag'));
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
        $tag = Tag::findOrFail($id);
        $data = $this->validate($request,[
            '*_title' => 'sometimes',
        ]);

        $langs = SiteLanguage::all();

        foreach ($langs as $lang){
            $tagTranslation = TagTranslation::where('locale',$lang->locale)->where('tag_id',$tag->id)->first();
            $tagTranslation->title = $request->get($lang->locale.'_title');
            $tagTranslation->meta_title = $request->get($lang->locale.'_meta_title');
            $tagTranslation->meta_description = $request->get($lang->locale.'_meta_description');
            $tagTranslation->meta_keywords = $request->get($lang->locale.'_meta_keywords');
            $tagTranslation->locale = $lang->locale;
            $tag->translations()->save($tagTranslation);
        }

        return redirect(aurl('tags'))->with('success',_i('success update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tagTranslation = TagTranslation::where('tag_id',$tag->id)->delete();
        $tag->delete();
        return redirect(aurl('tags'))->with('success',_i('success delete'));
    }
}
