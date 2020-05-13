<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingCountryPhone extends Model
{
    protected $table = 'setting_country_phones';
    public $timestamps = true;
    protected $fillable = array(
        'setting_id',
        'country_id',
        'phone',
    );
}
