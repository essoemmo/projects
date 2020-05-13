<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use Translatable;
    protected $table = 'advertisements';
    protected $fillable = array('from' ,'to' ,'image','video','advertise_type','advertise_on');
    public $translatedAttributes = ['title','content'];
    public $timestamps = true;

    public function translations()
    {
        return $this->hasMany(AdvertisementTranslation::class, 'advertisement_id');
    }
}
