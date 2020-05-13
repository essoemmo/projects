<?php

namespace App\Http\Controllers\Admin\transaction;



use App\Bll\Utility;
use App\DataTables\OfflineDataTable;
use App\DataTables\OnlineDataTable;
use App\Http\Controllers\Controller;
use App\Models\product\bank_transfer;
use App\Models\product\order_products;
use App\Models\product\orders;
use App\Models\product\transaction_types;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TransactionsController extends Controller
{

    public function offline_orders(OfflineDataTable $transaction)
    {
        return $transaction->render('admin.transaction.offline.all_offline');
    }


    public  function show_offline($id)
    {
        $transaction = Transaction::findOrFail($id);
        $order = Orders::where('id' , $transaction->order_id)->first();
        $user = User::where('id' , $order->user_id)->where('store_id' , Utility::getStoreId())->first();
        $bank = Bank_transfer::where('id' , $transaction->bank_id)->where('store_id' , Utility::getStoreId())->first();

        return view('admin.transaction.offline.show' , compact('transaction','order','user','bank' ));
    }



    public function online_orders(OnlineDataTable $transaction)
    {
        return $transaction->render('admin.transaction.online.all_online');
    }


    public  function show_online($id)
    {
        $transaction = Transaction::findOrFail($id);
        $order = Orders::where('id' , $transaction->order_id)->first();
        $user = User::where('id' , $order->user_id)->where('store_id' , Utility::getStoreId())->first();
        $transaction_type = transaction_types::where('id' , $transaction->type_id)->where('store_id' , Utility::getStoreId())->first();   //type_id => is transaction_types table id

        return view('admin.transaction.online.show' , compact('transaction','order','user','transaction_type'));
    }


    public function accept($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = "paid";
        $transaction->save();
        return redirect()->back()->with('flash_message' ,_i('Accepted Successfully !'));
    }

    public function refused($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = "refused";
        $transaction->save();
        return redirect()->back()->with('flash_message' ,_i('Refused Successfully !'));
    }
}
