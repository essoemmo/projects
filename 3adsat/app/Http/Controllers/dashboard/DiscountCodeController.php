<?php

namespace App\Http\Controllers\dashboard;

use App\DataTables\discountCodeDataTable;
use App\Http\Controllers\Controller;
use App\Models\discount_code;
use Illuminate\Http\Request;

class DiscountCodeController extends Controller
{
    public $lang = "en_US";
    public $language_id;

    /**
     * Create a new controller instance.
     */
    public function __construct() {
        $this->middleware(function ($request, $next) {
            // fetch session and use it in entire class with constructor
            $this->language_id = checknotsessionlang();

            return $next($request);
        });
    }

    public function index(discountCodeDataTable $discount){
        return $discount->render('admin.discount.index');
    }

    public function store(Request $request){
//        dd($request->all());
        $data = $this->validate($request,[
            'title' => 'required',
            'code' => 'required',
            'discount' => 'required',
            'type' => 'required',
        ]);
        $discount = discount_code::create([
            'title' => $request->title,
            'code' => $request->code,
            'discount' => $request->discount,
            'type' => $request->type,
            'lang_id' => getLang(session('lang')),
        ]);
        $discount->save();
        return redirect()->back()->with('message',_i('success create'));
    }
    public function update(Request $request,$id){
        $discount = discount_code::findOrFail($id);
        $data = $this->validate($request,[
            'title' => 'required',
            'code' => 'required',
            'discount' => 'required',
            'type' => 'required',
        ]);
        $discount->update($data);
        return redirect()->back()->with('message',_i('success update'));
    }
    public function destroy(Request $request,$id){
        $discount = discount_code::findOrFail($id);
        $discount->delete();
        return redirect()->back()->with('message',_i('success delete'));
    }
}
