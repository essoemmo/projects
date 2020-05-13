<?php

namespace App\Models\rating;

use Illuminate\Database\Eloquent\Model;

class userRating extends Model
{
    protected $table = 'user_rating';
    protected $fillable = [
        'user_id',
        'rating_id',
        'rating',
        'comment',
        'approve',
        'store_id',
    ];

    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }
    public function rate(){
        return $this->hasOne('App\Models\rating\rating','id','rating_id');
    }
}
