<?php

namespace App\Http\Controllers;

use App\Bll\Utility;
use App\Models\AbandonedCart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbandonedCartsController extends Controller
{
    public function index()
    {
        $users_items = DB::table('abandoned_carts')->leftJoin('users', 'users.id', '=', 'abandoned_carts.user_id')
            ->leftJoin('products', 'products.id', '=', 'abandoned_carts.item_id')
            ->where('abandoned_carts.store_id' , Utility::getStoreId())
            ->get();

        $users_items_count = count($users_items);

        $result = [];

        for ($i = 0; $i < $users_items_count; $i++) {

            foreach ($users_items as $item) {
                if (!array_key_exists($item->name, $result)) {
                    $result[$item->name] = [];
                }


                if ($users_items[$i]->id == $item->id) {
                    $result[$item->name] != null ? $result[$item->name]["total"] += $item->price : $result[$item->name]["total"] = $item->price;
                    $result[$item->name]["user_id"] = $item->user_id;
                    $result[$item->name]["created_at"] = Carbon::parse($item->created_at)->diffforhumans();
                }
            }

        }

        return view('admin.abandonedcarts.index', ['items' => $result]);
    }


    public function show($id)
    {
//dd($id);
        $user_items = DB::table('abandoned_carts')
            ->leftJoin('users', 'users.id', '=', 'abandoned_carts.user_id')
            ->leftJoin('products', 'products.id', '=', 'abandoned_carts.item_id')
            ->leftJoin('product_details', 'product_details.product_id', '=', 'abandoned_carts.item_id')
            ->leftJoin('product_photos', function ($join) {
                $join->on('product_photos.product_id', '=', 'abandoned_carts.item_id')
                    ->where('product_photos.main', '=', '1');
            })
            ->where('user_id', $id)
            ->where('abandoned_carts.store_id' , Utility::getStoreId())
            ->select('users.*', 'products.*', 'product_details.*', 'product_photos.*', 'abandoned_carts.*')
            ->get();

        //dd($user_items);
        $total = 0;
        foreach ($user_items as $item) {
            $item->total_price_qty = $item->total_price * $item->qty;
            $total == 0 ? $total = $item->total_price_qty : $total += $item->total_price_qty;
        }
        $user_items->total = $total;
        return view('admin.abandonedcarts.show', ['user_items' => $user_items]);

    }

    public function update_price(Request $request)
    {
        $cart = AbandonedCart::findOrFail($request->pk);
        $cart->total_price = $request->value;
        $cart->save();
        return response()->json(['cart' => $cart]);
    }
}
