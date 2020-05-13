<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    protected $table = 'counters';
    protected $fillable = [
        'icon',
        'title',
        'counter',
    ];
}
