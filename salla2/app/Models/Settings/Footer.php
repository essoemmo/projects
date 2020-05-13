<?php


namespace App\Models\Settings;


use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{

    protected $table = 'footers';
    public $timestamps = true;
    protected $fillable = array('title','link', 'category_id','lang_id','source_id','store_id');
}