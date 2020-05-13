<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{

    protected $table = 'orders';
    protected $fillable = [
        'user_id',
    ];
    public $timestamps = true;
}