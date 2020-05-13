<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    use Translatable;
    protected $table = 'cities';
    public $timestamps = true;
    protected $fillable = array('country_id');
    public $translatedAttributes = ['title'];

    public function translations()
    {
        return $this->hasMany(CityTranslation::class, 'city_id');
    }
}
