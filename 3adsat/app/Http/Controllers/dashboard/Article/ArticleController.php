<?php


namespace App\Http\Controllers\dashboard\Article;


use App\Http\Controllers\Controller;
use App\Models\Article\Artcl_category;
use App\Models\Article\Article;
use App\Models\Article\Article_category;
use App\Models\Article\Article_data;
use App\Models\Language;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Xinax\LaravelGettext\Facades\LaravelGettext;
use Yajra\DataTables\DataTables;

class ArticleController extends  Controller
{

    public  function index()
    {
        $langs = Language::all();
        $translation = Translation::where('table_name','article_data')->first();
        return view('admin.articles.article.all', compact('translation','langs'));
    }

    public function datatableArticles()
    {
        $query = Article::select(['id','category_id', 'title', 'img_url', 'content', 'published', 'created','lang_id','source_id'])
            ->where( 'source_id' , null);

        return DataTables::of($query)
            ->editColumn('category_id', function($query) {
                $category = Artcl_category::select(['title'])->where('id', '=', $query->category_id)->first();
                return $category['title'];
            })
            ->editColumn('published', function($query) {
                return $query->published == 1 ? _i('Published') : _i('Not Published');
            })
            ->editColumn('lang_id', function($query) {
                $language = Language::where('id' , $query->lang_id)->first();
                return _i($language['name']);
            })
//            ->addColumn('edit', function($query){
//                return '<a href="../article/'.$query->id.'/edit" class="btn btn-success"><i class="fa fa-edit"></i> '._i('Edit').' </a>';
//            })
            ->addColumn('img_url', function ($query) {
                if(is_file(public_path('uploads/articles/'.$query->id.'/'.$query->img_url))){
                    $url = asset('uploads/articles/'.$query->id.'/'.$query->img_url);
                }else{
                    $url = asset('uploads/articles/'.$query->source_id.'/'.$query->img_url);
                }
//                $url = asset('uploads/articles/'.$query->id.'/'.$query->img_url);
                return '<img src='.$url.' border="0" class=" img-rounded" align="center" width="100px" height="80px"/>';
            })
            ->addColumn('delete', 'admin.articles.article.btn.delete')
            ->rawColumns([
                'category_id',
                'img_url',
                'delete',
            ])
            ->make(true);
    }


    public function create()
    {
        $categories = Artcl_category::all();
        $languages = Language::all() ;
        return view('admin.articles.article.create',compact('categories' ,'languages'));
    }

    public function store(Request $request)
    { //dd($request->all());
        $rules = [
            'title' =>  ['required', 'max:150', 'unique:articles'],
            'content' =>  ['required'],
            'category_id' =>  ['required'],
            'img_url' => ['required','image','mimes:jpeg,jpg,png,bmp,gif,svg']
        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $article = Article::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'created' => $request->created,
            'content' => $request->input('content'),
            'lang_id' => $request->lang_id,
        ]);
        if($request->has('published')){
            $article->published = $request->published;
        }

        $image = $request->file('img_url');

        if ($image && $file = $image->isValid()) {
            $destinationPath = public_path('uploads/articles/'.$article->id);
            $fileName = $image->getClientOriginalName();
            $image->move($destinationPath, $fileName);
            $request->img_url = $fileName;
        }
        $article->img_url = $request->img_url;
        $article->save();

        $artcl_cat = Article_category::create([
            'category_id' => $request->category_id,
            'article_id' => $article->id
        ]);
        $artcl_cat->save();

        return redirect()->back()->with('success',_i('Added Successfully !'));
    }

    public function edit($id)
    {
        $categories = Artcl_category::all();
        $article = Article::findOrFail($id);
        $languages = Language::all() ;
        $cat_val = Artcl_category::where('id' , $article->category_id)->first()->title;
        $cat_id = Artcl_category::where('id' , $article->category_id)->first()->id;
        //dd($cat_val);
        return view('admin.articles.article.edit',compact('categories','article','languages','cat_val','cat_id'));
    }
    public function update(Request $request ,$id)
    {
        $article = Article::findOrFail($id);
//        $artcl_data = Article_data::where('title' ,'=', $article->title)->first();
        $artcl_cat = Article_category::where('category_id',$article->category_id)
            ->where('article_id', $article->id)->first();

        $rules = [
            'title' =>  ['required', 'max:150', Rule::unique('articles')->ignore($article->id)],
            'content' =>  ['required'],
            'category_id' =>  ['required'],
            'img_url' => ['sometimes','image','mimes:jpeg,jpg,png,bmp,gif,svg']
        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        if ($request->has('img_url'))
        {
            $image = $request->file('img_url');

            if ($image && $file = $image->isValid()) {
                $destinationPath = public_path('uploads/articles/'.$article->id);
                $fileName = $image->getClientOriginalName();
                $image->move($destinationPath, $fileName);
                $request->img_url = $fileName;

                if(!empty($article->img_url)){
                    //delete old image
                    $file = public_path('uploads/articles/'.$article->id.'/').$article->img_url;
                    @unlink($file);
                }
            }
            $article->img_url = $request->img_url;
        }

        $article->title = $request->title;
        $article->category_id = $request->category_id;
        $article->lang_id = $request->lang_id;
        $article->content = $request->input('content');
        $article->created = $request->created;
        if ($request->has('published'))
        {
            $article->published = $request->published;
        }else{
            $article->published = 0;

        }
        $article->save();

        // edit arrticle category data
        $artcl_cat->category_id = $article->category_id;
        $artcl_cat->save();

        return redirect()->back()->with('success', 'Updated Successfully !');
    }

    public function delete($id)
    {
        $article = Article::findOrFail($id);
//        $artcl_data = Article_data::where('title' ,$article->title)->first();
//        $artcl_data->delete();
        $article->delete();
        return redirect()->back()->with('success' ,_i('Deleted Successfully !'));
    }


}
