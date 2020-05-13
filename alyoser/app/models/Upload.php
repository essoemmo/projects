<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $table ='uploads';
    protected $guarded=[];

    public function files(){
        return $this->morphMany(File::class,'fileable','fileable_type','fileable_id');
    }
}
