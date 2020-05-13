<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserTemplate extends Model
{

    protected $table = 'user_template';
    protected $fillable = ['user_id', 'template_id'  ];
}