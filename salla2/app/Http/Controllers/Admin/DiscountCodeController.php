<?php

namespace App\Http\Controllers\Admin;

use App\Bll\Utility;
use App\DataTables\DiscountCodeDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\product\discount_code;
use App\Models\product\discount_code_data;
use App\Models\product\DiscountCodeItems;
use App\Models\product\product_details;
use App\Models\product\stores;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DiscountCodeController extends Controller
{

    public function index(DiscountCodeDataTable $discountCodeDataTable) {
        $categories = Category::select(['id', 'title','store_id', 'parent_id',  ])
            ->where('parent_id' ,'=' , null)
            ->where('store_id', Utility::getStoreId())->get();

        $products = product_details::select('products.id as prod_id','product_details.title as title')
            ->join('products','products.id','=','product_details.product_id')
            ->where('products.store_id',Utility::getStoreId())->get();

        $users = Group::where('store_id' , Utility::getStoreId())->get();

        return $discountCodeDataTable->render('admin.discount_code.index' , compact('categories','products','users'));
    }

    public function store(Request $request) {



        if($request->ajax()) {

            $store = stores::findOrFail(\App\Bll\Utility::getStoreId());


            $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                'title'    => 'required',
                'code'     => 'required|unique:discount_codes',
                'discount' => 'required|numeric',
                'count'    => 'required|numeric',
                'type'     => 'required',
            ]);

            if ($validator->fails()) {

                return response()->json([false,'errors'=>$validator->errors()->all()]);

            } else {



                $discount_code = discount_code::create([
                    'store_id' => $store->id,
                    'code' => $request->code,
                    'discount' => $request->discount,
                    'count' => $request->count,
                    'type' => $request->type,
                    'status' => 1,
                    'expire_date' => $request->expire_date,
                ]);



                $discount_code_data = discount_code_data::create([
                    'discount_code_id' => $discount_code->id,
                    'title' => $request->title,
                    'lang_id' => getLang(session('adminlang')),
                ]);

                if($request->type_category || $request->type_product || $request->type_userGroup )
                {
                    /***************** $request->type_category ******************/
                    if($request->type_category)
                    {
                        if($request->type_category[0] == "all_category")
                        {
                            $discount_items = DiscountCodeItems::create([
                                'discount_id' => $discount_code->id,
                                'type' => "category",
                                'include_all' => 1,
                                'item_id' => null,
                            ]);

                        }else{
                            foreach ($request->type_category as $single_itemId)
                            {
                                $discount_items = DiscountCodeItems::create([
                                    'discount_id' => $discount_code->id,
                                    'type' => "category",
                                    'include_all' => 0,
                                    'item_id' => $single_itemId,
                                ]);
                            }
                        }
                    }
                    /***************** $request->type_category ******************/
                    if($request->type_product)
                    {
                        if($request->type_product[0] == "all_product")
                        {
                            $discount_items = DiscountCodeItems::create([
                                'discount_id' => $discount_code->id,
                                'type' => "product",
                                'include_all' => 1,
                                'item_id' => null,
                            ]);
                        }else{
                            foreach ($request->type_product as $single_itemId)
                            {
                                $discount_items = DiscountCodeItems::create([
                                    'discount_id' => $discount_code->id,
                                    'type' => "product",
                                    'include_all' => 0,
                                    'item_id' => $single_itemId,
                                ]);
                            }
                        }
                    }

                    /***************** $request->type_category ******************/
                    if($request->type_userGroup)
                    {
                        if($request->type_userGroup[0] == "all_userGroup")
                        {
                            $discount_items = DiscountCodeItems::create([
                                'discount_id' => $discount_code->id,
                                'type' => "user_group",
                                'include_all' => 1,
                                'item_id' => null,
                            ]);
                        }else{
                            foreach ($request->type_userGroup as $single_itemId)
                            {
                                $discount_items = DiscountCodeItems::create([
                                    'discount_id' => $discount_code->id,
                                    'type' => "user_group",
                                    'include_all' => 0,
                                    'item_id' => $single_itemId,
                                ]);
                            }
                        }
                    }
                }

                return response()->json(true);
            }

        }

    }

    public function update(Request $request,$id) {
//dd($request->all());
        if($request->ajax()) {
            $discount_code =  discount_code::findOrFail($id);

            $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                'title' => ['required'],
                'code' => ['required', Rule::unique('discount_codes')->ignore($discount_code->id)],
                'discount' => ['required','numeric'],
                'count' => ['required','numeric'],
                //'type' => ['required'],
            ]);

            if ($validator->fails()) {
                return response()->json([false,'errors'=>$validator->errors()->all()]);
            } else {
//dd($id);
                $discount_code->store_id = Utility::getStoreId();
                $discount_code->code = $request->code;
                $discount_code->discount = $request->discount;
                $discount_code->count = $request->count;
                $discount_code->type = $request->type;
                $discount_code->expire_date = $request->expire_date;
                $discount_code->save();

                $discount_code_data = discount_code_data::where('discount_code_id', $discount_code->id)
                    //->where('lang_id', getLang(session('adminlang')))
                    ->where('source_id', null)
                    ->first();
                $discount_code_data->title = $request->title;
                $discount_code_data->save();

                if($request->type_category || $request->type_product || $request->type_userGroup )
                {
                    /***************** $request->type_category ******************/
                    if($request->type_category)
                    {
                        $discount_items = DiscountCodeItems::where('discount_id' ,$discount_code->id)->where('type' , "category")->delete();

                        if($request->type_category[0] == "all_category")
                        {
                            $discount_items = DiscountCodeItems::create([
                                'discount_id' => $discount_code->id,
                                'type' => "category",
                                'include_all' => 1,
                                'item_id' => null,
                            ]);
                        }else{
                            foreach ($request->type_category as $single_itemId)
                            {
                                $discount_items = DiscountCodeItems::create([
                                    'discount_id' => $discount_code->id,
                                    'type' => "category",
                                    'include_all' => 0,
                                    'item_id' => $single_itemId,
                                ]);
                            }
                        }
                    }
                    /***************** $request->type_category ******************/
                    if($request->type_product)
                    {
                        $discount_items = DiscountCodeItems::where('discount_id' ,$discount_code->id)->where('type' , "product")->delete();

                        if($request->type_product[0] == "all_product")
                        {
                            $discount_items = DiscountCodeItems::create([
                                'discount_id' => $discount_code->id,
                                'type' => "product",
                                'include_all' => 1,
                                'item_id' => null,
                            ]);
                        }else{
                            foreach ($request->type_product as $single_itemId)
                            {
                                $discount_items = DiscountCodeItems::create([
                                    'discount_id' => $discount_code->id,
                                    'type' => "product",
                                    'include_all' => 0,
                                    'item_id' => $single_itemId,
                                ]);
                            }
                        }
                    }

                    /***************** $request->type_category ******************/
                    if($request->type_userGroup)
                    {
                        $discount_items = DiscountCodeItems::where('discount_id' ,$discount_code->id)->where('type' , "user_group")->delete();

                        if($request->type_userGroup[0] == "all_userGroup")
                        {
                            $discount_items = DiscountCodeItems::create([
                                'discount_id' => $discount_code->id,
                                'type' => "user_group",
                                'include_all' => 1,
                                'item_id' => null,
                            ]);
                        }else{
                            foreach ($request->type_userGroup as $single_itemId)
                            {
                                $discount_items = DiscountCodeItems::create([
                                    'discount_id' => $discount_code->id,
                                    'type' => "user_group",
                                    'include_all' => 0,
                                    'item_id' => $single_itemId,
                                ]);
                            }
                        }
                    }
                }

                return response()->json(true);
            }
        }
    }


    public function destroy ($id)
    {
        //dd($id);
        $discount_code =  discount_code::findOrFail($id);
        $discount_code_data = discount_code_data::where('discount_code_id', $discount_code->id)->delete();
        $discount_items = DiscountCodeItems::where('discount_id' ,$discount_code->id)->get();
        if(count($discount_items) > 0  )
        {
            foreach ($discount_items as $item){
                $item->delete();
            }
        }
        $discount_code->delete();
        return redirect()->back()->with('flash_message',  _i('Deleted Succesfully'));


    }

    public function get_types()
    {
        $discountId = \request()->discountId;

        $items_category = DiscountCodeItems::where('discount_id' ,$discountId)->where('type' ,"category")
            ->get();
        if(count($items_category) > 0)
        {
            if($items_category[0]->include_all == 1)
            {
                $data_category ="all_category";
            }else{
                $data_category = $items_category->where('include_all' ,0)->pluck(["item_id"]);
            }
        }else{$data_category = null;}

        $items_product = DiscountCodeItems::where('discount_id' ,$discountId)->where('type' ,"product")
            ->get();
        if(count($items_product) > 0)
        {
            if($items_product[0]->include_all == 1)
            {
                $data_product ="all_product";
            }else{
                $data_product = $items_product->where('include_all' ,0)->pluck(["item_id"]);
            }
        }else{$data_product = null;}

        $items_userGroup = DiscountCodeItems::where('discount_id' ,$discountId)->where('type' ,"user_group")
            ->get();
        if(count($items_userGroup) > 0)
        {
            if($items_userGroup[0]->include_all == 1)
            {
                $data_userGroup ="all_userGroup";
            }else{
                $data_userGroup = $items_userGroup->where('include_all' ,0)->pluck(["item_id"]);
            }
        }else{$data_userGroup = null;}

        return response()->json(["data_category" => $data_category , "data_product" => $data_product ,"data_userGroup" => $data_userGroup]);

    }

}
