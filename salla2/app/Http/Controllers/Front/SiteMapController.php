<?php

namespace App\Http\Controllers\Front;

use App\Bll\Constants;
use App\Bll\Utility;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\product\products;

class SiteMapController extends Controller
{
    public function StoreSiteMap()
    {
        $storeId = Utility::getStoreId();
        $products = products::with('product_details')
            ->where('store_id', $storeId)
            ->where('deleted_at', null)
            ->where('max_count', '>', 0)
            ->get()->first();
        $categories = Category::where('store_id', $storeId)->get()->first();
        return response()->view('front.sitemap.index', [
            'categories' => $categories,
            'products' => $products,
        ])->header('Content-Type', 'text/xml');
    }


    public function StoreCategories()
    {
        $storeId = Utility::getStoreId();
        $categories = Category::where('store_id', $storeId)->get();
        dd($categories);
        return response()->view('front.sitemap.categories', [
            'categories' => $categories,
        ])->header('Content-Type', 'text/xml');
    }

    public function StoreProducts()
    {
        $storeId = Utility::getStoreId();
        $products = products::leftJoin('product_details', 'product_details.product_id', 'products.id')
            ->where('products.store_id', $storeId)
            ->where('products.deleted_at', null)
            ->where('product_details.lang_id', Constants::defaultLanguage)
            ->where('products.max_count', '>', 0)
            ->select('products.*', 'product_details.title')
            ->get();
        return response()->view('front.sitemap.products', [
            'products' => $products,
        ])->header('Content-Type', 'text/xml');
    }

}
