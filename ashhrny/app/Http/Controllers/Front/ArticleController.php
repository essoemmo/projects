<?php


namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use App\Models\blog;
use App\Models\BlogCategory;
use App\Models\Country;
use App\Models\Social_link;
use Illuminate\Support\Facades\App;

class ArticleController extends Controller
{

    // return all blog categories
    public function blogCats()
    {
        $social_links = Social_link::LeftJoin('social_links_translations','social_links_translations.social_id','=','social_links.id')
            ->select('social_links_translations.title as title' ,'social_links.id as id' ,'social_links.icon')
            ->where('locale',App::getLocale())->get();

        $countries = Country::leftJoin('countries_translations','countries_translations.country_id','=','countries.id')
            ->select('countries_translations.title as title' ,'countries.id as id')
            ->where('locale',App::getLocale())->get();

        $blogCats = BlogCategory::where('main' ,"!=", 1)->orderBy('id', 'desc')->paginate(12);
        return view('front/article/article_categories' , compact('blogCats','social_links','countries'));
    }

    public function blogCat($id)
    {
        $social_links = Social_link::LeftJoin('social_links_translations','social_links_translations.social_id','=','social_links.id')
            ->select('social_links_translations.title as title' ,'social_links.id as id' ,'social_links.icon')
            ->where('locale',App::getLocale())->get();

        $countries = Country::leftJoin('countries_translations','countries_translations.country_id','=','countries.id')
            ->select('countries_translations.title as title' ,'countries.id as id')
            ->where('locale',App::getLocale())->get();

        $cat = BlogCategory::findOrFail($id);
        $blogs = blog::where('category_id' , $cat->id)->orderBy('id', 'desc')->paginate(12);
        return view('front/article/category' , compact('cat' ,'blogs','social_links','countries'));
    }

    public function blog($id)
    {
        $social_links = Social_link::LeftJoin('social_links_translations','social_links_translations.social_id','=','social_links.id')
            ->select('social_links_translations.title as title' ,'social_links.id as id' ,'social_links.icon')
            ->where('locale',App::getLocale())->get();

        $countries = Country::leftJoin('countries_translations','countries_translations.country_id','=','countries.id')
            ->select('countries_translations.title as title' ,'countries.id as id')
            ->where('locale',App::getLocale())->get();

        $blog = blog::where('id' , $id)->first();
        $blogCat = BlogCategory::where('id' , $blog['category_id'])->first();
        return view('front/article/article' , compact('blog' , 'blogCat','social_links','countries'));
    }
}