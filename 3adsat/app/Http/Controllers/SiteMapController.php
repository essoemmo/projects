<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use Illuminate\Http\Request;

class SiteMapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::leftJoin('category_descriptions','category_descriptions.category_id','categories.id')->get()->first();
        $brands = Manufacturer::all()->first();
        $products = Product::leftJoin('product_descriptions','product_descriptions.product_id','products.id')->get()->first();
        return response()->view('sitemap.index', [
            'categories' => $categories,
            'brands' => $brands,
            'products' => $products,
        ])->header('Content-Type', 'text/xml');
    }

    public function categories()
    {
        $categories = Category::leftJoin('category_descriptions','category_descriptions.category_id','categories.id')->get();
        return response()->view('sitemap.categories', [
            'categories' => $categories,
        ])->header('Content-Type', 'text/xml');
    }

    public function brands()
    {
        $brands = Manufacturer::all();
        return response()->view('sitemap.brands', [
            'brands' => $brands,
        ])->header('Content-Type', 'text/xml');
    }

    public function products()
    {
        $products = Product::leftJoin('product_descriptions','product_descriptions.product_id','products.id')->get();
        return response()->view('sitemap.products', [
            'products' => $products,
        ])->header('Content-Type', 'text/xml');
    }
}
