<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Country;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PurchasedProductsReportController extends Controller
{
    public function index()
    {
        $countries = Country::getByLanguage(checknotsessionlang());
        return view('admin.reports.purchasedProductsReport.index', ['countries' => $countries]);
    }

    public function datatable()
    {
        $query = OrderItem::query();

        $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');
        $country_id = (!empty($_GET["country_id"])) ? ($_GET["country_id"]) : ('');

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

        if($country_id){
            $query->whereRaw("shipping_options.country_id = " . $country_id);
        }

        $data = $query->select('order_items.*', 'product_descriptions.name as productName', 'country_descriptions.name as countryName','shipping_options.country_id', DB::raw('SUM(order_items.count) as quantity'))
            ->join('orders', 'orders.id', 'order_items.order_id')
            ->join('product_descriptions', 'order_items.type_id', 'product_descriptions.product_id')
            ->join('shipping_options', 'orders.shipping_option_id', '=', 'shipping_options.id')
            ->join('country_descriptions', 'shipping_options.country_id', '=', 'country_descriptions.country_id')
            ->join('countries', 'country_descriptions.country_id', '=', 'countries.id')
            ->where([
                ['country_descriptions.deleted_at', '=', NULL],
                ['country_descriptions.language_id', '=', checknotsessionlang()],
                ['product_descriptions.language_id', '=', checknotsessionlang()],
            ])->groupBy('type_id')->get();
//        dd($data);
        if(!empty($data)){
            foreach ($data as $item) {
                $country = DB::table('countries')->where('id',$item->country_id)->first();
                $convert = getRate($country->iso_code);
                $item->total = ( $item->quantity * $item->price ).' '. $convert->code;
            }
        }
        return datatables()->of($data)
            ->make(true);
    }
}
