<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CountryDescription extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
     'name', 'country_id', 'language_id'
    ];  

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }

    public static function getAllById($country_id)
    {               
        $rowTranslation = \App\Models\CountryDescription::where([
                    ['deleted_at', '=', NULL],
                    ['country_id', '=', $country_id],
                   ])->get();
        return $rowTranslation;
    }

    public static function getOneByIdAndLanguage($country_id, $language_id)
    {               
        $rowTranslation = \App\Models\CountryDescription::select('name')->where('country_id', '=', $country_id)
                    ->where('language_id', '=', $language_id)
                    ->where('deleted_at', '=', NULL)->first();
        return $rowTranslation;
    }
}
