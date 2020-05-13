<?php


namespace App\Models\Admin;


use Illuminate\Database\Eloquent\Model;

class EducationLevel extends Model
{

    protected $table = "education_levels";
    protected $fillable = ['title' ,'country_id' ,'lang_id', 'source_id' ,'description'];
    public $timestamps = true;

}