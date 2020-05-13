<?php

namespace App\Http\Controllers\Admin\reports;

use App\Models\Country;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class PurchasedProductsReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Report-Show'])->only(['index','datatable']);
    }

    public function index()
    {
        return view('admin.reports.purchasedProductsReport.index');
    }

    public function datatable()
    {
        $query = OrderItem::query();

        $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');

        if($start_date && $end_date){
            $start_date = date('Y-m-d', strtotime($start_date));
            $end_date = date('Y-m-d', strtotime($end_date));
            $query->whereBetween('order_items.created_at', [$start_date.' 00:00:00', $end_date.' 23:59:59']);
        } else if($start_date){
            $start_date = date('Y-m-d', strtotime($start_date));
            $query->whereRaw("date(order_items.created_at) >= '" . $start_date . "' ");
        } else if($end_date){
            $end_date = date('Y-m-d', strtotime($end_date));
            $query->whereRaw("date(order_items.created_at) <= '" . $end_date . "'");
        }

        $data = $query->select('order_items.*', 'products_translations.title as productName', DB::raw('SUM(order_items.count) as quantity'))
            ->join('orders', 'orders.id', 'order_items.order_id')
            ->join('products', 'order_items.type_id', 'products.id')
            ->join('products_translations', 'products.id', 'products_translations.product_id')
            ->where([
                ['products_translations.locale', '=', \app()->getLocale()],
            ])->groupBy('type_id')->get();
//        dd($data);
        if(!empty($data)){
            foreach ($data as $item) {
                $item->total = ( $item->quantity * $item->price );
            }
        }
        return datatables()->of($data)
            ->make(true);
    }
}
