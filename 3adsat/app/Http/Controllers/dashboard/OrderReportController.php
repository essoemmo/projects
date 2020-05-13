<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Country;
use App\Models\OrderItem;
use App\Models\orders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderReportController extends Controller
{

    public function index()
    {
        $countries = Country::getByLanguage(checknotsessionlang());
        return view('admin.reports.orderReport.index', ['countries' => $countries]);
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
        $query = orders::query();

        $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');
        $country_id = (!empty($_GET["country_id"])) ? ($_GET["country_id"]) : ('');

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

        if($country_id){
            $query->whereRaw("shipping_options.country_id = " . $country_id);
        }

        $data = $query->select('orders.created_at', 'orders.ordernumber', 'orders.id','shipping_options.country_id', 'country_descriptions.name as countryName', 'orders.total',  DB::raw('COUNT(*) as orderCount'))
            ->join('shipping_options', 'orders.shipping_option_id', '=', 'shipping_options.id')
            ->join('country_descriptions', 'shipping_options.country_id', '=', 'country_descriptions.country_id')
            ->join('countries', 'country_descriptions.country_id', '=', 'countries.id')
            ->where([
                ['country_descriptions.deleted_at', '=', NULL],
                ['country_descriptions.language_id', '=', checknotsessionlang()],
            ])->groupBy(DB::raw('date(orders.created_at), shipping_options.country_id'))->get();

        if(!empty($data)){
            foreach ($data as $item) {
                $country = DB::table('countries')->where('id',$item->country_id)->first();
                $convert = getRate($country->iso_code);
                $item->created_at = $item->created_at->format('Y-m-d');
                $item->total = $item->total . ' ' . $convert->code;


                $order_products = OrderItem::select('orders.created_at', 'shipping_options.country_id', DB::raw('SUM(order_items.count) as productCount'))
                    ->join('orders','order_items.order_id','=','orders.id')
                    ->join('shipping_options', 'orders.shipping_option_id', '=', 'shipping_options.id')
                    ->where([
                        ['shipping_options.country_id', '=', $item->country_id],
                    ])->groupBy(DB::raw('date(orders.created_at), shipping_options.country_id'))->first();
                $item->productCount = $order_products->productCount;
            }
        }

        return datatables()->of($data)
            ->editColumn('ordernumber', function($query) {
                return '<a href="' . url('/admin/panel/orders/' . $query->id ) . '">' . $query->ordernumber . '
                        <input type="hidden" id="ordernumber" name="ordernumber" value="'. $query->id .'">
                     </a>';
            })
            ->rawColumns([
                'ordernumber',
            ])
            ->make(true);
    }
}
