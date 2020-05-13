<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cylinder extends Model
{
    protected $table = 'cylinder';

    protected $fillable = [
        'title',
        'price',
        'type',
    ];
}
