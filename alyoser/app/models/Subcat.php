<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Subcat extends Model
{
    protected $guarded=[];
    protected $table = 'subcats';


    public function SubCategory()
    {
        return $this->belongsTo(Subcategory::class,'SubCat_id');
    }
}
