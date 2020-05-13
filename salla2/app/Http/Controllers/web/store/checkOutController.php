<?php

namespace App\Http\Controllers\web\store;

use App\Bll\Discount;
use App\Bll\MyFatoorah;
use App\Bll\Utility;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\countries;
use App\Models\OrderProductItem;
use App\Models\product\bank_transfer;
use App\Models\product\features;
use App\Models\product\order_products;
use App\Models\product\orders;
use App\Models\product\product_details;
use App\Models\product\products;
use App\Models\product\Shipping;
use App\Models\product\stores;
use App\Models\product\transaction_types;
use App\Models\product\transactions;
use App\Models\Product_card;
use App\Notifications\orderAdmin;
use App\Notifications\TemplateEmail;
use App\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Xinax\LaravelGettext\Facades\LaravelGettext;

class checkOutController extends Controller
{
    public function checkout()
    {
        $storeOptions = Utility::storeOptions(\App\Bll\Utility::getStoreId())->first();
        if ($storeOptions != null) {
            if ($storeOptions->order_accept == 0) {
                return redirect()->back()->with('error', _i('Not Available'));
            }
        }
        $store = stores::findOrFail(\App\Bll\Utility::getStoreId());
        if (auth()->check()) {
            $cart_content = Cart::content();
            $countries = countries::leftJoin('countries_data', 'countries_data.country_id', 'countries.id')
                ->where('countries_data.lang_id', getLang(LaravelGettext::getLocale()))
                ->select('countries.id as id', 'countries_data.title')
                ->pluck('title', 'id');
            $cities = DB::table("cities")
                ->leftJoin('city_datas', 'city_datas.city_id', 'cities.id')
                ->where('city_datas.lang_id', getLang(LaravelGettext::getLocale()))
                ->pluck("city_datas.title", "cities.id");
            $payments = DB::table('transaction_types')->where('store_id', $store->id)->get();
            $orderNumber = orders::where('store_id', $store->id)
                ->orderBy('id', 'desc')->first();
            if ($orderNumber) {
                $number = $orderNumber['ordernumber'] + 1;
            } else {
                $number = 1;
            }
            $categoriesnav = Category::where('lang_id', getLang(LaravelGettext::getLocale()))->where('store_id', $store->id)->get();
            $banks = bank_transfer::where('lang_id', getLang(LaravelGettext::getLocale()))->where('store_id', $store->id)->pluck('title', 'id');
            $allbanks = bank_transfer::where('lang_id', getLang(LaravelGettext::getLocale()))->where('store_id', $store->id)->get();
            return view('store.checkout.create', compact('countries', 'cities', 'payments', 'number', 'categoriesnav', 'store', 'banks', 'allbanks'));
        } else {
            return redirect(route('signin', app()->getLocale()));
        }
    }

    public function getCityList(Request $request)
    {
        $cities = DB::table("cities")
            ->leftJoin('city_datas', 'city_datas.city_id', 'cities.id')
            ->where('city_datas.lang_id', getLang(LaravelGettext::getLocale()))
            ->where("cities.country_id", $request->country_id)
            ->pluck("city_datas.title", "cities.id");
        return response()->json($cities);
    }

    public function getDiscount(Request $request)
    {
        $store = stores::findOrFail(\App\Bll\Utility::getStoreId());
        $code = $request->code;
        $result = Discount::checkDiscount($code, $store->id);
//        dd($result);
        return response()->json($result);
    }

    public function getBankDetails(Request $request)
    {
        if ($request->ajax()) {
            $store = stores::findOrFail(\App\Bll\Utility::getStoreId());

            $shippingOption = DB::table('shipping_options')
                ->where('shipping_options.store_id', $store->id)
                ->where('shipping_options.lang_id', getLang(LaravelGettext::getLocale()))
                ->leftJoin('cities_shipping_options', 'cities_shipping_options.shipping_option_id', 'shipping_options.id')
                ->leftJoin('shipping_companies', 'shipping_companies.id', 'shipping_options.company_id')
                ->where('cities_shipping_options.city_id', $request->city)
                ->where('shipping_options.country_id', $request->country)
                ->get();
            return view('store.checkout.details', compact('shippingOption'));
        }
    }

    public
    function getShipCost(Request $request)
    {
        if ($request->ajax()) {
            $store = stores::findOrFail(\App\Bll\Utility::getStoreId());
            $payment = transaction_types::where('id', $request->payment)->where('store_id', $store->id)->where('lang_id', getLang(LaravelGettext::getLocale()))->first();
            if ($payment['status'] == 'without') {
                $shippingOption = DB::table('shipping_options')->where('store_id', $store->id)->where('lang_id', getLang(LaravelGettext::getLocale()))->where('id', $request->ship_id)->first();
                $ship = $shippingOption->cash_delivery_commission + $shippingOption->cost;
                return response()->json($ship);
            } elseif ($payment['status'] == 'bank') {
                $shippingOption = DB::table('shipping_options')->where('store_id', $store->id)->where('lang_id', getLang(LaravelGettext::getLocale()))->where('id', $request->ship_id)->first();
                $ship = $shippingOption->cost;
                return response()->json($ship);
            }
        }
    }

    public function saveallorders(Request $request)
    {
        $storeOptions = Utility::storeOptions(\App\Bll\Utility::getStoreId())->first();
        if ($storeOptions != null) {
            if ($storeOptions->order_accept == 0) {
                return redirect()->back()->with('error', _i('Not Available'));
            }
        }
        $store = stores::findOrFail(\App\Bll\Utility::getStoreId());
        if ($request->payment == 'bank') {
            $this->validate($request, [
                'city_id' => 'required',
                'address' => 'required',
                'shippingOption' => 'required',
                'bank' => 'required',
                'bank_transactions_num' => 'required',
                'holder_name' => 'required',
                'image' => 'required|image',
            ]);
        } else {
            $this->validate($request, [
                'city_id' => 'required',
                'address' => 'required',
                'shippingOption' => 'required',
            ]);
        }

        $shippingOption = $request->shippingOption;
        $ordernumber = $request->ordernumber;
        $products = $request->product;
        $user_id = auth()->guard(\App\Help\Utility::Web)->user()->id;
        $country_id = $request->country_id;
        $city_id = $request->city_id;
        $phone = $request->phone;
        $neighborhood = $request->neighborhood;
        $street = $request->street;
        $address = $request->address;
        $code = $request->code;
        $payment = $request->payment;
        $payment_id = $request->payment_id;
        $bank = $request->bank;
        $total = $request->total;
        $bank_transactions_num = $request->bank_transactions_num;
        $shipping_cost = $request->shipping_cost;
        $discount_id = $request->discount_id;
        $discount_cost = $request->discount_cost;
        $discount_code = $request->discount_code;

        session()->put('orderNumber', $ordernumber);

        $paymentMethodId = session()->get('PaymentMethodId');  //to check if user paid or not
        $invoiceId = session()->get('InvoiceId');  //to check if user paid or not


        if ($discount_code != null) {
            Discount::getDiscount($discount_code, $store->id);
        }

        $total = str_replace(',', '', $total);
        $image = $request->image;


        if ($ordernumber != null && $user_id != null) {
            DB::beginTransaction();
            try {
                $order = orders::create(['user_id' => $user_id, 'ordernumber' => $ordernumber, 'total' => $total, 'store_id' => $store->id, 'shipping_option_id' => $shippingOption, 'shipping_cost' => $shipping_cost, 'discount_id' => $discount_id, 'discount' => $discount_cost]);

                foreach ($products as $key => $product) {
                    $pro = product_details::where('product_id', $product)->where('source_id', null)->first();
                    $id = $pro->product->id;
                    $cart = Cart::search(function ($cartItem, $rowId) use ($id) {
                        return $cartItem->id == $id;
                    })->first();
//                    dd($cart, $id);
                    $productUpdate = products::where('id', $id)->where('store_id', $store->id)->first();
                    $productUpdate->update(['max_count' => $productUpdate->max_count - $request->input('count_' . $id)]);
                    $order_product[$id] = order_products::create([
                        'product_id' => $id,
                        'order_id' => $order->id,
                        'count' => $request->input('count_' . $id),
                        'price' => $request->input('price_' . $id),
                        'description' => json_encode($cart->options)
                    ]);

//                    dd($cart, $order_product[$id],$order_product);
                    if ($cart->id == $id) {
                        if ($cart->options->product_type == 'cards') {
                            $product_card = Product_card::where('product_id', $cart->id)->where('is_active', '!=', 1)->first();
                            $order_product_items = OrderProductItem::create([
                                'order_product_id' => $order_product[$id]->id,
                                'item_id' => $product_card->id,
                                'product_type_code' => $cart->options->product_type,
                            ]);
                            $product_card->update(['is_active' => 1]);
                        } elseif ($cart->options->features != null) {
                            foreach ($cart->options->features as $index => $value) {
                                $feature = features::leftJoin('feature_options', 'feature_options.feature_id', 'features.id')
                                    ->where('features.id', $index)
                                    ->where('feature_options.id', $value)
                                    ->first();
                                $order_product_items = OrderProductItem::create([
                                    'order_product_id' => $order_product[$id]->id,
                                    'item_id' => $value,
                                    'product_type_code' => $cart->options->product_type,
                                ]);
                                $feature->update(['count' => $feature->count - $request->input('count_' . $id)]);
                            }
                        }
                    }
                }

                if ($image) {
                    $numberrand = rand(11111, 99999);
                    $randname = time() . $numberrand;
                    $imageName = $randname . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/payment'), $imageName);
                }

                $shipping = Shipping::create([
                    'country_id' => $country_id,
                    'city_id' => $city_id,
                    'order_id' => $order['id'],
                    'Neighborhood' => $neighborhood,
                    'street' => $street,
                    'address' => $address,
                    'code' => $code
                ]);

                if ($payment != null) {
                    if ($payment == 'bank') {
                        $transaction = transactions::create([
                            'holder_name' => $request->holder_name,
                            'order_id' => $order->id,
                            'type_id' => null,
                            'type' => $payment,
                            'status' => 'pending',
                            'store_id' => $store->id,
                            'bank_id' => $bank,
                            'bank_transactions_num' => $bank_transactions_num,
                            'image' => '/uploads/payment/' . $imageName
                        ]);
                    } elseif ($payment == 'delivery') {
                        $transaction = transactions::create([
                            'order_id' => $order->id,
                            'type_id' => null,
                            'type' => $payment,
                            'status' => 'pending',
                            'store_id' => $store->id,
                        ]);
                    } elseif ($payment == 'online') {
                        if ($paymentMethodId != null && $invoiceId != null) {
                            $transaction = transactions::create([
                                'order_id' => $order->id,
                                'type_id' => $payment_id,
                                'type' => $payment,
                                'status' => 'paid',
                                'store_id' => $store->id,
                            ]);
                        } else {
                            return back()->with('failure', _i('Please Pay First with Myfatoorah'));
                        }
                    }
                }
                DB::commit();
            } catch (\Exception $e) {

                DB::rollBack();
                error_log($e->getMessage());
                return $e;

            }
            $order;
            $order_product;
            $shipping;
            $transaction;

        }
//        $user_id = User::findOrFail(auth()->user()->id);
//        $admins = Admin::where('guard', 'admin')->get();
        $order = orders::where('ordernumber', $ordernumber)->first();
        $user = auth()->user();
        if ($phone != null) {
            $user->phone = $phone;
            $user->save();
        }
//        if ($cash_delivery_commission != null){
//            $user->notify(new TemplateEmail($ordernumber,$total,$cost + $cash_delivery_commission,auth()->user()));
//            foreach ($admins as $admin) {
//                $admin->notify(new orderAdmin($ordernumber,$total,$cost + $cash_delivery_commission,auth()->user()));
//            }
//        }else{
//            $user->notify(new TemplateEmail($ordernumber,$total,$cost,auth()->user()));
//            foreach ($admins as $admin) {
//                $admin->notify(new orderAdmin($ordernumber, $total, $cost, auth()->user()));
//            }
//        }
//        Notification::send($admins, new \App\Notifications\orders($user_id->name,$order->ordernumber,$order->id));
        return redirect()->route('invoice', app()->getLocale());
    }

    public function invoice()
    {
//        $user_id = auth()->user()->id;
        DB::table('abandoned_carts')->where('user_id', auth()->user()->id)->delete();
        $order = orders::where('ordernumber', session('orderNumber'))->first();
        $payment = transactions::where('order_id', $order->id)->first();
        $address = Shipping::where('order_id', $order->id)->first();
        Cart::destroy();
        session()->forget('orderNumber');
        session()->forget('PaymentMethodId');
        session()->forget('InvoiceId');
        return view('store.checkout.invoice', compact('order', 'payment', 'address'));
    }

    public
    function confirm()
    {
        $user_id = User::findOrFail(auth()->user()->id);
        $order = orders::where('ordernumber', session('orderNumber'))->first();
        Cart::destroy();
        session()->forget('orderNumber');
        session()->forget('PaymentMethodId');
        session()->forget('InvoiceId');
        return redirect(route('store.home'));
    }


    public function bankDetails(Request $request)
    {
        if ($request->ajax()) {
            $bank = bank_transfer::findOrFail($request->bank_id);
            return view('store.checkout.bank', compact('bank'));
        }
    }

    public function myfatoorah(Request $request)
    {
        $storeOptions = Utility::storeOptions(\App\Bll\Utility::getStoreId())->first();
        if ($storeOptions != null) {
            if ($storeOptions->order_accept == 0) {
                return redirect()->back()->with('error', _i('Not Available'));
            }
        }
        $currency = $request->currency_myfatoorah;
        if ($request->discount_cost_myfatoorah != null) {
            $discount = $request->discount_cost_myfatoorah;
        } else {
            $discount = 0;
        }
        $price = $request->price_myfatoorah + $request->shipping_cost_myfatoorah - $discount;

        $user = auth()->user();

        $resultInitPayment = MyFatoorah::initializePayment($price, $currency);
        $resultInitPaymentdecode = json_decode($resultInitPayment);
        return view('store.checkout.pay', ["resultInitPaymentdecode" => $resultInitPaymentdecode, "user" => $user, 'currency' => $currency, 'price' => $price]);
    }

    public function execute_payment(Request $request)
    {
        $storeOptions = Utility::storeOptions(\App\Bll\Utility::getStoreId())->first();
        if ($storeOptions != null) {
            if ($storeOptions->order_accept == 0) {
                return redirect()->back()->with('error', _i('Not Available'));
            }
        }
        $user = json_decode($request->user);
        $params = [];
        $params['PaymentMethodId'] = $request->paymentmethod_id;
        $params['CustomerName'] = $user->name . ' ' . $user->lastname;
        $params['DisplayCurrencyIso'] = $request->currency;
        $params['CustomerMobile'] = $user->phone;
        $params['CustomerEmail'] = $user->email;
        $params['InvoiceValue'] = $request->price;
        $params['CallBackUrl'] = route('myfatoorah.finish', app()->getLocale());
        $params['ErrorUrl'] = MyFatoorah::$errorUrl;
        $params['language'] = \App\Bll\Utility::lang();
        $params['CustomerReference'] = "cart_" . $user->id;
        $params['InvoiceItems'][0]['itemName'] = $user->name . ' ' . $user->lastname;
        $params['InvoiceItems'][0]['Quantity'] = 1;
        $params['InvoiceItems'][0]['UnitPrice'] = $request->price;

        $resultExecPayment = MyFatoorah::ExecutePayment($params);
        $resultExecPaymentdecode = json_decode($resultExecPayment);
        if ($resultExecPaymentdecode->IsSuccess) {
            session()->put('PaymentMethodId', $request->paymentmethod_id); //to check if user paid or not
            session()->put('InvoiceId', $resultExecPaymentdecode->Data->InvoiceId); //to check if user paid or not
            $data = $resultExecPaymentdecode->Data;
            $PaymentURL = $data->PaymentURL;
            return redirect($PaymentURL);
            $return = MyFatoorah::directPayment(["paymentType" => "card",
                "card" => ["Number" => "5123450000000008",
                    "expiryMonth" => "05",
                    "expiryYear" => "21",
                    "securityCode" => "100"]], $PaymentURL);
            echo($return);
        }
//        return redirect()->back()->with("error", "Payment gateway error");
        //$request->session()->put('resultExecPaymentdecode', $resultExecPaymentdecode);
    }

    public function myfatoorahFinish()
    {
        return view('store.checkout.myfatoorah_finish');
    }

}
