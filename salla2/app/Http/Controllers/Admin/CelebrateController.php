<?php

namespace App\Http\Controllers\Admin;

use App\Bll\Utility;
use App\Celebrate;
use App\Store;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CelebrateController extends Controller
{
    public function index(){
       $conditions =  Utility::getCelebrated();
        $store_id = Utility::getStoreId();
       return view('admin.celebrates.index',compact('conditions','store_id'));
    }


    public function store(Request $request){
        $added = Celebrate::create([
            'store_id' => $request->store_id,
            'created' => Carbon::now(),
            'status' => 'pending'
        ]);

        session()->flash('success',_i('done the service ok!!'));
            return back();
    }







}
