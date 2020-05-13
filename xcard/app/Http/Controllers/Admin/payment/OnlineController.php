<?php

namespace App\Http\Controllers\Admin\payment;

use App\Models\Online;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OnlineController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Online-Payment','permission:Payment-Add'])->only(['index','store']);
    }

    public function index()
    {
        $online = Online::first();
        if($online != null) {
            return view('admin.online.show',compact('online'));
        } else {
            return view('admin.online.show',compact('online'));
        }
    }

    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'key' => 'required',
        ]);

        $online = Online::first();

        if($online == null){
            $online = Online::create([
                'key' => $request->key,
            ]);
        }else{
            $online->key = $request->key;
            $online->update();
        }
        return redirect()->back()->with('success' , _i('Updated Successfully !'));

    }

}
