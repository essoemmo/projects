<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\product\orders;
use App\Models\product\stores;
use App\Visitor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
//dd(auth()->guard(\App\Help\Utility::Store)->user()->name);

        $visitors = Visitor::where('store_id', session()->get('StoreId'))->whereMonth(
            'created_at',
            Carbon::now()->format('m'))->whereYear(
            'created_at',
            Carbon::now()->format('Y'))->get();

        $orders = orders::
            leftJoin('users', 'users.id', 'orders.user_id')
            ->select(
            'orders.id as id',
            'orders.ordernumber as ordernumber',
            'orders.status as status',
            'orders.total as total',
            'orders.shipping_cost as shipping_cost',
            'users.name as name'
            )
            ->where('orders.store_id', session()->get('StoreId'))
            ->whereMonth(
            'orders.created_at',
             Carbon::now()->format('m'))->whereYear(
            'orders.created_at',
            Carbon::now()->format('Y'))
            ->get();

        //  dd($orders);

        $store = stores::findOrFail(\App\Bll\Utility::getStoreId());

        //  dd($store);
        // if(auth()->guard('store')->check()){
        // $usersStores = User::where('store_id',session('StoreId'))->get();
        // $products_orders = order_products::select('orders.ordernumber as number','order_products.price as price','order_products.count as count','product_details.title as productname','product_photos.photo as image')
        // ->leftJoin('orders','orders.id','=','order_products.order_id')
        // ->join('products','products.id','=','order_products.order_id')
        // ->leftJoin('product_details','products.id','=','product_details.product_id')
        // ->leftJoin('product_photos','products.id','=','product_photos.product_id')
        // ->where('product_photos.main',1)
        // ->where('orders.store_id',session('StoreId'))
        // ->where('product_details.lang_id',getLang(session('lang')))
        // ->get();
        // }else{
        //     $usersStores = User::where('guard','!=','admin')->get();
        //     $products_orders = order_products::select('orders.ordernumber as number','order_products.price as price','order_products.count as count','product_details.title as productname','product_photos.photo as image')
        //         ->leftJoin('orders','orders.id','=','order_products.order_id')
        //         ->join('products','products.id','=','order_products.order_id')
        //         ->leftJoin('product_details','products.id','=','product_details.product_id')
        //         ->leftJoin('product_photos','products.id','=','product_photos.product_id')
        //         ->where('product_photos.main',1)
        //         ->where('product_details.lang_id',getLang(session('lang')))
        //         ->get();
        // }
        $user = auth()->guard('store')->user()->id;

        $notifications = DB::table('notifications')
        ->where('notifiable_id',$user)
        ->orderBy('created_at','desc')->get()->toArray();
          //  dd($notifications)
        return view('admin.home.index', compact( 'store', 'visitors', 'orders','notifications'));
    }
}
