<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class membership extends Model
{
    protected $table = 'memberships';
    protected $fillable = [
        'title',
        'is_active',
        'price',
        'duration',
    ];

    public function membershipUser(){
        return $this->hasMany('App\membershipUser','membership_id','id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
