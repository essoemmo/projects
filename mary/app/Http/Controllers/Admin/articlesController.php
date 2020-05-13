<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ArticlesDataTable;
//use App\Models\Setting;
use App\Models\Artcl_category;
use App\Models\Article;
use App\Models\Article_data;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class articlesController extends Controller
{


    public function __construct()
    {
        $this->middleware(['permission:show-categoryArticle'])->only('index');
        $this->middleware(['permission:Article-Add'])->only('create');
        $this->middleware(['permission:Article-Edit'])->only('update');
        $this->middleware(['permission:Article-Delete'])->only('destroy');
    }

        public function index(ArticlesDataTable $article){
          return  $article->render('admin.articles.index' , ['title' => _i('Articles')]);
        }
        public function create(){

            return view('admin.articles.create',['title' => _i('Articles')]);
        }
        public function store(Request $request){



            $request->validate([
                'title' => 'required',
                'category' => 'required',
                'conteent' => 'required',
            ]);

            $addArticle = new Article();
            $addArticle->lang_id = $request->language;
            if ($request->image)
            {
                Image::make($request->image)->save(public_path('/uploads/articles/'.$request->image->hashName()));
                $addArticle->img_url = $request->image->hashName();
            }

                $addArticle->category_id = $request->category;
                if ($request->published){
                    $addArticle->publishe = 'true';
                }else{
                    $addArticle->publishe = 'false';
                }

                $addArticle->created = $request->created;
                $addArticle->save();

                if ($addArticle->save()){
                    $addArticledata = new Article_data();
                    $addArticledata->title = $request->title;
                    $addArticledata->content = $request->conteent;
                    $addArticledata->created = $request->created;

                    $addArticledata->article_id = $addArticle->id;
                    $addArticledata->lang_id = $request->language;
//                    $addArticledata->source_id = $addArticle->id;
                    $addArticledata->save();
                }

                if ($addArticledata->save()){

                    DB::table('article_category')->insert([
                       'category_id' => $request->category,
                       'article_id' => $addArticle->id,
                    ]);
                }

                session()->flash('success',_i('added Succfully'));
                return redirect()->route('articles.index');
        }

        public function update(Request $request){
            $request->validate([
                'title' => 'required',
                'category' => 'required',
                'conteent' => 'required',
            ]);

            $addArticle =Article::findOrFail($request->id);
            if ($request->image)
            {

                if ($addArticle->img_url != 'default.png'){
                    Storage::disk('public_uploads')->delete('/articles/'.$addArticle->img_url);
                }


                Image::make($request->image)->save(public_path('/uploads/articles/'.$request->image->hashName()));
                $addArticle->img_url = $request->image->hashName();
            }

            $addArticle->category_id = $request->category;
            if ($request->published){
                $addArticle->publishe = 'true';
            }else{
                $addArticle->publishe = 'false';
            }

//            $addArticle->created = $request->created;
            $addArticle->save();

            if ($addArticle->save()){
                $addArticledata =Article_data::where('article_id','=',$request->id)->first();
                $addArticledata->title = $request->title;
                $addArticledata->content = $request->conteent;
//                $addArticledata->created = $request->created;
                $addArticledata->lang_id = $request->language;
                $addArticledata->article_id = $addArticle->id;

//                $addArticledata->source_id = $addArticle->id;
                $addArticledata->save();
            }

            if ($addArticledata->save()){
                DB::table('article_category')
                    ->where('article_id','=', $addArticle->id)
                    ->where('category_id','=',$request->category)
                ->update([
                    'category_id' => $request->category,
                    'article_id' => $addArticle->id,
                ]);
            }

            session()->flash('success',_i('edited Succfully'));
            return redirect()->route('articles.index');
        }

    public function destroy(Request $request,$id){

        $addArticle =Article::findOrFail($id);

        if ($addArticle->img_url != 'default.png'){
            Storage::disk('public_uploads')->delete('/articles/'.$addArticle->img_url);
        }

        $addArticle->delete();
        session()->flash('success',_i('deleted Succfully'));
        return redirect()->route('articles.index');
    }

    public function getlangArticle(Request $request){
        $addArticle =DB::table('artcl_categories')
        ->where('lang_id',$request->id)
        ->get();

       return response()->json(['data'=>$addArticle]);
    }

}
