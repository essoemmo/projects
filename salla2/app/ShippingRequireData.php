<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingRequireData extends Model
{
    protected $table = 'shipping_require_data';
    protected $guarded = [];

    public function shipping_require()
    {
        return $this->belongsTo('App\ShippingRequire');
    }
}
