<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model 
{

    protected $table = 'ratings';
    public $timestamps = true;
    protected $fillable = array('product_id', 'rating');

}