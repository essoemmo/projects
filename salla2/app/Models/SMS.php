<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SMS extends Model
{
    protected $table = 'sms';
    protected $fillable = array('to', 'message', 'store_id', 'model_type', 'user_id');
}
