<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SiteAdsDataTable;
use App\Http\Controllers\Controller;
use App\Models\FeaturedAdUser;
use App\Models\Order;
use App\Models\Transaction;
use App\User;

class SiteAdsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Order-Show'])->only('index');
        $this->middleware(['permission:Order-Show'])->only('show');
        $this->middleware(['permission:Order-Delete'])->only('delete');
    }

    public function index(SiteAdsDataTable $siteAdsDataTable)
    {
        return $siteAdsDataTable->render('admin.site_ads.index');
    }

    public function show($id)
    {
        $featured_user = FeaturedAdUser::findOrFail($id);
        $order = Order::where('orderNumber', $featured_user->orderNumber)->first();
        $user = User::findOrFail($order->user_id);
        $transaction = Transaction::where('order_id', $order->id)->first();
        return view('admin.site_ads.show', compact('order', 'transaction', 'user', 'featured_user'));
    }

    public function change($id)
    {
        $featured_user = FeaturedAdUser::findOrFail($id);
        if ($featured_user->publish == 1) {
            return response()->json([false]);
        }
        $featured_user->publish = 1;
        $featured_user->update();
        return response()->json(true);
    }
}
