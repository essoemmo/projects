<?php

namespace App\Models;

use App\ProductLens;
use Carbon\Carbon;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property string $model
 * @property string $sku
 * @property string $upc
 * @property string $ean
 * @property string $jan
 * @property string $isbn
 * @property string $mpn
 * @property string $location
 * @property int $quantity
 * @property int $stock_status_id
 * @property string $main_image
 * @property int $manufacturer_id
 * @property int $requires_shipping
 * @property float $price
 * @property float $tax_rate
 * @property int $tax_type
 * @property string $date_available
 * @property float $weight
 * @property string $weight_type
 * @property float $length
 * @property int $width
 * @property float $height
 * @property string $length_type
 * @property int $subtract_stock
 * @property int $minimum_order_amount
 * @property int $sort_order
 * @property int $status
 * @property int $viewed
 * @property int $special
 * @property int $country_id
 * @property ProductAttribute[] $productAttributes
 * @property ProductCategory[] $productCategories
 * @property ProductDescription[] $productDescriptions
 * @property ProductDiscount[] $productDiscounts
 * @property ProductImage[] $productImages
 * @property ProductOptionValue[] $productOptionValues
 * @property ProductOption[] $productOptions
 * @property RelatedProduct[] $relatedProducts
  // * @property RelatedProduct[] $relatedProducts
 */
class Product extends Model {

    use Favoriteable;

//    use SoftDeletes;
    // protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $fillable = ['created_at', 'updated_at', 'deleted_at', 'model', 'sku', 'upc', 'ean', 'jan', 'isbn', 'mpn', 'location', 'stock_status_id', 'main_image', 'manufacturer_id', 'date_available', 'weight', 'weight_type', 'length', 'width', 'height', 'length_type', 'subtract_stock', 'minimum_order_amount', 'sort_order', 'status', 'viewed', 'special', 'product_type'];
    var $price;

    // product rating
    public function rating(){
        return $this->belongsTo('App\Models\rating\rating','id','product_id');
    }

    public function countries() {
        return $this->belongsToMany('App\Models\Country', 'product_price', 'product_id', 'country_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productAttributes() {
        return $this->hasMany('App\Models\ProductAttribute')->orderBy('product_attributes.id', 'asc');
    }

    public function delete() {
        // delete all related photos
        $this->productDescriptions()->delete();
        // as suggested by Dirk in comment,
        // it's an uglier alternative, but faster
        // Photo::where("user_id", $this->id)->delete()
        return parent::delete();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productCategories() {
        return $this->hasMany('App\Models\ProductCategory');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productDescriptions() {
        return $this->hasMany('App\Models\ProductDescription');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productDiscounts() {
        return $this->hasMany('App\Models\ProductDiscount');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productImages() {
        return $this->hasMany('App\Models\ProductImage')->orderBy('product_images.sort_order', 'asc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productOptionValues() {
        return $this->hasMany('App\Models\ProductOptionValue');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productOptions() {
        return $this->hasMany('App\Models\ProductOption');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function relatedProducts() {
        return $this->hasMany('App\Models\RelatedProduct', 'related_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productReviews() {
        return $this->hasMany('App\Models\ProductReview');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productColors() {
        return $this->hasMany('App\Models\ProductColor');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function showOptions() {
        return $this->hasMany('App\Models\ProductShowOptions');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prices() {
        return $this->hasMany('App\Models\ProductPrice');
    }

    public function spheres() {
        return $this->hasMany('App\Models\Product_Sphere');
    }

    public function cylinder() {
        return $this->hasMany('App\Models\Product_Cylinder');
    }

    public function axis() {
        return $this->hasMany('App\Models\Product_Axis');
    }

    public function price() {

        if (request()->cookie('code') != null){
            $country_id = request()->cookie('code');
        }else{
            $iso = \Illuminate\Support\Facades\DB::table('countries')->first();
            $country_id = $iso->iso_code;

        }
        $country = \Illuminate\Support\Facades\DB::table('countries')->where('iso_code',$country_id)->first();
        $obj = $this->prices()->where("country_id", "=", $country->id)->orderBy("price", "asc")->first();

        if ($obj != NULL)
//            dd($obj->first());
            return ($obj);
        $obj =new \stdClass();
        
        $obj->price="";
        $obj->discount="";
        return $obj;
    }

    public static function getOneById($id, $language_id) {
        $data = DB::table('products')
                ->join('product_descriptions', 'products.id', '=', 'product_descriptions.product_id')
                ->select('product_descriptions.name')
                ->where([
                    ['product_descriptions.product_id', '=', $id],
                    ['product_descriptions.language_id', '=', $language_id],
                    ['product_descriptions.deleted_at', '=', NULL],
                ])
                ->first();
        return $data;
    }

    public static function getProductByIdAndLanguage($id, $language_id) {
        $data = Product::join('product_descriptions', 'products.id', '=', 'product_descriptions.product_id')
                ->where([
                    ['product_descriptions.product_id', '=', $id],
                    ['product_descriptions.language_id', '=', $language_id],
                    ['product_descriptions.deleted_at', '=', NULL],
                ])
                ->select('products.*', 'product_descriptions.id as translation_id', 'product_descriptions.name', 'product_descriptions.description', 'product_descriptions.tag', 'product_descriptions.meta_title', 'product_descriptions.meta_description', 'product_descriptions.meta_keyword')
                ->first();

        return $data;
    }

    //get names by language
    public static function getByLanguage($language_id) {
        $products = DB::table('products')
                ->leftJoin('product_descriptions', 'products.id', '=', 'product_descriptions.product_id')
                ->select('products.*', 'product_descriptions.name')
                ->where([
                    ['products.status', '=', 0],
                    ['product_descriptions.language_id', '=', $language_id],
                    ['products.deleted_at', '=', NULL],
                    ['product_descriptions.deleted_at', '=', NULL],
                ])
                ->get();

        return $products;
    }

    public static function getByLanguageExtend($language_id) {
        $products = DB::table('products')
                ->leftJoin('product_descriptions', 'products.id', '=', 'product_descriptions.product_id')
                ->select('products.*', 'product_descriptions.name')
                ->where([
                    ['products.status', '=', 0],
                    ['product_descriptions.language_id', '=', $language_id],
                    ['products.deleted_at', '=', NULL],
                    ['product_descriptions.deleted_at', '=', NULL],
                ])
                ->get();

        return $products;
    }

    public static function getByLanguageAndDate($language_id, $date_query) {
        $products = DB::table('products')
                ->leftJoin('product_descriptions', 'products.id', '=', 'product_descriptions.product_id')
                ->select('products.*', 'product_descriptions.name')
                ->where([
                    ['products.status', '=', 0],
                    ['product_descriptions.language_id', '=', $language_id],
                    ['products.deleted_at', '=', NULL],
                    ['product_descriptions.deleted_at', '=', NULL],
                ])
                ->get();

        return $products;
    }

    public static function getByLanguageAndCategoriesLimited($language_id, $categoryIds, $country_id) {
        $products = DB::table('products')
                ->join('product_descriptions', 'products.id', '=', 'product_descriptions.product_id')
                ->join('product_categories', 'products.id', '=', 'product_categories.product_id')
                ->join('categories', 'categories.id', '=', 'product_categories.category_id')
                ->join('product_price', function ($join) {
                    $join->on('product_price.product_id', '=', 'products.id');
                })->groupBy('products.id')
                ->select('products.*', 'product_descriptions.name',"product_price.price","product_price.discount")
                ->where([
                    ['products.status', '=', 0],
                    ['product_descriptions.language_id', '=', $language_id],
                    ['products.deleted_at', '=', NULL],
                    ['product_price.country_id', '=', $country_id],
                ])
                ->whereIn('product_categories.category_id', $categoryIds)
                ->distinct('products.id')
                ->orderBy('products.sort_order', 'asc')
                ->orderBy('products.created_at', 'desc')
                ->limit(9)
                ->get();
//        dd($products);
        return $products;
    }

    public static function getByLanguageAndCategories($language_id, $categoryIds) {
        $products = DB::table('products')
                ->join('product_descriptions', 'products.id', '=', 'product_descriptions.product_id')
                ->join('product_categories', 'products.id', '=', 'product_categories.product_id')
                ->join('categories', 'categories.id', '=', 'product_categories.category_id')
                ->select('products.*', 'product_descriptions.name')
                ->where([
                    ['products.status', '=', 0],
                    ['product_descriptions.language_id', '=', $language_id],
                    ['products.deleted_at', '=', NULL],
                ])
                ->whereIn('product_categories.category_id', $categoryIds)
                ->distinct('products.id')
                ->orderBy('products.sort_order', 'asc')
                ->orderBy('products.created_at', 'desc')
                ->paginate(6);

        return $products;
    }

    public static function getByLanguageAndCategoriesPaginate($language_id, $categoryIds, $country_id) {
        $products = DB::table('products')
                ->join('product_descriptions', 'products.id', '=', 'product_descriptions.product_id')
                ->join('product_categories', 'products.id', '=', 'product_categories.product_id')
                ->join('categories', 'categories.id', '=', 'product_categories.category_id')
                //->join('product_price', 'products.id', '=', 'product_price.product_id')
                  ->join('product_price', function ($join) {
                    $join->on('product_price.product_id', '=', 'products.id');
                })->groupBy('products.id')
                ->select('products.*', 'product_descriptions.name','product_price.price')
                ->where([
                    ['products.status', '=', 0],
                    ['product_descriptions.language_id', '=', $language_id],
                    ['products.deleted_at', '=', NULL],
                    ['product_price.country_id', '=', $country_id],
                ])
                ->whereIn('product_categories.category_id', $categoryIds)
                ->distinct('products.id')
                ->orderBy('products.sort_order', 'asc')
                ->orderBy('products.created_at', 'desc')
                ->paginate(50);

        return $products;
    }

    public static function getByLanguagePaginate($language_id, $country_id) {
        $products = DB::table('products')
                ->join('product_descriptions', 'products.id', '=', 'product_descriptions.product_id')
                ->join('product_categories', 'products.id', '=', 'product_categories.product_id')
                ->join('categories', 'categories.id', '=', 'product_categories.category_id')
                ->join('product_price', 'products.id', '=', 'product_price.product_id')
                ->select('products.*', 'product_descriptions.name')
                ->where([
                    ['products.status', '=', 0],
                    ['product_descriptions.language_id', '=', $language_id],
                    ['products.deleted_at', '=', NULL],
                    ['product_price.country_id', '=', $country_id],
                ])
                ->distinct('products.id')
                ->orderBy('products.sort_order', 'asc')
                ->orderBy('products.created_at', 'desc')
                ->paginate(50);

        return $products;
    }

    public static function getNewProductsLimited($language_id, $country_id) {
        $products = Product::join('product_descriptions', 'products.id', '=', 'product_descriptions.product_id')
                ->join('product_price', function ($join) {
                    $join->on('product_price.product_id', '=', 'products.id');
                })->groupBy('products.id')
                ->where([
                    ['products.status', '=', 0],
                    ['product_price.country_id', '=', $country_id],
                    ['product_descriptions.language_id', '=', $language_id],
                    ['products.deleted_at', '=', NULL],
                ])
                ->select('products.*', 'product_descriptions.name','product_price.price','product_price.discount')
                ->latest()
                ->limit(6)
                ->get();
        //   DB::table('products')
        // ->join('product_descriptions', 'products.id', '=', 'product_descriptions.product_id')
        // ->select('products.*', 'product_descriptions.name')
        // ->where([
        //         ['products.status', '=', 0],
        //         ['products.country_id', '=', $country_id],
        //         ['product_descriptions.language_id', '=', $language_id],
        //         ['products.deleted_at', '=', NULL],
        //        ])
        // ->latest()
        // ->limit(6)
        // ->get();
        return $products;
    }
    public function lenses(){
        return $this->belongsToMany(Lens::class,ProductLens::class,'product_id','lens_id');
    }
}
