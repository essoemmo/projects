<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    use Translatable;
    protected $table = 'countries';
    public $timestamps = true;
    protected $fillable = array('logo', 'code');

    public $translatedAttributes = ['title'];

    public function translations()
    {
        return $this->hasMany(CountryTranslations::class, 'country_id');
    }

}
