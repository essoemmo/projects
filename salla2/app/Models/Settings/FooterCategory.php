<?php


namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;


class FooterCategory extends Model
{

    protected $table = 'footer_category';
    public $timestamps = true;
    protected $fillable = array('title','lang_id','source_id','store_id');
}