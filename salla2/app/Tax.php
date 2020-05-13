<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $table = 'tax';
    protected $fillable = [
        'tax',
        'store_id',
        'country_id',
    ];
}
