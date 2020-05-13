<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{

    use Translatable;
    protected $table = 'genre';
    public $timestamps = true;

    public $translatedAttributes = ['title'];


    public function translations()
    {
        return $this->hasMany(GenreTranslation::class, 'genre_id');
    }

}
