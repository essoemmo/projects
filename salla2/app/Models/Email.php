<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table = 'email';
    protected $fillable = array('to', 'message', 'store_id', 'model_type', 'user_id');
}
