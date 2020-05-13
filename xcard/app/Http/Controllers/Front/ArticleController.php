<?php


namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use App\Models\blog;
use App\Models\BlogCategory;

class ArticleController extends Controller
{

    // return all blog categories
    public function blogCats()
    {
        //$blogCats = BlogCategory::orderBy('id', 'desc')->paginate(6);
        $blogCats = BlogCategory::where('main' ,"!=", 1)->orderBy('id', 'desc')->paginate(12);
        return view('front/article/article_categories' , compact('blogCats'));
    }

    public function blogCat($id)
    {
        $cat = BlogCategory::findOrFail($id);
        $blogs = blog::where('category_id' , $cat->id)->orderBy('id', 'desc')->paginate(12);
        return view('front/article/category' , compact('cat' ,'blogs'));
    }

    public function blog($id)
    {
        $blog = blog::where('id' , $id)->first();
        $blogCat = BlogCategory::where('id' , $blog['category_id'])->first();
        return view('front/article/article' , compact('blog' , 'blogCat'));
    }
}