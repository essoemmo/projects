<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'bills';
    protected $fillable = [
        'user_id',
        'status',
        'title',
        'description',
        'total',
        'currency_id'
    ];
}
