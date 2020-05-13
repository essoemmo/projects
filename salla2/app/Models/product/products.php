<?php

namespace App\Models\product;

use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class products extends Model
{

    use SoftDeletes;
    use Favoriteable;
    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = array('id', 'currency_code', 'store_id', 'product_type', 'sku', 'max_count', 'weight', 'price', 'net', 'stock', 'discount', 'discount_type', 'delivary', 'created_at');
    protected $with = ['comments', 'comments.user', 'comments.reply'];

    public function mainPhoto()
    {
        $find = $this->product_photos()->where("main", "1")->first();
        if ($find != null)
            return $find->photo;
        return "/images/placeholder.png";
    }

    public function Type()
    {
        $find = $this->product_type()->first();
        if ($find != null)
            return $find->id;
        return -1;
    }

    public function Category()
    {
        return $this->categories()->get();

    }

    public function singleProductDetails()
    {
        $find = $this->product_details()->where("source_id", null)->first();
        return $find;
    }

    public function product_type()
    {
        return $this->hasOne('App\Models\Product_type', 'id', 'product_type');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'categories_products', 'product_id', 'category_id')->withPivot('sort');
    }

    public function features()
    {
        return $this->hasMany('App\Models\product\features', 'product_id', 'id');
    }

    public function product_details()
    {
        return $this->hasMany('App\Models\product\product_details', 'product_id', 'id', 'lang_id');
    }

    public function order_products()
    {
        return $this->hasMany('App\Models\product\order_products', 'product_id', 'id');
    }

    public function detailes()
    {
        return $this->hasOne('App\Models\product\product_details', 'product_id', 'id');
    }

    public function product_photos()
    {
        return $this->hasMany('App\Models\product\product_photos', 'product_id', 'id');
    }

    public function main_product_photo()
    {
        return $this->hasOne('App\Models\product\product_photos', 'product_id', 'id')->whereMain(1);
    }

    public function comments()
    {
        return $this->hasMany('App\Comment')->whereNull('comment_id');
    }
}
