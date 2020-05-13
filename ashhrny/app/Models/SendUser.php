<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SendUser extends Model
{
    protected $table = "send_users";
    protected $fillable = [
        'user_id',
        'message',
        'type',
        'status',
    ];
}
