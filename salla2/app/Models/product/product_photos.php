<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product_photos extends Model
{
    use SoftDeletes;
    protected $table = 'product_photos';
    protected $fillable = [
        'product_id',
        'lang_id',
        'source_id',
        'tag',
        'photo',
        'description',
        'main',
    ];

    public function product()
    {
        return $this->belongsTo('\App\Models\product\products', 'id', 'product_id');
    }
}
