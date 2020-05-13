<?php


namespace App\Models\Settings;


use Illuminate\Database\Eloquent\Model;

class DesignOption extends  Model
{

    protected $table = 'design_options';
    protected $fillable = array('store_id','color', 'font','main_menu','home_page_display','navigation_path','show_all_button','display_charge_indicator');
    // 'main_menu' , ['classification_list' , 'custom_list']
    // 'home_page_display' , ['latest_product' , 'custom_design']
    public $timestamps = true;

}