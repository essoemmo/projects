<?php


namespace App\Http\Controllers\Admin\Article;


use App\DataTables\articleDataTable;
use App\Help\Utility;
use App\Http\Controllers\Controller;
use App\Models\Article\Artcl_category;
use App\Models\Article\Article;
use App\Models\Article\Article_category;
use App\Models\Article\Article_data;
use App\Models\Language;
use App\Models\product\stores;
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
        $translation = Translation::where('table_name','articles')->first();
        return view('admin.articles.article.all', compact('translation','langs'));
    }

    public function datatableArticles()
    {
        $query = Article::leftJoin('article_category', 'article_category.article_id', 'articles.id')->select(['articles.id', 'title', 'img_url', 'content', 'published', 'created','lang_id','source_id','category_id']);
        return DataTables::of($query)
            ->editColumn('category_id', function($query) {
                $category = Artcl_category::select(['title'])->where('id', '=', $query->category_id)->first();
                if($category == null) {
                    return _i('No Data');
                }
                return $category->title;
            })
            ->editColumn('published', function($query) {
                return $query->published == 1 ? _i('Published') : _i('Not Published');
            })
            ->editColumn('lang_id', function($query) {
                $language = Language::where('id' , $query->lang_id)->first();
                if($language == null) {
                    return _i('No Data');
                }
                return _i($language->title);
            })
//            ->addColumn('edit', function($query){
//                return '<a href="../article/'.$query->id.'/edit" class="btn btn-success"><i class="fa fa-edit"></i> '._i('Edit').' </a>';
//            })
            ->addColumn('img_url', function ($query) {
                $url = asset('uploads/articles/'.$query->id.'/'.$query->img_url);
                return '<img src='.$url.' border="0" class=" img-rounded" align="center" style="max-width:100px; max-height:100px;"/>';
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
            'img_url' => ['required','image','mimes:jpeg,jpg,png,bmp,gif,svg']
        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $article = Article::create([
            'title' => $request->title,
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
//            if (!is_dir($destinationPath)) {
//                mkdir($destinationPath, 0766, true);
//            }
//            $extension = $image->getClientOriginalExtension();
//            $fileName = 'Article.'.$extension;
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

        return redirect()->back()->with('flash_message',_i('Added Successfully !'));
    }

    public function edit($id)
    {
        $categories = Artcl_category::all();
        $article = Article::findOrFail($id);
        $category_id = Article_category::where('article_id', $article->id)->first();
        $languages = Language::all();
        if($category_id == null) {
            $cat_val = '';
        } else {
            $cat_val = Artcl_category::where('id' , $category_id->category_id)->first()->title;
        }
        return view('admin.articles.article.edit',compact('categories','article','languages','cat_val'));
    }
    public function update(Request $request ,$id)
    {
        $article = Article::findOrFail($id);
        $artcl_cat = Article_category::where('article_id', $article->id)->first();

        $rules = [
            'title' =>  ['required', 'max:150', Rule::unique('articles')->ignore($article->id)],
            'content' =>  ['required'],
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
        $article->lang_id = $request->lang_id;
        $article->content = $request->input('content');
        $article->created = $request->created;
        if ($request->has('published'))
        {
            $article->published = $request->published;
        }else{
            $article->published = 0;

        }
//        $article->img_url = $request->img_url;
        $article->save();

        // edit arrticle category data
        if($artcl_cat == null) {
            $artcl_cat = Article_category::create([
                'category_id' => $request->category_id,
                'article_id' => $article->id
            ]);
            $artcl_cat->save();
        }
        $artcl_cat->category_id = $request->category_id;
        $artcl_cat->save();

        return redirect()->back()->with('flash_message', 'Updated Successfully !');
    }

    public function delete($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect()->back()->with('flash_message' ,_i('Deleted Successfully !'));
    }


}
