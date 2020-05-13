<?php


namespace App\Models\Settings;


use Illuminate\Database\Eloquent\Model;

class CustomDesign extends Model
{

    protected $table = 'custom_design_options';
    protected $fillable = array('store_id','option_type', 'code','value','additional_value','title','value_type','integer_value','icon');
    // 'option_type' , ['custom_list' ,'custom_design']
    public $timestamps = true;



}