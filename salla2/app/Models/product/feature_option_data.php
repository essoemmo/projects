<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Model;

class feature_option_data extends Model
{
    protected $table = 'feature_options_data';
    public $timestamps = false;
    protected $fillable = array('feature_option_id','title', 'lang_id','source_id');
}
