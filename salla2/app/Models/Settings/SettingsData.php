<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class SettingsData extends Model
{
    protected $table = "settings_data";
    protected $fillable = ['setting_id', 'lang_id', 'source_id', 'title', 'description', 'maintenance_title', 'maintenance_message'];
    public $timestamps = true;
}
