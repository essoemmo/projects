<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingRequire extends Model
{
    protected $table = 'shipping_require';
    protected $guarded = [];

    public function shipping_require_data()
    {
        return $this->hasOne('App\ShippingRequireData')->whereLangId(getLang(session('lang')));
    }
}
