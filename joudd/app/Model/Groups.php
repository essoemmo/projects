<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{

    protected $table = 'groups';
    protected $fillable = ['title' , 'description'];
    public $timestamps = true;
}