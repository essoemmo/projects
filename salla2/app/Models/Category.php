<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $hidden = ['pivot'];
    public $timestamps = true;
    protected $fillable = array('id', 'title', 'description', 'number', 'store_id', 'parent_id', 'lang_id', 'source_id', 'created_at');

    public function store()
    {
        return $this->hasOne('\App\Models\product\stores', 'id', 'store_id');
    }

    public function parent()
    {
        return $this->hasOne('\App\Models\category', 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('\App\Models\category', 'parent_id', 'id');
    }

    public function homepages()
    {
        return $this->hasMany('\App\Models\Settings\homepage', 'category_id', 'id');
    }

    public function languages()
    {
        return $this->hasOne('\App\Models\Language', 'id', 'lang_id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\product\products', 'categories_products', 'category_id', 'product_id')->withPivot('sort');
    }
}
