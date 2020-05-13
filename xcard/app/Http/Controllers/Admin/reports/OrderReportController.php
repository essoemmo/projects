<?php

namespace App\Http\Controllers\Admin\reports;

use App\Models\Country;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class OrderReportController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Report-Show'])->only(['index','datatable']);
    }

    public function index()
    {
        return view('admin.reports.orderReport.index');
    }


    /**
     * To display dynamic table by datatable.
     *
     * @throws \Exception
     *
     * @return mixed
     */
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

        $data = $query->select('orders.created_at', 'orders.orderNumber', 'orders.status', 'orders.id', 'orders.total',  DB::raw('COUNT(*) as orderCount'))
            ->groupBy(DB::raw('orders.orderNumber'))->get();

        if(!empty($data)){
            foreach ($data as $item) {
                $item->created_at = $item->created_at->format('Y-m-d H:i:s');
                $item->total = $item->total;

                $order_products = OrderItem::select('orders.created_at', 'orders.orderNumber', DB::raw('SUM(order_items.count) as productCount'))
                    ->join('orders','order_items.order_id','=','orders.id')
                    ->where('order_items.order_id', $item->id)
                    ->groupBy('order_items.order_id')->first();
                $item->productCount = $order_products->productCount;
            }
        }

        return datatables()->of($data)
            ->editColumn('orderNumber', function($query) {
                return '<a href="' . aUrl('orders/' . $query->id ) . '">' . $query->orderNumber . '
                        <input type="hidden" id="orderNumber" name="orderNumber" value="'. $query->id .'">
                     </a>';
            })
            ->rawColumns([
                'orderNumber',
            ])
            ->make(true);
    }
}
