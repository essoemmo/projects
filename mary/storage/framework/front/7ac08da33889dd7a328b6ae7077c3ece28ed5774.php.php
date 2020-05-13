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
//            $article= Article::where('lang_id',session('language'))->get();

        if (!session('language')){
            $article = DB::table('article_datas')->where('source_id',null)->latest()->paginate(4);

        }else{
            $article = DB::table('article_datas')->where('lang_id',session('language'))->latest()->paginate(4);
        }
            return view('web.article.index',compact('article'));
    }

}
