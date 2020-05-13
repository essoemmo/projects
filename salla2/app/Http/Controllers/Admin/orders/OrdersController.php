<?php

namespace App\Http\Controllers\Admin\orders;

use App\Bll\MyFatoorah;
use App\Bll\Utility;
use App\Http\Controllers\Controller;
use App\Models\countries;
use App\Models\Order_status;
use App\Models\Order_track;
use App\Models\product\bank_transfer;
use App\Models\product\order_products;
use App\Models\product\orders;
use App\Models\product\product_details;
use App\Models\product\product_photos;
use App\Models\product\products;
use App\Models\product\Shipping;
use App\Models\product\transaction_types;
use App\Models\product\transactions;
use App\Models\Product_type;
use App\Models\Shipping\Shipping_option;
use App\Notifications\AdminNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Notification;
use Yajra\DataTables\Facades\DataTables;

class OrdersController extends Controller
{

    public function index()
    {

        if (request()->ajax()) {

            $section = orders::query()->where("store_id", session("StoreId"));

            if (\request()->type2) {
                $section = transactions::query()
                    ->leftJoin('orders', 'orders.id', '=', 'transactions.order_id')
                    ->leftJoin('transaction_types', 'transaction_types.id', '=', 'transactions.type_id')
                    ->select('orders.id as id', 'orders.status as status', 'orders.ordernumber as ordernumber', 'orders.shipping_cost as shipping_cost')->where("transactions.store_id", session("StoreId"))->where('transactions.type_id', \request()->type2);
            }

            if (\request()->type3) {

                $section = orders::query()->select()->where('shipping_option_id', \request()->type3)->where("store_id", session("StoreId"));
            }

            if (\request()->type) {
                $section = orders::query()->where('status', \request()->type)->where("store_id", session("StoreId"));


            }
            return DataTables::eloquent($section)
                ->order(function ($query) {
                    $query->orderBy('status', 'asc');
                })
                ->addColumn('action', function ($section) {
                    return
                        '<div style="display: flex">' .
                        '<a href="' . $section->id . '/edit"
                    class="btn waves-effect waves-light btn-primary edit text-center btn-sm" title="' . _i("Edit") . '">
                    <i class="ti-pencil-alt"></i>
                                </a>'
                        . "&nbsp;&nbsp;&nbsp;" .

                        '<form action="' . url("adminpanel/orders/" . $section->id . "/delete") . '"  method="POST">
                   <input name="_method" type="hidden" value="DELETE">
                   <input type="hidden" name="_token" value="' . csrf_token() . '">
                   <button type="submit" class="btn btn-danger btn-sm"  title="' . _i("Delete") . '"> <span> <i class="ti-trash"></i></span></button>
                    </form>'
                        . "&nbsp;&nbsp;&nbsp;" .
                        '<a href="' . route('show_orders', $section->id) . '" target="_blank"
                    class="btn waves-effect waves-light btn-success show text-center btn-sm" title="' . _i("Show") . '">
                    <i class="ti-eye"></i>
                                </a> </div>';
                })
                ->rawColumns([
                    'action',
                ])
                ->make(true);
        }

        $orderstatus = ['wait', 'refused', 'accepted', 'shipped', 'complete'];

        $transtransaction_types = transaction_types::where("store_id", session("StoreId"))->get();

        $shipping_option = Shipping_option::where("store_id", session("StoreId"))->get();

        return view('admin.orders.index', ['transtransaction_types' => $transtransaction_types, 'shipping_option' => $shipping_option, 'orderstatus' => $orderstatus]);


    }

    public function show()
    {

        $number = rand(1111111, 9999999);
        $users = User::where('guard', 'web')->where('store_id', \App\Bll\Utility::getStoreId())->get();
        $countries = countries::leftJoin('countries_data', 'countries_data.country_id', 'countries.id')
            ->where('countries_data.source_id', null)
            ->select('countries.id as id', 'countries_data.title')
            ->pluck('title', 'id');
        $product_type = Product_type::where('store_id', \App\Bll\Utility::getStoreId())->get();

        $products = products::leftJoin('product_details', 'products.id', '=', 'product_details.product_id')
            ->where('store_id', \App\Bll\Utility::getStoreId())
            ->select(['products.*', 'product_details.title', 'product_details.description', 'product_details.product_id as product_id', 'product_details.lang_id'])
            ->get();

        $banks = bank_transfer::where('store_id', \App\Bll\Utility::getStoreId())->pluck('title', 'id');

        foreach ($products as $product) {
            $product['product_photos'] = product_photos::where('product_id', $product->id)->get();
        }

//        $products = product_details::
//            with(['product'=>function ($query){
//            $query->where('store_id',\App\Bll\Utility::getStoreId());
//            $query->with(['product_photos'=>function($q){
//                $q->where('main',1);
//            }]);
//            $query->with(['features'=>function($q){
//                $q->with('options');
//            }]);
//        }])->get();

//        dd($products);
        $transtransaction_types = transaction_types::where('store_id', \App\Bll\Utility::getStoreId())->get();

        return view('admin.orders.create', compact('banks', 'product_type', 'number', 'users', 'countries', 'products', 'transtransaction_types'));
    }

    public function edit($id)
    {
        $order = orders::where('id', $id)->where('store_id', \App\Bll\Utility::getStoreId())->with('user')->with('store')->with('shipping_option')->with(['orderProducts' => function ($query) {
            $query->with('product');
        }])->with('features')->first();
        $transactions = transactions::where('order_id', $id)->where('store_id', \App\Bll\Utility::getStoreId())->first();
        if ($transactions == null) {
            $transactions = 0;
        }
        $number = $order->ordernumber;
        $address = Shipping::where('order_id', $id)->with('city')->with('country')->get();
        $address = $address->map(function ($query) {
            $query->countries = $query->country;
            return $query;
        });
        $address = $address->first();
        $users = User::where('guard', 'web')->where('store_id', \App\Bll\Utility::getStoreId())->get();
        $countries = countries::leftJoin('countries_data', 'countries_data.country_id', 'countries.id')
            ->where('countries_data.source_id', null)
            ->select('countries.id as id', 'countries_data.title')
            ->pluck('title', 'id');
        $product_type = Product_type::where('store_id', session()->get('StoreId'))->get();
        $products = product_details::with(['product' => function ($query) {
            $query->where('store_id', session('StoreId'));
            $query->with(['product_photos' => function ($q) {
                $q->where('main', 1);
            }]);
            $query->with(['features' => function ($q) {
                $q->with('options');
            }]);
        }])->get();
        $transtransaction_types = transaction_types::all();
        $banks = bank_transfer::where('store_id', \App\Bll\Utility::getStoreId())->pluck('title', 'id');
        return view('admin.orders.edit', compact('address', 'product_type', 'number', 'users', 'countries', 'products', 'transtransaction_types', 'order', 'transactions', 'banks'));
    }

    public function saveallorders(Request $request)
    {



        $sessionStore = session()->get('StoreId');

        if ($sessionStore == \App\Bll\Utility::$demoId) {
            return redirect()->back()->with('flash_message', _i('Added Successfully'));
        }

        $storeOptions = Utility::storeOptions(\App\Bll\Utility::getStoreId())->first();
        if ($storeOptions != null) {
            if ($storeOptions->order_accept == 0) {
                return redirect()->back()->with('error', _i('Not Available'));
            }
        }

        if ($request->shipping_option == null && $request->total == null) {
            return response()->json(['status' => 'failed']);

        } else {
            $shippingOption_id = $request->shipping_option;
            $ordernumber = $request->ordernumber;
            $store = (int)session('StoreId');
            $products = $request->product;
            $user_id = $request->user_id;
            if ($request->shipping_option != null) {
                $country_id = $request->countries;

//                $country_id = $country->country_id;
                $city_id = (int)$request->cities;
                $neighborhood = $request->neighborhood;
                $street = $request->street;
                $address = $request->address;
            }
            $code = $request->code;
            $payment_id = $request->paymentId;
            $totalPrice = (int)$request->totalprice;
            $payment = $request->payment;
            $bank = $request->bank;
            $total = $request->total;
            $bank_transactions_num = $request->bank_transactions_num;
            $shipping_cost = $request->shipping_cost;
            $image = $request->image;

            $paymentMethodId = session()->get('PaymentMethodId');  //to check if user paid or not
            $invoiceId = session()->get('InvoiceId');  //to check if user paid or not

            if ($ordernumber != null && $store != null && $user_id != null) {
                DB::beginTransaction();
                try {
                    if ($shippingOption_id != null) {
                        $shippingOption = Shipping_option::findOrFail($shippingOption_id);
                        $order = orders::create(['user_id' => $user_id, 'store_id' => $store, 'ordernumber' => $ordernumber, 'shipping_option_id' => $shippingOption->id, 'shipping_cost' => $shipping_cost, 'total' => $totalPrice]);
                    } else {
                        $order = orders::create(['user_id' => $user_id, 'store_id' => $store, 'ordernumber' => $ordernumber, 'shipping_option_id' => null, 'shipping_cost' => null, 'total' => $totalPrice]);
                    }

                    $order_product = [];

                    foreach ($products as $key => $product) {

                        $pro = product_details::where('product_id', $key)->first();
//                $id = $pro->product->id;
                        $productUpdate = products::where('id', $key)->first();

                        $productUpdate->update(['max_count' => DB::raw('max_count -' . $product['quantity'])]);
                        $order_product[] = order_products::create(['product_id' => $key, 'order_id' => $order->id, 'count' => $product['quantity'], 'price' => $productUpdate->price]);
//                if($product['option'] != null) { $order->features()->attach($product['option']['id']); }


                        $details = [
                            'id' => $order->id,
                            'product_id' => $key,
                            'title' => $pro->title,
                            'number' => $order->ordernumber,
                            'total' => $order->total,
                            'action' => 'Add',
                            'storename' => \App\Bll\Utility::getStoreName()
                        ];

                        Notification::send(auth()->guard('store')->user(), new AdminNotification($details));

                    }
                    if ($image) {
                        $numberrand = rand(11111, 99999);
                        $randname = time() . $numberrand;
                        $imageName = $randname . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('uploads/payment'), $imageName);
                    }
                    if ($shippingOption != null) {
                        $shipping = Shipping::create(['country_id' => $country_id, 'city_id' => $city_id, 'order_id' => $order['id'], 'Neighborhood' => $neighborhood, 'street' => $street
                            , 'address' => $address, 'code' => $code]);
                    }

                    if ($payment != null) {
                        if ($payment == 'bank') {
                            $transaction = transactions::create([
                                'holder_name' => $request->holder_name,
                                'order_id' => $order->id,
                                'type_id' => null,
                                'type' => $payment,
                                'status' => 'pending',
                                'store_id' => $store,
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
                                'store_id' => $store,
                            ]);
                        } elseif ($payment == 'online') {
                            if ($paymentMethodId != null && $invoiceId != null) {
                                $transaction = transactions::create([
                                    'order_id' => $order->id,
                                    'type_id' => $payment_id,
                                    'type' => $payment,
                                    'status' => 'paid',
                                    'store_id' => $store,
                                ]);
                            } else {
                                return back()->with('failure', _i('Please Pay First with Myfatoorah'));
                            }
                        }
                    }
                    DB::commit();
                } catch (\Exception $e) {
                    return $e;
                    DB::rollBack();
                }
                $order;
                $order_product;
                $shipping;
                $transaction;
            }

        }

        return response()->json(['status' => 'success', 'order' => $order]);
    }

    public function updateallorders(Request $request)
    {
        $sessionStore = session()->get('StoreId');

        if ($sessionStore == \App\Bll\Utility::$demoId) {
            return redirect()->back()->with('flash_message', _i('Added Successfully'));
        }

        $storeOptions = Utility::storeOptions(\App\Bll\Utility::getStoreId())->first();
        if ($storeOptions != null) {
            if ($storeOptions->order_accept == 0) {
                return redirect()->back()->with('error', _i('Not Available'));
            }
        }

        if ($request->shipping_option == null && $request->total == null) {
            return response()->json(['status' => 'failed']);

        } else {
            $shippingOption_id = $request->shipping_option;
            $ordernumber = $request->ordernumber;
            $order = orders::findOrFail($request->order_id);
            $products = $request->product;
            $user_id = $request->user_id;
            $store = (int)session('StoreId');
            if ($request->shipping_option != null) {
                $country_id = $request->countries;

//                $country_id = $country->country_id;
                $city_id = (int)$request->cities;
                $neighborhood = $request->neighborhood;
                $street = $request->street;
                $address = $request->address;
            }
            $code = $request->code;
            $payment_id = $request->paymentId;
            $totalPrice = (int)$request->totalprice;
            $payment = $request->payment;
            $bank = $request->bank;
            $total = $request->total;
            $bank_transactions_num = $request->bank_transactions_num;
            $shipping_cost = $request->shipping_cost;
            $image = $request->image;

            $paymentMethodId = session()->get('PaymentMethodId');  //to check if user paid or not
            $invoiceId = session()->get('InvoiceId');  //to check if user paid or not

            if ($ordernumber != null && $store != null && $user_id != null) {
                DB::beginTransaction();
                try {
                    if ($shippingOption_id != null) {
                        $shippingOption = Shipping_option::findOrFail($shippingOption_id);
                        $orderupdate = $order->update(['user_id' => $user_id, 'store_id' => $store, 'ordernumber' => $ordernumber, 'shipping_option_id' => $shippingOption->id, 'shipping_cost' => $shipping_cost, 'total' => $totalPrice]);
                    } else {
                        $orderupdate = $order->update(['user_id' => $user_id, 'store_id' => $store, 'ordernumber' => $ordernumber, 'shipping_option_id' => null, 'shipping_cost' => null, 'total' => $totalPrice]);
                    }
                    $order_product = [];
                    $ids = [];
                    $getOrderProduct = order_products::where('order_id', $order['id'])->get();

                    foreach ($products as $key => $product) {
                        $ids[] = $key;
                        $getOrderProduct = $getOrderProduct->map(function ($orderProduct) use ($product, $key, $order) {
                            if ($orderProduct['product_id'] == $key) {
                                $pro = product_details::where('product_id', $key)->first();
                                $id = $pro->product->id;
                                $productUpdate = products::where('id', $id)->first();
                                if ($orderProduct->count > $product['quantity']) {
                                    $minus = $orderProduct->count - $product['quantity'];
                                    $productUpdate->update(['max_count' => DB::raw('max_count +' . $minus)]);
                                } elseif ($orderProduct->count < $product['quantity']) {
                                    $minus = $product['quantity'] - $orderProduct->count;
                                    $productUpdate->update(['max_count' => DB::raw('max_count -' . $minus)]);
                                }
                                $orderProduct->update(['count' => $product['quantity'], 'price' => $productUpdate['price']]);
                            } else {
                                $productUpdate = products::where('id', $key)->first();
                                $productUpdate->update(['max_count' => DB::raw('max_count -' . $product['quantity'])]);
                                $orderProduct = order_products::create(['product_id' => $key, 'order_id' => $order->id, 'count' => $product['quantity'], 'price' => $productUpdate->price]);
                            }
                            return $orderProduct;
                        });
//                $order->features()->attach($product['option']['id']);
                    }
                    $productNotIn = order_products::whereNotIn('product_id', $ids)->get();
                    $productNotIn = $productNotIn->map(function ($product) {
                        $pro = product_details::where('id', $product['id'])->first();
                        $id = $pro->product->id;
                        $productUpdate = products::where('id', $id)->first();
                        $productUpdate->update(['max_count' => DB::raw('max_count +' . $product['quantity'])]);
                        order_products::whereNotIn('product_id', $product['id'])->delete();
                        return $product;
                    });
                    if ($order->gettransactions->image == null) {
                        if ($image) {
                            $numberrand = rand(11111, 99999);
                            $randname = time() . $numberrand;
                            $imageName = $randname . '.' . $image->getClientOriginalExtension();
                            $image->move(public_path('uploads/payment'), $imageName);
                        }
                    } else {
                        $image_path = $order->gettransactions->image;  // Value is not URL but directory file path

                        if (File::exists(public_path($image_path))) {
                            File::delete(public_path($image_path));
                        }
                        if ($image) {
                            $numberrand = rand(11111, 99999);
                            $randname = time() . $numberrand;
                            $imageName = $randname . '.' . $image->getClientOriginalExtension();
                            $image->move(public_path('uploads/payment'), $imageName);
                        }
                    }
                    $ship = Shipping::where('order_id', $order['id'])->first();
                    if ($shippingOption_id != null) {
                        $shipping = $ship->update(['country_id' => $country_id, 'city_id' => $city_id, 'order_id' => $order['id'], 'Neighborhood' => $neighborhood, 'street' => $street
                            , 'address' => $address, 'code' => $code]);
                    }
                    $order->transactions()->detach();
                    if ($payment != null) {
                        if ($payment == 'bank') {
                            $transaction = transactions::create([
                                'holder_name' => $request->holder_name,
                                'order_id' => $order->id,
                                'type_id' => null,
                                'type' => $payment,
                                'status' => 'pending',
                                'store_id' => $store,
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
                                'store_id' => $store,
                            ]);
                        } elseif ($payment == 'online') {
                            if ($paymentMethodId != null && $invoiceId != null) {
                                $transaction = transactions::create([
                                    'order_id' => $order->id,
                                    'type_id' => $payment_id,
                                    'type' => $payment,
                                    'status' => 'paid',
                                    'store_id' => $store,
                                ]);
                            } else {
                                return back()->with('failure', _i('Please Pay First with Myfatoorah'));
                            }
                        }
                    }
                    DB::commit();
                } catch (\Exception $e) {
                    return $e;
                    DB::rollBack();
                }
                $orderupdate;
                $order_product;
                $shipping;
                $productNotIn;
                $transaction;
            }
            return response()->json(['status' => 'success', 'order' => $order]);
        }
    }

    public function saveproduct(Request $request)
    {

        $storeOptions = Utility::storeOptions(\App\Bll\Utility::getStoreId())->first();
        if ($storeOptions != null) {
            if ($storeOptions->order_accept == 0) {
                return redirect()->back()->with('error', _i('Not Available'));
            }
        }
        $this->validate($request, [
            'title' => 'required',
            'type' => 'required',
            'max_count' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $product = products::create(['max_count' => $request['max_count'], 'price' => $request['price'], 'product_type' => $request['type'], 'store_id' => session('StoreId')]);
            $product_details = product_details::create(['title' => $request->title, 'product_id' => $product->id, 'lang_id' => session('langId')]);
            DB::commit();
        } catch (\Exception $e) {
            return $e;
            DB::rollBack();
        }
        //$product;
        $product_details = product_details::with(['product', 'product.features', 'product.features.options'])->whereProductId($product->id)->first();
        return response()->json($product_details);
    }

    public function refreshproducts()
    {
        $products = product_details::with(['product' => function ($query) {
            $query->where('store_id', session('StoreId'));
            $query->with(['product_photos' => function ($q) {
                $q->where('main', 1);
            }]);
            $query->with(['features' => function ($q) {
                $q->with('options');
            }]);
        }])->get();
        return response()->json($products);
    }

    public function savenewuser(Request $request)
    {

        $storeOptions = Utility::storeOptions(\App\Bll\Utility::getStoreId())->first();
        if ($storeOptions != null) {
            if ($storeOptions->order_accept == 0) {
                return redirect()->back()->with('error', _i('Not Available'));
            }
        }

        $this->validate($request, [
            'email' => 'required|unique:users',
            'name' => 'required',
        ]);
        $user = User::create(['name' => $request['name'], 'password' => Hash::make($request['123123']), 'email' => $request['email'], 'guard' => 'web', 'phone' => $request['phone']]);
        return response()->json($user);
    }

    public function delete($id)
    {
        // dd($id);
        $order = orders::findOrFail($id);
        $order->orderProducts()->delete();
        $order->gettransactions()->delete();
        $order->delete();
        return redirect()->back()->with('flash_message', _i('Deleted Successfully !'));
    }

    public function getproduct(Request $request)
    {

        $products = products::where('store_id', \App\Bll\Utility::getStoreId())
            ->with(['product_details' => function ($m) use ($request) {
                $m->where('title', 'LIKE', '%' . $request->val . '%');
            }])
            ->with(['product_photos' => function ($q) {
                $q->where('main', 1);
            }])
            ->with(['features' => function ($qq) {
                $qq->with('options');
            }])->get();

        return response()->json(['data' => $products]);
    }

    public function getproductsingle(Request $request)
    {

        $product = products::
        leftJoin('product_details', 'products.id', '=', 'product_details.product_id')->
        leftJoin('product_photos', 'products.id', '=', 'product_photos.product_id')->
        where('store_id', \App\Bll\Utility::getStoreId())->
        where('products.id', $request->pro_id)->
        where('product_photos.main', 1)->
        select(['products.*', 'product_details.title',
            'product_details.description',
            'product_details.product_id as product_id',
            'product_details.lang_id',
            'product_photos.photo',
        ])->first();
        $product->photo = url("") . $product->photo;

        return response()->json(['data' => $product]);


    }

    public function getPayways(Request $request)
    {
        if ($request->ajax()) {
            $bank = bank_transfer::findOrFail($request->bank_id);
            return view('admin.orders.includes.bank', compact('bank'));
        }
    }

    public function myfatoorah_admin(Request $request)
    {
//        dd($request->all());
        $storeOptions = Utility::storeOptions(\App\Bll\Utility::getStoreId())->first();
        if ($storeOptions != null) {
            if ($storeOptions->order_accept == 0) {
                return redirect()->back()->with('error', _i('Not Available'));
            }
        }

        $price = $request->price_myfatoorah;
        $currency = $request->currency_myfatoorah;
        $user = $request->user_myfatoorah;
        if ($price == 'NaN' || $user == null || $price == 0) {
            return redirect()->back()->with('error', _i('Please Complete Data'));
        } else {
            $resultInitPayment = MyFatoorah::initializePayment($price, $currency);
            $resultInitPaymentdecode = json_decode($resultInitPayment);
            return view('admin.orders.pay', ["resultInitPaymentdecode" => $resultInitPaymentdecode, "user" => $user, 'currency' => $currency, 'price' => $price]);
        }
    }

    public function execute_payment_admin(Request $request)
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
        $params['CustomerName'] = $user->name;
        $params['DisplayCurrencyIso'] = $request->currency;
        $params['CustomerMobile'] = $user->phone;
        $params['CustomerEmail'] = $user->email;
        $params['InvoiceValue'] = $request->price;
        $params['CallBackUrl'] = 'http://localhost:8000/adminpanel/myfatoorah/finish';
        $params['ErrorUrl'] = MyFatoorah::$errorUrl;
        $params['language'] = \App\Bll\Utility::lang();
        $params['CustomerReference'] = "storeOrder_" . $user->id;
        $params['InvoiceItems'][0]['itemName'] = $user->name;
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
        } else {
            return view('admin.orders.myFatoorahError');
        }
    }

    public function myfatoorahFinish()
    {
        return view('admin.orders.myfatoorah_finish');
    }


    // show order

    public function showOrder(Request $request, $id)
    {

        $order = orders::where('id', $id)->
        with('user')->
        with('store')->
        with(['shipping_option' => function ($m) {
            $m->where('source_id', null);
        }])
            ->with('gettransactions')
            ->with('shipping')
            ->with(['orderProducts' => function ($query) {
                $query->with('product');
            }])->with('features')->first();


        $transactions = transactions::where('order_id', $id)->where('status', 'paid')->first();
        if ($transactions == null) {
            $transactions = 0;
        }
        $number = $order->ordernumber;

        $status = Order_status::
        leftJoin('order_status_datas', 'order_statuses.id', '=', 'order_status_datas.status_id')
            ->select(['order_statuses.*', 'order_status_datas.title'])
            ->get();


        return view('admin.orders.show', compact('order', 'number', 'status'));
    }


    public function reviewOrder(Request $request)
    {


        $storeOptions = Utility::storeOptions(\App\Bll\Utility::getStoreId())->first();




        if ($storeOptions->order_accept == 0) {

            return redirect()->back()->with('error', _i('Not Available'));
        }

        Order_track::create([
            'order_id'  => $request->order_id,
            'status_id' => $request->status_id,
            'comment'   => $request->comments,
        ]);

        $status = Order_status::findOrFail($request->status_id);

        $order = orders::findOrFail($request->order_id);

        $order->update(['status' => $status->code]);

        return response()->json('SUCCESS');

    }
}
