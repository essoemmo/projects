<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class RatingTranslation extends Model
{
    protected $table = "ratings_translations";
    protected $fillable = ['title','locale','rating_id'];
    public $timestamps = true;

}