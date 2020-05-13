<?php

namespace App\Http\Controllers\web;


use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductColorDescription;
use App\Models\ProductDescription;
use App\Models\ProductPrice;
use App\ProductLens;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
//use Validator;

class CartController extends Controller
{

    public function cart() {
        $carts = \Cart::getContent();
        $count = 0;
        return view('web.cart.cart', compact('carts','count'));
    }
    public function addToCart(Request $request) {
        if(request()->cookie('code') != null){
            $countries = \Illuminate\Support\Facades\DB::table('countries')
                ->where('iso_code',request()->cookie('code'))->first();
        }else{
            $countries = \Illuminate\Support\Facades\DB::table('countries')
                ->first();
        }

        $country = DB::table('countries')->where('iso_code', $countries->iso_code)->first();
        $convert = getRate($country->iso_code);
        if ($request->ajax()){
            if($request->qty != null) {
                if($request->product_type == 'sunglass') {
                    $product = Product::leftJoin('product_price','product_price.product_id','products.id')
                        ->where('products.id',$request->product_id)
                        ->where('product_price.country_id',$countries->id)
                        ->select('products.*','product_price.price as Price','product_price.quantity as max_count','product_price.size','product_price.discount')
                        ->first();

                    if($request->qty > $product->max_count) {
                        return 'false';
                    } elseif($request->qty >= $product->max_count) {
                        return 'false';
                    }

                    if($product->max_count == 0) {
                        return 'false';
                    } elseif($product->max_count > 0) {
                        if ($product->discount != null) {
                            $price = $product->Price - $product->discount;
                        } else {
                            $price = $product->Price;
                        }
                        $product_detail = ProductDescription::where('language_id','=',getLang(session('lang')))->where('product_id', $product->id)->first();
                        DB::beginTransaction();
                        try {
                            $add = \Cart::add(array('id' => $product->id, 'name' => $product_detail->name, 'quantity' => $request->qty, 'price' => $price, 'attributes' => ['description' => $product_detail->description, 'max_count' => $product->max_count,'image'=> $product->main_image,'type' => $product->product_type,'currency' => $convert->code]));
                            $cart = \Cart::getContent();
                            foreach ($cart as $item) {
                                if($item->quantity > $product->max_count) {
                                    return 'false';
                                } elseif($item->quantity >= $product->max_count) {
                                    return 'false';
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
                } elseif($request->product_type == 'glasses') {
                    $product = Product::leftJoin('product_price','product_price.product_id','products.id')
                        ->where('products.id',$request->product_id)
                        ->where('product_price.country_id',$countries->id)
                        ->select('products.*','product_price.price as Price','product_price.quantity as max_count','product_price.size','product_price.discount')
                        ->first();

                    if($request->qty > $product->max_count) {
                        return 'false';
                    } elseif($request->qty >= $product->max_count) {
                        return 'false';
                    }

                     $product_price  = $product->price();
                    if($request->glasses_lens != null) {
                        $glasses_lens = ProductLens::leftJoin('tbl_lenses','tbl_lenses.id','product_lenses.lens_id')->where('product_lenses.lens_id',$request->glasses_lens)->first()->name;
                    } else {
                        $glasses_lens = null;
                    }

                    if($product_price->quantity <= 0) {
                        return 'false';
                    }


                    //  dd($product_price);
                        if ($product_price->discount != null) {

                            $price = $product_price->price - $product->discount;
                        } else {
                            $price = $product_price->price;
                        }
                        $product_detail = ProductDescription::where('language_id','=',getLang(session('lang')))->where('product_id', $product->id)->first();
                        DB::beginTransaction();
                        try
                        {

                           // echo $product->price.$product->id."ppppppppp";
                            $params =array(
                                'id' => $product->id,
                                'name' => $product_detail->name,
                                'quantity' => $request->qty,
                                'price' => $request->price,
                                'attributes' => [
                                    'description' => $product_detail->description,
                                    'max_count' => $product->max_count,
                                    'image'=> $product->main_image,
                                    'type' => $product->product_type,
                                    'right_size' => $request->rs,
                                    'left_size' => $request->ls,
                                    'right_cylinder' => $request->rcyl,
                                    'left_cylinder' => $request->lcyl,
                                    'right_axis' => $request->ra,
                                    'left_axis' => $request->la,
                                    'pd' => $request->pd,
                                    'lense_type' => $glasses_lens,
                                    'currency' => $convert->code
                                ]);
                        // dd($params);
                            $add = \Cart::add($params);
                            $cart = \Cart::getContent();
                            foreach ($cart as $item) {
                                if($item->quantity > $product->max_count) {
                                    return 'false';
                                } elseif($item->quantity >= $product->max_count) {
                                    return 'false';
                                }
                            }
                            DB::commit();
                        }
                        catch (\Exception $e) {
                                                        DB::rollBack();

                            return "false";
                            return $e->getMessage();
                        }
                        $add;
                        $cart;
                        $count = count(\Cart::getContent());
                        $total = \Cart::getTotal();
                        return response()->json([$cart, $count, $total]);

                } elseif($request->product_type == 'lenses') {
                    $product = Product::leftJoin('product_price','product_price.product_id','products.id')
                        ->where('products.id',$request->product_id)
                        ->where('product_price.country_id',$countries->id)
                        ->select('products.*','product_price.price as Price','product_price.quantity as max_count','product_price.size','product_price.discount')
                        ->first();

                    if($request->qty > $product->max_count) {
                        return 'false';
                    } elseif($request->qty >= $product->max_count) {
                        return 'false';
                    }

                    if($request->color != null) {
                        $color = ProductColor::where('id',$request->color)->first('color');
                        $color_name = ProductColorDescription::where('product_color_id', $request->color)->where('language_id',checknotsessionlang())->first()->name;
                    } else {
                        $color = null;
                        $color_name = null;
                    }
                    if($request->pack != null) {
                        $pack = ProductPrice::where('id',$request->pack)->first()->size;
                    } else {
                        $pack = null;
                    }
                    if($product->max_count == 0) {
                        return 'false';
                    } elseif($product->max_count > 0) {
                        $product_detail = ProductDescription::where('language_id','=',checknotsessionlang())->where('product_id', $product->id)->first();
                        DB::beginTransaction();
                        try {
                            $params =array(
                                'id' => $product->id,
                                'name' => $product_detail->name,
                                'quantity' => $request->qty,
                                'price' => $request->price,
                                'attributes' => [
                                    'description' => $product_detail->description,
                                    'max_count' => $product->max_count,
                                    'image'=> $product->main_image,
                                    'type' => $product->product_type,
                                    'right_size' => $request->rs,
                                    'left_size' => $request->ls,
                                    'right_cylinder' => $request->rcyl,
                                    'left_cylinder' => $request->lcyl,
                                    'right_axis' => $request->ra,
                                    'left_axis' => $request->la,
                                    'auto_reorder' => $request->auto_reorder,
                                    'color' => $color,
                                    'color_name' => $color_name,
                                    'package' => $pack,
                                    'currency' => $convert->code
                                ]);
                            $add = \Cart::add($params);
                            $cart = \Cart::getContent();
                            foreach ($cart as $item) {
                                if($item->quantity > $product->max_count) {
                                    return 'false';
                                } elseif($item->quantity >= $product->max_count) {
                                    return 'false';
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
            } else {
                if($request->product_type == 'sunglass') {
                    $product = Product::leftJoin('product_price','product_price.product_id','products.id')
                        ->where('products.id',$request->product_id)
                        ->where('product_price.country_id',$countries->id)
                        ->select('products.*','product_price.price as Price','product_price.quantity as max_count','product_price.size','product_price.discount')
                        ->first();

                    if($request->qty > $product->max_count) {
                        return 'false';
                    } elseif($request->qty >= $product->max_count) {
                        return 'false';
                    }

                    if($product->max_count == 0) {
                        return 'false';
                    } elseif($product->max_count > 0) {
                        if ($product->discount != null) {
                            $price = $product->Price - $product->discount;
                        } else {
                            $price = $product->Price;
                        }
                        $product_detail = ProductDescription::where('language_id','=',getLang(session('lang')))->where('product_id', $product->id)->first();
                        DB::beginTransaction();
                        try {
                            $add = \Cart::add(array('id' => $product->id, 'name' => $product_detail->name, 'quantity' => 1, 'price' => $price, 'attributes' => ['description' => $product_detail->description, 'max_count' => $product->max_count,'image'=> $product->main_image,'type' => $product->product_type,'currency' => $convert->code]));
                            $cart = \Cart::getContent();
                            foreach ($cart as $item) {
                                if($item->quantity > $product->max_count) {
                                    return 'false';
                                } elseif($item->quantity >= $product->max_count) {
                                    return 'false';
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
                } elseif($request->product_type == 'glasses') {
                    $product = Product::leftJoin('product_price','product_price.product_id','products.id')
                        ->where('products.id',$request->product_id)
                        ->where('product_price.country_id',$countries->id)
                        ->select('products.*','product_price.price as Price','product_price.quantity as max_count','product_price.size','product_price.discount')
                        ->first();
                    if($request->qty > $product->max_count) {
                        return 'false';
                    } elseif($request->qty >= $product->max_count) {
                        return 'false';
                    }

                    $product_price  = $product->price();
                    if($request->glasses_lens != null) {
                        $glasses_lens = ProductLens::leftJoin('tbl_lenses','tbl_lenses.id','product_lenses.lens_id')->where('product_lenses.lens_id',$request->glasses_lens)->first()->name;
                    } else {
                        $glasses_lens = null;
                    }

                    if($product_price->quantity <= 0) {
                        return 'false';
                    }


                    //  dd($product_price);
                    if ($product_price->discount != null) {

                        $price = $product_price->price - $product->discount;
                    } else {
                        $price = $product_price->price;
                    }
                    $product_detail = ProductDescription::where('language_id','=',getLang(session('lang')))->where('product_id', $product->id)->first();
                    DB::beginTransaction();
                    try
                    {

                        // echo $product->price.$product->id."ppppppppp";
                        $params =array(
                            'id' => $product->id,
                            'name' => $product_detail->name,
                            'quantity' => 1,
                            'price' => $price,
                            'attributes' => [
                                'description' => $product_detail->description,
                                'max_count' => $product->max_count,
                                'image'=> $product->main_image,
                                'type' => $product->product_type,
                                'right_size' => $request->rs,
                                'left_size' => $request->ls,
                                'right_cylinder' => $request->rcyl,
                                'left_cylinder' => $request->lcyl,
                                'right_axis' => $request->ra,
                                'left_axis' => $request->la,
                                'pd' => $request->pd,
                                'lense_type' => $glasses_lens,
                                'currency' => $convert->code
                            ]);
                        // dd($params);
                        $add = \Cart::add($params);
                        $cart = \Cart::getContent();
                        foreach ($cart as $item) {
                            if($item->quantity > $product->max_count) {
                                return 'false';
                            } elseif($item->quantity >= $product->max_count) {
                                return 'false';
                            }
                        }
                        DB::commit();
                    }
                    catch (\Exception $e) {
                        DB::rollBack();

                        return "false";
                        return $e->getMessage();
                    }
                    $add;
                    $cart;
                    $count = count(\Cart::getContent());
                    $total = \Cart::getTotal();
                    return response()->json([$cart, $count, $total]);

                } elseif($request->product_type == 'lenses') {
                    $product = Product::leftJoin('product_price','product_price.product_id','products.id')
                        ->where('products.id',$request->product_id)
                        ->where('product_price.country_id',$countries->id)
                        ->select('products.*','product_price.price as Price','product_price.quantity as max_count','product_price.size','product_price.discount')
                        ->first();

                    if($request->qty > $product->max_count) {
                        return 'false';
                    } elseif($request->qty >= $product->max_count) {
                        return 'false';
                    }

                    if($request->color != null) {
                        $color = ProductColor::where('id',$request->color)->first('color');
                        $color_name = ProductColorDescription::where('product_color_id', $request->color)->where('language_id',checknotsessionlang())->first()->name;
                    } else {
                        $color = null;
                        $color_name = null;
                    }
                    if($request->pack != null) {
                        $pack = ProductPrice::where('id',$request->pack)->first()->size;
                    } else {
                        $pack = null;
                    }
                    if($product->max_count == 0) {
                        return 'false';
                    } elseif($product->max_count > 0) {
                        $product_detail = ProductDescription::where('language_id','=',checknotsessionlang())->where('product_id', $product->id)->first();
                        DB::beginTransaction();
                        try {
                            $params = array(
                                'id' => $product->id,
                                'name' => $product_detail->name,
                                'quantity' => 1,
                                'price' => $request->price,
                                'attributes' => [
                                    'description' => $product_detail->description,
                                    'max_count' => $product->max_count,
                                    'image'=> $product->main_image,
                                    'type' => $product->product_type,
                                    'right_size' => $request->rs,
                                    'left_size' => $request->ls,
                                    'right_cylinder' => $request->rcyl,
                                    'left_cylinder' => $request->lcyl,
                                    'right_axis' => $request->ra,
                                    'left_axis' => $request->la,
                                    'auto_reorder' => $request->auto_reorder,
                                    'color' => $color,
                                    'color_name' => $color_name,
                                    'package' => $pack,
                                    'currency' => $convert->code
                                ]);
                            $add = \Cart::add($params);
                            $cart = \Cart::getContent();
                            foreach ($cart as $item) {
                                if($item->quantity > $product->max_count) {
                                    return 'false';
                                } elseif($item->quantity >= $product->max_count) {
                                    return 'false';
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

