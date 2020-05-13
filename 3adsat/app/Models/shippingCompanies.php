<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class shippingCompanies extends Model
{
    protected $table = 'shipping_companies';
    protected $fillable = [
        'title',
        'description',
        'logo',
        'lang_id',
        'source_id'
    ];
}
