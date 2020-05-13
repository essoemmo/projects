<?php

namespace App\Models;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PrAttributeDescription extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'pr_attribute_id', 'language_id', 'name'
    ];  
  
    public function attribute()
    {
        return $this->belongsTo('App\Models\PrAttribute', 'pr_attribute_id');
    }

    public static function getAllById($pr_attribute_id)
    {               
        $rowTranslation = \App\Models\PrAttributeDescription::where([
                    ['deleted_at', '=', NULL],
                    ['pr_attribute_id', '=', $pr_attribute_id],
                   ])->get();
        return $rowTranslation;
    }

    public static function getOneByIdAndLanguage($pr_attribute_id, $language_id)
    {               
        $rowTranslation = \App\Models\PrAttributeDescription::select('name')->where('pr_attribute_id', '=', $pr_attribute_id)
                    ->where('language_id', '=', $language_id)
                    ->where('deleted_at', '=', NULL)->first();
        return $rowTranslation;
    }

}
