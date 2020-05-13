<?php

namespace App\Models;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class OptionDescription extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    protected  $table ="option_data";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
//    	'option_id', 'language_id', 'name'
//    ];  
  
    public function option()
    {
        return $this->belongsTo('App\Models\Option', 'option_id');
    }

    public static function getAllById($option_id)
    {               
        $rowTranslation = \App\Models\OptionDescription::where([
                    ['deleted_at', '=', NULL],
                    ['option_id', '=', $option_id],
                   ])->get();
        return $rowTranslation;
    }

    public static function getOneByIdAndLanguage($option_id, $language_id)
    {               
        $rowTranslation = \App\Models\OptionDescription::select('name')->where('option_id', '=', $option_id)
                    ->where('language_id', '=', $language_id)
                    ->where('deleted_at', '=', NULL)->first();
        return $rowTranslation;
    }
}
