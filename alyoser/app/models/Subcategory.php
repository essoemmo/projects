<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $guarded=[];
    protected $table = 'subcategories';


    public function Category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function subCat(){
        return $this->hasMany(Subcat::class);

    }
}
