<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreUsers extends Model
{
    protected $table = 'store_users';
    protected $fillable = [
        'user_id',
        'store_id',
    ];
}
