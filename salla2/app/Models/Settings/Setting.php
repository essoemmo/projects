<?php


namespace App\Models\Settings;


use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('store_id', 'script_id', 'chatscript', 'email', 'logo', 'facebook_url', 'instagram_url', 'twitter_url', 'phone1', 'phone2', 'work_time', 'address','template_id', 'show_all_button', 'maintenance','tax_on_shipping','tax_on_product','taxnumb');
}
