<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturedAd extends Model
{
    protected $table = 'featured_ads';
    public $timestamps = true;
    protected $fillable = array('place', 'price');
}
