<?php


namespace App\Models;


use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Rating extends  Model
{

    use Translatable;

    protected $table = "ratings";
    public $translatedAttributes = ['title'];
    public $timestamps = true;


    public function translations()
    {
        return $this->hasMany(RatingTranslation::class, 'rating_id');
    }

}