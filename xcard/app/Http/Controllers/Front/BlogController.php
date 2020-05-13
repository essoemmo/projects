<?php


namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use App\Models\blog;
use App\Models\BlogCategory;

class BlogController extends  Controller
{

    // return all blog categories
    public function blogCats()
    {
        //$blogCats = BlogCategory::orderBy('id', 'desc')->paginate(6);
        $blogCats = BlogCategory::where('main' ,"!=", 1)->orderBy('id', 'desc')->get();
        return view('front/blogs/blog_categories' , compact('blogCats'));
    }

    public function blogCat($id)
    {
        $cat = BlogCategory::findOrFail($id);
        $blogs = blog::where('category_id' , $cat->id)->orderBy('id', 'desc')->get();
        return view('front/blogs/category' , compact('cat' ,'blogs'));
    }

    public function blog($id)
    {
        $blog = blog::where('id' , $id)->first();
        $blogCat = BlogCategory::where('id' , $blog['category_id'])->first();
        return view('front/blogs/blog' , compact('blog' , 'blogCat'));
    }
}