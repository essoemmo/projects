<?php

namespace App\Models\rating;

use Illuminate\Database\Eloquent\Model;

class rating extends Model
{
    protected $table = 'ratings';
    protected $fillable = [
        'product_id',
        'rating',
 
    ];
    public function users(){
        return $this->belongsToMany('App\User','user_rating','rating_id','user_id')->withPivot('rating','comment','store_id');
    }
    public function product(){
        return $this->hasOne('App\Models\product\products','id','product_id');
    }
    public function userRating(){
        return $this->hasMany('App\Models\rating\userRating','rating_id','id');
    }
}
