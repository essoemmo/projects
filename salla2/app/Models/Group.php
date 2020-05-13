<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';
    protected $fillable = [
        'title',
        'icon',
        'store_id',
    ];

    public function groups_users()
    {
        return $this->hasMany('App\Models\GroupUser', 'group_id', 'id');
    }
}
