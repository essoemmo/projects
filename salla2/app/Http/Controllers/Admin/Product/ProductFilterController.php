<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\Category;
use App\Models\product\products;
use App\Models\product\stores;
use \App\Models\Product_type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductFilterController extends Controller
{
    public function product_status(Request $request)
    {
        $sessionStore = session()->get('StoreId');

        $store = stores::where('id', $sessionStore)->first();
          $product_type = Product_type::join('product_types_data','product_types_data.product_types_id','product_types.id')
            ->whereNull('product_types_data.source_id')
            ->where('product_types.store_id', $store['id'])
            //->get()
            ->pluck("product_types_data.title", "product_types.id");
                //\App\Models\ProductTypeData::where('lang_id', 1)->where('store_id', $store['id'])->get()->pluck("title", "id");
        $categories = Category::where('lang_id', 1)->where('store_id', $store['id'])->with(['parent' => function ($query) {
            $query->where('lang_id', 1);
        }])->orderBy('number', 'asc')->with(['children' => function ($query) {
            $query->orderBy('number', 'asc');
        }])->get();
        $categories = Category::where('lang_id', 1)->where('store_id', $sessionStore)->whereNull("parent_id")->orderBy('number', 'asc')->get();
        $category_tree = Category::where('lang_id', 1)->where('store_id', $sessionStore)->get();
        $cats = [];
        \App\Bll\Utility::getCategories($category_tree, $cats);

        if ($request->ajax()) {
            if ($request->code == 'all') {
                $products = products::where("store_id", session()->get("StoreId"))->orderBy("id", "desc")->get();
            }
            if ($request->code == 'discount') {
                $products = products::where("store_id", session()->get("StoreId"))->where('discount', '!=', null)->orderBy("id", "desc")->get();
            }
            if ($request->code == 'sale') {
                $products = products::where("store_id", session()->get("StoreId"))->orderBy("id", "desc")->get();
            }
            if ($request->code == 'outofstock') {
                $products = products::where("store_id", session()->get("StoreId"))->where('max_count', 0)->orderBy("id", "desc")->get();
            }
            return view('admin.products.products.ajax.product_ajax', compact('product_type', "cats", "categories", 'store', 'products'))->render();
        }
    }

    public function product_type(Request $request)
    {
        $sessionStore = session()->get('StoreId');

        $store = stores::where('id', $sessionStore)->first();
        $product_type  =  Product_type::join('product_types_data','product_types_data.product_types_id','product_types.id')
            ->whereNull('product_types_data.source_id')
            ->where('product_types.store_id', $store['id'])
            //->get()
            ->pluck("product_types_data.title", "product_types.id");
                //\App\Models\ProductTypeData::where('lang_id', 1)->where('store_id', $store['id'])->get()->pluck("title", "id");
        $categories = Category::where('lang_id', 1)->where('store_id', $store['id'])->with(['parent' => function ($query) {
            $query->where('lang_id', 1);
        }])->orderBy('number', 'asc')->with(['children' => function ($query) {
            $query->orderBy('number', 'asc');
        }])->get();
        $categories = Category::where('lang_id', 1)->where('store_id', $sessionStore)->whereNull("parent_id")->orderBy('number', 'asc')->get();
        $category_tree = Category::where('lang_id', 1)->where('store_id', $sessionStore)->get();
        $cats = [];
        \App\Bll\Utility::getCategories($category_tree, $cats);

        if ($request->ajax()) {
            if ($request->id != null) {
                $products = products::where("store_id", session()->get("StoreId"))->where('product_type', $request->id)->orderBy("id", "desc")->get();
            }
            return view('admin.products.products.ajax.product_ajax', compact('product_type', "cats", "categories", 'store', 'products'))->render();
        }
    }

  
    public function product_category(Request $request)
    {
        $sessionStore = session()->get('StoreId');

        $store = stores::where('id', $sessionStore)->first();
        $product_type = $product_type = Product_type::join('product_types_data','product_types_data.product_types_id','product_types.id')
            ->whereNull('product_types_data.source_id')
            ->where('product_types.store_id', $store['id'])
            //->get()
            ->pluck("product_types_data.title", "product_types.id");
               // \App\Models\ProductTypeData::where('lang_id', 1)->where('store_id', $store['id'])->get()->pluck("title", "id");
        $categories = Category::where('lang_id', 1)->where('store_id', $store['id'])->with(['parent' => function ($query) {
            $query->where('lang_id', 1);
        }])->orderBy('number', 'asc')->with(['children' => function ($query) {
            $query->orderBy('number', 'asc');
        }])->get();
        $categories = Category::where('lang_id', 1)->where('store_id', $sessionStore)->whereNull("parent_id")->orderBy('number', 'asc')->get();
        $category_tree = Category::where('lang_id', 1)->where('store_id', $sessionStore)->get();
        $cats = [];
        \App\Bll\Utility::getCategories($category_tree, $cats);

        if ($request->ajax()) {
            if ($request->category != null) {
                $category = Category::where('id', $request->category)->where('store_id', $sessionStore)->first()->id;
                $products = products::whereHas('categories', function ($query) use ($category) {
                    $query->where('category_id', $category);
                })->get();
            }
            return view('admin.products.products.ajax.product_ajax', compact('product_type', "cats", "categories", 'store', 'products'))->render();
        }
    }
}
