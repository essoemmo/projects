<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialAdvertisement extends Model
{
    protected $table = 'social_advertisement';
    public $timestamps = true;
    protected $fillable = array('type', 'price');
}
