<?php

namespace App\Http\Controllers\Admin\reports;

use App\Models\Order;
use App\Models\OrderItem;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class CustomerOrdersReportController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Report-Show'])->only(['index','datatable','show']);
    }

    public function index()
    {
        return view('admin.reports.customer.index');
    }

    public function datatable()
    {
        $query = Order::query();

        $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');


        if($start_date && $end_date){
            $start_date = date('Y-m-d', strtotime($start_date));
            $end_date = date('Y-m-d', strtotime($end_date));
            $query->whereBetween('orders.created_at', [$start_date.' 00:00:00', $end_date.' 23:59:59']);
        } else if($start_date){
            $start_date = date('Y-m-d', strtotime($start_date));
            $query->whereRaw("date(orders.created_at) >= '" . $start_date . "' ");
        } else if($end_date){
            $end_date = date('Y-m-d', strtotime($end_date));
            $query->whereRaw("date(orders.created_at) <= '" . $end_date . "'");
        }

        $data = $query->select( 'orders.*', DB::raw('COUNT(*) as orderCount'), 'users.email','users.first_name','users.last_name',DB::raw('SUM(orders.total) as orderTotal'))
            ->join('users','users.id','orders.user_id')
            ->groupBy(DB::raw('orders.user_id, users.email'))->get();
//        dd($data);
        if(!empty($data)){
            foreach ($data as $item) {
                $item->orderTotal = $item->orderTotal;
                if($item->first_name != null && $item->last_name != null) {
                    $item->customerName = $item->first_name.' '.$item->last_name;
                } else {
                    $item->customerName = $item->email;
                }

                $order_products = OrderItem::select(DB::raw('SUM(order_items.count) as productCount'))
                    ->join('orders','order_items.order_id','=','orders.id')
                    ->join('users','users.id','orders.user_id')
                    ->where([
                        ['orders.user_id', '=', $item->user_id],
                        ['users.email', '=', $item->email],
                    ])->groupBy(DB::raw('orders.user_id, users.email'))
                    ->first();
                $item->productCount = $order_products->productCount;
            }
        }

        return datatables()->of($data)
            ->editColumn('show', function($query) {
                return '<a href="' . aUrl('customerOrderReport/' . $query->user_id ) . '/show">' . _i('Customer Order Details') . '</a>';
            })
            ->rawColumns([
                'show',
            ])
            ->make(true);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $orders = OrderItem::leftJoin('orders','orders.id','order_items.order_id')
            ->where('user_id', $user->id)
            ->get();
        $orderTotal = Order::where('user_id', $user->id)->sum('total');
        return view('admin.reports.customer.show',compact('orders','user','orderTotal'));
    }
}
