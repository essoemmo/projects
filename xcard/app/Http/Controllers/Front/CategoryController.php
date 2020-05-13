<?php


namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductTranslation;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categories()
    {
        $categories = Category::where('parent_id' , null)->orderBy('id', 'desc')->paginate(9);
        return view('front.category.categories' ,compact('categories'));
    }

    public function category_parent($id)
    {
        $categories = Category::where('parent_id' , $id)->orderBy('id', 'desc')->paginate(9);
        return view('front.category.parent_category' ,compact('categories'));
    }


    public function category_products($id,Request $request)
    {
        $category_products = ProductCategory::where('category_id' , $id)
            ->leftJoin('products' , 'products.id' ,'products_categories.product_id')
            ->paginate(9);

        return view('front.category.category_products' ,compact('category_products','id'));
    }

    public function category_products_sort($id,Request $request) {
        if($request->ajax()) {
            if($request->sort == 'ASC' || $request->sort == 'DESC') {
                $category_products = ProductCategory::where('category_id' , $id)
                    ->leftJoin('products' , 'products.id' ,'products_categories.product_id')
                    ->orderBy('products.created_at', $request->sort)
                    ->paginate(9);

            } elseif($request->sort == 'price_desc') {
                $category_products = ProductCategory::where('category_id' , $id)
                    ->leftJoin('products' , 'products.id' ,'products_categories.product_id')
                    ->orderBy('products.price', 'ASC')
                    ->paginate(9);
            }
            return view('front.category..ajax.category_products_ajax' ,compact('category_products','id'))->render();
        }
    }

    public function quick_purchase()
    {
        $categories = Category::where('parent_id' , null)->orderBy('id', 'desc')->paginate(9);
        return view('front.category.quick_purchase' ,compact('categories'));
    }

    public function cat_list()
    {
        $catId = \request()->cat_id;
        $categories = Category::where('parent_id' , $catId)->get();
        //dd($catId);
        return response()->json($categories);
    }

    public function products_list()
    {
        //Product::
        $catId = \request()->cat_id;
        $category_products = ProductCategory::where('category_id' , $catId)
            ->leftJoin('products' , 'products.id' ,'products_categories.product_id')
            ->leftJoin('products_translations' , 'products_translations.product_id' ,'products.id')
            ->select('products.id','products.main_image'  ,'products_translations.title' ,'products_translations.locale as locale' )
            ->where('locale',App::getLocale())
            ->get();

        return response()->json($category_products);
    }

    public function product_details()
    {
        $product_id = \request()->product_id;
        $product = Product::where('id' , $product_id)->first();
//        $product = Product::leftJoin('products_translations','products_translations.product_id','=','products.id')
//            ->select('products_translations.title as title' ,'products_translations.locale as locale' ,'products.id as id' ,'products.main_image as main_image')
//            ->where('locale',App::getLocale())->first();
        //dd($product);
        return response()->json($product);
    }

}
