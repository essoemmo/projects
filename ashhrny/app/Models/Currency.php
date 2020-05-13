<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{

    use Translatable;
    protected $table = 'currencies';
    public $timestamps = true;
    protected $fillable = array('country_id');
    public $translatedAttributes = ['title','code'];

    public function translations()
    {
        return $this->hasMany(CurrencyTranslation::class, 'currency_id');
    }

}
