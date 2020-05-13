<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class FooterTranslation extends Model
{
    protected $table = "footer_translations";
    protected $fillable = ['footer_id','title','locale'];
    public $timestamps;

}