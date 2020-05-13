<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $table ="messages";
    protected $fillable = ['from_id' ,'to_id' ,'message' ,'message_id' ,'read_at'];
    public $timestamps = true;
}