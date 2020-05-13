<?php

namespace App\Http\Controllers\Admin\blog;

use App\DataTables\blogDataTable;
use App\Models\blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\BlogTranslation;
use App\Models\SiteLanguage;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Blog-Add'])->only('index');
        $this->middleware(['permission:Blog-Add'])->only('create');
        $this->middleware(['permission:Blog-Edit'])->only('edit');
        $this->middleware(['permission:Blog-Delete'])->only('delete');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(blogDataTable $blogDataTable)
    {
        return $blogDataTable->render('admin.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $langs = SiteLanguage::all();
        $categories = BlogCategory::leftJoin('blog_categories_translations','blog_categories_translations.blog_category_id','blog_categories.id')->select('blog_categories.id as id', 'blog_categories_translations.title as title')->where('locale',App::getLocale())->get();
        $tags = Tag::leftJoin('tag_translations','tag_translations.tag_id','tags.id')->select('tags.id as id', 'tag_translations.title as title')->where('locale',App::getLocale())->get();
        return view('admin.blog.create',compact('langs','categories','tags'));
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
            'publish' => 'required',
            'category_id' => 'required',
            '*_title' => 'sometimes',
            '*_content' => 'sometimes',
            'image' => 'sometimes|image'
        ]);

        $langs = SiteLanguage::all();
        $blog = blog::create([
            'publish' => $request->publish,
            'category_id' => $request->category_id,
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/blog/'.$blog->id), $filename);

            $blog->image = '/uploads/blog/'. $blog->id .'/'. $filename;
            $blog->save();
        }

        foreach ($langs as $lang){
            $blogTranslation = new BlogTranslation();
            $blogTranslation->title = $request->get($lang->locale.'_title');
            $blogTranslation->content = $request->get($lang->locale.'_content');
            $blogTranslation->meta_title = $request->get($lang->locale.'_meta_title');
            $blogTranslation->meta_description = $request->get($lang->locale.'_meta_description');
            $blogTranslation->meta_keywords = $request->get($lang->locale.'_meta_keywords');
            $blogTranslation->locale = $lang->locale;
            $blog->translations()->save($blogTranslation);
        }

        if($request->tag_id != null){
            for($ii = 0; $ii < count($request->tag_id) ; $ii++) {
                $tag_id = $request->tag_id[$ii];
                $blog_id = $blog->id;
                BlogTag::create([
                    'tag_id' => $tag_id,
                    'blog_id' => $blog_id,
                ]);
            }
        }

        //return redirect(aurl('blog'))->with('flash_message',_i('success save'));
        return redirect()->back()->with('success',_i('success save'));

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
        $blog = blog::findOrFail($id);
        $langs = SiteLanguage::all();
        $categories = BlogCategory::leftJoin('blog_categories_translations','blog_categories_translations.blog_category_id','blog_categories.id')->select('blog_categories.id as id', 'blog_categories_translations.title as title')->where('locale',App::getLocale())->get();
        $tags = Tag::leftJoin('tag_translations','tag_translations.tag_id','tags.id')->select('tags.id as id', 'tag_translations.title as title')->where('locale',App::getLocale())->get();
        $blog_tags = BlogTag::where('blog_id', $id)->get();
        return view('admin.blog.edit',compact('langs','categories','tags','blog','blog_tags'));
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
       // dd($request->all());
        $blog = blog::findOrFail($id);
        $data = $this->validate($request,[
            'publish' => 'required',
            'category_id' => 'required',
            '*_title' => 'sometimes',
            '*_content' => 'sometimes',
            'image' => 'sometimes|image',
        ]);

        $langs = SiteLanguage::all();
        $blog->update([
            'publish' => $request->publish,
            'category_id' => $request->category_id,
        ]);

        if ($request->hasFile('image')) {
            $image_path = $blog->image;  // Value is not URL but directory file path
            if(File::exists(public_path($image_path))) {
                File::delete(public_path($image_path));
            }
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/blog/'.$blog->id), $filename);

            $blog->image = '/uploads/blog/'. $blog->id .'/'. $filename;
            $blog->save();
        }

        foreach ($langs as $lang){
            $blogTranslation = BlogTranslation::where('locale',$lang->locale)->where('blog_id',$blog->id)->first();
            $blogTranslation->title = $request->get($lang->locale.'_title');
            $blogTranslation->content = $request->get($lang->locale.'_content');
            $blogTranslation->meta_title = $request->get($lang->locale.'_meta_title');
            $blogTranslation->meta_description = $request->get($lang->locale.'_meta_description');
            $blogTranslation->meta_keywords = $request->get($lang->locale.'_meta_keywords');
            $blogTranslation->locale = $lang->locale;
            $blog->translations()->save($blogTranslation);
        }

        if($request->tag_id != null){
            BlogTag::where('blog_id', $blog->id)->delete();
            for($ii = 0; $ii < count($request->tag_id) ; $ii++) {
                $tag_id = $request->tag_id[$ii];
                $blog_id = $blog->id;
                BlogTag::create([
                    'tag_id' => $tag_id,
                    'blog_id' => $blog_id,
                ]);
            }
        }else{
            BlogTag::where('blog_id', $blog->id)->delete();
        }

       // return redirect(aurl('blog'))->with('flash_message',_i('success update'));
        return redirect()->back()->with('success',_i('success update'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = blog::findOrFail($id);
        $blogTranslation = BlogTranslation::where('blog_id',$blog->id)->delete();
        $blog_tags = BlogTag::where('blog_id',$blog->id)->delete();
        $image_path = $blog->image;  // Value is not URL but directory file path
        if(File::exists(public_path($image_path))) {
            File::delete(public_path($image_path));
        }
        $blog->delete();
        return redirect(aurl('blog'))->with('success',_i('success delete'));
    }
}
