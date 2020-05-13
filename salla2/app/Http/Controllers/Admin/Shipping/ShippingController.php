<?php


namespace App\Http\Controllers\Admin\Shipping;


use App\Bll\Utility;
use App\Http\Controllers\Controller;
use App\Models\cities;
use App\Models\countries;
use App\Models\Language;
use App\Models\Shipping\Cities_shipping_option;
use App\Models\Shipping\Shipping_option;
use App\Models\Shipping\Shipping_type;
use App\Models\Shipping\shippingCompanies;
use App\StoreData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ShippingController extends Controller
{

    public function index(){

        $storeId = Utility::getStoreId();
        $store = StoreData::where('id' , $storeId)->first();

        $countries = countries::join('countries_data','countries_data.country_id','countries.id')
            ->select('countries_data.title','countries.id')->where('countries_data.source_id' , null)->get();
        $cities = cities::join('city_datas','city_datas.city_id','cities.id')
            ->select('city_datas.title','cities.id')->where('city_datas.source_id' , null)->get();

        $shipping_company = shippingCompanies::where('store_id',$storeId)->where('title','like', "Free Shipping")->first();
        if($shipping_company != null){
            $shipping_options = Shipping_option::where('store_id',$storeId)->where('company_id' ,$shipping_company->id)->get();
        }else{
            $shipping_options = null;
        }
        //dd($shipping_options);

        $companies = shippingCompanies::where('store_id',$storeId)->where('title','!=', "Free Shipping")->get();


        return view('admin.shipping.companies.index', compact('countries','cities','shipping_options',
        'shipping_company' ,'companies'));
    }

    public function get_cities(Request $request)
    {

        $cities = cities::join('city_datas','city_datas.city_id','cities.id')
            ->select('city_datas.title','cities.id')->where('city_datas.source_id' , null)
            ->where('cities.country_id',$request->country_id)->get();
        return response()->json($cities);
    }

    public function save_shipping_company(Request $request)
    {
        //dd($request->all());
        $storeId = Utility::getStoreId();
        $langId = Language::first()->id;
        if($request->free_shipping == 1){
            $shipping_company = shippingCompanies::where('store_id',$storeId)->where('title','like', "Free Shipping")->first();

            if($shipping_company == null){
                $shipping_company = shippingCompanies::create([
                    'title' => "Free Shipping",
                    'store_id' => $storeId,
                    'lang_id' => $langId,
                ]);

            }else{
                $old_shipping_options = Shipping_option::where('store_id',$storeId)->where('company_id' ,$shipping_company->id)->delete();
                for( $i=0 ; $i<count($request->country_id) ; $i++){
                    $request['country_id'][$i] == "all" ? "null" : $request['country_id'][$i] ;
                    $request['city_id'][$i] == "all" ? "null" : $request['city_id'][$i] ;
                    $shipping_options = Shipping_option::create([
                        'company_id' => $shipping_company->id,
                        'country_id' => $request['country_id'][$i],
                        'minimum_purchases' => $request['minimum_purchases'][$i],
                        'store_id' => $storeId,
                        'lang_id' => $langId,
                    ]);
                    $cities_shipping_options = Cities_shipping_option::create([
                       'shipping_option_id' => $shipping_options->id,
                       'city_id' => $request['city_id'][$i],
                    ]);

                }
            }

        }else{ // if not free shipping =>  $request->free_shipping == 1

            $shipping_company = shippingCompanies::create([
                'title' => $request->company_name,
                'store_id' => $storeId,
                'lang_id' => $langId,
            ]);
            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $request->logo->move(public_path('uploads/shipping_company/'.$shipping_company->id), $filename);

                $shipping_company->logo = '/uploads/shipping_company/'. $shipping_company->id .'/'. $filename;
                $shipping_company->save();
            }
            $old_shipping_options = Shipping_option::where('store_id',$storeId)->where('company_id' ,$shipping_company->id)->delete();
            for( $i=0 ; $i<count($request->country_id) ; $i++){
                if($request['delivery_method'][$i] == "available"){
                    $comission = $request['cash_delivery_commission'][$i];
                }else{
                    $comission = null ;
                }

                if($request['pricing_type'][$i] == "fixed"){
                    $cost = $request['cost'][$i];
                    $no_kg = null;
                    $cost_no_kg = null;
                    $cost_increase = null;
                    $kg_increase = null;

                }else{
                    $cost = null ;
                    $no_kg = $request['no_kg'][$i];
                    $cost_no_kg = $request['cost_no_kg'][$i];
                    $cost_increase = $request['cost_increase'][$i];
                    $kg_increase = $request['kg_increase'][$i];
                }

                $request['country_id'][$i] == "all" ? "null" : $request['country_id'][$i] ;
                $request['city_id'][$i] == "all" ? "null" : $request['city_id'][$i] ;
                $shipping_options = Shipping_option::create([
                    'company_id' => $shipping_company->id,
                    'country_id' => $request['country_id'][$i],
                    'cash_delivery_commission' => $comission,
                    'cost' => $cost,
                    'delay' => $request['delay'][$i],
                    'store_id' => $storeId,
                    'lang_id' => $langId,
                ]);
                $shipping_types = Shipping_type::create([
                    'shipping_option_id' => $shipping_options->id,
                    'no_kg' => $no_kg,
                    'cost_no_kg' => $cost_no_kg,
                    'cost_increase' => $cost_increase,
                    'kg_increase' => $kg_increase,
                    'store_id' => $storeId
                ]);
                $cities_shipping_options = Cities_shipping_option::create([
                    'shipping_option_id' => $shipping_options->id,
                    'city_id' => $request['city_id'][$i],
                ]);

            }


        }

        return redirect()->back()->with('success', _i('Saved Successfully !'));
    }

    public function update_shipping_company($id , Request $request)
    {
        $storeId = Utility::getStoreId();
        $shipping_company = shippingCompanies::findOrFail($id);
        $shipping_company->update([
            'title' => $request->company_name,
            'store_id' => $storeId,
        ]);
        if ($request->hasFile('logo')) {
            $image_path = $shipping_company->logo;
            if (File::exists(public_path($image_path))) {
                File::delete(public_path($image_path));
            }
            $image = $request->file('logo');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $request->logo->move(public_path('uploads/shipping_company/'.$shipping_company->id), $filename);

            $shipping_company->logo = '/uploads/shipping_company/'. $shipping_company->id .'/'. $filename;
            $shipping_company->save();
        }

        $old_shipping_options = Shipping_option::where('store_id',$storeId)->where('company_id' ,$shipping_company->id)->delete();
        for( $i=0 ; $i<count($request->country_id) ; $i++){
            if($request['delivery_method'][$i] == "available"){
                $comission = $request['cash_delivery_commission'][$i];
            }else{
                $comission = null ;
            }

            if($request['pricing_type'][$i] == "fixed"){
                $cost = $request['cost'][$i];
                $no_kg = null;
                $cost_no_kg = null;
                $cost_increase = null;
                $kg_increase = null;

            }else{
                $cost = null ;
                $no_kg = $request['no_kg'][$i];
                $cost_no_kg = $request['cost_no_kg'][$i];
                $cost_increase = $request['cost_increase'][$i];
                $kg_increase = $request['kg_increase'][$i];
            }

            $request['country_id'][$i] == "all" ? "null" : $request['country_id'][$i] ;
            $request['city_id'][$i] == "all" ? "null" : $request['city_id'][$i] ;
            $shipping_options = Shipping_option::create([
                'company_id' => $shipping_company->id,
                'country_id' => $request['country_id'][$i],
                'cash_delivery_commission' => $comission,
                'cost' => $cost,
                'delay' => $request['delay'][$i],
                'store_id' => $storeId,
            ]);
            $shipping_types = Shipping_type::create([
                'shipping_option_id' => $shipping_options->id,
                'no_kg' => $no_kg,
                'cost_no_kg' => $cost_no_kg,
                'cost_increase' => $cost_increase,
                'kg_increase' => $kg_increase,
                'store_id' => $storeId
            ]);
            $cities_shipping_options = Cities_shipping_option::create([
                'shipping_option_id' => $shipping_options->id,
                'city_id' => $request['city_id'][$i],
            ]);

        }

        return redirect()->back()->with('success', _i('Saved Successfully !'));

    }

    public function delete_shipping_option(Request $request)
    {
        $shipping_option = Shipping_option::destroy($request->optionId);
        return response()->json(true);


    }
}
