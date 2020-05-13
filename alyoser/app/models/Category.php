<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $guarded=[];
    protected $table = 'categories';


    public function subCat()
    {
            return $this->hasMany(Subcategory::class,'category_id','id');
    }

}
