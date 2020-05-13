<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameDetailProduct extends Model
{

    protected $table = 'gamedetails_products';
    public $timestamps = true;
    protected $fillable = array('game_detail_id', 'product_id');

}
