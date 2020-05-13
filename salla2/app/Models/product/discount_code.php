<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Model;

class discount_code extends Model
{
    protected $table = 'discount_codes';
    public $timestamps = true;
    protected $fillable = array('store_id','code','discount','count','type','status','expire_date','items_count');
//'type' , ["perc","fixed","item"]
    public function data() {
        return $this->hasOne('App\Models\product\discount_data','discount_code_id','id');
    }
}
