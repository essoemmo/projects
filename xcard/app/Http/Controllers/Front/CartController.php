<?php

namespace App\Http\Controllers\Front;


use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function cart() {
        $cart = \Cart::getContent();
//        dd($cart);
        $count = 0;
        return view('front.cart.cart', compact('cart','count'));
    }

    public function addToCart(Request $request) {
        if ($request->ajax()){
            $product = Product::select('products_translations.title as title','products_translations.description as description','products.id as id','products.price as price','products.quantity as max_count','products.main_image as main_image')
                ->leftJoin('products_translations','products_translations.product_id','=','products.id')->where('locale',App::getLocale())->where('products.id', $request->product_id)->first();
            if($product->max_count == 0) {
                return 'false';
            } elseif($product->max_count > 0) {
                $price = $product->price;
                DB::beginTransaction();
//                    dd($price);
                try {
                    $add = \Cart::add(array('id' => $product->id, 'name' => $product->title, 'quantity' => 1, 'price' => $price, 'attributes' => ['description' => $product->description, 'max_count' => $product->max_count,'image'=> $product->main_image, 'code' => currency()->code]));
                    $cart = \Cart::getContent();
                    foreach ($cart as $item) {
                        if($item->quantity > $product->max_count) {
                            $item->quantity = $product->max_count;
                        }
                    }
                    DB::commit();
                } catch (\Exception $e) {
                    return $e->getMessage();
                    DB::rollBack();
                }
                $add;
                $cart;
                $count = count(\Cart::getContent());
                $total = \Cart::getTotal();
                return response()->json([$cart, $count, $total]);
            }
        }
    }

    public function buyNow($id) {
        $product = Product::select('products_translations.title as title','products_translations.description as description','products.id as id','products.price as price','products.quantity as max_count','products.main_image as main_image')
            ->leftJoin('products_translations','products_translations.product_id','=','products.id')->where('locale',App::getLocale())->where('products.id', $id)->first();
        if($product->max_count == 0) {
            return 'false';
        } elseif($product->max_count > 0) {
            $price = $product->price;
            DB::beginTransaction();
            try {
                $add = \Cart::add(array('id' => $product->id, 'name' => $product->title, 'quantity' => 1, 'price' => $price, 'attributes' => ['description' => $product->description, 'max_count' => $product->max_count,'image'=> $product->main_image, 'code' => currency()->code]));
                $cart = \Cart::getContent();
                foreach ($cart as $item) {
                    if($item->quantity > $product->max_count) {
                        $item->quantity = $product->max_count;
                    }
                }
                DB::commit();
            } catch (\Exception $e) {
                return $e->getMessage();
                DB::rollBack();
            }
            $add;
            $cart;
            $count = count(\Cart::getContent());
            $total = \Cart::getTotal();
            return redirect(route('cart'));
        }
    }

    public function update(Request $request) {
        if($request->ajax()) {
            $rowId = $request->rowId;
            if($request->qty != null) {
                $update =  \Cart::update($rowId, array('quantity' => array(
                        'relative' => false,
                        'value' => $request->qty
                        ),
                    ));
                $cart = \Cart::getContent();
                $total = \Cart::getTotal();
                return response()->json([$cart,$total]);
            } else {
                return '';
            }
        }
    }

    public function remove(Request $request) {
        $rowId = $request->id;
        \Cart::remove($rowId);
        return redirect('cart');
    }
}

