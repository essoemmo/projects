<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product_details extends Model
{
    use SoftDeletes;
    protected $table = 'product_details';
    protected $fillable = [
        'title',
        'description',
        'product_id',
        'lang_id',
        'source_id',
    ];

    public function product()
    {
        return $this->hasOne('\App\Models\product\products', 'id', 'product_id');
    }

    public function products()
    {
        return $this->belongsTo('\App\Models\product\products', 'product_id', 'id');
    }

    public function language()
    {
        return $this->hasOne('\App\Models\language', 'id', 'lang_id');
    }

    public function parent()
    {
        return $this->hasOne('\App\Models\product\product_details', 'id', 'source_id');
    }

    public function children()
    {
        return $this->hasMany('\App\Models\product\product_details', 'source_id', 'id');
    }
}
