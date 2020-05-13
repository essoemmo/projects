<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class StockStatusDescription extends Model
{
   // use SoftDeletes;
    protected $guarded = ['id'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'stock_status_id', 'language_id', 'name'
    ];  
  
    public function stockStatus()
    {
        return $this->belongsTo('App\Models\StockStatus', 'stock_status_id');
    }

    public static function getAllById($stock_status_id)
    {               
        $rowTranslation = \App\Models\StockStatusDescription::where([
                    ['deleted_at', '=', NULL],
                    ['stock_status_id', '=', $stock_status_id],
                   ])->get();
        return $rowTranslation;
    }

    public static function getOneByIdAndLanguage($stock_status_id, $language_id)
    {               
        $rowTranslation = \App\Models\StockStatusDescription::select('name')->where('stock_status_id', '=', $stock_status_id)
                    ->where('language_id', '=', $language_id)
                    ->where('deleted_at', '=', NULL)->first();
        return $rowTranslation;
    }
}
