<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlbumCategoryData extends Model
{
    protected $guarded =[];

    public function albumCat(){
        return $this->belongsTo(AlbumCategory::class);
    }
}
