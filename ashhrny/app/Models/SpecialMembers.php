<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SpecialMembers extends Model
{

    protected $table = "special_members";
    protected $fillable = ['user_id' , 'sort' ,'publish'];
    public $timestamps = true ;
}