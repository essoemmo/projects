<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use Translatable;
    protected $table = 'regions';
    public $timestamps = true;
    protected $fillable = array('code');
    public $translatedAttributes = ['title'];


    public function translations()
    {
        return $this->hasMany(RegionTranslation::class, 'region_id');
    }

}
