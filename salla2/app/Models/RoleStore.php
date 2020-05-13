<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class RoleStore extends Model
{

    protected $table = 'role_store';
    protected $fillable = array('role_id', 'store_id');
    public $timestamps = true;


}