<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class SmsReservation extends Model
{
    protected $table = 'sms_reservations';
    protected $fillable = [
        'sender_name',
        'sender_ad_name',
        'company_name',
        'commercial_register',
        'store_owner_name',
        'store_title',
        'store_id',
        'general_name',
        'ad_name',
        'commercial_register_file',
        'status',
    ];

    public function store()
    {
        return $this->hasOne('App\Store', 'id', 'store_id');
    }
}
