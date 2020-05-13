<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SliderData extends Model
{
    protected $table = 'sliders_data';
    protected $fillable = [
        'name',
        'description',
        'lang_id',
        'source_id',
        'slider_id',
    ];
}
