<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Country;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\orders;
use App\Models\ShippingAddress;
use App\Models\Transaction;
use App\Models\transaction_types;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CustomerOrdersReportController extends Controller
{
    public function index()
    {
        $countries = Country::getByLanguage(checknotsessionlang());
        return view('admin.reports.customer.index', ['countries' => $countries]);
    }

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

        $data = $query->select( 'orders.*', 'country_descriptions.name as countryName', DB::raw('COUNT(*) as orderCount'), 'shipping_options.country_id','users.email','users.first_name','users.last_name','users.name',DB::raw('SUM(orders.total) as orderTotal'))
            ->join('shipping_options', 'orders.shipping_option_id', '=', 'shipping_options.id')
            ->join('country_descriptions', 'shipping_options.country_id', '=', 'country_descriptions.country_id')
            ->join('countries', 'country_descriptions.country_id', '=', 'countries.id')
            ->join('users','users.id','orders.user_id')
            ->where([
                ['country_descriptions.deleted_at', '=', NULL],
                ['country_descriptions.language_id', '=', checknotsessionlang()],
            ])->groupBy(DB::raw('orders.user_id, users.email'))->get();
        if(!empty($data)){
            foreach ($data as $item) {
                $country = DB::table('countries')->where('id',$item->country_id)->first();
                $convert = getRate($country->iso_code);
                $item->orderTotal = $item->orderTotal . ' ' . $convert->code;
                if($item->name == '') {
                    $item->customerName = $item->first_name.' '.$item->last_name;
                } else {
                    $item->customerName = $item->name;
                }

                $order_products = OrderItem::select(DB::raw('SUM(order_items.count) as productCount'))
                    ->join('orders','order_items.order_id','=','orders.id')
                    ->join('shipping_options', 'orders.shipping_option_id', '=', 'shipping_options.id')
                    ->join('users','users.id','orders.user_id')
                    ->where([
                        ['orders.user_id', '=', $item->user_id],
                        ['users.email', '=', $item->email],
                        ['shipping_options.country_id', '=', $item->country_id],
                    ])->groupBy(DB::raw('orders.user_id, users.email'))
                    ->first();
                $item->productCount = $order_products->productCount;
            }
        }

        return datatables()->of($data)
            ->editColumn('show', function($query) {
                return '<a href="' . url('/admin/panel/customerOrderReport/' . $query->user_id ) . '/show">' . _i('Customer Order Details') . '</a>';
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
        $orderTotal = orders::where('user_id', $user->id)->sum('total');
        $orderShipCost = orders::where('user_id', $user->id)->sum('shipping_cost');
        return view('admin.reports.customer.show',compact('orders','user','orderShipCost','orderTotal'));
    }
}
