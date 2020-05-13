<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = 'currencies';
    protected $fillable =[
        'code',
        'show',
        'store_id',
    ];

}
