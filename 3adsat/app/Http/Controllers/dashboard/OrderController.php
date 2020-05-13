<?php

namespace App\Http\Controllers\dashboard;

use App\DataTables\OrderDataTable;
use App\Models\OrderItem;
use App\Models\orders;
use App\Models\ShippingAddress;
use App\Models\Transaction;
use App\Models\transaction_types;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class OrderController extends Controller
{
    public $lang = "en_US";
    public $language_id;

    /**
     * Create a new controller instance.
     */
    public function __construct() {
        $this->middleware(function ($request, $next) {
            // fetch session and use it in entire class with constructor
            $this->language_id = checknotsessionlang();

            return $next($request);
        });
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
        $order = orders::findOrFail($id);
        $user = User::findOrFail($order->user_id);
        $transaction = Transaction::where('order_id',$id)->first();
        $paymentMethod = transaction_types::where('id',$transaction->type_id)->first();
        $shipping_address = ShippingAddress::where('order_id', $order->id)->first();
        $order_items = OrderItem::where('order_id', $order->id)->get();
        return view('admin.orders.show',compact('order', 'transaction','paymentMethod','user','shipping_address','order_items'));
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
        $order = orders::findOrFail($id);
        $order_items = OrderItem::where('order_id', $order->id)->delete();
        $order->delete();
        session()->flash('success',_i('deleted successfuly'));
        return back();
    }

    public function change($id, Request $request) {
        $order = orders::findOrFail($id);
        if($request->ajax()) {
            $order->status = $request->status;
            $order->save();
            return response()->json(true);
        }
    }

    public function pdf($id) {
        $order = orders::findOrFail($id);
        $user = User::findOrFail($order->user_id);
        $transaction = Transaction::where('order_id',$id)->first();
        $paymentMethod = transaction_types::where('id',$transaction->type_id)->first();
        $shipping_address = ShippingAddress::where('order_id', $order->id)->first();
        $order_items = OrderItem::where('order_id', $order->id)->get();
        $config = ['instanceConfigurator' => function($mpdf) {
            $mpdf->SetHTMLFooter('
                        <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                        <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
            );
        }];
        $pdf = PDF::loadView('admin.orders.pdf.print', compact('order', 'transaction','paymentMethod','user','shipping_address','order_items'), [] , $config);
        return $pdf->stream($order->ordernumber);
    }
}
