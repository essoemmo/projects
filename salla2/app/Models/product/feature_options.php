<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Model;

class feature_options extends Model
{
    protected $table = 'feature_options';
    public $timestamps = true;
    protected $fillable = array('id','feature_id','title', 'price','lang_id','source_id','count','multiple','created_at');


    public function data() {
        return $this->hasOne('App\Models\product\feature_option_data','feature_option_id','id');
    }
}
