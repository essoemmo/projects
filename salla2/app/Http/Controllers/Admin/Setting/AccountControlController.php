<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Bll\Utility;
use App\Http\Controllers\Controller;
use App\Models\Settings\StoreAccount;
use Illuminate\Http\Request;

class AccountControlController extends Controller
{
    public function index()
    {
        $is_stopped = StoreAccount::where('store_id' , Utility::getStoreId())
            ->where('is_active' , 0)->where( 'end_date' ,">=", NOW())->first();
        return view('admin.settings.accountControl.index' , compact('is_stopped'));
    }


    public function change_setting(Request $request)
    {
        $storeId = Utility::getStoreId();
        if($request->status == 0){
            $change_no = StoreAccount::where('store_id' , Utility::getStoreId())
                ->whereYear('created_date', '=', date('Y'))->count();
            //dd($change_no);
            if($change_no == 2){
                return response()->json(false);
            }else{
                $change = StoreAccount::create([
                    'store_id' => $storeId,
                    'is_active' => 0,
                    'created_date' => date('Y-m-d'),
                    'end_date' => date('Y-m-d', strtotime('+30 day'))
                ]);
                return response()->json(true);
            }
        }
        // activate account
        if($request->status == 1){
            $account = StoreAccount::where('store_id' , Utility::getStoreId())
                ->where('is_active' , 0)->first();

            $account->update([
               'is_active' => 1
            ]);
            return response()->json(true);
        }

    }
}
