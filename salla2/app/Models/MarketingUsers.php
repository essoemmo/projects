<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class MarketingUsers extends Model
{
    protected $table = 'marketing_users';
    protected $fillable = [
        'marketing_id',
        'code',
        'value',
        'store_id'
    ];
    public $timestamps = true;
}