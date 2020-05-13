<?php

namespace App\Http\Controllers\web;

use App\Models\Category;
use App\Models\CategoryDescription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            // fetch session and use it in entire class with constructor
            $this->language_id = session()->get('language');
            if(request()->cookie('code') != null){
                $countries = \Illuminate\Support\Facades\DB::table('countries')
                    ->where('iso_code',request()->cookie('code'))->first();
            }else{
                $countries = \Illuminate\Support\Facades\DB::table('countries')
                    ->first();

            }
            $this->currentCountryId = $countries->id;
//            $this->currentCountryCurrencyLeft = session()->get('currentCountryCurrencyLeft');
//            $this->currentCountryCurrencyRight = session()->get('currentCountryCurrencyRight');
            return $next($request);
        });
    }
    public function show($id)
    {
        if (!empty($id)){

            if(request()->cookie('code') != null){
                $countries = \Illuminate\Support\Facades\DB::table('countries')
                    ->where('iso_code',request()->cookie('code'))->first();
            }else{
                $countries = \Illuminate\Support\Facades\DB::table('countries')
                    ->first();

            }

            $country = DB::table('countries')->where('iso_code', $countries->iso_code)->first();
            $convert = getRate($country->iso_code);

            $manufacturers = \App\Models\Manufacturer::orderBy('sort_order', 'asc')->get();

            $catname = CategoryDescription::where('category_id',$id)->where('language_id',getLang(lang()))->first();

            $newProducts = \Illuminate\Support\Facades\DB::table('product_categories')
                ->leftJoin('products','products.id','=','product_categories.product_id')
//                        ->leftJoin('categories','product_categories.category_id','=','categories.id')
                ->leftJoin('product_descriptions','products.id','=','product_descriptions.product_id')
                ->leftJoin('product_images','products.id','=','product_images.product_id')
                ->leftJoin('product_price','products.id','=','product_price.product_id')


                ->select(['products.*',
                    'product_descriptions.name as namedesc',
                    'product_descriptions.language_id',
                    'product_images.image as proimage',
                    'product_price.price as proprice',
                    'product_price.country_id as procountry',
                    'product_price.discount as discount',
                    'product_price.quantity as quantity',
//                             'product_colors.color',
//                             'product_categories.product_id',
//                             'product_categories.category_id'
                ])
                ->where('product_descriptions.language_id','=',getLang(lang()))
                ->where('product_categories.category_id','=',$id)
                ->where('product_price.country_id','=', $countries->id)
                ->groupBy('products.id')->latest()->get();//paginate(20);


        }

        return view('web.categories.show', compact('newProducts','country','manufacturers','catname','convert'));



    }
}
