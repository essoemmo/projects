<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryDataTable;
use App\Models\Category;
use App\Models\CategoryTranslations;
use App\Models\SiteLanguage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:ProductCategory-Add'])->only('index');
        $this->middleware(['permission:ProductCategory-Add'])->only('store');
        $this->middleware(['permission:ProductCategory-Edit'])->only('update');
        $this->middleware(['permission:ProductCategory-Delete'])->only('delete');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryDataTable $categoryDataTable)
    {
        return $categoryDataTable->render('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $langs = SiteLanguage::all();
        $categories = Category::leftJoin('categories_translations','categories_translations.category_id','categories.id')->select('categories.id as id', 'categories_translations.title as title')->where('locale',App::getLocale())->get();
        return view('admin.category.create',compact('langs','categories'));
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
            'parent_id' => 'sometimes',
            '*_title' => 'sometimes',
            '*_description' => 'sometimes',
        ]);
        $langs = SiteLanguage::all();
        if($request->main_menu == null) {
            $request->main_menu = 0;
        }
        $category = Category::create([
            'parent_id' => $request->parent_id,
            'main_menu' => $request->main_menu,
        ]);
        foreach ($langs as $lang){
            $categoryTranslation = new CategoryTranslations();
            $categoryTranslation->title = $request->get($lang->locale.'_title');
            $categoryTranslation->description = $request->get($lang->locale.'_description');
            $categoryTranslation->category_id = $category->id;
            $categoryTranslation->locale = $lang->locale;
            $category->translations()->save($categoryTranslation);
        }
        return redirect(aUrl('categories'))->with('success',_i('success save'));
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
        $category = Category::findOrFail($id);
        $langs = SiteLanguage::all();
        $categories = Category::leftJoin('categories_translations','categories_translations.category_id','categories.id')->select('categories.id as id', 'categories_translations.title as title')->where('locale',App::getLocale())->get();
        return view('admin.category.edit',compact('category','langs','categories'));
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
        $category = Category::findOrFail($id);
        $data = $this->validate($request,[
            'parent_id' => 'sometimes',
            '*_title' => 'sometimes',
            '*_description' => 'sometimes',
        ]);
        $langs = SiteLanguage::all();
        if($request->main_menu == null) {
            $request->main_menu = 0;
        }
        $category->update([
            'parent_id'=>$request->parent_id,
            'main_menu'=>$request->main_menu,
        ]);
        foreach ($langs as $lang){
            if ($category->translate($lang->locale)){
                $categoryTranslation = CategoryTranslations::where('locale',$lang->locale)->where('category_id',$category->id)->first();
            }else{
                $categoryTranslation = new CategoryTranslations();
            }
            $categoryTranslation->title = $request->get($lang->locale.'_title');
            $categoryTranslation->description = $request->get($lang->locale.'_description');
            $categoryTranslation->category_id = $category->id;
            $categoryTranslation->locale = $lang->locale;
            $category->translations()->save($categoryTranslation);
        }
        return redirect(aUrl('categories'))->with('success',_i('success update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $categoryTraslation = CategoryTranslations::where('category_id', $category->id)->delete();
        $category->delete();
        return redirect(aUrl('categories'))->with('success',_i('success delete'));
    }
}
