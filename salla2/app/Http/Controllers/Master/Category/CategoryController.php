<?php

/**
 * Created by PhpStorm.
 * User: misr computer
 * Date: 21/07/2019
 * Time: 03:37 �
 */

namespace App\Http\Controllers\Master\Category;

use App\Help\Utility;
use App\Models\product\stores;
use function foo\func;
use Ut;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller {

    public function create() {
        $categories = Category::where('lang_id', 1)->whereNull('store_id')->whereNull("parent_id")->orderBy('number', 'asc')->get();
        return view('master.category.create', compact('categories'));
    }
 private function getCategories()
    {
        $categories = Category::whereNull('store_id')->whereNull("parent_id")->where('lang_id', 1)->orderBy('number', 'asc')->with(['children' => function ($query) {
            $query->orderBy('number', 'asc');
        }])->get();
        return $categories;
    }
   public function saveAll(Request $request)
    {

        $storeId = null ;
      

        $cats = $request->input('category');
        $cats_sort = $request->input('sort');
        $parent_sort = $request->input("parent_sort");
        if ($request->input('parentCategory') != null) {


            foreach ($request->input('parentCategory') as $key => $arr_parent_cats) {

                if ($key == "new") {

                    $parent_sort = $parent_sort["new"];
                    $new_parent_cats_index = 0;
                    foreach ($arr_parent_cats as $virtual_category_id => $new_parent_cat) {
                        $sort_val = $parent_sort[$virtual_category_id];
                        $inserted = null;
                        foreach ($new_parent_cat as $title) {
                            $inserted = Category::create(['title' => $title,
                                'store_id' => $storeId,
                                'number' => $sort_val[0],
                                'lang_id' => 1]);

                            $new_parent_cats_index++;
                        }
                        if (isset($cats["new"])) {
                            $new_sub_categories = $cats["new"];
                            if ($new_sub_categories && isset($new_sub_categories[$virtual_category_id])) {
                                $sort_sub = $cats_sort["new"];
                                $sort_sub = $sort_sub[$virtual_category_id];

                                $sub_category_index = 0;
                                //  var_dump($sort_sub);
                                foreach ($new_sub_categories[$virtual_category_id] as $sub_category) {
                                    //  dd($inserted->id);
                                    Category::create(['title' => $sub_category,
                                        'store_id' => $storeId,
                                        'parent_id' => $inserted->id,
                                        'number' => $sort_sub[$sub_category_index],
                                        'lang_id' => 1]);
                                    $sub_category_index++;
                                }
                                //Category::create(['title' => $found, 'store_id' => session()->get("StoreId"), 'number' => $sort[$i], 'lang_id' => 1]);
                                unset($cats["new"][$virtual_category_id]);
                            }
                        }
                    }
                } else {
                    $categoryEntity = Category::findOrFail($key);
                    $parent_sort = $request->input("parent_sort");
                    $categoryEntity->update(['title' => $arr_parent_cats, 'number' => $parent_sort[$key]]);
                }
            }
        }
        //add children
        if ($cats != null) {

            foreach ($cats as $category_id => $new_parent_cat) {

                foreach ($new_parent_cat as $key => $arr_parent_cats) {
                    $parent_sort = $request->input("sort");
                    $parent_sort = $parent_sort[$category_id];
                    if ($key == "new") {

                        $parent_sort = $parent_sort["new"];
                        $new_parent_cats_index = 0;
                        foreach ($arr_parent_cats as $item_1) {
                            Category::create(['title' => $item_1, 
                                'store_id' => $storeId, 
                                'number' => $parent_sort[$new_parent_cats_index], 
                                "parent_id" => $category_id, 'lang_id' => 1]);
                            $new_parent_cats_index++;
                        }
                    } else if ($key == "") {

                        ;
                    } else {

                        $categoryEntity = Category::findOrFail($key);

                        $categoryEntity->update(['title' => $arr_parent_cats, 'number' => $parent_sort[$key]]);
                    }
                }
            }
        }

        $categories = $this->getCategories();
        return response()->json($categories);
    }

 

    public function del($cat_id)
    {
        $storeId = null;
       
        $category = Category::where('id', $cat_id)->where("store_id", $storeId)->first();

        if ($category) {
            if (count($category->products) > 0) {
                return response()->json('failed');
            } else {
               
              //  $sub_exists = Category::where('parent_id', $category->id)->exists();
                Category::where("parent_id", $category->id)->delete();

                $category->delete();
                $categories = $this->getCategories();

                return response()->json($categories);
            }
        }
    }

}
