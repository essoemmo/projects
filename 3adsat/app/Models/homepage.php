<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class homepage extends Model
{
    protected $table = 'store_homepages';
    protected $fillable = [
        'category_id',
        'sort',
        'template',
    ];

    public function category(){
        return $this->hasOne('App\Models\Category','id','category_id');
    }
}
