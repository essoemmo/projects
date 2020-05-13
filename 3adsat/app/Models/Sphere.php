<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sphere extends Model
{
    protected $table = 'spheres';

    protected $fillable = [
        'title',
        'price',
        'type',
    ];
}
