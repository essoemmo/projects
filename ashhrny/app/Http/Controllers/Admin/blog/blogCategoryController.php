<?php

namespace App\Http\Controllers\Admin\blog;

use App\DataTables\blogCategoryDataTable;
use App\Models\BlogCategory;
use App\Models\BlogCategoryTranslation;
use App\Models\SiteLanguage;
use hanneskod\classtools\Transformer\ReaderTest;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class blogCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:BlogCategory-Add'])->only('index');
        $this->middleware(['permission:BlogCategory-Add'])->only('create');
        $this->middleware(['permission:BlogCategory-Edit'])->only('edit');
        $this->middleware(['permission:BlogCategory-Delete'])->only('delete');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(blogCategoryDataTable $blogCategoryDataTable)
    {
        return $blogCategoryDataTable->render('admin.blog_category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $langs = SiteLanguage::all();
        return view('admin.blog_category.create',compact('langs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $data = $this->validate($request,[
            '*_title' => 'sometimes',
        ]);

        $langs = SiteLanguage::all();

        if($request->main){
            $blog_category = BlogCategory::create(['main' => 1]);
        }else{
            $blog_category = BlogCategory::create();
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/blog_category/'.$blog_category->id), $filename);

            $blog_category->image = '/uploads/blog_category/'. $blog_category->id .'/'. $filename;
            $blog_category->save();
        }

        foreach ($langs as $lang){
            $blog_categoryTranslation = new BlogCategoryTranslation();
            $blog_categoryTranslation->title = $request->get($lang->locale.'_title');
            $blog_categoryTranslation->locale = $lang->locale;
            $blog_category->translations()->save($blog_categoryTranslation);
        }

        return redirect(aUrl('blog_categories'))->with('success',_i('success save'));
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
        $blog_category = BlogCategory::findOrFail($id);
        $langs = SiteLanguage::all();
        return view('admin.blog_category.edit',compact('langs','blog_category'));
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
        $blog_category = BlogCategory::findOrFail($id);

        if($request->main){
            $blog_category->update([
                'main' => 1 ]);
        }else{
            $blog_category->update(['main' => 0 ]);
        }

        $data = $this->validate($request,[
            '*_title' => 'sometimes',
        ]);

        if ($request->hasFile('image')) {
            $image_path = $blog_category->image;  // Value is not URL but directory file path
            if(File::exists(public_path($image_path))) {
                File::delete(public_path($image_path));
            }
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/blog_category/'.$blog_category->id), $filename);

            $blog_category->image = '/uploads/blog_category/'. $blog_category->id .'/'. $filename;
            $blog_category->save();
        }

        $langs = SiteLanguage::all();
        foreach ($langs as $lang){
            $blog_categoryTranslation = BlogCategoryTranslation::where('locale',$lang->locale)->where('blog_category_id',$blog_category->id)->first();
            $blog_categoryTranslation->title = $request->get($lang->locale.'_title');
            $blog_categoryTranslation->locale = $lang->locale;
            $blog_category->translations()->save($blog_categoryTranslation);
        }

        return redirect(aUrl('blog_categories'))->with('success',_i('success update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog_category = BlogCategory::findOrFail($id);
        $blog_categoryTranslation = BlogCategoryTranslation::where('blog_category_id',$blog_category->id)->delete();
        $blog_category->delete();
        return redirect(aUrl('blog_categories'))->with('success',_i('success delete'));
    }

    public function check_main()
    {
        if(\request()->rowId){
            $blog_category = BlogCategory::where('main' , 1)->where('id' , "!=",\request()->rowId)->first();
        }else{
            $blog_category = BlogCategory::where('main' , 1)->first();
        }
        if($blog_category){
            return response()->json($blog_category);
        }else{
            return response()->json(0);
        }
    }
}
