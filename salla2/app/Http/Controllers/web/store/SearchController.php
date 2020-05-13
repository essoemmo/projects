<?php

namespace App\Http\Controllers\web\store;

use App\Bll\Utility;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\product\products;
use App\Models\product\stores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Xinax\LaravelGettext\Facades\LaravelGettext;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $store = stores::findOrFail(\App\Bll\Utility::getStoreId());

        $categoriesnav = Category::where('lang_id', getLang(session('lang')))->where('store_id', $store->id)->get();

        $query = $request->input('searchProducts');

        if ($request->searchProducts && $request->category_id == null) {
            $storeOptions = Utility::storeOptions(\App\Bll\Utility::getStoreId())->first();
            if ($storeOptions != null) {
                if ($storeOptions->product_outStock == 1) {
                    $products = products::join('product_details', 'product_details.product_id', '=', 'products.id')
                        ->join('product_photos', 'product_photos.product_id', '=', 'products.id')
                        ->where('product_photos.main', 1)
                        ->where('product_details.lang_id', getLang(LaravelGettext::getLocale()))
                        ->where('store_id', $store->id)
                        ->where('product_details.title', 'like', "%$query%")
                        ->paginate(12);
                } else {
                    $products = products::join('product_details', 'product_details.product_id', '=', 'products.id')
                        ->join('product_photos', 'product_photos.product_id', '=', 'products.id')
                        ->where('product_photos.main', 1)
                        ->where('products.max_count', '>', 0)
                        ->where('product_details.lang_id', getLang(LaravelGettext::getLocale()))
                        ->where('store_id', $store->id)
                        ->where('product_details.title', 'like', "%$query%")
                        ->paginate(12);
                }
            }

            return view('store.search_result', compact('products', 'store', 'categoriesnav'));
        } elseif ($request->category_id && $request->searchProducts == null) {
            $category = Category::where('id', $request->category_id)->first();

            $storeOptions = Utility::storeOptions(\App\Bll\Utility::getStoreId())->first();
            if ($storeOptions != null) {
                if ($storeOptions->product_outStock == 1) {
                    $category_products = DB::table('categories_products')
                        ->leftJoin('products', 'products.id', 'categories_products.product_id')
                        ->join('product_details', 'product_details.product_id', '=', 'products.id')
                        ->join('product_photos', 'product_photos.product_id', '=', 'products.id')
                        ->where('product_photos.main', 1)
                        ->where('product_details.lang_id', getLang(LaravelGettext::getLocale()))
                        ->where('store_id', $store->id)
                        ->where('category_id', $category->id)
                        ->orderBy('products.id', 'desc')
                        ->paginate(12);
                } else {
                    $category_products = DB::table('categories_products')
                        ->leftJoin('products', 'products.id', 'categories_products.product_id')
                        ->join('product_details', 'product_details.product_id', '=', 'products.id')
                        ->join('product_photos', 'product_photos.product_id', '=', 'products.id')
                        ->where('product_photos.main', 1)
                        ->where('products.max_count', '>', 0)
                        ->where('product_details.lang_id', getLang(LaravelGettext::getLocale()))
                        ->where('store_id', $store->id)
                        ->where('category_id', $category->id)
                        ->orderBy('products.id', 'desc')
                        ->paginate(12);
                }
            }


            return view('store.categories.category_product', compact('category_products', 'store', 'categoriesnav'));
        } elseif ($request->category_id == null && $request->searchProducts == null) {
            return redirect()->back();
        } else {
            $category = Category::where('id', $request->category_id)->first();

            $storeOptions = Utility::storeOptions(\App\Bll\Utility::getStoreId())->first();
            if ($storeOptions != null) {
                if ($storeOptions->product_outStock == 1) {
                    $category_products = DB::table('categories_products')
                        ->leftJoin('products', 'products.id', 'categories_products.product_id')
                        ->join('product_details', 'product_details.product_id', '=', 'products.id')
                        ->join('product_photos', 'product_photos.product_id', '=', 'products.id')
                        ->where('product_photos.main', 1)
                        ->where('product_details.lang_id', getLang(LaravelGettext::getLocale()))
                        ->where('store_id', $store->id)
                        ->where('category_id', $category->id)
                        ->where('product_details.title', 'like', "%$query%")
                        ->orderBy('products.id', 'desc')
                        ->paginate(12);
                } else {
                    $category_products = DB::table('categories_products')
                        ->leftJoin('products', 'products.id', 'categories_products.product_id')
                        ->join('product_details', 'product_details.product_id', '=', 'products.id')
                        ->join('product_photos', 'product_photos.product_id', '=', 'products.id')
                        ->where('product_photos.main', 1)
                        ->where('products.max_count', '>', 0)
                        ->where('product_details.lang_id', getLang(LaravelGettext::getLocale()))
                        ->where('store_id', $store->id)
                        ->where('category_id', $category->id)
                        ->where('product_details.title', 'like', "%$query%")
                        ->orderBy('products.id', 'desc')
                        ->paginate(12);
                }
            }

            return view('store.categories.category_product', compact('category_products', 'store', 'categoriesnav'));
        }

    }
}
