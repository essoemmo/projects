<?php

namespace App\Http\Controllers\Admin\Product;

use App\Bll\Constants;
use App\DataTables\productTableDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\product\feature_data;
use App\Models\product\feature_option_data;
use App\Models\product\feature_options;
use App\Models\product\features;
use App\Models\product\orders;
use App\Models\product\product_details;
use App\Models\product\product_photos;
use App\Models\product\products;
use App\Models\product\stores;
use App\Models\Product_type;
use App\Models\ProductPrice;
use App\Store;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Notification;
use Up;

class ProductsController extends Controller
{

    public function all_products(productTableDataTable $product)
    {

        return $product->render('admin.products.product.index');
    }

    public function show_product($id)
    {
        $product = products::findOrFail($id);
        $store = Store::where('id', '=', $product->store_id)->first();
        $category = Category::where('id', '=', $product->category_id)->first();


        $product_type = Product_type::where('id', '=', $product->product_type)->first();
//         dd($product);
        return view('admin.products.product.show_product', compact('product', 'store', 'category', 'product_type'));
    }

    public function edit($id)
    {

        $sessionStore = session()->get('StoreId');
        //dd($sessionStore);
        $store = stores::where('id', $sessionStore)->first(); //        dd($store->languages);
        //dd($store);
        // $features = features::with('options')->where('store_id', $store['id'])->get();
        $features = features::with('options')->where('product_id', $id)->get();

        $product_type = Product_type::where('lang_id', Constants::defaultLanguage)->where('store_id', $store['id'])->get();
        $categories = Category::where('lang_id', Constants::defaultLanguage)->where('store_id', $store['id'])->with('products')->with(['parent' => function ($query) {
            $query->where('lang_id', Constants::defaultLanguage);
        }])->orderBy('number', 'asc')->with(['children' => function ($query) {
            $query->orderBy('number', 'asc');
        }])->get();
        $products = product_details::where('id', $id)->with(['product' => function ($query) use ($store) {
            $query->where('store_id', $store['id']);
            $query->with(['categories' => function ($q) {
                $q->with('children');
                $q->with('parent');
                $q->with('products');
                $q->where('lang_id', Constants::defaultLanguage);
            }]);
            $query->with('product_type');
            $query->with('product_photos');
            $query->with(['features' => function ($q) {
                $q->with('options');
            }]);
        }])->orderBy('id', 'desc')->get();
        $product = products::findOrFail($id);
        return view('admin.products.products.edit', compact('products', 'product_type', 'categories', 'features', 'store', 'product'));
    }

    public function delete($id)
    {
        $sessionStore = session()->get('StoreId');

        if ($sessionStore == \App\Bll\Utility::$demoId)
            return redirect()->back()->with('success', _i('Deleted Successfully !'));

        $product = products::where("id", $id)->where("store_id", $sessionStore)->first();

        //$store = stores::where('id', '=', $product->store_id);
        // if ($store != null) {
        //     return redirect()->back()->with('danger', _i('Can`t Delete Product Because it attached with Store!'));
        // } else {
        $product->delete();
        return redirect()->back()->with('success', _i('Deleted Successfully !'));
    }

    public function dublicated(Request $request)
    {

        if (\App\Bll\Utility::IsDemoStore()) {
            
            return redirect()->back()->with('success', _i('Duplicated Successfully !'));
        }
        $product = products::where("id", $request->id)->where("store_id", \App\Bll\Utility::getStoreId())->first();

        if ($product == null) {
            return redirect()->back()->with('error', _i('Product Not found !'));
        }

//products::findOrFail($request->id);
        DB::beginTransaction();
        try {
            $newProduct = products::create([
                'currency_code' => $product->currency_code,
                'sku' => $product->sku,
                'max_count' => $product->max_count,
                'weight' => $product->weight,
                'price' => $product->price,
                'net' => $product->net,
                'stock' => $product->stock,
                'discount' => $product->discount,
                'discount_type' => $product->discount_type,
                'delivary' => $product->delivary,
                'product_type' => $product->product_type,
                'store_id' => $product->store_id,
            ]);
            if ($product->Category() != null) {
                $newProduct->categories()->attach($product->Category());
            }
            $details = $product->singleProductDetails();
            //dd($details);
            $product_details = product_details::create([
                'title' => $details->title,
                'description' => $details->description,
                'product_id' => $newProduct->id, 'lang_id' => Constants::defaultLanguage]);

            DB::commit();
            \Illuminate\Support\Facades\File::copyDirectory(public_path('uploads/products/' . $product->id), public_path('uploads/products/' . $newProduct->id));
            $photos = $product->product_photos()->get();
            foreach ($photos as $photo) {
                product_photos::create([
                    'product_id' => $newProduct->id,
                    'photo' => str_replace("/{$photo->product_id}/", "/" . $newProduct->id . "/", $photo->photo),
                    'description' => $photo->description,
                    'tag' => $photo->tag,
                    'main' => $photo->main,
                ]);
            }
            return redirect()->back()->with('success', _i('Duplicated Successfully !'));
        } catch (\Exception $e) {
            return $e;
            DB::rollBack();
        }
        return redirect()->back()->with('error', _i('Failed !'));
    }


    public function hidden(Request $request)
    {
        $product = products::where("id", $request->id)->where("store_id", \App\Bll\Utility::getStoreId())->first();
        $val = 0;
        if ($product == null) {
            $val = 1;
            return response()->json(['pro_hidden' => $val, 'status' => 'success']);
        }
        if ($product->hidden == 0) {
            $val = 1;
        }

        if (!\App\Bll\Utility::IsDemoStore()) {
            $product->hidden = $val;
            $product->save();
        }
        return response()->json(['pro_hidden' => $val, 'status' => 'success']);
    }

    public function Get_users_product($id)
    {


        $sessionStore = session()->get('StoreId');

        $product = products::findOrFail($id);

        $users_product = User::
        leftJoin('orders', 'orders.user_id', '=', 'users.id')
            ->leftJoin('order_products', 'order_products.order_id', '=', 'orders.id')
            ->leftJoin('product_details', 'product_details.product_id', '=', 'order_products.product_id')
            ->where("users.store_id", $sessionStore)
            ->where("order_products.product_id", $id)
            ->select('product_details.title as proname', 'users.name as username', 'users.lastname as userlastname', 'users.image as userimage')
            ->get();



        return view('admin.products._product.pro_users', compact('users_product'));
    }

    public function get_category()
    {

        $categories = Category::where('parent_id', null)->orderBy('number', 'asc')->where('store_id', session('StoreId'))->get();
//        dd($categories);

        foreach ($categories as $key => $category) {
            $sub_categories = Category::where('parent_id', $category->id)->orderBy('number', 'asc')->get();
//            $sub_cats [] = $sub_categories;
            $cat_result [] = [
                'parent_cat' => $category,
                'child_cat' => $sub_categories
            ];
        }
        return $cat_result;
    }

    public function Get_status(Request $request)
    {
        $sessionStore = session()->get('StoreId');
        $proorders = orders::leftJoin('order_products', 'order_products.order_id', '=', 'orders.id')
            ->where("order_products.product_id", $request->id)
            ->where('orders.store_id', $sessionStore)
            ->get();

        $sum = $proorders->sum('total');
        $order_numb = $proorders->count();
        $penfit = $sum - $proorders->sum('shipping_cost');
        // dd($proorders);
        return response()->json(['sum' => $sum, 'order_num' => $order_numb, 'penfit' => $penfit, 'status' => 'success']);
    }

    public function index()
    {

        $sessionStore = session()->get('StoreId');

        $store = stores::where('id', $sessionStore)->first();

//        $features = features::with('options')->where('store_id', $store['id'])->get();
        //$product_type = Product_type::where('lang_id', 1)->where('store_id', $store['id'])->get()->pluck("title", "id");
        $product_type = Product_type::join('product_types_data', 'product_types_data.product_types_id', 'product_types.id')
            ->whereNull('product_types_data.source_id')
            ->where('product_types.store_id', $store['id'])
            //->get()
            ->pluck("product_types_data.title", "product_types.id");

        $categories = Category::where('lang_id', Constants::defaultLanguage)->where('store_id', $store['id'])->with(['parent' => function ($query) {
            $query->where('lang_id', Constants::defaultLanguage);
        }])->orderBy('number', 'asc')->with(['children' => function ($query) {
            $query->orderBy('number', 'asc');
        }])->get();
        $categories = Category::where('lang_id', Constants::defaultLanguage)->where('store_id', $sessionStore)->whereNull("parent_id")->orderBy('number', 'asc')->get();
        $category_tree = Category::where('lang_id', Constants::defaultLanguage)->where('store_id', $sessionStore)->get();
//if you don't have the eloquent model you can use DB query builder:
//$categories = DB::table('categories')->select('id', 'parent_id', 'title')->get();
//prepare an empty array for $id => $formattedVal storing
        $cats = [];
//start by root categories
        \App\Bll\Utility::getCategories($category_tree, $cats);

//        $products = product_details::where('lang_id', 1)->whereHas('product', function ($q) use ($store) {
//                    $q->where('store_id', $store['id']);
//                })->with(['product' => function ($query) use ($store) {
//                        $query->where('store_id', $store['id']);
//                        $query->with(['categories' => function($q) {
//                                $q->with('children');
//                                $q->with('parent');
//                                $q->with('products');
//                                $q->where('lang_id', 1);
//                            }]);
//                        $query->with('product_type');
//                        $query->with('product_photos');
//                        $query->with(['features' => function($q) {
//                                $q->with('options');
//                            }]);
//                    }])->orderBy('id', 'desc')->get();
        // dd($cats);
        $products = products::where("store_id", session()->get("StoreId"))->orderBy("id", "desc")->get();
//        foreach ($products as $product) {
//            $features = features::where('product_id', $product->id)->get();
//        }
        $data = [];
        return view('admin.products.products.index', compact('data', 'product_type', "cats", "categories", 'store', 'products'));
    }

    public function saveproduct(Request $request)
    {
        $sessionStore = session()->get('StoreId');
        if ($sessionStore == \App\Bll\Utility::$demoId) {
            $products = products::where("store_id", session()->get("StoreId"))->first();
            return response()->json(['success' => ["id" => $products->id]]);
        }
        DB::beginTransaction();
        try {
            $product = products::create([
                'max_count' => $request->count,
                'price' => $request->price,
                'product_type' => $request->types,
                'store_id' => session()->get("StoreId"),
                'currency_code' => Constants::defaultCurrency,
            ]);
            if ($request['categories'] != null) {
                $product->categories()->attach($request['categories']);
            }
            $product_details = product_details::create(['title' => $request->product_name,
                'description' => $request->text,
                'product_id' => $product->id, 'lang_id' => Constants::defaultLanguage]);

            if ($request->image_url != null) {
                $image_url = $request->image_url;

                $path = parse_url($image_url, PHP_URL_PATH);       // get path from url
                $extension = pathinfo($path, PATHINFO_EXTENSION); // get ext from path
                $filename = pathinfo($path, PATHINFO_FILENAME); // get name from path
                $imageName = $filename . '.' . $extension;

                if (!is_dir(public_path('uploads/products/' . $product->id))) {
                    mkdir(public_path('uploads/products/' . $product->id), 755, true);
                }

                Image::make($image_url)->save(public_path('/uploads/products/' . $product->id . '/' . $imageName));

                product_photos::create([
                    'product_id' => $product->id,
                    'photo' => '/uploads/products/' . $product->id . '/' . $imageName,
                    'description' => $filename,
                    'tag' => $filename,
                    'main' => 1,
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            return $e;
            DB::rollBack();
        }

//        $product_details;
        $products = product_details::where('id', $product_details->id)->with(['product' => function ($query) {
            $query->with('categories');
            $query->with('product_type');
            $query->with('product_photos');
        }])->first();
        // $store = stores::where('id', $sessionStore)->first();
        // $adminStore = User::where('id',$store->owner_id)->first();
        // $details = [
        //     'product_id' => $products->product_id,
        //     'title' => $products->title,
        //     'action' => 'Add',
        //     'storename' => \App\Bll\Utility::getStoreName()
        // ];
        // Notification::send($adminStore, new AddProductNotification($details));

        return response()->json(['success' => ["id" => $products->product_id]]);
    }

    public function updateproduct(Request $request)
    {

        if ($request->product_id == -1) {
            return $this->saveproduct($request);
        }

        $storeId = session()->get("StoreId");
        if ($storeId == \App\Bll\Utility::$demoId) {
            return response()->json(['success' => 'success']);
        }

        $product = products::where("store_id", $storeId)->where("id", $request->product_id)->first();
        if ($product == null) {
            return response()->json(['fail' => _i('not found')]);
        }

        $categories = [];
        $product_details = product_details::where("product_id", $request->product_id)->first();
        $product_details->title = $request['product_name'];
        $product_details->save();
        $product_details->with(['product' => function ($query) {
            $query->with('categories');
            $query->with('product_type');
            $query->with('product_photos');
            $query->with(['features' => function ($q) {
                $q->with('options');
            }]);
        }]);

        $product = $product_details->product->update([
            'max_count' => $request->count,
            'price' => $request->price,
            'product_type' => $request->types,
            'currency_code' => Constants::defaultCurrency,
        ]);
        if ($request['categories'] != null) {
            $product_details->product->categories()->sync($request['categories']);
        }

        return response()->json(['success' => 'success']);
    }

    public function saveAllCat(Request $request)
    {

        $storeId = session()->get("StoreId");
        if ($storeId == \App\Bll\Utility::$demoId) {
            $categories = $this->getCategories();
            return response()->json($categories);
        }

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
                                'store_id' => session()->get("StoreId"),
                                'number' => $sort_val[0],
                                'lang_id' => Constants::defaultLanguage]);

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
                                        'store_id' => session()->get("StoreId"),
                                        'parent_id' => $inserted->id,
                                        'number' => $sort_sub[$sub_category_index],
                                        'lang_id' => Constants::defaultLanguage]);
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
                            Category::create(['title' => $item_1, 'store_id' => session()->get("StoreId"), 'number' => $parent_sort[$new_parent_cats_index], "parent_id" => $category_id, 'lang_id' => Constants::defaultLanguage]);
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

    private function getCategories()
    {
        $categories = Category::where('store_id', session()->get("StoreId"))->whereNull("parent_id")->where('lang_id', Constants::defaultLanguage)->orderBy('number', 'asc')->with(['children' => function ($query) {
            $query->orderBy('number', 'asc');
        }])->get();
        return $categories;
    }

    public function catdel($cat_id)
    {
        $storeId = session()->get("StoreId");
        if ($storeId == \App\Bll\Utility::$demoId) {
            $categories = $this->getCategories();
            return response()->json($categories);
        }
        $category = Category::where('id', $cat_id)->where("store_id", $storeId)->first();

        if ($category) {
            if (count($category->products) > 0) {
                return response()->json('failed');
            } else {
                $store_id = session()->get("StoreId"); //Category::where('parent_id', $category->id)->first()['store_id'];
                $sub_exists = Category::where('parent_id', $category->id)->exists();
                Category::where("parent_id", $category->id)->delete();

                $category->delete();
                $categories = $this->getCategories();

                return response()->json($categories);
            }
        }
    }

    public function getproduct($id)
    {
        $product = products::where('id', $id)->with('product_details')->with('product_photos')->with(['features' => function ($q) {
            $q->with('options');
        }])->first();
        return response()->json($product);
    }

    protected function get_images($id)
    {

        $product = product_photos::where("product_id", $id)->get();
        // dd($product);
        return response()->json($product);
    }

    public function imagespost(Request $request)
    {
//  dd($request->file);
        $storeId = session()->get("StoreId");
        if ($storeId == \App\Bll\Utility::$demoId) {
            $product = products::where('id', $request->product_id)->where("store_id", $storeId)->with('product_photos')->first();
            return response()->json($product);
        }
        foreach ($request->file as $file) {
            $numberrand = rand(11111, 99999);
            $randname = time() . $numberrand;
            $imageName = $randname . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products/' . $request->product_id), $imageName);
            product_photos::create([
                'product_id' => $request->product_id,
                'photo' => '/uploads/products/' . $request->product_id . '/' . $imageName,
                'description' => $randname,
                'tag' => $randname,
                'main' => 0,
            ]);
        }
        $product = products::where('id', $request->product_id)->with('product_details')->with('product_photos')->first();
        return response()->json($product);
    }

    public function imagesdel(Request $request)
    {
//        dd($request->all());
        $storeId = session()->get("StoreId");
        if ($storeId == \App\Bll\Utility::$demoId) {
            return response()->json('success');
        }
        $id = $request['id'];
        $photo = products::where("store_id", $storeId)->join("product_photos", "products.id", "product_photos.product_id")->where("product_photos.id", $id)->first();
        // $photo = product_photos::where("id", $id)->first();
        if ($photo !== null) {
            $image_path = $photo->photo;  // Value is not URL but directory file path
            if (File::exists(public_path($image_path))) {
                File::delete(public_path($image_path));
            }
            $photo = product_photos::where("id", $id)->first();
            $photo->delete();
            return response()->json('success');
        }
        return response()->json('fail');
    }

    public function imageSubmit(Request $request)
    {
//dd($request->all());
        if ($request->file("file") != null) {
            $exists = product_photos::where('product_id', $request->product_id)->where('main', 1)->exists();
            if ($exists) {
                $image = product_photos::where('product_id', $request->product_id)->where('main', 1)->first();
                $image_path = $image->photo;  // Value is not URL but directory file path
                if (File::exists(public_path($image_path))) {
                    File::delete(public_path($image_path));
                }
                $numberrand = rand(11111, 99999);
                $imageName = time() . $numberrand . '.' . $request->file("file")->getClientOriginalExtension();
                $image->update([
                    'product_id' => $request->product_id,
                    'photo' => '/uploads/products/' . $request->product_id . '/' . $imageName,
                    'description' => $imageName,
                    'tag' => $imageName,
                    'main' => 1,
                ]);
                $request->file("file")->move(public_path('uploads/products/' . $request->product_id), $imageName);
                return response()->json(["status" => "ok", "data" => '/uploads/products/' . $request->product_id . '/' . $imageName]);
            } else {
                // dd(1);
                $numberrand = rand(11111, 99999);
                $imageName = time() . $numberrand . '.' . $request->file("file")->getClientOriginalExtension();
                product_photos::create([
                    'product_id' => $request->product_id,
                    'photo' => '/uploads/products/' . $request->product_id . '/' . $imageName,
                    'description' => $imageName,
                    'tag' => $imageName,
                    'main' => 1,
                ]);
                $request->file("file")->move(public_path('uploads/products/' . $request->product_id), $imageName);
                return response()->json(["status" => "ok", "data" => '/uploads/products/' . $request->product_id . '/' . $imageName]);
            }
        }
/// save request => image  request comung from product view saveMain() function
        if ($request->file("image") != null) {
            $exists = product_photos::where('product_id', $request->product_id)->where('main', 1)->exists();
            if ($exists) {
                $image = product_photos::where('product_id', $request->product_id)->where('main', 1)->first();
                $image_path = $image->photo;  // Value is not URL but directory file path
                if (File::exists(public_path($image_path))) {
                    File::delete(public_path($image_path));
                }
                $numberrand = rand(11111, 99999);
                $imageName = time() . $numberrand . '.' . $request->file("image")->getClientOriginalExtension();
                $image->update([
                    'product_id' => $request->product_id,
                    'photo' => '/uploads/products/' . $request->product_id . '/' . $imageName,
                    'description' => $imageName,
                    'tag' => $imageName,
                    'main' => 1,
                ]);
                $request->file("image")->move(public_path('uploads/products/' . $request->product_id), $imageName);
                return response()->json(["status" => "ok", "data" => '/uploads/products/' . $request->product_id . '/' . $imageName]);
            } else {
                // dd(1);
                $numberrand = rand(11111, 99999);
                $imageName = time() . $numberrand . '.' . $request->file("image")->getClientOriginalExtension();
                product_photos::create([
                    'product_id' => $request->product_id,
                    'photo' => '/uploads/products/' . $request->product_id . '/' . $imageName,
                    'description' => $imageName,
                    'tag' => $imageName,
                    'main' => 1,
                ]);
                $request->file("image")->move(public_path('uploads/products/' . $request->product_id), $imageName);
                return response()->json(["status" => "ok", "data" => '/uploads/products/' . $request->product_id . '/' . $imageName]);
            }
        }
        return response()->json(["status" => "ok", "data" => $image_path]);
    }

    public function featuredel($feature_id)
    {
        $feature = features::where('id', $feature_id)->first();

        if ($feature) {
            $sub_exists = feature_options::where('feature_id', $feature->id)->exists();
            if ($sub_exists) {
                $sub_features = feature_options::where('feature_id', $feature->id)->get();
                foreach ($sub_features as $sub_feature) {
                    $sub_feature->delete();
                }
            }
            $feature->products()->detach();
            $feature->delete();
            return response()->json('success');
        }
    }

    public function savefeatures(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $feature_products = features::where('product_id', $request->id)->get();
            if (count($feature_products) == 0) {

                for ($ii = 0; $ii < count($request->feature_title); $ii++) {
                    $feature_title = $request->feature_title[$ii];
                    if ($feature_title != null) {
                        $product = products::findOrFail($request->id);
                        $feature = features::create(['product_id' => $product->id]);
                        $feature_data = feature_data::create([
                            'feature_id' => $feature->id,
                            'title' => $feature_title,
                            'lang_id' => getLang(session('adminlang')),
                        ]);


                        if (($request["feature_option"]) != null) {
                            $package = $request["feature_option"][$ii];

                            $feature_option_titles = $package['t'];
                            $feature_option_prices = $package["p"];
                            $feature_option_counts = $package["c"];

                            $sIndex = -1;

                            foreach ($feature_option_titles as $feature_option_title) {
                                $sIndex++;
                                if ($feature_option_titles != null) {
                                    $feature_option = feature_options::create([
                                        'feature_id' => $feature->id,
                                        'price' => $feature_option_prices[$sIndex],
                                        'count' => $feature_option_counts[$sIndex],
                                    ]);
                                    feature_option_data::create([
                                        'feature_option_id' => $feature_option->id,
                                        'title' => $feature_option_title,
                                        'lang_id' => getLang(session('adminlang')),
                                    ]);
                                }
                            }
                        }
                    }
                }
            } else {
                $features = features::where('product_id', $request->id)->get();
                foreach ($features as $feature) {
                    $feature_data = feature_data::where('feature_id', $feature->id)->delete();
                    $feature_options = feature_options::where('feature_id', $feature->id)->get();
                    foreach ($feature_options as $feature_option) {
                        $feature_option_data = feature_option_data::where('feature_option_id', $feature_option->id)->delete();
                        $feature_option->delete();
                    }
                    $feature->delete();
                }

                if ($request->feature_title != null) {
                    for ($ii = 0; $ii < count($request->feature_title); $ii++) {
                        $feature_title = $request->feature_title[$ii];
                        $product = products::findOrFail($request->id);
                        $feature = features::create(['product_id' => $product->id]);
                        //                dd($product,$feature);
                        $feature_data = feature_data::create([
                            'feature_id' => $feature->id,
                            'title' => $feature_title,
                            'lang_id' => getLang(session('adminlang')),
                        ]);

                        if (($request["feature_option"]) != null) {
                            $package = $request["feature_option"][$ii];

                            $feature_option_titles = $package['t'];
                            $feature_option_prices = $package["p"];
                            $feature_option_counts = $package["c"];

                            $sIndex = -1;

                            foreach ($feature_option_titles as $feature_option_title) {
                                $sIndex++;
                                if ($feature_option_titles != null) {
                                    $feature_option = feature_options::create([
                                        'feature_id' => $feature->id,
                                        'price' => $feature_option_prices[$sIndex],
                                        'count' => $feature_option_counts[$sIndex],
                                    ]);
                                    feature_option_data::create([
                                        'feature_option_id' => $feature_option->id,
                                        'title' => $feature_option_title,
                                        'lang_id' => getLang(session('adminlang')),
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            return $e;
            DB::rollBack();
        }
        return response()->json('success');
    }

    public function saveProductDetails(Request $request)
    {
//        dd($request->all());
        $storeId = session()->get('StoreId');

        if ($storeId == \App\Bll\Utility::$demoId) {
            return response()->json('success');
        }
        $id = $request['id'];
        $sku = $request['sku'];
        $max_count = $request['count'];
        $weight = $request['weight'];
        $price = $request['price'];
        $net = $request['net'];
        $stock = $request['stock'];
        $discount = $request['discount'];
        $discount_type = $request['discount_type'];
        $delivary = $request['delivary'];
        $created_at = date('Y-m-d', strtotime($request['created_at']));
        $product = products::where("id", $id)->where("store_id", $storeId)->first();
        $productdescrption = product_details::where("product_id", $id)->first();
        if ($product == null) {
            return response()->json('fail');
        }
        $product->update(['sku' => $sku, 'max_count' => $max_count, 'weight' => $weight
            , 'price' => $price, 'net' => $net, 'stock' => $stock, 'discount' => $discount
            , 'discount_type' => $discount_type, 'delivary' => $delivary, 'created_at' => $created_at]);
        $productdescrption->update([
            'description' => $request['text'],
        ]);
        return response()->json('success');
    }

    public function productdel(Request $request)
    {
        $id = $request['id'];
        $storeId = session()->get('StoreId');

        if ($storeId == \App\Bll\Utility::$demoId) {
            return response()->json(["status" => "ok", "msg" => _i("Deleted Successfully")]);
        }
        $product_details = products::where("id", $id)->where("store_id", $storeId)->first();
        if ($product_details != null) {
            $product_details->categories()->detach();
            $product_details->delete();
//            $products = product_details::with(['product' => function ($query) use ($storeId) {
//                            $query->where('store_id', $storeId);
//                            $query->with(['categories' => function($q) {
//                                    $q->with('children');
//                                    $q->with('products');
//                                }]);
//                            $query->with('product_type');
//                            $query->with('product_photos');
//                            $query->with(['features' => function($q) {
//                                    $q->with('options');
//                                }]);
//                        }])->orderBy('id', 'desc')->get();
            return response()->json(["status" => "ok", "msg" => _i("Deleted Successfully")]);
        }
        return response()->json(["status" => "fail", "msg" => _i("Not found")]);
    }

    public function getData(Request $request)
    {
        $product = products::findOrFail($request->id);
        $product['text'] = product_details::where('product_id', $request->id)->value('description');


        if ($product) {
            return response()->json(['data' => $product, 'status' => 'success']);
        } else {
            return response()->json(['data' => null, 'status' => 'error']);
        }
    }

    public function getFeatures(Request $request)
    {
        $product = products::findOrFail($request->id);
        $features = features::leftJoin('features_data', 'features_data.feature_id', 'features.id')
            ->where('features.product_id', $product->id)
            ->where('features_data.lang_id', getLang(session('adminlang')))
            ->select('features.id as id', 'features_data.title', 'features.product_id as product_id')
            ->get();
        foreach ($features as $feature) {
            $features_option = feature_options::leftJoin('feature_options_data', 'feature_options_data.feature_option_id', 'feature_options.id')
                ->where('feature_options.feature_id', $feature->id)
                ->where('feature_options_data.lang_id', getLang(session('adminlang')))
                ->get();
            $feature['options'] = $features_option;
        }

        if (count($features) > 0) {
            return response()->json(['data' => $features, 'status' => 'success']);
        } else {
            return response()->json(['data' => null, 'status' => 'error']);
        }
    }

    public function ProductrgetLangvalue(Request $request)
    {
        $rowData = product_details::where('product_id', $request->transRow)
            ->where('lang_id', $request->lang_id)
            ->first(['title', 'description']);
        //dd($rowData);
        if (!empty($rowData)) {
            return \response()->json(['data' => $rowData]);
        } else {
            return \response()->json(['data' => false]);
        }
    }

    public function ProductstorelangTranslation(Request $request)
    {

        $rowData = product_details::where('product_id', $request->id)
            ->where('source_id', "!=", null)
            ->first();
        if ($rowData != null) {
            $rowData->update([
                'title' => $request->title,
                'description' => $request->input('description'),
                'lang_id' => $request->lang_id_data,
            ]);
        } else {
            $parentRow = product_details::where('product_id', $request->id)->where('source_id', null)->first();
            product_details::create([
                'title' => $request->title,
                'description' => $request->input('description'),
                'lang_id' => $request->lang_id_data,
                'slider_id' => $request->id,
                'source_id' => $parentRow->id,
            ]);
        }
        return \response()->json("SUCCESS");
    }

    public function clone(Request $request)
    {

      $id =  $request->id;

      $product     =  products::findOrFail($id);

      $newProduct  = $product->replicate();

      $newProduct->push();

      $details     =  product_details::where('product_id', $id)->first();

      $newDetails  =  $details->replicate();

      $newDetails->push();

      $newDetails->update(['product_id' => $newProduct->id]);

      $photo       =  product_photos::where('product_id', $id)->first();

      $newPhoto    =  $photo->replicate();

      $newPhoto->push();

      $newPhoto->update(['product_id' => $newProduct->id]);

      return response()->json(['status' => 'success']);
    }

}
