<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{

    use Translatable;
    protected $table = 'sliders';
    public $timestamps = true;
    public $translatedAttributes = ['title','description'];
    protected $fillable = array('image', 'url', 'publish');

    public function translations()
    {
        return $this->hasMany('App\Models\SliderTranslation', 'slider_id');
    }

}
