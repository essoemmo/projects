<?php

namespace App\Models\Shipping;

use Illuminate\Database\Eloquent\Model;

class shippingCompanies extends Model
{
    protected $table = 'shipping_companies';
    protected $fillable = [
        'title',
        'description',
        'logo',
        'store_id',
        'lang_id',
        'source_id'
    ];

    public function shipping_options()
    {
        return $this->hasMany('App\Models\Shipping\Shipping_option', 'id', 'company_id');
    }
}
