<?php

namespace App\Http\Controllers\web;

use App\Models\bank_transfer;
use App\Models\cities;
use App\Models\Country;
use App\Models\discount_code;
use App\Models\OrderItem;
use App\Models\orders;
use App\Models\Product;
use App\Models\ProductDescription;
use App\Models\ProductPrice;
use App\Models\ShippingAddress;
use App\Models\Transaction;
use App\Models\transaction_types;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class checkOutController extends Controller
{
    public function checkout() {
        if(auth()->check()){
            $countries = Country::query()->leftJoin('country_descriptions' ,'country_descriptions.country_id','countries.id')
                ->where('country_descriptions.language_id',checknotsessionlang())
                //->pluck('country_descriptions.name','countries.id');
                ->select('countries.*','country_descriptions.name')->get();

            $countries = \App\Models\CountryDescription::where("language_id",getLang(session('lang')))->select("country_id as id","name")->get();
            $cities = cities::where('lang_id',checknotsessionlang())->pluck('title','id');
            $payments = DB::table('transaction_types')->get();
            $number = rand(1111111,9999999);
            return view('web.checkout.create',compact('countries','payments','number'));
        }
        else{
            return redirect('getweblogin');
        }
    }

    public function getCityList(Request $request)
    {
      $city_sources = cities::where("lang_id","=",getLang(session('lang')))->whereNotNull("source_id")->where("country_id",$request->country_id)->select("title", "source_id as id");
      $cities = cities::where("lang_id","=", getLang(session('lang')))->whereNull("source_id")->where("country_id",$request->country_id)->select("title","id")
              ->union($city_sources)->pluck("title","id");

       
        return response()->json($cities);
    }

    public function getDiscount(Request $request)
    {
        if($request->discount != null )
        {
            $discount = discount_code::where('code', $request->discount)->first();
            if($discount != null) {
                return response()->json($discount);
            } else {
                return response()->json(0);
            }
        } else {
            $discount = 0;
            return response()->json($discount);
        }
    }

    public function getBankDetails(Request $request)
    {
        if($request->ajax()) {
            $payment = transaction_types::where('id', $request->payment)->first();
            if($payment->status == 'bank') {
                $shippingOption = DB::table('shipping_options')->leftJoin('cities_shipping_options','cities_shipping_options.shipping_option_id','shipping_options.id')
                        ->leftJoin('shipping_companies','shipping_companies.id','shipping_options.company_id')->where('cities_shipping_options.city_id', $request->city)->where('shipping_options.country_id', $request->country)->get();
                $bank_with_sources = bank_transfer::where("lang_id","=",getLang(session('lang')))->whereNotNull("source_id")->select("title", "source_id as id");
                $banks = bank_transfer::where("lang_id","=", getLang(session('lang')))->whereNull("source_id")
                        ->select("title","id")->union($bank_with_sources)
                        ->pluck('title','id');
                
                return view('web.checkout.bank' ,compact('banks','shippingOption'));
            } elseif ($payment->status == 'without') {
                $shippingOption = DB::table('shipping_options')->leftJoin('cities_shipping_options','cities_shipping_options.shipping_option_id','shipping_options.id')->leftJoin('shipping_companies','shipping_companies.id','shipping_options.company_id')->where('cities_shipping_options.city_id', $request->city)->where('shipping_options.country_id', $request->country)->get();
                return view('web.checkout.details' ,compact('shippingOption'));

            }
        }
    }

    public function getShipCost(Request $request)
    {
        if($request->ajax()) {
            $payment = transaction_types::where('id', $request->payment)->first();
            if ($payment->status == 'without') {
                $shippingOption = DB::table('shipping_options')->where('id', $request->ship_id)->first();
                $ship = $shippingOption->cash_delivery_commission + $shippingOption->cost;
                return response()->json($ship);
            } elseif ($payment->status == 'bank') {
                $shippingOption = DB::table('shipping_options')->where('id', $request->ship_id)->first();
                $ship = $shippingOption->cost;
                return response()->json($ship);
            }
        }
    }

    public function saveallorders(Request $request) {

        $this->validate($request,[
            'city_id' => 'required',
            'neighborhood' => 'required',
            'address' => 'required',
            'street' => 'required',
            'code' => 'required',
        ]);
        $shippingOption = $request->shippingOption;
        $ordernumber = $request->ordernumber;
        $products = $request->product;
        $user_id = $request->user;
        $country_id = $request->country_id;
        $city_id = $request->city_id;
        $neighborhood = $request->neighborhood;
        $street = $request->street;
        $address = $request->address;
        $code = $request->code;
        $payment = $request->payment;
        $cash_delivery_commission = $request->cash_delivery_commission;
        $cost = $request->cost;
//        $counts = $request->count;
//        $prices = $request->price;
        $bank = $request->bank;
        $total = $request->total;
//        $types = $request->product_type;
        $bank_transactions_num = $request->bank_transactions_num;

        session()->put('orderNumber',$ordernumber);

        if(request()->cookie('code') != null){
            $country = \Illuminate\Support\Facades\DB::table('countries')
                ->where('iso_code',request()->cookie('code'))->first();
        }else{
            $country = \Illuminate\Support\Facades\DB::table('countries')
                ->first();
        }

        if($request->discount_code != null) {
            $discount = discount_code::where('code', $request->discount_code)->first();
            if($discount){
                if($discount->type != 0) {
                    $type = $discount->type - 1;
                    $discount->update([
                        'type' => $type,
                    ]);
                } else {
                    return redirect()->back()->with('failure' , _i('Discount Code Used Before'));
                }
            }

        }
        $payment_status = transaction_types::where('id' ,$payment)->first();
//        dd($request->all());

        $image = $request->image;
//        dd($request->file('image'));
        if ($ordernumber != null && $user_id != null){
            DB::beginTransaction();
            try{
                if ($cash_delivery_commission != null){
                    $order = orders::create(['user_id'=>$user_id,'ordernumber'=>$ordernumber,'total' => $total, 'shipping_option_id'=>$shippingOption,'shipping_cost'=> $cost + $cash_delivery_commission]);
                }else{
                    $order = orders::create(['user_id'=>$user_id,'ordernumber'=>$ordernumber,'total' => $total, 'shipping_option_id'=>$shippingOption,'shipping_cost'=>$cost]);
                }
                $order_items = [];
                foreach ($products as $product){
                    $pro = ProductDescription::where('language_id','=',checknotsessionlang())->where('product_id', $product)->first();
                    $id = $pro->product->id;
                    $productUpdate = ProductPrice::where('product_id',$id)->where('country_id',$country->id)->first();
                    $productUpdate->update(['quantity' => $productUpdate->quantity - $request->input('count_' . $id)]);
                    $cart = \Cart::get($id);
                        $order_items[] = OrderItem::create([
                            'order_id'=>$order->id,
                            'type' => $request->input('product_type_' . $id),
                            'type_id' => $id,
                            'description' => json_encode($cart->attributes),
                            'count'=>$request->input('count_' . $id),
                            'price'=>$request->input('price_' . $id)
                        ]);
                }
                if ($image) {
                    $numberrand = rand(11111, 99999);
                    $randname = time() . $numberrand;
                    $imageName = $randname . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/payment'), $imageName);
                }

                $shipping = ShippingAddress::create(['country_id'=>$country_id,'city_id'=>$city_id,'order_id'=>$order['id'],'Neighborhood'=>$neighborhood,'street'=>$street
                    ,'address'=>$address,'code'=>$code]);
                if($payment_status->status == 'bank') {
                    $transaction = Transaction::create(['holder_name'=>$request->holder_name,'order_id'=>$order->id, 'type_id' => $payment, 'status' => 'paid', 'bank_id' => $bank, 'bank_transactions_num' => $bank_transactions_num, 'image' => '/uploads/payment/'.$imageName]);
                } else {
                    $transaction = $order->transactions()->attach($payment,['status'=>'paid']);
                }
                DB::commit();
            }catch (\Exception $e){
                return $e;
                DB::rollBack();
            }
            $order;
            $order_items;
            $shipping;
            $transaction;
        }
        return redirect('invoice');
    }

    public function invoice() {
        if(request()->cookie('code') != null){
            $countries = \Illuminate\Support\Facades\DB::table('countries')
                ->where('iso_code',request()->cookie('code'))->first();
        }else{
            $countries = \Illuminate\Support\Facades\DB::table('countries')
                ->first();
        }

        $country = DB::table('countries')->where('iso_code', $countries->iso_code)->first();
        $convert = getRate($country->iso_code);
        $user_id = auth()->user()->id;
        $order = orders::where('ordernumber', session('orderNumber'))->first();
        $payment = Transaction::where('order_id', $order->id)->first();
        $address = ShippingAddress::where('order_id', $order->id)->first();
//        \Cart::clear();
//        session()->forget('orderNumber');

       // $html = view('web.mail', compact('order', 'payment', 'address','convert'))->render();
        $user =auth()->user() ;
        \Illuminate\Support\Facades\Mail::send('web.checkout.mail',compact('order', 'payment', 'address','convert'), function ($m) use ($user) {
            $m->from('support@qeyeq.com', 'QeyeQ Customer care');
            $m->bcc('support@qeyeq.com', 'support@qeyeq.com');
            $m->to($user->email, $user->name)->subject('Thanks for your order');
        });


//        ::send('web.checkout.mail', compact('order', 'payment', 'address','convert'), function($message) use($Subscribe,$templtedata,$attach) {
//
//                    \App\Models\Bll\Mail::sendemail($message,$Subscribe,$templtedata,$attach);
//            });

        return view('web.checkout.invoice', compact('order', 'payment', 'address','convert'));
    }

    public function confirm() {
        \Cart::clear();
        session()->forget('orderNumber');
        return redirect('/');
    }
}
