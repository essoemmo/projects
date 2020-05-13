<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = 'currencies';
    protected $fillable = [
        'title',
        'lang_id',
        'source_id',
        'country_id',
        'code',
    ];
}
