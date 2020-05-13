<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{

    use Translatable;
    protected $table = 'sliders';
    public $timestamps = true;
    public $translatedAttributes = ['title'];
    protected $fillable = array('user_id', 'sort','alt_image', 'publish');

    public function translations()
    {
        return $this->hasMany('App\Models\SliderTranslation', 'slider_id');
    }

}
