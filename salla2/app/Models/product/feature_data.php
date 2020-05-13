<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Model;

class feature_data extends Model
{
    protected $table = 'features_data';
    public $timestamps = false;
    protected $fillable = array('id','feature_id', 'lang_id','source_id', 'title');

}
