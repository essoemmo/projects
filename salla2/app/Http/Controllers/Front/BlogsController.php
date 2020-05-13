<?php


namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use App\Models\Article\Article;
use App\Models\Article\ArticleCategory;

class BlogsController extends Controller
{


    public function all_blog_cats()
    {
        $blog_cats = ArticleCategory::leftJoin('article_category_data' ,'article_category_data.category_id','article_category.id')
            ->select('article_category.*','article_category_data.category_id','article_category_data.lang_id','article_category_data.source_id',
                'article_category_data.title')->where('article_category_data.lang_id' , getLang(session('lang')))
            ->where('article_category.published' , 1)
            ->where('article_category.store_id' , null)
            ->orderBy('article_category.id', 'desc')->paginate(6);
        //dd($blog_cats);
        return view('front.blogs.blog_category.all_cats' , compact('blog_cats'));
    }

    public function single_blog_cat($locale = null ,$id)
    {
        $blogs = Article::leftJoin('articles_data' ,'articles_data.article_id','articles.id')
            ->select('articles.*','articles_data.article_id','articles_data.lang_id','articles_data.source_id',
                'articles_data.title','articles_data.content')
            ->where('articles.category_id' , $id)
            ->where('articles_data.lang_id' , getLang(session('lang')))
            ->where('articles.published' , 1)
            ->orderBy('articles.id', 'desc')->paginate(6);

        $blog_cat = ArticleCategory::leftJoin('article_category_data' ,'article_category_data.category_id','article_category.id')
            ->select('article_category_data.lang_id', 'article_category_data.title')
            ->where('article_category_data.lang_id' , getLang(session('lang')))
            ->where('article_category.id' , $id)
            ->first();
        return view('front.blogs.blog_category.single_cat' , compact('blogs','blog_cat'));
    }

    public function single_blog($locale = null ,$id)
    {
        $blog = Article::leftJoin('articles_data' ,'articles_data.article_id','articles.id')
            ->select('articles.*','articles_data.article_id','articles_data.lang_id','articles_data.source_id',
                'articles_data.title','articles_data.content','articles.category_id')
            ->where('articles.id' , $id)
            ->where('articles_data.lang_id' , getLang(session('lang')))
            ->where('articles.published' , 1)
            ->first();

        $blog_cat = ArticleCategory::leftJoin('article_category_data' ,'article_category_data.category_id','article_category.id')
            ->select('article_category_data.lang_id', 'article_category_data.title' ,'article_category.id')
            ->where('article_category.id' , $blog->category_id)
            ->where('article_category_data.lang_id' , getLang(session('lang')))
            ->first();

        $similar_articles = Article::leftJoin('articles_data' ,'articles_data.article_id','articles.id')
            ->select('articles.*','articles_data.article_id','articles_data.lang_id','articles_data.source_id',
                'articles_data.title','articles.category_id')
            ->where('articles.category_id' , $blog->category_id)
            ->where('articles.id' , "!=",$id)
            ->where('articles_data.lang_id' , getLang(session('lang')))
            ->where('articles.published' , 1)
            ->take(4)->get();

        return view('front.blogs.single_blog' , compact('blog','blog_cat' ,'similar_articles'));
    }


}