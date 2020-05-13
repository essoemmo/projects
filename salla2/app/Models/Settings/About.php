<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table = 'abouts';
    protected $fillable = [
        'title',
        'descrption',
        'created_at'
    ];

}
