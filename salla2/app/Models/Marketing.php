<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Marketing extends Model
{

    protected $table = 'marketing';
    protected $fillable = [
        'name',
        'message',
        'url_item', // id of link according to type
        'type',  // 'type' => ['store','product','category','offers']
        'apply_all_conditions',
        'campaign_target',
        'campaign_target_value',
        'campaign_time',
        'campaign_date',
        'is_draft',
        'store_id',
    ];
    public $timestamps = true;
}