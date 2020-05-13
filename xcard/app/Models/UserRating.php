<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRating extends Model
{

    protected $table = 'users_ratings';
    public $timestamps = true;
    protected $fillable = array('user_id', 'rating', 'comment', 'approve', 'ra_id');

}
