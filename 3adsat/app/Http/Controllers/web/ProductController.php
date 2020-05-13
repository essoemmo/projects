<?php

namespace App\Http\Controllers\web;

use App\Http\Middleware\lang;
use App\Models\AttributeGroup;
use App\Models\Product;
use App\Models\Product_Axis;
use App\Models\Product_Cylinder;
use App\Models\Product_Sphere;
use App\Models\ProductAttribute;
use App\Models\ProductColor;
use App\Models\ProductDiscount;
use App\Models\stockStatus;
use App\ProductLens;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller {

    public $language_id;
    public $currentCountryId;

    public function __construct() {
        $this->middleware(function ($request, $next) {
            // fetch session and use it in entire class with constructor
            $this->language_id = getLang(lang());
            if (request()->cookie('code') != null) {
                $countries = \Illuminate\Support\Facades\DB::table('countries')
                                ->where('iso_code', request()->cookie('code'))->first();
            } else {
                $countries = \Illuminate\Support\Facades\DB::table('countries')
                        ->first();
            }
            $this->currentCountryId = $countries->id;

            return $next($request);
        });
    }

    protected function showName($name) {
         $find =\App\Models\ProductDescription::where("name" , $name)->first();

            if($find!==null)
            {

              return $this->show($find->product_id);
            }
            abort(404);
    }
    public function show($id) {
        $product = Product::findOrFail($id);
        if (request()->cookie('code') != null) {
            $countries = \Illuminate\Support\Facades\DB::table('countries')
                            ->where('iso_code', request()->cookie('code'))->first();
        } else {
            $countries = \Illuminate\Support\Facades\DB::table('countries')
                    ->first();
        }

        $country = DB::table('countries')->where('iso_code', $countries->iso_code)->first();
        $lang = DB::table('languages')->where('code', lang())->first();

        $convert = getRate($country->iso_code);

        if (!empty($id)) {
            $product =  $product = Product::
             Join('product_descriptions', 'products.id', '=', 'product_descriptions.product_id')
              ->leftJoin('product_price','product_price.product_id', '=', 'products.id')
              ->leftJoin('products_spheres','products_spheres.product_id', '=', 'products.id')
              ->leftJoin('products_cylinder','products_cylinder.product_id', '=', 'products.id')
              ->leftJoin('products_axis','products_axis.product_id', '=', 'products.id')

                ->where('products.id', '=', $id)
                ->where('product_descriptions.product_id', '=', $id)
                ->where('product_descriptions.language_id', '=', $this->language_id)
                ->where('product_descriptions.deleted_at', '=', NULL)
                ->where('product_price.country_id','=',$countries->id)

            ->select('products.*', 'product_descriptions.id as descId','product_descriptions.name', 'product_descriptions.description', 'product_descriptions.tag', 'product_descriptions.meta_title', 'product_descriptions.meta_description', 'product_descriptions.meta_keyword','product_price.price as Price','product_price.discount','product_price.country_id','product_price.quantity','products_spheres.type as sphere_type','products_axis.type as axis_type','products_cylinder.type as cylinder_type')
                ->groupBy('products.id')->first();

            if ($product != null) {
                //add number of views
                $viewsNum = Product::find($id);
                $viewsNum->viewed += 1;
                $viewsNum->save();

                //get average rating
                $averageRating = Product::find($id)->productReviews->avg('rating');

                $product->ratingPercentage = 100 / 5 * $averageRating;
                //colors
                $product->productColors = ProductColor::with(['productColorDescriptions' => function ($query) {
                                $query->where('language_id', '=', $this->language_id);
                                $query->where('deleted_at', '=', null);
                            }])->where('product_colors.product_id', '=', $id)->get();

                if (!empty($product->productColors)) {
                    foreach ($product->productColors as $color) { //color image
                        if (!empty($colorId) && $colorId == $color->id) {
                            $product->color_image = $color->image;
                            $product->color_id = $color->id;
                            $product->color_name = $color->name;
                        }
                    }
                }

                //discount
                $productDiscount = ProductDiscount::getDiscountedPrice($id);

                if (!empty($productDiscount)) {
                    $product->price = $productDiscount->price;
                }

                //images
                $product->productImages = Product::find($id)->productImages;
//
                //stock status
                if (!empty($product->stock_status_id)) {
                    $product->stockStatusName = StockStatus::find($product->stock_status_id)->getName($this->language_id);
                }
//
                //attributes
                $atributeGroups = \App\Models\AttributeGroup::getByProductIdAndLanguage($id, $this->language_id);

                if (!empty($atributeGroups)) {
                    foreach ($atributeGroups as $group) {
                        //get attributes
//                            $productAttributes = ProductAttribute::getByProductIdAndLanguage($group->id, $this->language_id);
                        $productAttributes = ProductAttribute::where('product_id', $id)->where('language_id', $this->language_id)->get();
                        $group->productAttributes = $productAttributes;
                    }
                    $product->atributeGroups = $atributeGroups;
                }


                //get product options with no parent first
//                    $productOptions = ProductOption::getByLanguageAndProductId2($id, $this->language_id);
//                    $product->productOptions = $productOptions[0];
//                    $product->optionJson = json_encode($productOptions[1]);
//                    $product->options_hidden = json_encode($productOptions[2]);
                //related products
                $relatedProducts = \App\Models\RelatedProduct::getByProductIdAndLanguage($id, $this->language_id);
                if (!empty($relatedProducts)) {
                    foreach ($relatedProducts as $related) {
                        //discount
                        $productDiscount = ProductDiscount::getDiscountedPrice($related->id);
                        if (!empty($productDiscount)) {
                            $related->price = $productDiscount->price;
                        }
                    }
                    $product->relatedProducts = $relatedProducts;
                }
            //dd($product->relatedProducts);

                //reviews
                $productReviews = \App\Models\ProductReview::where('product_reviews.status', 0)->where('product_reviews.product_id', $id)->orderBy('date_added', 'asc')->get();
                if (!empty($productReviews)) {
                    foreach ($productReviews as $review) {
                        //get rating percentage
                        $review->ratingPercentage = 100 / 5 * $review->rating;
                    }
                    $product->productReviews = $productReviews;
                }


                $productSphere = Product_Sphere::where('product_id', $product->id)->get();
                $productCylinder = Product_Cylinder::where('product_id', $product->id)->get();
                $productAxis = Product_Axis::where('product_id', $product->id)->get();
                $productLenses = ProductLens::leftJoin('tbl_lenses', 'tbl_lenses.id', 'product_lenses.lens_id')
                                                ->where('product_id', $product->id)
                       ->where("lang_id","=", $this->language_id)->get();
                if(count($productLenses)==0)     
                {
                       $productLenses = ProductLens::leftJoin('tbl_lenses', 'tbl_lenses.source_id', 'product_lenses.lens_id')
                                                ->where('product_id', $product->id)
                       ->where("lang_id","=", $this->language_id)->get();
                }

                $productData = Product::getOneById($id, $this->language_id);
                if ($product->product_type == 'lenses') {
                    return view('web.product.showLenses', ['product' => $product, 'convert' => $convert, 'productSphere' => $productSphere, 'productCylinder' => $productCylinder, 'productAxis' => $productAxis]);
                } elseif ($product->product_type == 'glasses' || $product->product_type == 'sunglass') {
                    return view('web.product.showGlasses', ['product' => $product, 'convert' => $convert, 'productSphere' => $productSphere, 'productCylinder' => $productCylinder, 'productAxis' => $productAxis, 'productLenses' => $productLenses]);
                }
            }
        }

//        dd($product->price);
        // }
    }

    public function rate(Request $request) {
        $data = $request->data;
        parse_str($data, $dataa);
//            dd($dataa);
        $rate = DB::table('ratings')->where('product_id', $dataa['product_id'])->first();
        if (!$rate) {
            DB::table('ratings')->insert(['product_id' => $dataa['product_id']]);

            $ratetabel = DB::table('ratings')->where('product_id', $dataa['product_id'])->first();


            $rateUser = DB::table('user_rating')->insert([
                'user_id' => auth()->user()->id,
                'rating_id' => $ratetabel->id,
                'rating' => $dataa['rating'],
                'author' => $dataa['author'],
                'comment' => $dataa['review_text'],
                'created_at' => Carbon::now(),
                'approve' => 0,
            ]);


            $ratetab = DB::table('ratings')->where('product_id', $dataa['product_id'])->first();

            $rateUsers = DB::table('user_rating')->where('rating_id', $ratetab->id)->sum('rating');
            $rateUserscount = DB::table('user_rating')->where('rating_id', $ratetab->id)->count();
            // final rate in user rate
            $rated = ($rateUsers * 20) / $rateUserscount;
            // store rate in rate table
            DB::table('ratings')->where('product_id', $dataa['product_id'])->update([
                'rating' => $rated,
            ]);

            return 'done';
        } else {
            $ratetabel = DB::table('ratings')->where('product_id', $dataa['product_id'])->first();


            $rateUser = DB::table('user_rating')->insert([
                'user_id' => auth()->user()->id,
                'rating_id' => $ratetabel->id,
                'rating' => $dataa['rating'],
                'author' => $dataa['author'],
                'comment' => $dataa['review_text'],
                'created_at' => Carbon::now(),
                'approve' => 0,
            ]);


            $ratetab = DB::table('ratings')->where('product_id', $dataa['product_id'])->first();

            $rateUsers = DB::table('user_rating')->where('rating_id', $ratetab->id)->sum('rating');
            $rateUserscount = DB::table('user_rating')->where('rating_id', $ratetab->id)->count();
            // final rate in user rate
            $rated = ($rateUsers * 20) / $rateUserscount;
            // store rate in rate table
            DB::table('ratings')->where('product_id', $dataa['product_id'])->update([
                'rating' => $rated,
            ]);

            return 'donetwo';
        }
    }

}
