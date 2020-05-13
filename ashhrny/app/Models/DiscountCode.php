<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model 
{

    protected $table = 'discount_codes';
    public $timestamps = true;
    protected $fillable = array('title', 'code', 'discount', 'count');

}