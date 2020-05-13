<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class UsersGroup extends Model
{
    protected $table = 'user_groups';
    protected $fillable = ['group_id' , 'user_id'];
    public $timestamps = true;

}