<?php

namespace App\Models;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CountryLanguage extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
     'country_id', 'language_id'
    ];  


    public static function getByLanguageAndId($country_code, $language_code)
    {        
       // DB::enableQueryLog(); // Enable query log
        $country = DB::table('country_languages')
            ->join('countries', 'countries.id', '=', 'country_languages.country_id')
            ->join('languages', 'languages.id', '=', 'country_languages.language_id')
            ->where([
                    ['countries.iso_code', '=', $country_code],
                    ['languages.code', '=', $language_code],
                    ['country_languages.deleted_at', '=', NULL],
                    ['languages.deleted_at', '=', NULL],
                   ])
            ->first();
            // dd(DB::getQueryLog()); // Show results of log
        return $country;      
    }
    
}
