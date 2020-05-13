<?php

namespace App\Http\Controllers\web\store;

use App\Bll\Utility;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\product\feature_options;
use App\Models\product\features;
use App\Models\product\product_details;
use App\Models\product\products;
use App\Models\product\stores;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Xinax\LaravelGettext\Facades\LaravelGettext;

class CartController extends Controller
{

    public function cart()
    {
        $store = stores::findOrFail(\App\Bll\Utility::getStoreId());
        $categoriesnav = Category::where('lang_id', getLang(LaravelGettext::getLocale()))->where('store_id', $store->id)->whereNull("parent_id")->get();
        $cart = Cart::content();
        if (auth()->check()) {
            DB::table('abandoned_carts')->where('user_id', auth()->user()->id)->where('store_id', Utility::getStoreId())->delete();
            foreach ($cart as $item) {
                DB::table('abandoned_carts')->insert(['user_id' => auth()->user()->id, 'item_id' => $item->id, 'qty' => $item->qty,
                    'total_price' => $item->price , 'store_id' => Utility::getStoreId()]);
            }
        }
        $count = 0;
        return view('store.cart.cart', compact('cart', 'count', 'store', 'categoriesnav'));
    }

    public function addToCart(Request $request)
    {
        if ($request->ajax()) {

            $product = products::find($request->product_id);

            if ($product->currency_code == null) {
                $currency = \App\Bll\Constants::defaultCurrency;
            } else {
                $currency = $product->currency_code;
            }

            $price = $request->price;
            if ($product->max_count == 1) {
                $message = _i('Out Of Stock For This Product');
                return response()->json([false, $message]);
            }
            if (collect($request->formData)->count() > 0) {
                foreach ($request->formData as $index => $value) {
                    if ($value != null) {
                        $feature_option = feature_options::leftJoin('feature_options_data', 'feature_options_data.feature_option_id', 'feature_options.id')
                            ->where('feature_options.id', $value)
                            ->where('feature_options_data.lang_id', getLang(LaravelGettext::getLocale()))
                            ->first();
                        $feature = features::leftJoin('features_data', 'features_data.feature_id', 'features.id')
                            ->where('features.id', $index)
                            ->where('features_data.lang_id', getLang(LaravelGettext::getLocale()))
                            ->first();
                        $message = _i('Out Of Stock For This Option') . ' ' . $feature->title . ' ' . '(' . $feature_option->title . ')';
                        if ($feature_option->count == 1) {
                            return response()->json([false, $message]);
                        }
                        $formData = $request->formData;
                    } else {
                        $formData = null;
                    }
                }
            } else {
                $formData = null;
            }
            $product_detail = product_details::where('lang_id', '=', getLang(LaravelGettext::getLocale()))->where('product_id', '=', $product['id'])->first();
            $product_type = products::leftJoin('product_types', 'product_types.id', 'products.product_type')
                ->where('products.id', $request->product_id)
                ->first()->type_code; // get product type
            DB::beginTransaction();
            try {
                $add = Cart::add(array(
                    'id' => $product['id'],
                    'name' => $product_detail['title'],
                    'qty' => $request->qty,
                    'price' => $price,
                    'options' => [
                        'description' => $product_detail['description'],
                        'max_count' => $product['max_count'],
                        'image' => getimage($product->id),
                        'features' => $formData,
                        'original_price' => $product->price,
                        'currency' => $currency,
                        'product_type' => $product_type,
                    ]
                ));
                $cart = Cart::content();
                DB::commit();
            } catch (\Exception $e) {
                return $e->getMessage();
                DB::rollBack();
            }
            $add;
            $cart;
            $count = count(Cart::content());
            $total = Cart::total();
            return response()->json([$cart, $count, $total]);
        }
    }

    public function update(Request $request)
    {
        if ($request->ajax()) {
            $rowId = $request->rowId;
            if ($request->qty != null) {
                $cart = Cart::update($rowId, ['qty' => $request->qty]);
                $total = Cart::total();
                return response()->json([$cart, $total]);
            } else {
                return '';
            }
        }
    }

    public function updateFeatures(Request $request)
    {
        if ($request->ajax()) {
            $formData = array_filter($request->formData);
            $rowId = $request->rowId;
            $options = Cart::get($request->rowId)->options;
            $options['features'] = $formData;
            $cart = Cart::update($rowId, [
                'price' => $request->result,
            ]);
            $total = Cart::total();
            return response()->json([$cart, $total]);
        }
    }

    public function remove(Request $request)
    {
        $rowId = $request->id;
        Cart::remove($rowId);
        return back();
    }
}
