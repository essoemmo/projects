<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Model;

class store_language extends Model
{
    protected $table = 'store_languages';
    protected $fillable = [
        'store_id',
        'language_id',
    ];
}
