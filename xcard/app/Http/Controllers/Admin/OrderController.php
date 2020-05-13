<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrderDataTable;
use App\Mail\SendCodes;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductCode;
use App\Models\Transaction;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Order-Show'])->only('index');
        $this->middleware(['permission:Order-Show'])->only('show');
        $this->middleware(['permission:Order-Delete'])->only('delete');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OrderDataTable $orderDataTable)
    {
        return $orderDataTable->render('admin.orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $user = User::findOrFail($order->user_id);
        $transaction = Transaction::where('order_id',$id)->first();
        $order_items = OrderItem::where('order_id', $order->id)->get();
        return view('admin.orders.show',compact('order','transaction','user','order_items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order_items = OrderItem::where('order_id', $order->id)->delete();
        $order->delete();
        return redirect(aUrl('orders'))->with('success',_i('success delete'));
    }

    public function change($id, Request $request) {
        $order = Order::findOrFail($id);
        if($request->ajax()) {
            $order->status = $request->status;
            $order->save();
            return response()->json(true);
        }
    }

    public function sendCodes(Request $request) {
        $order = Order::findOrFail($request->id);
        $user = User::findOrFail($order->user_id);
        $orderItems = OrderItem::where('order_id', $order->id)->get();

        DB::beginTransaction();
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
            return response()->json(true);
        }catch (\Exception $e){
            return response()->json(false);
            DB::rollBack();
        }

    }
}
