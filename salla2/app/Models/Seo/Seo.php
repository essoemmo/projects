<?php

namespace App\Models\Seo;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $table = 'seo';
    protected $fillable = [
        'itemable_id',
        'itemable_type',
        'store_id',
    ];
}
