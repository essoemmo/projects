<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    protected $table = 'groups_users';
    protected $fillable = [
        'group_id',
        'user_id',
    ];
}
