<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class RatingUser extends Model
{

    protected $table = "rating_user";
    protected $fillable = ['user_id' ,'rating_id','social_advertisement_id','comment'];

    public function rate()
    {
        return $this->hasOne('App\Models\Rating', 'id', 'rating_id');
    }
}
