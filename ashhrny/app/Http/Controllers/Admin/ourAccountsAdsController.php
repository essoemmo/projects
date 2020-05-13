<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ourAccountsAdsDataTable;
use App\Models\Order;
use App\Models\RatingUser;
use App\Models\SocialAdvertisementUser;
use App\Models\Transaction;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ourAccountsAdsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Order-Show'])->only('index');
        $this->middleware(['permission:Order-Show'])->only('show');
        $this->middleware(['permission:Order-Delete'])->only('delete');
    }

    public function index(ourAccountsAdsDataTable $ourAccountsAdsDataTable)
    {
        return $ourAccountsAdsDataTable->render('admin.our_accounts_ads.index');
    }


    public function show($id)
    {
        $famous_ad = SocialAdvertisementUser::findOrFail($id);
        $order = Order::where('orderNumber', $famous_ad->orderNumber)->first();
        $user = User::findOrFail($order->user_id);
        $transaction = Transaction::where('order_id',$id)->first();
        $userAdRate = RatingUser::where('user_id', $user->id)->where('social_advertisement_id', $famous_ad->id)->first();
        return view('admin.our_accounts_ads.show',compact('order','transaction','user','famous_ad','userAdRate'));
    }

    public function change($id) {
        $famous_ad = SocialAdvertisementUser::findOrFail($id);
        if($famous_ad->publish == 1) {
            return response()->json([false]);
        }
        $famous_ad->publish = 1;
        $famous_ad->update();
        return response()->json(true);
    }

    public function destroy($id)
    {
        //
    }
}
