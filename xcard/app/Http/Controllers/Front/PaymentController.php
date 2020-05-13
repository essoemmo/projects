<?php

namespace App\Http\Controllers\Front;

use App\Mail\SendCodes;
use App\Mail\WelcomeMail;
use App\Models\Bank;
use App\Models\Online;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductCode;
use App\Models\Transaction;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{

    public function userRegister(Request $request)
    {
        $rules = [
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
        ];

        $user = User::where('email', $request->email)->first();
        if($user != null) {
            auth()->login($user);
            $url = route('payment');
            return response()->json([false, 'url' => $url]);
        } else {
            if ($request->ajax()) {
                $user = User::create([
                    'email' => $request->email,
                    'password' => Hash::make(123456),
                    'guard' => 'web',
                ]);
                $user->assignRole('registered-users');
                $user->save();
                auth()->login($user);
                Mail::to($user->email)->send(new WelcomeMail($user));
                $url = route('payment');
                return response()->json([true, 'url' => $url]);
            }
        }
    }

    public function index() {
        if(auth()->check()) {
            $number = rand(1111111,9999999);
            $online = Online::first();
            $banks = Bank::select('banks_translations.title as title','banks.id as id','banks.image as image','banks.code as code')
                ->leftJoin('banks_translations','banks_translations.bank_id','=','banks.id')->where('locale',App::getLocale())->get();
            return view('front.payment.index', compact('banks','number','online'));
        } else {
            return redirect(route('getLogin'));
        }
    }

    public function saveOrder(Request $request) {
        $this->validate($request,[
            'holder_name_*' => 'sometimes',
            'bank_transactions_num_*' => 'sometimes',
            'image_*' => 'sometimes',
        ]);

        $orderNumber = $request->orderNumber;
        $products = $request->product;
        $user_id = $request->user;
        $total = $request->total;
        $bank = $request->bank_id;
        $bank_transactions_num = $request->get('bank_transactions_num_' . $bank);
        $holder_name = $request->get('holder_name_' . $bank);
        $currency = $request->currency;
        $payment_type = $request->payment_type;
        $image = $request->file('image_'. $bank);

        if ($orderNumber != null && $user_id != null){
            DB::beginTransaction();
            session()->put('orderNumber',$orderNumber);
            try{
                $order = Order::create(['user_id'=> $user_id, 'orderNumber'=> $orderNumber, 'total' => $total,'status' => 'wait']);
                $order_items = [];
                foreach ($products as $product){
                    $pro = Product::where('id', $product)->first();
                    $id = $pro->id;
                    $cart = \Cart::get($id);
                    $order_items[] = OrderItem::create([
                        'order_id'=>$order->id,
                        'type_id' => $id,
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

                if($payment_type == 'bank') {
                    $transaction = Transaction::create(['holder_name'=> $holder_name, 'order_id'=> $order->id, 'payment_type' => $payment_type, 'status' => 'pending', 'bank_id' => $bank, 'bank_transactions_num' => $bank_transactions_num, 'currency' => $currency, 'image' => '/uploads/payment/'.$imageName]);
                }
                DB::commit();
            }catch (\Exception $e){
                return $e;
                DB::rollBack();
            }
            $order;
            $order_items;
            $transaction;
        }
        return redirect(route('invoice'));
    }

    public function invoice() {
        $order = Order::where('orderNumber', session('orderNumber'))->first();
        $payment = Transaction::where('order_id', $order->id)->first();
        return view('front.payment.invoice', compact('order', 'payment'));
    }

    public function confirm() {
        \Cart::clear();
        session()->forget('orderNumber');
        return redirect('/');
    }

    public function postPay(Request $request) {

        $post = [
            "amount" =>  $request->amount,
            "currency" =>  $request->currency,
            "publishable_api_key" =>  $request->publishable_api_key,
            "description" =>  null,
            "callback_url" =>  $request->callback_url,
            "source" => [
                "type" => $request->source['type'],
                "company" => $request->source['company'],
                "name" => $request->source['name'],
                "number" => $request->source['number'],
                "cvc" => $request->source['cvc'],
                "month" => $request->source['month'],
                "year" => $request->source['year'],
            ]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.moyasar.com/v1/payments');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        $result = curl_exec($ch);

        $result = json_decode($result, true);

        if(isset($result['type']) &&$result['type'] === 'invalid_request_error') {
            return redirect()->back()->withErrors($result['errors'])->withInput();
        }

        if($request->status == 'failed') {
            $errors = $request->message;
            return \redirect()->back()->withErrors($errors);
        }

        $online = Online::first();

        if($request->status == 'paid') {

            $username = $online->key;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.moyasar.com/v1/payments/' . $request->id);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_USERPWD, "$username:");
            $result = curl_exec($ch);

            $result = json_decode($result, true);

            $orderNumber = rand(1111111,9999999);
            $user = User::findOrFail(auth()->id());
            if ($orderNumber != null && $user->id != null){
                DB::beginTransaction();
                session()->put('orderNumber',$orderNumber);
                try{
                    $order = Order::create(['user_id'=> $user->id, 'orderNumber'=> $orderNumber, 'total' => round(\Cart::getTotal() * getRate(country_code())->rate),'status' => 'accepted']);
                    $order_items = [];
                    foreach (\Cart::getContent() as $item){
                        $pro = Product::where('id', $item->id)->first();
                        $id = $pro->id;
                        $cart = \Cart::get($id);
                        $order_items[] = OrderItem::create([
                            'order_id'  => $order->id,
                            'type_id'   => $id,
                            'count'     => $item->quantity,
                            'price'     => $item->price,
                        ]);
                    }

                    $transaction = Transaction::create(['holder_name'=> $result['source']['name'], 'bank_transactions_num' => $result['id'],'order_id'=> $order->id, 'payment_type' => 'online', 'status' => 'paid', 'holder_card_number' => $result['source']['number'], 'currency' => $result['currency']]);

                    DB::commit();
                }catch (\Exception $e){
                    return $e;
                    DB::rollBack();
                }
                $order;
                $order_items;
                $transaction;
            }
            DB::beginTransaction();
            $orderItems = OrderItem::where('order_id', $order->id)->get();

            try{
                Mail::to($user->email)->send(new SendCodes(['order' => $order,'user' => $user, 'orderItems' => $orderItems]));

                foreach ($orderItems as $item) {
                    if(count(codes($item->product->id,$item->count)) != 0) {
                        foreach(codes($item->product->id,$item->count) as $code) {
                            $status = ProductCode::where('code', $code->code)->first();
                            $status->status = 1;
                            $status->save();
                        }
                    } else {
                        $status = ProductCode::where('code', codes($item->product->id,$item->count)->code)->first();
                        $status->status = 1;
                        $status->save();
                    }

                    $products = Product::where('id', $item->type_id)->get();
                    foreach ($products as $product) {
                        $product->quantity = ($product->quantity - $item->count);
                        $product->save();
                    }
                }

                $order->code_status = 1;
                $order->save();
                DB::commit();
                return \Illuminate\Support\Facades\Redirect::to( route('invoice') );
            }catch (\Exception $e){
                return response()->json(false);
                DB::rollBack();
            }
        }
    }
}
