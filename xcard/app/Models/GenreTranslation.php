<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GenreTranslation extends Model
{

    protected $table = 'genre_translations';
    public $timestamps = true;
    protected $fillable = array('title', 'locale', 'genre_id');

}
