<?php


namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{

    protected $table = 'sliders';
    public $timestamps = true;
    protected $fillable = array('link','published', 'status','image', 'logo','store_id');

}