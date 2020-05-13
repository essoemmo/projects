<?php

namespace App\Http\Controllers\Admin;

use App\CountriesData;
use App\Http\Controllers\Controller;
use App\Models\product\orders;
use App\Models\product\order_products;
use App\Models\product\products;
use App\Models\product\stores;
use App\Models\product\transaction_types;
use App\Models\rating\userRating;
use App\Models\Shipping\shippingCompanies;
use App\User;
use App\Visitor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class ReportController extends Controller
{


    public function dayFilter(Request $request)
    {
        if ($request->ajax()) {
            $store_id = \App\Bll\Utility::getStoreId();
            if ($request->date) {

                $orders_count = orders::where('store_id', $store_id)
                ->where(DB::raw('DATE(`created_at`)'),$request->date)
                ->get()->count();

                $orders_total = orders::where('store_id', $store_id)
                ->where(DB::raw('DATE(`created_at`)'),$request->date)
                ->get()->sum('total');

                $orders_ship_cost = orders::where('store_id', $store_id)
                ->where(DB::raw('DATE(`created_at`)'),$request->date)
                ->get()->sum('shipping_cost');

                $clints = User::where('store_id',$store_id)
                ->where(DB::raw('DATE(`created_at`)'),$request->date)
                ->get()->count();

                $countries = CountriesData::all();

                $visitors = Visitor::where('store_id', session()->get('StoreId'))
                ->where(DB::raw('DATE(`created_at`)'),$request->date)
                ->get()->count();

                $shippingcompanies = shippingCompanies::where('store_id', session()->get('StoreId'))->get();

                $transaction_types = transaction_types::where('store_id', session()->get('StoreId'))->get();

                 $best_products = order_products::
                select('order_products.product_id as pro_id',DB::raw('SUM(order_products.count) as product_count'),'products.price as price', 'product_details.title as name', 'product_details.description as desc', 'product_details.lang_id','product_details.source_id', 'product_photos.photo', 'product_photos.tag')
                ->leftJoin('products', 'products.id', '=', 'order_products.product_id')
                ->leftJoin('product_details', 'product_details.product_id', '=', 'order_products.product_id')
                ->leftJoin('product_photos', 'product_photos.product_id', '=', 'order_products.product_id')
                ->where('products.store_id', session()->get('StoreId'))
                ->where('product_photos.main', 1)
                ->groupBy('order_products.product_id')
                ->orderBy('product_count', 'desc')
                ->where(DB::raw('DATE(order_products.created_at)'),$request->date)
                ->get();

                //Best clints orderd
                $best_clints = User::leftJoin('orders', 'orders.user_id', '=', 'users.id')
                ->where('orders.store_id', session()->get('StoreId'))
                ->groupBy('users.id')
                ->select('users.id as user_id', DB::raw('COUNT(orders.user_id) as orders_count'),'users.name as user_name')
                ->orderBy('orders_count', 'desc')
                ->where(DB::raw('DATE(orders.created_at)'),$request->date)
                ->get();
                      //dd($best_clints);

                $best_paymant = orders::select('users.id as user_id',DB::raw('SUM(orders.total) as order_total'),'users.name as userName')
                ->leftJoin('users', 'orders.user_id', '=', 'users.id')
                ->groupBy('orders.user_id')
                ->where('orders.store_id', session()->get('StoreId'))
                ->orderBy('order_total', 'desc')
                ->where(DB::raw('DATE(orders.created_at)'),$request->date)
                ->get();
            }
            return response()->json(
            [
            'orders_count' => $orders_count,
            'orders_total' => $orders_total,
            'orders_ship_cost' => $orders_ship_cost,
            'clints' => $clints,
            'countries' => $countries,
            'visitors' => $visitors,
            'best_products' => $best_products,
            'best_clints' => $best_clints,
            'shippingcompanies' => $shippingcompanies,
            'transaction_types' => $transaction_types,
            'best_paymant' => $best_paymant,
            'status' => 'success',
            ]);
        }
    }

    public function weekFilter(Request $request)
    {


        if ($request->ajax()) {
            $store_id = \App\Bll\Utility::getStoreId();
            if ($request->week == 1) {

                $orders_count = orders::where('store_id', $store_id)
                 ->where('created_at', '>', Carbon::now()->startOfWeek())
                 ->where('created_at', '<', Carbon::now()->endOfWeek())
                ->get()->count();

                $orders_total = orders::where('store_id', $store_id)
                ->where('created_at', '>', Carbon::now()->startOfWeek())
                ->where('created_at', '<', Carbon::now()->endOfWeek())
                ->get()->sum('total');

                $orders_ship_cost = orders::where('store_id', $store_id)
                ->where('created_at', '>', Carbon::now()->startOfWeek())
                 ->where('created_at', '<', Carbon::now()->endOfWeek())
                ->get()->sum('shipping_cost');

                $clints = User::where('store_id',$store_id)
                ->where('created_at', '>', Carbon::now()->startOfWeek())
                ->where('created_at', '<', Carbon::now()->endOfWeek())
                ->get()->count();

                $countries = CountriesData::all();

                $visitors = Visitor::where('store_id', session()->get('StoreId'))
                ->where('created_at', '>', Carbon::now()->startOfWeek())
                 ->where('created_at', '<', Carbon::now()->endOfWeek())
                ->get()->count();

                $shippingcompanies = shippingCompanies::where('store_id', session()->get('StoreId'))->get();

                $transaction_types = transaction_types::where('store_id', session()->get('StoreId'))->get();

                $best_products = order_products::
                select('order_products.product_id as pro_id',DB::raw('SUM(order_products.count) as product_count'),'products.price as price', 'product_details.title as name', 'product_details.description as desc', 'product_details.lang_id','product_details.source_id', 'product_photos.photo', 'product_photos.tag')
                 ->leftJoin('products', 'products.id', '=', 'order_products.product_id')
                 ->leftJoin('product_details', 'product_details.product_id', '=', 'order_products.product_id')
                 ->leftJoin('product_photos', 'product_photos.product_id', '=', 'order_products.product_id')
                 ->where('products.store_id', session()->get('StoreId'))
                 ->where('product_photos.main', 1)
                ->groupBy('order_products.product_id')
                ->orderBy('product_count', 'desc')
                ->where(DB::raw('DATE(order_products.created_at)'),'>', Carbon::now()->startOfWeek())
                ->where(DB::raw('DATE(order_products.created_at)'),'<', Carbon::now()->endOfWeek())
                ->get();

                //Best clints orderd
                $best_clints = User::leftJoin('orders', 'orders.user_id', '=', 'users.id')
                ->where('orders.store_id', session()->get('StoreId'))
                ->groupBy('users.id')
                ->select('users.id as user_id', DB::raw('COUNT(orders.user_id) as orders_count'),'users.name as user_name')
                ->orderBy('orders_count', 'desc')
                ->where(DB::raw('DATE(orders.created_at)'),'>', Carbon::now()->startOfWeek())
                ->where(DB::raw('DATE(orders.created_at)'),'<', Carbon::now()->endOfWeek())
                ->get();
                      //dd($best_clints);

                $best_paymant = orders::select('users.id as user_id',DB::raw('SUM(orders.total) as order_total'),'users.name as userName')
                ->leftJoin('users', 'orders.user_id', '=', 'users.id')
                ->groupBy('orders.user_id')
                ->where('orders.store_id', session()->get('StoreId'))
                ->orderBy('order_total', 'desc')
                ->where(DB::raw('DATE(orders.created_at)'),'>', Carbon::now()->startOfWeek())
                ->where(DB::raw('DATE(orders.created_at)'),'<', Carbon::now()->endOfWeek())
                ->get();

            }elseif($request->week == 2){

                $orders_count = orders::where('store_id', $store_id)
                ->where('created_at', '>', \App\Bll\Utility::LastWeek()[0])
                ->where('created_at', '<', \App\Bll\Utility::LastWeek()[1])
                ->get()->count();

                $orders_total = orders::where('store_id', $store_id)
                ->where('created_at', '>', \App\Bll\Utility::LastWeek()[0])
                ->where('created_at', '<', \App\Bll\Utility::LastWeek()[1])
                ->get()->sum('total');

                $orders_ship_cost = orders::where('store_id', $store_id)
                ->where('created_at', '>', \App\Bll\Utility::LastWeek()[0])
                ->where('created_at', '<', \App\Bll\Utility::LastWeek()[1])
                ->get()->sum('shipping_cost');

                $clints = User::where('store_id',$store_id)
                ->where('created_at', '>', \App\Bll\Utility::LastWeek()[0])
                ->where('created_at', '<', \App\Bll\Utility::LastWeek()[1])
                ->get()->count();

                $countries = CountriesData::all();

                $visitors = Visitor::where('store_id', session()->get('StoreId'))
                ->where('created_at', '>', \App\Bll\Utility::LastWeek()[0])
                ->where('created_at', '<', \App\Bll\Utility::LastWeek()[1])
                ->get()->count();

                $shippingcompanies = shippingCompanies::where('store_id', session()->get('StoreId'))->get();

                $transaction_types = transaction_types::where('store_id', session()->get('StoreId'))->get();

                $best_products = order_products::
                select('order_products.product_id as pro_id',DB::raw('SUM(order_products.count) as product_count'),'products.price as price', 'product_details.title as name', 'product_details.description as desc', 'product_details.lang_id','product_details.source_id', 'product_photos.photo', 'product_photos.tag')
                 ->leftJoin('products', 'products.id', '=', 'order_products.product_id')
                 ->leftJoin('product_details', 'product_details.product_id', '=', 'order_products.product_id')
                 ->leftJoin('product_photos', 'product_photos.product_id', '=', 'order_products.product_id')
                 ->where('products.store_id', session()->get('StoreId'))
                 ->where('product_photos.main', 1)
                ->groupBy('order_products.product_id')
                ->orderBy('product_count', 'desc')
                ->where(DB::raw('DATE(order_products.created_at)'),'>', \App\Bll\Utility::LastWeek()[0])
                ->where(DB::raw('DATE(order_products.created_at)'),'<', \App\Bll\Utility::LastWeek()[1])
                ->get();

                //Best clints orderd
                $best_clints = User::leftJoin('orders', 'orders.user_id', '=', 'users.id')
                ->where('orders.store_id', session()->get('StoreId'))
                ->groupBy('users.id')
                ->select('users.id as user_id', DB::raw('COUNT(orders.user_id) as orders_count'),'users.name as user_name')
                ->orderBy('orders_count', 'desc')
                ->where(DB::raw('DATE(orders.created_at)'),'>', \App\Bll\Utility::LastWeek()[0])
                ->where(DB::raw('DATE(orders.created_at)'),'<', \App\Bll\Utility::LastWeek()[1])
                ->get();
                    //dd($best_clints);

                $best_paymant = orders::select('users.id as user_id',DB::raw('SUM(orders.total) as order_total'),'users.name as userName')
                ->leftJoin('users', 'orders.user_id', '=', 'users.id')
                ->groupBy('orders.user_id')
                ->where('orders.store_id', session()->get('StoreId'))
                ->orderBy('order_total', 'desc')
                ->where(DB::raw('DATE(orders.created_at)'),'>', \App\Bll\Utility::LastWeek()[0])
                ->where(DB::raw('DATE(orders.created_at)'),'<', \App\Bll\Utility::LastWeek()[1])
                ->get();


            }
            return response()->json(
            [
            'orders_count' => $orders_count,
            'orders_total' => $orders_total,
            'orders_ship_cost' => $orders_ship_cost,
            'clints' => $clints,
            'countries' => $countries,
            'visitors' => $visitors,
             'best_products' => $best_products,
            // 'best_clints' => $best_clints,
            'shippingcompanies' => $shippingcompanies,
            'transaction_types' => $transaction_types,
            // 'best_paymant' => $best_paymant,
            'status' => 'success',
            ]);
        }
    }


    public function monthFilter(Request $request)
    {

        if ($request->ajax()) {
            $store_id = \App\Bll\Utility::getStoreId();
            if ($request->month && $request->month_year) {

                $orders_count = orders::where('store_id', $store_id)
                ->where(DB::raw('MONTHNAME(`created_at`)'),$request->month)
                ->where(DB::raw('YEAR(`created_at`)'),$request->month_year)
                ->get()->count();

                $orders_total = orders::where('store_id', $store_id)
                ->where(DB::raw('MONTHNAME(`created_at`)'),$request->month)
                ->where(DB::raw('YEAR(`created_at`)'),$request->month_year)
                ->get()->sum('total');

                $orders_ship_cost = orders::where('store_id', $store_id)
                ->where(DB::raw('MONTHNAME(`created_at`)'),$request->month)
                ->where(DB::raw('YEAR(`created_at`)'),$request->month_year)
                ->get()->sum('shipping_cost');

                $clints = User::where('store_id',$store_id)
                ->where(DB::raw('MONTHNAME(`created_at`)'),$request->month)
                ->where(DB::raw('YEAR(`created_at`)'),$request->month_year)
                ->get()->count();

                $countries = CountriesData::all();

                $visitors = Visitor::where('store_id', session()->get('StoreId'))
                ->where(DB::raw('MONTHNAME(`created_at`)'),$request->month)
                ->where(DB::raw('YEAR(`created_at`)'),$request->month_year)
                ->get()->count();

                $shippingcompanies = shippingCompanies::where('store_id', session()->get('StoreId'))->get();

                $transaction_types = transaction_types::where('store_id', session()->get('StoreId'))->get();

                $best_products = order_products::
                select('order_products.product_id as pro_id',DB::raw('SUM(order_products.count) as product_count'),'products.price as price', 'product_details.title as name', 'product_details.description as desc', 'product_details.lang_id','product_details.source_id', 'product_photos.photo', 'product_photos.tag')
                ->leftJoin('products', 'products.id', '=', 'order_products.product_id')
                ->leftJoin('product_details', 'product_details.product_id', '=', 'order_products.product_id')
                ->leftJoin('product_photos', 'product_photos.product_id', '=', 'order_products.product_id')
                ->where('products.store_id', session()->get('StoreId'))
                ->where('product_photos.main', 1)
                ->where(DB::raw('MONTHNAME(order_products.created_at)'),$request->month)
                ->where(DB::raw('YEAR(order_products.created_at)'),$request->month_year)
                ->groupBy('order_products.product_id')
                ->orderBy('product_count', 'desc')
                ->get();

            //Best clints orderd
            $best_clints = User::leftJoin('orders', 'orders.user_id', '=', 'users.id')
            ->where('orders.store_id', session()->get('StoreId'))
            ->groupBy('users.id')
            ->select('users.id as user_id', DB::raw('COUNT(orders.user_id) as orders_count'),'users.name as user_name')
            ->orderBy('orders_count', 'desc')
            ->where(DB::raw('MONTHNAME(order_products.created_at)'),$request->month)
            ->where(DB::raw('YEAR(order_products.created_at)'),$request->month_year)
            ->get();
                //dd($best_clints);

            $best_paymant = orders::select('users.id as user_id',DB::raw('SUM(orders.total) as order_total'),'users.name as userName')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->groupBy('orders.user_id')
            ->where('orders.store_id', session()->get('StoreId'))
            ->orderBy('order_total', 'desc')
            ->where(DB::raw('MONTHNAME(order_products.created_at)'),$request->month)
            ->where(DB::raw('YEAR(order_products.created_at)'),$request->month_year)
            ->get();
            }


            return response()->json(
            [
            'orders_count' => $orders_count,
            'orders_total' => $orders_total,
            'orders_ship_cost' => $orders_ship_cost,
            'clints' => $clints,
            'countries' => $countries,
            'visitors' => $visitors,
             'best_products' => $best_products,
            // 'best_clints' => $best_clints,
            'shippingcompanies' => $shippingcompanies,
            'transaction_types' => $transaction_types,
            // 'best_paymant' => $best_paymant,
            'status' => 'success',
            ]);
        }
    }



    public function yearFilter(Request $request)
    {

        if ($request->ajax()) {
            $store_id = \App\Bll\Utility::getStoreId();
            if ($request->year) {

                $orders_count = orders::where('store_id', $store_id)
                ->where(DB::raw('YEAR(`created_at`)'),$request->year)
                ->get()->count();

                $orders_total = orders::where('store_id', $store_id)
                ->where(DB::raw('YEAR(`created_at`)'),$request->year)
                ->get()->sum('total');

                $orders_ship_cost = orders::where('store_id', $store_id)
                ->where(DB::raw('YEAR(`created_at`)'),$request->year)
                ->get()->sum('shipping_cost');

                $clints = User::where('store_id',$store_id)
                ->where(DB::raw('YEAR(`created_at`)'),$request->year)
                ->get()->count();

                $countries = CountriesData::all();

                $visitors = Visitor::where('store_id', session()->get('StoreId'))
                ->where(DB::raw('YEAR(`created_at`)'),$request->year)
                ->get()->count();

                $shippingcompanies = shippingCompanies::where('store_id', session()->get('StoreId'))->get();

                $transaction_types = transaction_types::where('store_id', session()->get('StoreId'))->get();

                $best_products = order_products::
                select('order_products.product_id as pro_id',DB::raw('SUM(order_products.count) as product_count'),'products.price as price', 'product_details.title as name', 'product_details.description as desc', 'product_details.lang_id','product_details.source_id', 'product_photos.photo', 'product_photos.tag')
                 ->leftJoin('products', 'products.id', '=', 'order_products.product_id')
                 ->leftJoin('product_details', 'product_details.product_id', '=', 'order_products.product_id')
                 ->leftJoin('product_photos', 'product_photos.product_id', '=', 'order_products.product_id')
                 ->where('products.store_id', session()->get('StoreId'))
                 ->where('product_photos.main', 1)
                ->groupBy('order_products.product_id')
                ->orderBy('product_count', 'desc')
                ->where(DB::raw('YEAR(order_products.created_at)'),$request->year)
                ->get();


                //Best clints orderd
            $best_clints = User::leftJoin('orders', 'orders.user_id', '=', 'users.id')
            ->where('orders.store_id', session()->get('StoreId'))
            ->groupBy('users.id')
            ->select('users.id as user_id', DB::raw('COUNT(orders.user_id) as orders_count'),'users.name as user_name')
            ->orderBy('orders_count', 'desc')
            ->where(DB::raw('YEAR(order_products.created_at)'),$request->year)
            ->get();
                //dd($best_clints);

            $best_paymant = orders::select('users.id as user_id',DB::raw('SUM(orders.total) as order_total'),'users.name as userName')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->groupBy('orders.user_id')
            ->where('orders.store_id', session()->get('StoreId'))
            ->orderBy('order_total', 'desc')
            ->where(DB::raw('YEAR(order_products.created_at)'),$request->year)
            ->get();

            }
            return response()->json(
            [
            'orders_count' => $orders_count,
            'orders_total' => $orders_total,
            'orders_ship_cost' => $orders_ship_cost,
            'clints' => $clints,
            'countries' => $countries,
            'visitors' => $visitors,
             'best_products' => $best_products,
            // 'best_clints' => $best_clints,
            'shippingcompanies' => $shippingcompanies,
            'transaction_types' => $transaction_types,
            // 'best_paymant' => $best_paymant,
            'status' => 'success',
            ]);
        }
    }



    public function index(Request $request)
    {



        $orders_count = orders::where('store_id', session()->get('StoreId'))->get();

        $orders_total = DB::table('orders')->where('store_id', session()->get('StoreId'))->get();

        $orders_ship_cost = orders::where('store_id', session()->get('StoreId'))->get();


        $clints = DB::table('users')->where('store_id', session()->get('StoreId'))->get();

        $countries = CountriesData::all();

        $visitors = DB::table('visitors')->where('store_id', session()->get('StoreId'))->get();

        $shippingcompanies = DB::table('shipping_companies')->where('store_id', session()->get('StoreId'))->get();

        $transaction_types = DB::table('transaction_types')->where('store_id', session()->get('StoreId'))->get();


          // best product sell
          $best_products = order_products::
          select('order_products.product_id as pro_id',DB::raw('SUM(order_products.count) as product_count'),'products.price as price', 'product_details.title as name', 'product_details.description as desc', 'product_details.lang_id','product_details.source_id', 'product_photos.photo', 'product_photos.tag')
           ->leftJoin('products', 'products.id', '=', 'order_products.product_id')
           ->leftJoin('product_details', 'product_details.product_id', '=', 'order_products.product_id')
           ->leftJoin('product_photos', 'product_photos.product_id', '=', 'order_products.product_id')
           ->where('products.store_id', session()->get('StoreId'))
           ->where('product_photos.main', 1)
          ->groupBy('order_products.product_id')
          ->orderBy('product_count', 'desc')
          ->get();


        //Best clints orderd
        $best_clints = User::leftJoin('orders', 'orders.user_id', '=', 'users.id')
        ->where('orders.store_id', session()->get('StoreId'))
        ->groupBy('users.id')
        ->select('users.id as user_id', DB::raw('COUNT(orders.user_id) as orders_count'),'users.name as user_name')
        ->orderBy('orders_count', 'desc')
        ->get();
            //dd($best_clints);

        $best_paymant = orders::select('users.id as user_id',DB::raw('SUM(orders.total) as order_total'),'users.name as userName')
        ->leftJoin('users', 'orders.user_id', '=', 'users.id')
        ->groupBy('orders.user_id')
        ->where('orders.store_id', session()->get('StoreId'))
        ->orderBy('order_total', 'desc')
        ->get();



        return view('admin.reports.index',
            [
                'orders_count' => $orders_count,
                'orders_total' => $orders_total,
                'orders_ship_cost' => $orders_ship_cost,
                'clints' => $clints,
                'countries' => $countries,
                'visitors' => $visitors,
                'best_products' => $best_products,
                'best_clints' => $best_clints,
                'shippingcompanies' => $shippingcompanies,
                'transaction_types' => $transaction_types,
                'best_paymant' => $best_paymant,
            ]);
    }

}
