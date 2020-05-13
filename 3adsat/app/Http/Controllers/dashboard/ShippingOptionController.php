<?php

namespace App\Http\Controllers\dashboard;

use App\DataTables\shippingOptionDataTable;
use App\Models\cities;
use App\Models\Cities_shipping_option;
use App\Models\Country;
use App\Models\Shipping_option;
use App\Models\Shipping_type;
use App\Models\shippingCompanies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ShippingOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(shippingOptionDataTable $shipping_option)
    {
        return $shipping_option->render('admin.shipping_option.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = shippingCompanies::pluck('title','id');
        $countries = Country::leftJoin('country_descriptions','country_descriptions.country_id', 'countries.id')->where('country_descriptions.language_id', checknotsessionlang())->select('countries.id','country_descriptions.name')->get();
        return view('admin.shipping_option.create',compact('companies','countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'delay' => 'required',
            'cost' => 'sometimes',
            'company_id' => 'required',
            'country' => 'required',
            'cash_delivery_commission' => 'numeric|sometimes',
        ]);
        if ($request['shipping_type'] == 'constant'){
            $cost = $request['cost'];
        }else{
            $cost = null;
        }
        $Shipping_option = Shipping_option::create(['delay'=>$request['delay'],'company_id'=>$request['company_id'],'cost'=>$cost,'cash_delivery_commission'=>$request['cash_delivery_commission'],
            'country_id'=>$request['country'],'lang_id' => 1]);
        $Shipping_option->cities()->attach($request['cities']);
        if ($request['shipping_type'] == 'weight'){
            Shipping_type::create(['shipping_option_id'=>$Shipping_option->id,'no_kg'=>$request['no_kg'],'cost_no_kg'=>$request['cost_no_kg'],'cost_increase'=>$request['cost_increase'],'kg_increase'=>$request['kg_increase'],]);
        }
        return redirect()->back()->with('flash_message','success message');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shipping_option = Shipping_option::findOrfail($id);
        $cities_shipping = Cities_shipping_option::where('shipping_option_id', $shipping_option->id)->get();
        $companies = shippingCompanies::pluck('title','id');
        $countries = Country::leftJoin('country_descriptions','country_descriptions.country_id', 'countries.id')->where('country_descriptions.language_id', checknotsessionlang())->select('countries.id','country_descriptions.name')->get();
        return view('admin.shipping_option.edit',compact('shipping_option','companies','countries','cities_shipping'));
    }

    /**
     * Update the specified resource in storage.
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate($request,[
            'delay' => 'required',
            'cost' => 'sometimes',
            'company_id' => 'required',
            'country' => 'required',
            'cash_delivery_commission' => 'numeric|sometimes',
        ]);
        if ($request['shipping_type'] == 'constant'){
            $cost = $request['cost'];
        }else{
            $cost = null;
        }

        $shipping_option = Shipping_option::findOrfail($id);
        $shipping_option->update(['delay'=>$request['delay'],'company_id'=>$request['company_id'],'cost'=>$cost,'cash_delivery_commission'=>$request['cash_delivery_commission'],'country_id'=>$request['country']]);
        $shipping_option->cities()->sync($request['cities']);
        if ($request['shipping_type'] == 'weight'){
            $Shipping_type = Shipping_type::where('shipping_option_id',$shipping_option->id)->first();
            $Shipping_type->update(['no_kg'=>$request['no_kg'],'cost_no_kg'=>$request['cost_no_kg'],'cost_increase'=>$request['cost_increase'],'kg_increase'=>$request['kg_increase']]);
        }
        return redirect()->back()->with('flash_message','success message');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shipping_option = Shipping_option::findOrfail($id);
        $shipping_option->cities()->detach();
        $shipping_option->delete();
        return redirect()->back()->with('flash_message','success delete');
    }

    public function getcities(Request $request)
    {
        if ($request->ajax()){
            $cities = cities::where('country_id',$request->country)->pluck('title','id');
            return response()->json($cities);
        }
    }

//    public function getCountriesShipping(Request $request){
//        $exists = Shipping_option::where('country_id',$request->id)->exists();
//        $options = null;
//        if ($exists){
//            $options = Shipping_option::where('country_id',$request->id)->get();
//        }
//        dd($exists);
//        return response()->json($exists);
//    }
//    public function getShippingOptions(Request $request){
//        $exists = Shipping_option::where('id', $request->id)->where('country_id',$request->country)->exists();
//        $options = null;
//        if ($exists){
//            $option = Shipping_option::where('id',$request->id)->where('country_id',$request->country)->pluck('id')->toArray();
//            $cities = cities::where('country_id',$request->country)->pluck('title','id')->toArray();
//            $cities_shipping_options = DB::table('cities_shipping_options')->whereIn('shipping_option_id',$option)->pluck('city_id')->toArray();
////            $Shipping_option = Shipping_option::whereIn('id',$cities_shipping_options)->with('company')->get();
//            return response()->json([$cities,$cities_shipping_options]);
//        }
//    }
}
