<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Axis extends Model
{
    protected $table = 'axis';

    protected $fillable = [
        'title',
        'price',
        'type',
    ];
}
