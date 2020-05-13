<?php

namespace App\Http\Controllers\Front;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request) {
        $search = $request->search;
        if($request->search != null) {
            $products = Product::leftJoin('products_translations','products_translations.product_id','=','products.id')
                ->select('products_translations.title as title','products_translations.description as description','products.id as id','products.price as price','products.quantity as quantity','products.main_image as main_image')
                ->where('products_translations.title','like', "%$request->search%")
                ->paginate(9);
            return view('front.search_result', compact('products', 'search'));
        } else {
            return view('front.not-found');
        }
    }

    public function search_sort(Request $request) {
        $search = $request->search;
        //dd($request->sort);
        if($request->ajax()) {
            if($request->sort == "ASC" || $request->sort == "DESC") {
//                $products = Product::leftJoin('products_translations', 'products_translations.product_id', '=', 'products.id')
//                    ->select('products_translations.title as title', 'products_translations.description as description', 'products.id as id', 'products.price as price', 'products.quantity as quantity', 'products.main_image as main_image')
//                    ->where('products_translations.title','like', "%$request->search%")
//                    ->orderBy('products.created_at', $request->sort)
//                    ->paginate(9);

                // NEW CODE FOR created time SEARCH
                $products = Product::orderBy('created_at', $request->sort)
                    ->paginate(9);

            } elseif ($request->sort == 'price_desc') {
//                $products = Product::leftJoin('products_translations', 'products_translations.product_id', '=', 'products.id')
//                    ->select('products_translations.title as title', 'products_translations.description as description', 'products.id as id', 'products.price as price', 'products.quantity as quantity', 'products.main_image as main_image')
//                    ->where('products_translations.title','like', "%$request->search%")
//                    ->orderBy('products.price', 'ASC')
//                    ->paginate(9);

                // NEW CODE FOR PRICE SEARCH
                $products = Product::orderBy('products.price', 'ASC')
                    ->paginate(9);
            }
        }
        return view('front.search_ajax', compact('products','search'))->render();
    }

    public function advSearch(Request $request) {
        $search = $request->search;
        $products = Product:: leftJoin('products_translations','products_translations.product_id','=','products.id')
        ->select('products_translations.title as title','products_translations.description as description','products.id as id','products.price as price','products.quantity as quantity','products.main_image as main_image')

            ->where(function ($q) use($request) {
                return $q->when($request->search, function ($query) use ($request) {
                    return $query->where('products_translations.title','like', "%$request->search%");
                });
            })
            ->where(function ($q) use($request) {
                return $q->when($request->from, function ($query) use ($request) {
                    return $query->whereBetween('products.price', [$request->from, $request->to]);
                });
            })->where(function ($q) use($request) {
                return $q->when($request->region_id, function ($query) use ($request) {
                    return $query->where('products.region_id', $request->region_id);
                });
            })
            ->groupBy('products.id')
            ->paginate(9);
        return view('front.search_result', compact('products','search'));
    }
}
