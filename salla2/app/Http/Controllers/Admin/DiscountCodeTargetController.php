<?php


namespace App\Http\Controllers\Admin;


use App\Bll\Utility;
use App\DataTables\DiscountCodeTargetDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Language;
use App\Models\product\discount_code;
use App\Models\product\discount_code_data;
use App\Models\product\DiscountCodeItems;
use App\Models\product\DiscountCodeTarget;
use App\Models\product\product_details;
use Illuminate\Http\Request;

class DiscountCodeTargetController extends Controller
{

    public function index(DiscountCodeTargetDataTable $query)
    {
        return $query->render('admin.discount_code.target.index');
    }


    public function create()
    {
        $categories = Category::select(['id', 'title', 'store_id', 'parent_id',])
            ->where('parent_id', '=', null)
            ->where('store_id', Utility::getStoreId())->get();

        $products = product_details::select('products.id as prod_id', 'product_details.title as title')
            ->join('products', 'products.id', '=', 'product_details.product_id')
            ->where('products.store_id', Utility::getStoreId())->get();

        // dd($categories , $products);
        return view('admin.discount_code.target.create', compact('categories', 'products'));
    }

    public function store(Request $request)
    {
        $request->discount_type = $request->discount_type ?? null;
        $request->discount = $request->discount ?? null;
        $request->items_count = $request->items_count ?? null;
        $request->lang_id = $request->lang_id ?? Language::first()->id;

        $discount = discount_code::create([
            'store_id' => Utility::getStoreId(),
            'discount' => $request->discount,
            'type' => $request->discount_type,
            'expire_date' => $request->expire_date,
            'status' => 1,
            'items_count' => $request->items_count,
        ]);

        $discount_data = discount_code_data::create([
            'discount_code_id' => $discount->id,
            'lang_id' => $request->lang_id,
            'title' => $request->offer_name,
            'source_id' => null
        ]);
        /*************************** discount code items ***************************/
        if ($request->buyProducts || $request->buyCategories) {
            /***************** type => category ******************/
            if ($request->buyCategories) {
                if ($request->buyCategories[0] == "all_category") {
                    $discount_items = DiscountCodeItems::create([
                        'discount_id' => $discount->id,
                        'type' => "category",
                        'include_all' => 1,
                        'item_id' => null,
                    ]);
                } else {
                    foreach ($request->buyCategories as $single_itemId) {
                        $discount_items = DiscountCodeItems::create([
                            'discount_id' => $discount->id,
                            'type' => "category",
                            'include_all' => 0,
                            'item_id' => $single_itemId,
                        ]);
                    }
                }
            }
            /***************** $request->buyProducts ******************/
            if ($request->buyProducts) {
                if ($request->buyProducts[0] == "all_product") {
                    $discount_items = DiscountCodeItems::create([
                        'discount_id' => $discount->id,
                        'type' => "product",
                        'include_all' => 1,
                        'item_id' => null,
                    ]);
                } else {
                    foreach ($request->buyProducts as $single_itemId) {
                        $discount_items = DiscountCodeItems::create([
                            'discount_id' => $discount->id,
                            'type' => "product",
                            'include_all' => 0,
                            'item_id' => $single_itemId,
                        ]);
                    }
                }
            }
        }


        /*************************** discount code target ***************************/
        if ($request->optainProducts || $request->optainCategories) {
            /***************** type => products ******************/
            if ($request->model_type == "products" && $request->optainProducts) {
                foreach ($request->optainProducts as $single_itemId) {
                    $discount_items = DiscountCodeTarget::create([
                        'discount_id' => $discount->id,
                        'model_type' => $request->model_type,
                        'item_id' => $single_itemId,
                    ]);
                }
            }
            /***************** type => category ******************/
            if ($request->model_type == "category" && $request->optainCategories) {
                foreach ($request->optainCategories as $single_itemId) {
                    $discount_items = DiscountCodeTarget::create([
                        'discount_id' => $discount->id,
                        'model_type' => $request->model_type,
                        'item_id' => $single_itemId,
                    ]);
                }
            }
        }
        return redirect()->route('store.offers')->with('flash_message', _i('Saved Succesfully'));
    }

    public function edit($id)
    {
        $discount = discount_code::findOrFail($id);
        $discount_data = discount_code_data::where('discount_code_id', $discount->id)->where('source_id', null)->first();

        $discount_items_product = DiscountCodeItems::where('discount_id', $discount->id)->where('type', "product")->get();
        $discount_items_category = DiscountCodeItems::where('discount_id', $discount->id)->where('type', "category")->get();
        $discount_target_product = DiscountCodeTarget::where('discount_id', $discount->id)->where('model_type', "products")->get();
        $discount_target_category = DiscountCodeTarget::where('discount_id', $discount->id)->where('model_type', "category")->get();

        $categories = Category::select(['id', 'title', 'store_id', 'parent_id',])
            ->where('parent_id', '=', null)
            ->where('store_id', Utility::getStoreId())->get();

        $discount_items = DiscountCodeItems::where('discount_id', $discount->id)->get();
        $discount_target = DiscountCodeTarget::where('discount_id', $discount->id)->get();
//dd($discount_target_category);


        $products = product_details::select('products.id as prod_id', 'product_details.title as title')
            ->join('products', 'products.id', '=', 'product_details.product_id')
            ->where('products.store_id', Utility::getStoreId())->get();

        return view('admin.discount_code.target.edit', compact('categories', 'products', 'discount', 'discount_data',
            'discount_items_product', 'discount_items_category', 'discount_target_product', 'discount_target_category',
            'discount_items', 'discount_target'));
    }


    public function update($id, Request $request)
    {
        //dd($request->model_type);
        $discount = discount_code::findOrFail($id);

        $request->discount_type = $request->discount_type ?? null;
        $request->discount = $request->discount ?? null;
        $request->items_count = $request->items_count ?? null;
        $request->lang_id = $request->lang_id ?? Language::first()->id;

        $discount->update([
            //'store_id' => Utility::getStoreId(),
            'discount' => $request->discount,
            'type' => $request->discount_type,
            //'count' => null,
            'expire_date' => $request->expire_date,
            // 'status' => 1,
            'items_count' => $request->items_count,
        ]);

        $discount_data = discount_code_data::where('discount_code_id', $discount->id)->where('source_id', null)->first();
        $discount_data->update([
            //'discount_code_id' => $discount->id,
            'lang_id' => $request->lang_id,
            'title' => $request->offer_name,
            // 'source_id' => null
        ]);

        $discount_items = DiscountCodeItems::where('discount_id', $discount->id)->delete();
        /*************************** discount code items ***************************/
        if ($request->buyProducts || $request->buyCategories) {
            if ($request->discount_code_item_type == "category") {
                if ($request->buyCategories) {
                    if ($request->buyCategories[0] == "all_category") {
                        $discount_items = DiscountCodeItems::create([
                            'discount_id' => $discount->id,
                            'type' => "category",
                            'include_all' => 1,
                            'item_id' => null,
                        ]);
                    } else {
                        foreach ($request->buyCategories as $single_itemId) {
                            $discount_items = DiscountCodeItems::create([
                                'discount_id' => $discount->id,
                                'type' => "category",
                                'include_all' => 0,
                                'item_id' => $single_itemId,
                            ]);
                        }
                    }
                }
            } else {
                /***************** $request->buyProducts ******************/
                if ($request->buyProducts) {
                    if ($request->buyProducts[0] == "all_product") {
                        $discount_items = DiscountCodeItems::create([
                            'discount_id' => $discount->id,
                            'type' => "product",
                            'include_all' => 1,
                            'item_id' => null,
                        ]);
                    } else {
                        foreach ($request->buyProducts as $single_itemId) {
                            $discount_items = DiscountCodeItems::create([
                                'discount_id' => $discount->id,
                                'type' => "product",
                                'include_all' => 0,
                                'item_id' => $single_itemId,
                            ]);
                        }
                    }
                }
            }
        }

        /*************************** discount code target ***************************/
        $discount_targets = DiscountCodeTarget::where('discount_id', $discount->id)->delete();

        if ($request->optainProducts || $request->optainCategories) {
            /***************** type => products ******************/
            if ($request->model_type == "products" && $request->optainProducts) {
                foreach ($request->optainProducts as $single_itemId) {
                    $discount_items = DiscountCodeTarget::create([
                        'discount_id' => $discount->id,
                        'model_type' => $request->model_type,
                        'item_id' => $single_itemId,
                    ]);
                }
            }
            /***************** type => category ******************/
            if ($request->model_type == "category" && $request->optainCategories) {
                foreach ($request->optainCategories as $single_itemId) {
                    $discount_items = DiscountCodeTarget::create([
                        'discount_id' => $discount->id,
                        'model_type' => $request->model_type,
                        'item_id' => $single_itemId,
                    ]);
                }
            }
        }
        return redirect()->route('store.offers')->with('flash_message', _i('Updated Succesfully'));

    }


    public function delete($id)
    {
        $discount = discount_code::findOrFail($id);
        $discount_data = discount_code_data::where('discount_code_id', $discount->id)->delete();
        $discount_items = DiscountCodeItems::where('discount_id', $discount->id)->delete();
        $discount_target = DiscountCodeTarget::where('discount_id', $discount->id)->delete();
        $discount->delete();

        return redirect()->back()->with('flash_message', _i('Deleted Succesfully'));
    }

}
