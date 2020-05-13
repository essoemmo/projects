<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlbumCategory extends Model
{
    protected $guarded =[];

    public function albumCatData(){
        return $this->hasMany(AlbumCategoryData::class);
    }
}
