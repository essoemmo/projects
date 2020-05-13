<?php

namespace App\Http\Controllers\Front\User;

use App\Models\Bill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MyBillController extends Controller
{
    public function index() {
        $bills = Bill::where('user_id',auth()->id())->get();
        return view('front.user.myBills.all',compact('bills'));
    }

    public function cancel($id) {
        $bill = Bill::findOrFail($id);
        $bill->status = 0;
        $bill->update();
    }

    public function pay($id) {
        $bill = Bill::findOrFail($id);
        $bill->status = 1;
        $bill->update();
    }
}
