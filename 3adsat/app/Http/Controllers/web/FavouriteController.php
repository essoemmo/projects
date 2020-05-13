<?php


namespace App\Http\Controllers\web;


use App\Http\Controllers\Controller;
use App\Models\Article\Artcl_category;
use App\Models\Article\Article;
use App\Models\Product;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{

    public function addToFavorite(Request $request){
//dd($request);
        if ($request->ajax()){

            $user = auth()->user();
            if( $request->productId ){
                $product_id= $request->productId;
                $product = Product::findOrFail($product_id);
                $user->toggleFavorite($product);
                return response()->json($product->isFavorited());
            }

            if( $request->catId ){
                $catId = $request->catId;
                $category = Category::findOrFail($catId);
                $user->toggleFavorite($category);

                return response()->json($category->isFavorited());
            }

            if( $request->articleCatId ){
                $articleCatId = $request->articleCatId;
                $article_cat = Artcl_category::findOrFail($articleCatId);
                $user->toggleFavorite($article_cat);

                return response()->json($article_cat->isFavorited());
            }

            if( $request->articleId ){
                $article_id = $request->articleId;
                $article = Article::findOrFail($article_id);
                $user->toggleFavorite($article);

                return response()->json($article->isFavorited());
            }


        }
    }

    public function favorite(){
        $user = auth()->user();
        if (auth()->check()){
            $courses = $user->favorite(Course::class);
            $categories = $user->favorite(Category::class);
            $course_media = $user->favorite(CourseMedia::class);
            return view('front.favorite.index',compact('courses','categories','course_media'));
        }
    }

}