<?php

namespace App\Http\Controllers\Front;

use App\Models\Files;
use App\Models\Languages;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
//use Illuminate\Validation\Validator;
use App\Models\Rating;
use \Validator;
class ProductController extends Controller
{
    public function singleProduct($id) {
        $product = Product::findOrFail($id);
        $product_files = Files::where('fileable_id', $product->id)->where('main', 0)->limit(3)->get();
        $product_video = Files::where('fileable_id', $product->id)->where('main', 1)->first();
        $product_rate = Rating::where('product_id',$id)->avg('rating');
        $product_sum = Rating::where('product_id',$id)->sum('rating');
        $product_count = Rating::where('product_id',$id)->count('rating');

        return view('front.products.singleProduct', compact('product','product_files', 'product_video','product_rate','product_sum','product_count'));
    }

    public function products()
    {
        $products = Product::orderBy('id', 'desc')->paginate(9);
        return view('front.products.products', compact('products'));

    }

    public function products_sort(Request $request)
    {
        if($request->ajax()) {
            if($request->sort == 'ASC' || $request->sort == 'DESC') {
                $products = Product::orderBy('id', $request->sort)->paginate(9);
            } elseif ($request->sort == 'price_desc') {
                $products = Product::orderBy('price', 'ASC')->paginate(9);
            }
        }

        return view('front.products.ajax.product_ajax', compact('products'))->render();

    }

    public function rateProduct(Request $request){
        $validator = validator()->make($request->all(), [
            'val' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=>false]);
        }
        $add = Rating::create([
            'product_id' => $request->id,
            'rating' => $request->val,
        ]);

        return response()->json(['data'=>$add]);



    }

}
