<?php

namespace App\Models;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name', 'code', 'image', 'sort_order', 'status', 'default_language'
    ];       

    public static function getEnabledLanguages()
    {        
        $languages = DB::table('languages')->where([
                                    ['status', '=', 0],
                                    ['deleted_at', '=', NULL],
                                ])->get();  
        return $languages;
    }

    public static function getDefaultByCountryCode($country_code)
    {        
       // DB::enableQueryLog(); // Enable query log
        $languages = DB::table('languages')
            ->join('country_languages', 'languages.id', '=', 'country_languages.language_id')
            ->join('countries', 'countries.id', '=', 'country_languages.country_id')
            ->select('languages.code')
            ->where([
                    ['languages.status', '=', 0],
                    ['languages.default_language', '=', 1],
                    ['countries.iso_code', '=', $country_code],
                    ['languages.deleted_at', '=', NULL],
                    ['country_languages.deleted_at', '=', NULL],
                   ])
            ->first();
            // dd(DB::getQueryLog()); // Show results of log
        return $languages;      
    }

    public static function getByCountryExcept($language_id, $country_id)
    {        

        $languages = DB::table('languages')
            ->join('country_languages', 'languages.id', '=', 'country_languages.language_id')
            ->join('countries', 'countries.id', '=', 'country_languages.country_id')
            ->select('languages.*')
            ->where([
                    ['country_languages.language_id', '<>', $language_id],
                    ['languages.status', '=', 0],
                    ['country_languages.country_id', '=', $country_id],
                    ['languages.deleted_at', '=', NULL],
                    ['country_languages.deleted_at', '=', NULL],
                   ])
            ->get();
        return $languages;      
    }
}
