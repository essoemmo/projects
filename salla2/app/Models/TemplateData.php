<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TemplateData extends Model
{

    protected $table = 'template_data';
    protected $fillable = array('title', 'template_id', 'lang_id', 'source_id');
    public $timestamps = true;
}