<?php

namespace App\Models;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use SoftDeletes;
    protected $table = 'countries';
    protected $guarded = ['id'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
     'iso_code', 'status', 'default_country', 'image','id'
    ];

    public function currency()
    {
        return $this->hasOne('App\Models\Currency');
    }

    public function products(){
        return $this->belongsToMany('App\Models\Product','product_price','country_id','product_id');
    }
    /**
     * Get the banners for the country.
    */
    public function banners()
    {
        return $this->hasMany('App\Models\Banner');
    }

    public function hasDescription()
    {
        return $this->hasMany('App\Models\CountryDescription', 'country_id');
    }

    function get_hasDescription(){
      // print_r($this->relations['PostMeta']);
      return $this->relations['hasDescription'];
    }

    public static function getOneById($id, $language_id)
    {
      $data = DB::table('countries')
            ->join('country_descriptions', 'countries.id', '=', 'country_descriptions.country_id')
            ->select('country_descriptions.name')
            ->where([
                    ['country_descriptions.country_id', '=', $id],
                    ['country_descriptions.language_id', '=', $language_id],
                    ['country_descriptions.deleted_at', '=', NULL],
                   ])
            ->first();
      return $data;
    }

    //get names by language
    public static function getByLanguage($language_id)
    {
        $countries = DB::table('countries')
            ->leftJoin('country_descriptions', 'countries.id', '=', 'country_descriptions.country_id')
            ->select('countries.*', 'country_descriptions.name')
            ->where([
                    ['countries.status', '=', 0],
                    ['country_descriptions.language_id', '=', $language_id],
                    ['countries.deleted_at', '=', NULL],
                   ])
            ->get();
        return $countries;
    }

    public static function getByCodeAndLanguage($countryCode, $languageCode)
    {
       // DB::enableQueryLog(); // Enable query log
        $country = DB::table('countries')
            ->join('country_descriptions', 'countries.id', '=', 'country_descriptions.country_id')
            ->join('country_languages', 'countries.id', '=', 'country_languages.country_id')
            ->join('languages', 'languages.id', '=', 'country_languages.language_id')
            ->select('countries.*', 'country_descriptions.name', 'country_languages.language_id', 'languages.code', 'languages.name as lang_name', 'languages.image as lang_image')
            ->where([
                    ['countries.iso_code', '=', $countryCode],
                    ['countries.status', '=', 0],
                    ['languages.code', '=', $languageCode],
                    ['countries.deleted_at', '=', NULL],
                    ['country_languages.deleted_at', '=', NULL],
                   ])
            ->first();
            // dd(DB::getQueryLog()); // Show results of log
        return $country;
    }

    public static function getByLanguageExcept($language_id, $country_id)
    {
        $countries = DB::table('countries')
            ->leftJoin('country_descriptions', 'countries.id', '=', 'country_descriptions.country_id')
            ->select('countries.*', 'country_descriptions.name')
            ->where([
                    ['countries.id', '<>', $country_id],
                    ['countries.status', '=', 0],
                    ['country_descriptions.language_id', '=', $language_id],
                    ['countries.deleted_at', '=', NULL],
                   ])
            ->get();
        return $countries;
    }

    public static function updateDefaultCountry($currentCountryId)
    {
      DB::table('countries')
      ->where('id','<>', $currentCountryId)
      ->update(['default_country' => 0]);
    }

    public static function getDefaultCountry()
    {
      $data = DB::table('countries')
            ->join('country_descriptions', 'countries.id', '=', 'country_descriptions.country_id')
            ->join('country_languages', 'countries.id', '=', 'country_languages.country_id')
            ->join('languages', 'languages.id', '=', 'country_languages.language_id')
            ->select('countries.*', 'country_descriptions.name', 'country_languages.language_id', 'languages.code', 'languages.name as lang_name', 'languages.image as lang_image')
            ->where([
                    ['countries.status', '=', 0],
                    ['countries.default_country', '=', 1],
                    ['countries.deleted_at', '=', NULL],
                    ['languages.default_language', '=', 1],
                    ['languages.deleted_at', '=', NULL],
                    ['country_descriptions.deleted_at', '=', NULL],
                    ['country_languages.deleted_at', '=', NULL],
                   ])
            ->first();

      return $data;
    }
}
