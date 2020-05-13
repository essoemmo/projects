<?php

namespace App\Http\Controllers\dashboard;

use App\ProductLens;
use Carbon\Carbon;
use App\Models\Axis;
use App\Models\Lens;
use App\Models\Option;
use App\Models\Sphere;
use App\Models\Country;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cylinder;
use App\Models\Language;
use App\Models\PrAttribute;
use App\Models\stockStatus;
use App\Models\Manufacturer;
use App\Models\Product_Axis;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\ProductPrice;
use Illuminate\Http\Request;
use App\Models\AttributeGroup;
use App\Models\Product_Sphere;
use App\Models\RelatedProduct;
use App\Models\ProductCategory;
use App\Models\ProductDiscount;
use App\Models\ShippingCourier;
use App\Models\Product_Cylinder;
use App\Models\ProductAttribute;
use Yajra\DataTables\DataTables;
use App\Models\ProductDescription;
use App\Models\ProductOptionValue;
use App\Models\ProductShowOptions;
use Illuminate\Support\Facades\DB;
use App\Models\ProductOptionParent;
use App\Http\Controllers\Controller;
use App\Models\ProductShippingCourier;
use App\Models\ProductColorDescription;
use Illuminate\Support\Facades\Validator;

class productController extends Controller {

    public $lang = "en_US";
    public $language_id;

    public function __construct() {

        $this->middleware(function ($request, $next) {
            // fetch session and use it in entire class with constructor
            $this->language_id = checknotsessionlang();

            return $next($request);
        });
    }

    public function index() {

        return view('admin.products.list');
    }

    public function getproductdatatable() {
        return Datatables::of(Product::leftJoin('product_descriptions', 'products.id', 'product_descriptions.product_id')
                                ->leftJoin('product_price', function ($join) {
                                    $join->on('product_price.id', '=', DB::raw('(SELECT id FROM product_price WHERE product_price.product_id = products.id LIMIT 1)'));
                                })
                                //->leftJoin('product_price', 'products.id', 'product_price.product_id')
                                ->where('product_descriptions.language_id', $this->language_id)
                                ->select('products.product_type', 'products.id as products_id', 'product_price.price as products_price', 'product_price.quantity as products_quantity', 'products.status as products_status', 'products.created_at as created_at', 'product_descriptions.name as product_name')
                        )
                        ->rawColumns(['actions', 'status', "product_status"])
                        ->editColumn('productDescriptions', function ($rowData) {
                            //select fields by language_id
                            $rowTranslation = ProductDescription::getOneByIdAndLanguage($rowData->id, $this->language_id);
                            if (!empty($rowTranslation->product_name)) {
                                return $rowTranslation->product_name;
                            }
                            return "";
                        })
                        ->editColumn('created_at', function ($rowData) {
                            return $rowData->created_at;
                        })->editColumn('status', function ($rowData) {
                    if ($rowData->product_status == 0) {
                        return '<span class="label label-success">' . _i('Enabled') . '</span>';
                    }
                    return '<span class="label label-danger">' . _i('Disabled') . '</span>';
                })->editColumn('actions', function ($rowData) {
                    $b = $this->button(route('products.edit', $rowData->products_id), 'primary mrs', 'pencil-alt');
                    //                $b = '<a href=" ' .route('products.edit', $rowData->products_id).'" class="ti-pencil-alt"> </a>';
                    //                $b .= $this->button(route('products.destroy', $rowData->products_id), 'danger destroy', 'trash');
                    $b .= '<form action="' . route('products-destroy', $rowData->products_id) . '" method="delete" style="
    right: 50px;
    bottom: 34px;
        display: inline-block; " >
                        <button class="btn btn-danger btn-sm delete"><i class="ti-trash"></i></button>
                        </form>';
                    return $b;
                })->make(true);
    }

    private function button(string $route, string $class, string $icon): string {
        return sprintf('<a href="%s" class="btn btn-sm btn-%s"><i class="ti-%s"></i></a>', $route, $class, $icon);
    }

    public function create() {
        $languages = Language::getEnabledLanguages();
        $categories = Category::all();
        $manufacturers = Manufacturer::all();
        $stockStatuses = StockStatus::getByLanguage($this->language_id);
        $relatedProducts = Product::getByLanguage($this->language_id);
        $attributes = PrAttribute::getByLanguage($this->language_id);
        $attributeGroup = AttributeGroup::join('attribute_group_descriptions', 'attribute_groups.id', '=', 'attribute_group_descriptions.attribute_group_id')
                ->select('attribute_groups.*', 'attribute_group_descriptions.name')
                ->where([
                    ['attribute_groups.status', '=', 0],
                    ['attribute_group_descriptions.language_id', '=', $this->language_id],
                    ['attribute_groups.deleted_at', '=', NULL],
                ])
                ->get();
        //        dd($attributeGroup);
        $countries = Country::getByLanguage($this->language_id);
        $options = Option::getByLanguage($this->language_id);
        $currentDate = Carbon::now()->toDateString();
        $shippingCouriers = ShippingCourier::all();
        $country = Country::all('id');


        $lenses = Lens::whereNull('source_id')->get();
        return view(
                'admin.products.create',
                [
                    'categories' => $categories, 'country' => $country,
                    'languages' => $languages, 'language_id' => $this->language_id,
                    'stockStatuses' => $stockStatuses, 'currentDate' => $currentDate,
                    'manufacturers' => $manufacturers, 'relatedProducts' => $relatedProducts,
                    'attributes' => $attributes, 'options' => $options, 'countries' => $countries,
                    'shippingCouriers' => $shippingCouriers, 'attributeGroup' => $attributeGroup,
                    'lenses' => $lenses
                ]
        );
    }

    public function store(Request $request) {
        $input = $request->all();
        $rules = [
            'name.*' => 'required|string|min:2',
            'meta_title.*' => 'required|string|min:2',
            "price.*" => "required|numeric|min:0|not_in:0",
            "quantity.*" => "required|numeric|min:0|not_in:0",
        ];
        $messages = [
            'name.*.required' => _i('Name is required'),
            'name.*.min' => _i('The Name must be at least :min characters.'),
            'meta_title.*.required' => _i('Meta Title is required'),
            'meta_title.*.min' => _i('The Meta Title must be at least :min characters.'),
        ];

        //        $validator = Validator::make($input, $rules, $messages);
        //
        //        if ($validator->fails()) {
        //
        //            return redirect()->back()->withErrors($validator)->withInput();
        //        }
        try {
            $rowData = new Product();

            //                $rowData->country_id = $input['country_id'];
            $rowData->model = $input['model'];
            $rowData->sku = $input['sku'];
            $rowData->upc = $input['upc'];
            $rowData->ean = $input['ean'];
            $rowData->jan = $input['jan'];
            $rowData->isbn = $input['isbn'];
            $rowData->mpn = $input['mpn'];
            $rowData->location = $input['location'];
            //                $rowData->quantity = $input['quantity'];
            //                $rowData->minimum_order_amount = $input['minimum_order_amount'];
            //                $rowData->stock_status_id = $input['stock_status_id'];
            $rowData->manufacturer_id = $input['manufacturer_id'];
            //            $rowData->requires_shipping = $input['requires_shipping'];
            //                $rowData->price = $input['price'];
            //                $rowData->tax_rate = $input['tax_rate'];
            //                $rowData->tax_type = $input['tax_type'];
            $rowData->date_available = $input['date_available'];
            $rowData->weight = $request->input('weight') ? $request->input('weight') : 0;
            $rowData->weight_type = $input['weight_type'];
            $rowData->length = $request->input('length') ? $request->input('length') : 0;
            $rowData->width = $request->input('width') ? $request->input('width') : 0;
            $rowData->height = $request->input('height') ? $request->input('height') : 0;
            $rowData->length_type = $input['length_type'];
            //                $rowData->subtract_stock = $input['subtract_stock'];
            $rowData->sort_order = $input['sort_order'];
            $rowData->status = $input['status'];
            $rowData->product_type = $input['product_type'];

            //                dd($rowData);
            //upload the image
            if (isset($input['main_image'])) {
                // $main_image = $request->file('main_image');
                $main_image = $input['main_image'];
                $fileName = "";
                if ($file = $main_image->isValid()) {
                    $destinationPath = public_path('images/products');
                    if (!is_dir($destinationPath)) {
                        mkdir($destinationPath, 0766, true);
                    }
                    $imageName = $main_image->getClientOriginalName();
                    $extension = $main_image->getClientOriginalExtension();
                    $fileName = md5($imageName . time()) . '.' . $extension;
                    $main_image->move($destinationPath, $fileName);
                    $rowData->main_image = $fileName;
                }
            }
            $rowData->save();
            //get the last inserted id
            $rowId = $rowData->id;
            if (!empty($rowId)) {

                if (!empty($rowId)) {
                    for ($ii = 0; $ii < count($request->country_id); $ii++) {
                        //                            dd($request->tax_rate);
                        $country_id = $request->country_id[$ii];
                        $product_id = $rowId;
                        $quantity = $request->quantity[$ii];
                        $tax_rate = $request->tax_rate[$ii];
                        $tax_type = $request->tax_type[$ii];
                        $stock_status_id = $request->stock_status_id[$ii];
                        $minimum_order_amount = $request->minimum_order_amount[$ii];
                        $subtract_stock = $request->subtract_stock[$ii];
                        $discount = $request->discount[$ii];
                        //   dd($request->price);
                        $price = $request->price[$ii][0];


                        if (($input["pkg"]) !== null) {
                            //dd($input);
                            $package = $input["pkg"][$ii];

                            $prices = $package["p"];
                            $sizes = $package["s"];

                            $sIndex = -1;

                            $created = false;
                            foreach ($prices as $price2) {
                                $sIndex++;
                                if ($price2 != null) {
                                    //$request->size = $size;
                                    ProductPrice::create([
                                        'price' => $price2,
                                        'discount' => $discount,
                                        'country_id' => $country_id,
                                        'product_id' => $product_id,
                                        'quantity' => $quantity,
                                        'tax_rate' => $tax_rate,
                                        'tax_type' => $tax_type,
                                        'stock_status_id' => $stock_status_id,
                                        'minimum_order_amount' => $minimum_order_amount,
                                        'subtract_stock' => $subtract_stock,
                                        'size' => $sizes[$sIndex],
                                    ]);
                                    $created = true;
                                }
                            }
                        }
                        // dd($price);
                        if (!$created)
                            ProductPrice::create([
                                'price' => $price,
                                'discount' => $discount,
                                'country_id' => $country_id,
                                'product_id' => $product_id,
                                'quantity' => $quantity,
                                'tax_rate' => $tax_rate,
                                'tax_type' => $tax_type,
                                'stock_status_id' => $stock_status_id,
                                'minimum_order_amount' => $minimum_order_amount,
                                'subtract_stock' => $subtract_stock,
                                'size' => 0,
                            ]);
                        //dd($request->all());
                        //                        if (empty($request->price[$ii][0])) {
                        //                            $price = $request->pkgAmount[$ii];
                        //                            $sizes = $input['size'];
                        //                            foreach ($sizes[$ii] as $key => $size) {
                        //                                //$request->size = $size;
                        //                                ProductPrice::create([
                        //                                    'price' => $price[$key],
                        //                                    'country_id' => $country_id,
                        //                                    'product_id' => $product_id,
                        //                                    'quantity' => $quantity,
                        //                                    'tax_rate' => $tax_rate,
                        //                                    'tax_type' => $tax_type,
                        //                                    'stock_status_id' => $stock_status_id,
                        //                                    'minimum_order_amount' => $minimum_order_amount,
                        //                                    'subtract_stock' => $subtract_stock,
                        //                                    'size' => $size,
                        //                                ]);
                        //                            }
                        //                        } elseif (!empty($request->price[$ii][0])) {
                        //                            $price = $request->price[$ii][0];
                        //
                        ////                                dd($request->all());
                        //                            ProductPrice::create([
                        //                                'price' => $price,
                        //                                'country_id' => $country_id,
                        //                                'product_id' => $product_id,
                        //                                'quantity' => $quantity,
                        //                                'tax_rate' => $tax_rate,
                        //                                'tax_type' => $tax_type,
                        //                                'stock_status_id' => $stock_status_id,
                        //                                'minimum_order_amount' => $minimum_order_amount,
                        //                                'subtract_stock' => $subtract_stock,
                        //                                'size' => 0,
                        //                            ]);
                        //                        }
                    }
                    //
                    if ($rowData->product_type == "lenses") {
                        $options = request()->input("lenses_options");
                        if ($options != null)
                            foreach ($options as $option) {
                                $item = [
                                    'product_id' => $product_id,
                                    "code" => $option
                                ];
                                if ($option == "auto_reorder") {
                                    $item["value"] = $request->input("auto_reorder");
                                }
                                \App\Models\ProductShowOptions::create($item);
                            }
                    }

                    if ($request->sphere != null) {
                        for ($ii = 0; $ii < count($request->sphere); $ii++) {
                            $product_id = $rowId;
                            $sphere = $request->sphere[$ii];
                            $type = $request->type;
                            Product_Sphere::create([
                                'product_id' => $product_id,
                                'sphere_id' => $sphere,
                                'type' => $type,
                            ]);
                        }
                    }

                    if ($request->cylinder != null) {
                        for ($ii = 0; $ii < count($request->cylinder); $ii++) {
                            $product_id = $rowId;
                            $cylinder = $request->cylinder[$ii];
                            $type = $request->type;
                            Product_Cylinder::create([
                                'product_id' => $product_id,
                                'cylinder_id' => $cylinder,
                                'type' => $type,
                            ]);
                        }
                    }

                    if ($request->axis != null) {
                        for ($ii = 0; $ii < count($request->axis); $ii++) {
                            $product_id = $rowId;
                            $axis = $request->axis[$ii];
                            $type = $request->type;
                            Product_Axis::create([
                                'product_id' => $product_id,
                                'axis_id' => $axis,
                                'type' => $type,
                            ]);
                        }
                    }
                }
                //insert product translations
                foreach ($input['name'] as $key => $value) {
                    $rowTranslation = new ProductDescription();
                    $rowTranslation->product_id = $rowId;
                    $rowTranslation->language_id = $key;
                    $rowTranslation->name = $value;
                    $rowTranslation->description = $input['description'][$key];
                    $rowTranslation->meta_title = $input['meta_title'][$key];
                    $rowTranslation->meta_description = $input['meta_description'][$key];
                    $rowTranslation->meta_keyword = $input['meta_keyword'][$key];

                    $rowTranslation->save();
                }

                //insert shipping courriers
                //                if (isset($input['shipping_courier_id'])) {
                //
                //                    for ($ii = 0; $ii < count($request->country_id); $ii++) {
                //                        //get already existing
                ////                        dd($input['shipping_courier_id']);
                ////                        $shippingArr = ProductShippingCourier::where('product_id', $rowId)->pluck('shipping_courier_id')->toArray();
                ////                        dd($shippingArr);
                //                        //insert
                //                        $shippingIds = $input['shipping_courier_id'][$ii];
                //                        $cost = $input['shipping_cost'][$ii];
                //                        $country_id = $request->country_id[$ii];
                ////                        dd($cost);
                //                        foreach ($shippingIds as $key => $value) {
                //                            //if it is a newly added, insert it
                //                            $shipping = new ProductShippingCourier();
                //                            $shipping->product_id = $rowId;
                //                            $shipping->shipping_courier_id = $value;
                //                            $shipping->country_id = $country_id;
                //                            $shipping->cost = $cost[$key];
                ////                                dd($input['shipping_cost']);
                //
                //                            $shipping->save();
                //                        }
                //                    }
                //                }

                if (isset($input['categoryIds'])) {
                    //insert product categories
                    $categoryIds = $input['categoryIds'];
                    foreach ($categoryIds as $categoryId) {

                        $prCategory = new ProductCategory();
                        $prCategory->product_id = $rowId;
                        $prCategory->category_id = $categoryId;

                        $prCategory->save();
                    }
                }

                if (isset($input['relatedProductIds'])) {
                    //insert related products
                    $relatedProductIds = $input['relatedProductIds'];
                    foreach ($relatedProductIds as $relatedProductId) {
                        $prRelated = new RelatedProduct();
                        $prRelated->product_id = $rowId;
                        $prRelated->related_id = $relatedProductId;

                        $prRelated->save();
                    }
                }

                //insert product attributes

                if (isset($input['product_attribute'])) {

                    for ($ii = 0; $ii < count($request->attribute); $ii++) {
                        //                            dd($request->attribute[$ii]);
                        $product_attribute = $request->product_attribute;
                        //                            dd($product_attribute);
                        foreach ($product_attribute[$ii] as $key => $value) {
                            //                            dd($product_attribute[$key]);
                            $prAttribute = new ProductAttribute();
                            $prAttribute->product_id = $rowId;
                            $prAttribute->pr_attribute_id = $request->attribute[$ii];
                            $prAttribute->language_id = $key;
                            $prAttribute->text = $value;
                            //                                dd($prAttribute);
                            $prAttribute->save();
                        }
                    }
                    //                    }
                }

                //insert product options
                //insert product discounts
                //                if (isset($input['product_discount'])) {
                //                    $product_discount = $input['product_discount'];
                //                    foreach ($product_discount as $key => $value) {
                //                        if (empty($product_discount[$key]['price'])) {
                //                            $product_discount[$key]['price'] = '';
                //                            $product_discount[$key]['priority'] = '';
                //                        }
                //                        $prDiscount = new ProductDiscount();
                //                        $prDiscount->product_id = $rowId;
                //                        $prDiscount->price = $product_discount[$key]['price'];
                //                        $prDiscount->date_start = $product_discount[$key]['date_start'];
                //                        $prDiscount->date_end = $product_discount[$key]['date_end'];
                //                        $prDiscount->priority = $product_discount[$key]['priority'];
                //
                //                        $prDiscount->save();
                //                    }
                //                }
                //insert product images
                if (isset($input['product_image'])) {
                    $product_image = $input['product_image'];
                    foreach ($product_image as $key => $value) {

                        $prImage = new ProductImage();
                        $prImage->product_id = $rowId;
                        $prImage->sort_order = $product_image[$key]['sort_order'];
                        //upload the image
                        if (isset($product_image[$key]['image'])) {
                            $image = $product_image[$key]['image'];
                            $fileName = "";
                            if ($file = $image->isValid()) {
                                $destinationPath = public_path('images/products');
                                if (!is_dir($destinationPath)) {
                                    mkdir($destinationPath, 0766, true);
                                }
                                $imageName = $image->getClientOriginalName();
                                $extension = $image->getClientOriginalExtension();
                                $fileName = md5($imageName . time()) . '.' . $extension;
                                $image->move($destinationPath, $fileName);

                                $prImage->image = $fileName;
                            }

                            $prImage->save();
                        }
                    }
                }

                //insert product colors

                if (!empty($input['product_color'])) {
                    $product_color = $input['product_color'];
                    foreach ($product_color as $key => $value) {
                        if (empty($product_color[$key]['color'])) {
                            $product_color[$key]['color'] = '';
                            $input['product_color'][$key]['name'] = '';
                        }
                        $prColor = new ProductColor();
                        $prColor->product_id = $rowId;
                        $prColor->sort_order = $product_color[$key]['sort_order'];
                        $prColor->color = $product_color[$key]['color'];
                        //upload the image
                        if (isset($product_color[$key]['image'])) {
                            $image = $product_color[$key]['image'];
                            $fileName = "";
                            if ($file = $image->isValid()) {
                                $destinationPath = public_path('images/products');
                                if (!is_dir($destinationPath)) {
                                    mkdir($destinationPath, 0766, true);
                                }
                                $imageName = $image->getClientOriginalName();
                                $extension = $image->getClientOriginalExtension();
                                $fileName = md5($imageName . time()) . '.' . $extension;
                                $image->move($destinationPath, $fileName);

                                $prColor->image = $fileName;
                            }
                        }
                        $prColor->save();
                        $product_color_id = $prColor->id;
                        if (!empty($product_color_id)) {

                            //insert translation
                            if (!empty($input['product_color'][$key]['name'])) {
                                $names = $input['product_color'][$key]['name'];
                                foreach ($names as $key2 => $value2) {
                                    $prColorDesc = new ProductColorDescription();
                                    $prColorDesc->product_color_id = $product_color_id;
                                    $prColorDesc->name = $value2;
                                    $prColorDesc->language_id = $key2;
                                    $prColorDesc->save();
                                }
                            }
                        }
                    }
                }
            }

            $rowData->save();
            // Create Lenses
            if ($request->input('lenses') != null) {
                $lenses = Lens::whereIn('id', $request->input('lenses'))->get();
                $rowData->lenses()->sync($lenses);
            }
            //End Create
            session()->flash('success', _i('The product has been added successfully.'));
            return redirect()->route('products.edit', $rowData);
        } catch (Exception $e) {
            session()->flash('success', _i('There was an error, please try again.'));

            return redirect()->route('products.create');
        }
    }

    public function edit($id) {
        $rowData = Product::findOrFail($id);
        $productTranslation = ProductDescription::getAllById($id);
        $currentProductCatgeories = ProductCategory::where('product_id', '=', $id)->get();
        $currentProductRelated = RelatedProduct::where('product_id', '=', $id)->get();
        $countryProducts = ProductPrice::where('product_id', '=', $id)->get()->groupBy('country_id');
        $languageIds = $productTranslation->pluck('language_id')->toArray();
        $language_id = $this->language_id;
        $count = 0;
        $showOptions = ProductShowOptions::where('product_id', $rowData->id)->where('code', 'auto_reorder')->first();


        //        dd($showOptions);
        $code = ProductShowOptions::where('product_id', $rowData->id)->pluck('code')->toArray();

        $attributeGroup = AttributeGroup::join('attribute_group_descriptions', 'attribute_groups.id', '=', 'attribute_group_descriptions.attribute_group_id')
                ->select('attribute_groups.*', 'attribute_group_descriptions.name')
                ->where([
                    ['attribute_groups.status', '=', 0],
                    ['attribute_group_descriptions.language_id', '=', $this->language_id],
                    ['attribute_groups.deleted_at', '=', NULL],
                ])
                ->get();
        //        dd($attributeGroup);
        //        dd($code);
        //        dd($showOptions);
        //product attributes

        $productAttributes = ProductAttribute::getAllGroupBy($id);

        if (!empty($productAttributes)) {
            foreach ($productAttributes as $item) {
                //get product option values
                $productAttributeValues = ProductAttribute::where([['product_id', '=', $id], ['pr_attribute_id', '=', $item->pr_attribute_id]])->get();
                $item->productAttributeValues = $productAttributeValues;
            }
        }

        //        $productOptions = ProductOption::getByLanguageAndProductId($id, $this->language_id);
        //        if(!empty($productOptions)) {
        //            foreach ($productOptions as $item) {
        //                //get product option values
        //                $item->productOptionValues = ProductOptionValue::getByLanguageAndProductOptionId($item->id, $this->language_id);
        //                $item->optionValues = OptionValue::getByLanguageAndOptionId($item->option_id, $this->language_id);
        //
        //                //get product option parents
        //                $productOptionParents = ProductOptionParent::getByLanguageAndProductOptionId($item->id, $this->language_id);
        //                if(!empty($productOptionParents)) {
        //                    //get values
        //                    foreach ($productOptionParents as $parent) {
        //
        //                        $parent->productOptionValues = ProductOptionValue::getByLanguageAndProductOptionId($parent->parent_option_id, $this->language_id);
        //
        //                        $parent->productOptionParentValues = ProductOptionParentValue::where('product_option_parent_id', '=', $parent->id)->get();//;getByLanguageAndParentOptionId($parent->id, $this->language_id);
        //
        //                    }
        //                }
        //                $item->productOptionParents = $productOptionParents;
        //
        //            }
        //
        //            // dd($productOptions);
        //        }

        $productDiscounts = ProductDiscount::where('product_id', '=', $id)->get();
        $productImages = ProductImage::where('product_id', '=', $id)->get();
        // $productShippingCouriers = array();
        // $shippingCouriersIds = array();
        // if(!empty($rowData)){
        //     if($rowData->requires_shipping == 1){
        $productShippingCouriers = ProductShippingCourier::where('product_id', '=', $id)->get();
        //        dd($productShippingCouriers);
        $shippingCouriersIds = $productShippingCouriers->pluck('shipping_courier_id')->toArray();
        //        dd($shippingCouriersIds);
        //     }
        // }
        $productColors = ProductColor::where('product_id', '=', $id)->get();
        if (!empty($productColors)) {
            foreach ($productColors as $item) {
                //get product colors' translations
                $colorTranslation = ProductColorDescription::getAllById($item->id);
                $item->colorTranslation = $colorTranslation;
            }
        }

        //////////general
        $languages = Language::getEnabledLanguages();
        $categories = Category::all();
        $manufacturers = Manufacturer::all();
        $stockStatuses = StockStatus::getByLanguage($this->language_id);
        $relatedProducts = Product::getByLanguage($this->language_id);
        $attributes = PrAttribute::getByLanguage($this->language_id);
        $countries = Country::getByLanguage($this->language_id);
        $options = Option::getByLanguage($this->language_id);
        $shippingCouriers = ShippingCourier::all();
        $product_sphere = Product_Sphere::where('product_id', $id)->get();
        $spheres_colored = Sphere::where('type', 1)->pluck('title', 'id');
        $spheres_trans = Sphere::where('type', 2)->pluck('title', 'id');

        $product_cylinder = Product_Cylinder::where('product_id', $id)->get();
        $cylinders_colored = Cylinder::where('type', 1)->pluck('title', 'id');
        $cylinders_trans = Cylinder::where('type', 2)->pluck('title', 'id');

        $product_axis = Product_Axis::where('product_id', $id)->get();
        $axis_colored = Axis::where('type', 1)->pluck('title', 'id');
        $axis_trans = Axis::where('type', 2)->pluck('title', 'id');

        $lenses = Lens::where('lang_id', adminLang())->get();
        return view('admin.products.edit', ['product_lenses' => $rowData->lenses()->pluck('tbl_lenses.id'), 'lenses' => $lenses, 'spheres_colored' => $spheres_colored, 'spheres_trans' => $spheres_trans, 'cylinders_colored' => $cylinders_colored, 'cylinders_trans' => $cylinders_trans, 'axis_colored' => $axis_colored, 'axis_trans' => $axis_trans, 'product_sphere' => $product_sphere, 'product_cylinder' => $product_cylinder, 'product_axis' => $product_axis, 'attributeGroup' => $attributeGroup, 'rowData' => $rowData, 'count' => $count, 'showOptions' => $showOptions, 'code' => $code, 'countryProducts' => $countryProducts, 'productTranslation' => $productTranslation, 'categories' => $categories, 'languages' => $languages, 'language_id' => $this->language_id, 'stockStatuses' => $stockStatuses, 'manufacturers' => $manufacturers, 'relatedProducts' => $relatedProducts, 'attributes' => $attributes, 'options' => $options, 'countries' => $countries, 'languageIds' => $languageIds, 'currentProductCatgeories' => $currentProductCatgeories, 'currentProductRelated' => $currentProductRelated, 'productAttributes' => $productAttributes, 'productImages' => $productImages, 'productColors' => $productColors, 'shippingCouriers' => $shippingCouriers, 'productShippingCouriers' => $productShippingCouriers, 'shippingCouriersIds' => $shippingCouriersIds, 'productDiscounts' => $productDiscounts]);
    }

    public function update(Request $request, $rowId) {
        $rowData = Product::findOrFail($rowId);

        $input = $request->all();
        $rules = [
            'name.*' => 'required|string|min:2',
            'meta_title.*' => 'required|string|min:2',
            'image' => 'image|mimes:jpeg,jpg,png,bmp,gif,svg|max:2048',
        ];
        $messages = [
            'name.*.required' => _i('Name is required'),
            'name.*.min' => _i('The Name must be at least :min characters.'),
            'meta_title.*.required' => _i('Meta Title is required'),
            'meta_title.*.min' => _i('The Meta Title must be at least :min characters.'),
        ];

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route('products.edit', $rowData)
                            ->with('growl', [_i('There is a required field, please check again.'), 'error'])->withErrors($validator)->withInput();
        } else {
            try {
                //                $rowData->country_id = $input['country_id'];
                $rowData->model = $input['model'];
                $rowData->sku = $input['sku'];
                $rowData->upc = $input['upc'];
                $rowData->ean = $input['ean'];
                $rowData->jan = $input['jan'];
                $rowData->isbn = $input['isbn'];
                $rowData->mpn = $input['mpn'];
                $rowData->location = $input['location'];
                //                $rowData->quantity = $input['quantity'];
                //                $rowData->minimum_order_amount = $input['minimum_order_amount'];
                //                $rowData->stock_status_id = $input['stock_status_id'];
                $rowData->manufacturer_id = $input['manufacturer_id'];
                //                $rowData->requires_shipping = $input['requires_shipping'];
                //                $rowData->price = $input['price'];
                //                $rowData->tax_rate = $input['tax_rate'];
                //                $rowData->tax_type = $input['tax_type'];
                $rowData->date_available = $input['date_available'];
                $rowData->weight = $request->input('weight') ? $request->input('weight') : 0;
                $rowData->weight_type = $input['weight_type'];
                $rowData->length = $request->input('length') ? $request->input('length') : 0;
                $rowData->width = $request->input('width') ? $request->input('width') : 0;
                $rowData->height = $request->input('height') ? $request->input('height') : 0;
                $rowData->length_type = $input['length_type'];
                //                $rowData->subtract_stock = $input['subtract_stock'];
                $rowData->sort_order = $input['sort_order'];
                $rowData->status = $input['status'];
                $rowData->product_type = $input['product_type'];

                //                dd($rowData);
                //upload the image
                $fileName = $rowData->main_image; //get old image first
                if (isset($input['main_image'])) {
                    // $main_image = $request->file('main_image');
                    $main_image = $input['main_image'];
                    $fileName = "";
                    if ($file = $main_image->isValid()) {
                        $destinationPath = public_path('images/products');
                        if (!is_dir($destinationPath)) {
                            mkdir($destinationPath, 0766, true);
                        }
                        $imageName = $main_image->getClientOriginalName();
                        $extension = $main_image->getClientOriginalExtension();
                        $fileName = md5($imageName . time()) . '.' . $extension;
                        $main_image->move($destinationPath, $fileName);
                        //delete old image first
                        if (!empty($rowData->image)) {
                            //delete old image
                            $file = public_path('images/products/') . $rowData->image;
                            @unlink($file);
                        }
                        //insert new image name
                        $rowData->main_image = $fileName;
                    }
                }
                $rowData->save(); //update product

                if (!empty($rowId)) {

                    if ($rowId != null) {
                        ProductPrice::where('product_id', $rowId)->delete();
                        for ($ii = 0; $ii < count($request->country_id); $ii++) {
                            //                            dd($request->tax_rate);
                            $country_id = $request->country_id[$ii];
                            $product_id = $rowId;
                            $quantity = $request->quantity[$ii];
                            $tax_rate = $request->tax_rate[$ii];
                            $tax_type = $request->tax_type[$ii];
                            $stock_status_id = $request->stock_status_id[$ii];
                            $minimum_order_amount = $request->minimum_order_amount[$ii];
                            $subtract_stock = $request->subtract_stock[$ii];
                            $price = $request->price[$ii][0];
                            $discount = $request->discount[$ii];
                            //                            dd($request->price);

                            if (($input["pkg"]) !== null) {
                                //                                dd($input["pkg"]);
                                $package = $input["pkg"][$ii];

                                $prices = $package["p"];
                                $sizes = $package["s"];

                                $sIndex = -1;

                                $created = false;
                                foreach ($prices as $price2) {
                                    $sIndex++;
                                    if ($price2 != null) {
                                        //$request->size = $size;
                                        ProductPrice::create([
                                            'price' => $price2,
                                            'discount' => $discount,
                                            'country_id' => $country_id,
                                            'product_id' => $product_id,
                                            'quantity' => $quantity,
                                            'tax_rate' => $tax_rate,
                                            'tax_type' => $tax_type,
                                            'stock_status_id' => $stock_status_id,
                                            'minimum_order_amount' => $minimum_order_amount,
                                            'subtract_stock' => $subtract_stock,
                                            'size' => $sizes[$sIndex],
                                        ]);
                                        $created = true;
                                    }
                                }
                            }
                            // dd($price);
                            if (!$created) {
                                ProductPrice::create([
                                    'price' => $price,
                                    'discount' => $discount,
                                    'country_id' => $country_id,
                                    'product_id' => $product_id,
                                    'quantity' => $quantity,
                                    'tax_rate' => $tax_rate,
                                    'tax_type' => $tax_type,
                                    'stock_status_id' => $stock_status_id,
                                    'minimum_order_amount' => $minimum_order_amount,
                                    'subtract_stock' => $subtract_stock,
                                    'size' => 0,
                                ]);
                            }


                            //dd($request->all());
                        }
                    }

                    if ($rowData->product_type == "lenses") {
                        ProductShowOptions::where('product_id', $rowId)->delete();
                        $options = request()->input("lenses_options");
                        if ($options != null)
                            foreach ($options as $option) {
                                $item = [
                                    'product_id' => $product_id,
                                    "code" => $option
                                ];
                                if ($option == "auto_reorder") {
                                    $item["value"] = $request->auto_reorder;
                                }
                                \App\Models\ProductShowOptions::create($item);
                            }
                    }

                    if ($request->sphere != null) {
                        Product_Sphere::where('product_id', $rowId)->delete();
                        for ($ii = 0; $ii < count($request->sphere); $ii++) {
                            $product_id = $rowId;
                            $sphere = $request->sphere[$ii];
                            $type = $request->type;
                            // dd($rowId,$sphere,$type);
                            Product_Sphere::create([
                                'product_id' => $product_id,
                                'sphere_id' => $sphere,
                                'type' => $type,
                            ]);
                        }
                    }

                    if ($request->cylinder != null) {
                        Product_Cylinder::where('product_id', $rowId)->delete();
                        for ($ii = 0; $ii < count($request->cylinder); $ii++) {
                            $product_id = $rowId;
                            $cylinder = $request->cylinder[$ii];
                            $type = $request->type;
                            Product_Cylinder::create([
                                'product_id' => $product_id,
                                'cylinder_id' => $cylinder,
                                'type' => $type,
                            ]);
                        }
                    }

                    if ($request->axis != null) {
                        Product_Axis::where('product_id', $rowId)->delete();
                        for ($ii = 0; $ii < count($request->axis); $ii++) {
                            $product_id = $rowId;
                            $axis = $request->axis[$ii];
                            $type = $request->type;
                            Product_Axis::create([
                                'product_id' => $product_id,
                                'axis_id' => $axis,
                                'type' => $type,
                            ]);
                        }
                    }
                    //insert product translations

                    foreach ($input['name'] as $key => $value) {
                        $transId = $input['id'][$key];
                        if (!empty($transId)) { //if this is an existing translation, update it
                            $rowTranslation = ProductDescription::find($transId);
                        } else {
                            //insert new translation
                            $rowTranslation = new ProductDescription();
                        }
                        $rowTranslation->product_id = $rowId;
                        $rowTranslation->language_id = $key;
                        $rowTranslation->name = $value;
                        $rowTranslation->description = $input['description'][$key];
                        $rowTranslation->meta_title = $input['meta_title'][$key];
                        $rowTranslation->meta_description = $input['meta_description'][$key];
                        $rowTranslation->meta_keyword = $input['meta_keyword'][$key];

                        $rowTranslation->save();
                    }

                    if (isset($input['categoryIds'])) {
                        //get already existing categories
                        $categoriesArr = ProductCategory::where('product_id', $rowId)->pluck('category_id')->toArray();

                        //insert product categories
                        $categoryIds = $input['categoryIds'];
                        foreach ($categoryIds as $categoryId) {
                            if (!in_array($categoryId, $categoriesArr)) { //if it is a newly added category, insert it
                                $prCategory = new ProductCategory();
                                $prCategory->product_id = $rowId;
                                $prCategory->category_id = $categoryId;

                                $prCategory->save();
                            } //else if it does exist, do nothing
                        }

                        //get old rows that don't exist in the form input
                        $diff = array_diff($categoriesArr, $categoryIds);
                        if (!empty($diff)) {
                            foreach ($diff as $item) {
                                ProductCategory::where('product_id', $rowId)->where('category_id', $item)->delete();
                            }
                        }
                    }

                    if (isset($input['relatedProductIds'])) {
                        //get already existing related products
                        $relatedProductsArr = RelatedProduct::where('product_id', $rowId)->pluck('related_id')->toArray();
                        //insert related products
                        $relatedProductIds = $input['relatedProductIds'];
                        foreach ($relatedProductIds as $relatedProductId) {
                            if (!in_array($relatedProductId, $relatedProductsArr)) { //if it is a newly added row, insert it
                                $prRelated = new RelatedProduct();
                                $prRelated->product_id = $rowId;
                                $prRelated->related_id = $relatedProductId;

                                $prRelated->save();
                            } //else if it does exist, do nothing
                        }

                        //get old rows that don't exist in the form input
                        $diff = array_diff($relatedProductsArr, $relatedProductIds);
                        if (!empty($diff)) {
                            foreach ($diff as $item) {
                                RelatedProduct::where('product_id', $rowId)->where('related_id', $item)->delete();
                            }
                        }
                    }

                    //insert product attributes


                     if (isset($input['product_attribute'])) {
                        //   dd($input);
                        $pr_attribute = ProductAttribute::where("product_id","=",$rowId)->get();
                        if(count($pr_attribute) > 0) {
                            ProductAttribute::where("product_id","=",$rowId)->delete();
                            $product_attribute = $input['product_attribute'];
                             foreach ($product_attribute as $key => $value) {

                                foreach ($product_attribute[$key]['text'] as $key2 => $value2) {
                                    $prAttribute = new ProductAttribute();
                                    $prAttribute->product_id = $rowId;
                                    $prAttribute->pr_attribute_id = $product_attribute[$key]['attribute_id'];
                                    $prAttribute->language_id = $key2;
                                    $prAttribute->text = $value2[0];

                                    $prAttribute->save();
                                }
                            }
                        } else {
                            if (is_array($request->attribute)) {
                                for ($ii = 0; $ii < count($request->attribute); $ii++) {
                                    $product_attribute = $request->product_attribute;
                                    foreach ($product_attribute[$ii] as $key => $value) {
                                        $prAttribute = new ProductAttribute();
                                        $prAttribute->product_id = $rowId;
                                        $prAttribute->pr_attribute_id = $request->attribute[$ii];
                                        $prAttribute->language_id = $key;
                                        $prAttribute->text = $value;
                                        $prAttribute->save();
                                    }
                                }
                            }
                        }

                    }


//                    if (isset($input['product_attribute'])) {
//                        if (is_array($request->attribute)) {
//                            for ($ii = 0; $ii < count($request->attribute); $ii++) {
//                                //                            dd($request->attribute[$ii]);
//                                $product_attribute = $request->product_attribute;
//                                //                            dd($product_attribute);
//                                foreach ($product_attribute[$ii] as $key => $value) {
//                                    $prAttribute = new ProductAttribute();
//                                    $prAttribute->product_id = $rowId;
//                                    $prAttribute->pr_attribute_id = $request->attribute[$ii];
//                                    $prAttribute->language_id = $key;
//                                    $prAttribute->text = $value;
//                                    //                                dd($prAttribute);
//                                    $prAttribute->save();
//                                }
//                            }
//                        }
//
//                                            }
                    }


                    //insert product discounts
                    //                    if (isset($input['product_discount'])) {
                    //                        $product_discount = $input['product_discount'];
                    ////                        dd($product_discount);
                    //                        foreach ($product_discount as $key => $value) {
                    //                            if (empty($product_discount[$key]['price'])) {
                    //                                $product_discount[$key]['price'] = '';
                    //                                $product_discount[$key]['priority'] = '';
                    //                            }
                    //                            if (empty($product_discount[$key]['price'])) {
                    //                                $product_discount[$key]['price'] = '';
                    //                            }
                    //                            $product_discount_id = $product_discount[$key]['product_discount_id'];
                    //                            if (!empty($product_discount_id)) { //if it does exist, update it
                    //                                $prDiscount = ProductDiscount::find($product_discount_id);
                    //                            } else {
                    //                                //insert new
                    //                                $prDiscount = new ProductDiscount();
                    //                            }
                    //                            $prDiscount->product_id = $rowId;
                    //                            $prDiscount->price = $product_discount[$key]['price'];
                    //                            $prDiscount->date_start = $product_discount[$key]['date_start'];
                    //                            $prDiscount->date_end = $product_discount[$key]['date_end'];
                    //                            $prDiscount->priority = $product_discount[$key]['priority'];
                    //
                    //                            $prDiscount->save();
                    //                        }
                    //                    }
                    //insert product images
                    if (isset($input['product_image'])) {
                        $product_image = $input['product_image'];
                        foreach ($product_image as $key => $value) {
                            $prImage = new ProductImage();
                            $prImage->product_id = $rowId;
                            $prImage->sort_order = $product_image[$key]['sort_order'];
                            //upload the image
                            if (isset($product_image[$key]['image'])) {
                                $image = $product_image[$key]['image'];
                                $fileName = "";
                                if ($file = $image->isValid()) {
                                    $destinationPath = public_path('images/products');
                                    if (!is_dir($destinationPath)) {
                                        mkdir($destinationPath, 0766, true);
                                    }
                                    $imageName = $image->getClientOriginalName();
                                    $extension = $image->getClientOriginalExtension();
                                    $fileName = md5($imageName . time()) . '.' . $extension;
                                    $image->move($destinationPath, $fileName);

                                    $prImage->image = $fileName;
                                }
                                $prImage->save();
                            }
                        }
                    }

                    //insert product colors
                  // $this->deleteProductColor($input['product_color']);
//                     ProductColor::where("product_id",$rowId)->delete();
                    if (isset($input['product_color'])) {
                        $product_color = $input['product_color'];
                        foreach ($product_color as $key => $value) {
                            if (empty($product_color[$key]['color'])) {
                                $product_color[$key]['color'] = '';
                                $input['product_color'][$key]['name'] = '';
                            }
                            $product_color_id = $product_color[$key]['product_color_id'];
                            if (!empty($product_color_id)) { //if it does exist, update it
                                $prColor = ProductColor::findOrFail($product_color_id);
                            } else {
                                //insert new
                                $prColor = new ProductColor();
                            }
                            $prColor->product_id = $rowId;
                            $prColor->sort_order = $product_color[$key]['sort_order'];
                            $prColor->color = $product_color[$key]['color'];
                            //upload the image
                            if (isset($product_color[$key]['image'])) {
                                $image = $product_color[$key]['image'];
                                $fileName = "";
                                if ($file = $image->isValid()) {
                                    $destinationPath = public_path('images/products');
                                    if (!is_dir($destinationPath)) {
                                        mkdir($destinationPath, 0766, true);
                                    }
                                    $imageName = $image->getClientOriginalName();
                                    $extension = $image->getClientOriginalExtension();
                                    $fileName = md5($imageName . time()) . '.' . $extension;
                                    $image->move($destinationPath, $fileName);

                                    if (!empty($product_color_id)) { //if it does exist, remove old image from storage
                                        $file = public_path('images/products/') . $prColor->image;
                                        @unlink($file);
                                    }

                                    $prColor->image = $fileName;
                                }
                            }

                            $prColor->save();
                            $product_color_id = $prColor->id;
                            //update color translations
                            //

                            if (!empty($product_color_id)) {

                                //insert translation
                                if (!empty($input['product_color'][$key]['name'])) {
                                    $names = $input['product_color'][$key]['name'];
                                    foreach ($names as $key2 => $value2) {

                                        $product_color_description_id = $product_color[$key]['product_color_description_id'][$key2];

                                        if (isset($product_color_description_id)) { //if it does exist, update it
                                            $prColorDesc = ProductColorDescription::find($product_color_description_id);
                                        } else {
                                            //insert new
                                            $prColorDesc = new ProductColorDescription();
                                        }
                                        $prColorDesc->product_color_id = $product_color_id;
                                        $prColorDesc->name = $value2;
                                        $prColorDesc->language_id = $key2;
                                        // dd($prColorDesc);
                                        $prColorDesc->save();
                                    }
                                }
                            }
                        }
                    }
                $rowData->update();
                // Create Lenses
                if ($request->input('lenses') != null) {
                    $lenses = Lens::whereIn('id', $request->input('lenses'))->get();
                    $rowData->lenses()->sync($lenses);
                }
                //End Create
                session()->flash('success', _i('The product has been correctly modified.'));
                return redirect()->route('products.edit', $rowData);
            } catch (Exception $e) {
                session()->flash('success', _i('An error occurred, please try again.'));
                return redirect()->route('products.edit', $rowData);
            }
        }
    }

    public function destroy($id) {
        // Find the product by the ID
        $rowData = Product::find($id);

//         Find all the assigned orders
        $assignedItemsNum = \App\Models\OrderItem::where('type_id', $id)->count();
        if (!empty($assignedItemsNum)) {
            session()->flash("error", _i(' Warning: This product cannot be deleted as it is currently assigned to ' . $assignedItemsNum . '  orders!'));
        } else {
//         Delete the product
            \App\Models\ProductShowOptions::where("product_id", "=", $id)->delete();
            ProductLens::where("product_id", "=", $id)->delete();

            $rowData->delete();
            session()->flash('success', _i('deleted successfly'));
        }
        return back();
    }

    public function getOption(Request $request) {
        $input = $request->all();
        $option_id = $input['option_id'];
        if (!empty($option_id)) {
            // getoption by ID
            $option = Option::getOneById($option_id, $this->language_id);
            //get option values
            $optionValues = OptionValue::getByLanguageAndOptionId($option_id, $this->language_id);
            return response()->json([
                        'name' => $option->name,
                        'option_id' => $option->id,
                        'type' => $option->type,
                        'option_values' => $optionValues,
            ]);
        }
    }

    public function getParentValues(Request $request) {
        $input = $request->all();
        $parent_option_id = $input['parent_option_id'];
        if (!empty($parent_option_id)) {
            // getoption by ID
            $productOption = ProductOption::getOneById($parent_option_id, $this->language_id);
            //get option values
            $productOptionValues = ProductOptionValue::getByLanguageAndProductOptionId($parent_option_id, $this->language_id);
            return response()->json([
                        'product_option_values' => $productOptionValues,
            ]);
        }
    }

    public function deleteProductAttribute(Request $request) {
        $input = $request->all();
        $attribute_id = $input['attribute_id'];
        $product_id = $input['product_id'];
        // Find by pr_attribute_id, $product_id
        ProductAttribute::where('pr_attribute_id', $attribute_id)->where('product_id', $product_id)->delete();
        return "success";
    }

    public function deleteCountryProduct(Request $request) {
        $input = $request->all();
        ProductPrice::where('id', $input)->delete();
        return "success";
    }

    public function deleteProductOption(Request $request) {
        $input = $request->all();
        $product_option_id = $input['product_option_id'];
        // Find by ID
        $rowData = ProductOption::find($product_option_id);
        $rowData->delete();
        ProductOptionValue::where('product_option_id', $product_option_id)->delete();
        ProductOptionParent::where('product_option_id', $product_option_id)->delete();
        return "success";
    }

    public function deleteProductOptionValue(Request $request) {
        $input = $request->all();
        $product_option_value_id = $input['product_option_value_id'];
        // Find by ID
        $rowData = ProductOptionValue::find($product_option_value_id);
        $rowData->delete();
        return "success";
    }

    //    public function deleteProductDiscount(Request $request) {
    //        $input = $request->all();
    //        $product_discount_id = $input['product_discount_id'];
    //        // Find by ID
    //        $rowData = ProductDiscount::find($product_discount_id);
    //        $rowData->delete();
    //        return "success";
    //    }

    public function deleteProductImage(Request $request) {
        $input = $request->all();
        $product_image_id = $input['product_image_id'];
        // Find by ID
        $rowData = ProductImage::find($product_image_id);
        $rowData->delete();
        return "success";
    }

    public function deleteProductColor(Request $request) {
            // Find by ID
        $rowData = ProductColor::find($request->product_color_id);

        if (!empty($rowData)) {
            if (!empty($rowData->image)) { //if it does exist, remove old image from storage
                $file = public_path('images/products/') . $rowData->image;
                @unlink($file);
            }
            $rowData->delete();
            return "success";
        }
    }

    public function getAttributes(Request $request) {
        if ($request->ajax()) {
            if ($request->attributeGroup) {
                $languages = Language::getEnabledLanguages();
                $attributeGroupId = AttributeGroup::findOrFail($request->attributeGroup);
                $attributes = PrAttribute::leftJoin('pr_attribute_descriptions', 'pr_attributes.id', '=', 'pr_attribute_descriptions.pr_attribute_id')
                        ->leftJoin('attribute_groups', 'pr_attributes.attribute_group_id', '=', 'attribute_groups.id')
                        ->leftJoin('attribute_group_descriptions', 'attribute_groups.id', '=', 'attribute_group_descriptions.attribute_group_id')
                        ->select('pr_attributes.*', 'pr_attribute_descriptions.name', 'attribute_group_descriptions.name as group_name')
                        ->where([
                            ['pr_attributes.status', '=', 0],
                            ['pr_attribute_descriptions.language_id', '=', $this->language_id],
                            ['attribute_group_descriptions.language_id', '=', $this->language_id],
                            ['pr_attributes.attribute_group_id', '=', $request->attributeGroup],
                            ['pr_attributes.deleted_at', '=', NULL],
                        ])
                        ->get();
                ;
                //                dd($attributes);
                $count = 0;
                return view('admin.products.create.ajax.details', compact('attributes', 'languages', 'count'));
            }
        }
    }

    public function getOptions(Request $request) {
        if ($request->ajax()) {
            if ($request->type) {
                $type = $request->type;
                $spheres = Sphere::where('type', $type)->pluck('title', 'id');
                $cylinder = Cylinder::where('type', $type)->pluck('title', 'id');
                $axis = Axis::where('type', $type)->pluck('title', 'id');
                return view('admin.products.create.ajax.type', compact('spheres', 'cylinder', 'axis', 'type'));
            }
        }
    }

}
