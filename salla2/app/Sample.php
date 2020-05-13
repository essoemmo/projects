<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    protected $table = 'master_samples';
    protected $fillable = [
        'store_id',
        'img_url',
    ];

}
