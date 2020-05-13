<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class discount_code extends Model
{
    protected $table = 'discount_codes';
    protected $fillable = [
        'title',
        'code',
        'discount',
        'type',
        'lang_id',
        'source_id',
    ];
}
