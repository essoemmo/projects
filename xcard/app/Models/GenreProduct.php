<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GenreProduct extends Model
{

    protected $table = 'genres_products';
    public $timestamps = true;
    protected $fillable = array('genre_id', 'product_id');

}
