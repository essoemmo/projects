<?php


namespace App\Models\Content;


use Illuminate\Database\Eloquent\Model;

class SectionCountry extends Model
{

    protected  $table = "section_country";
    protected $fillable = ['section_id' ,'country_id'];
    public $timestamps = true;
}