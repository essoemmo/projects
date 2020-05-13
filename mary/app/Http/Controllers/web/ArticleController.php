<?php

namespace App\Http\Controllers\web;

use App\Models\Article;
use App\Models\Story;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{

    public function index(){

        if (!session('language')){
            $article = DB::table('article_category')
                ->leftJoin('articles','article_category.article_id','=','articles.id')
                ->leftJoin('artcl_categories','article_category.category_id','=','artcl_categories.id')
                ->leftJoin('article_datas','articles.id','=','article_datas.article_id')

               ->where('source_id',null)
                ->where('articles.publishe','=',true)

                ->select(['article_datas.*','articles.img_url','articles.publishe','articles.category_id'])
                ->paginate(4);

        }else {
            $article = DB::table('article_category')
                ->leftJoin('articles', 'article_category.article_id', '=', 'articles.id')
                ->leftJoin('artcl_categories', 'article_category.category_id', '=', 'artcl_categories.id')
                ->leftJoin('article_datas', 'articles.id', '=', 'article_datas.article_id')


               ->where('article_datas.lang_id',session('language'))
                ->where('articles.publishe','=',true)

                ->select(['article_datas.*','articles.img_url','articles.publishe','articles.category_id'])
                ->paginate(4);
        }



            return view('web.article.index',compact('article'));
    }

}
