<?php

namespace App\Hr\Course;

use Illuminate\Database\Eloquent\Model;

class Bank_transfer extends Model 
{

    protected $table = 'bank_transfers';
    public $timestamps = true;
    protected $fillable = array('title', 'description','created_at' ,'lang_id');

}