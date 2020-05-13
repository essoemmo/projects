<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SliderTranslation extends Model
{

    protected $table = 'sliders_translations';
    public $timestamps = true;
    protected $fillable = array('slider_id', 'title', 'locale');

}
