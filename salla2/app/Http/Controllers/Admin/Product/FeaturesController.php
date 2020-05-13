<?php

namespace App\Http\Controllers\Admin\Product;

use App\DataTables\FeaturesDataTable;
use App\Http\Controllers\Controller;
use App\Models\product\feature_options;
use App\Models\product\features;
use App\Models\product\product_details;
use App\Models\product\product_features;
use App\Models\product\products;
use App\Models\Product_type;
use App\Store;
use Illuminate\Http\Request;

class FeaturesController extends Controller
{

    public function index(FeaturesDataTable $feature)
    {

        return $feature->render('admin.products.features.all');
    }

    public function show($id)
    {
        $product_feature = product_features::findOrFail($id);

        $product = products::select('products.*','product_details.title')
            ->join('product_details','product_details.product_id','=','products.id')
            ->where('products.id' ,'=',$product_feature->product_id)
            ->first();
        $product_type = Product_type::where('id' ,'=' ,$product->product_type)->first();
        $feature = features::where('id','=',$product_feature->feature_id)->first();
        $feature_options = feature_options::where('feature_id','=',$feature->id)->get();
        $store = Store::where('id','=',$product->store_id)->first();
//        dd($feature_options);

        return view('admin.products.features.show' ,compact('product_feature','product','feature','feature_options','store'));
    }


    public function delete($id)
    {
//        dd($id);
        $product_feature = product_features::findOrFail($id);
        $product_feature->delete();
        return redirect('adminpanel/features/all')->with('flash_message' ,_i('Deleted Successfully !'));
    }

    public function destroy($id)
    {
        $product_feature = product_features::findOrFail($id);
        $product_feature->delete();
        return redirect()->with('flash_message' ,_i('Deleted Successfully !'));
    }






}
