<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;
use Illuminate\Database\Eloquent\Model;
use DB;

class Option extends Model {

    use SoftDeletes;
//    use HasRecursiveRelationships;

    protected $guarded = ['id'];


//    protected $fillable = [
//    	'type', 'parent_id', 'sort_order'
//    ];

    public function hasDescription() {
        return $this->hasMany('App\Models\OptionData', 'option_id');
    }

    function get_hasDescription() {
        return $this->relations['hasDescription'];
    }

    public function prices() {
        return $this->hasMany('App\Models\OptionPrice', 'option_id');
    }

    public static function getOneById($id, $language_id) {
        $option = DB::table('options')
                ->join('option_data', 'options.id', '=', 'option_data.option_id')
                ->select('option_data.*', 'options.*')
                ->where([
                    ['option_data.option_id', '=', $id],
                    ['option_data.language_id', '=', $language_id],
                    ['option_data.deleted_at', '=', NULL],
                ])
                ->first();
        return $option;
    }

    //get names by language
    public static function getByLanguage($language_id) {
        $options = DB::table('options')
                ->leftJoin('option_data', 'options.id', '=', 'option_data.option_id')
                ->select('options.*', 'option_data.*')
                ->where([
                    ['option_data.language_id', '=', $language_id],
                    ['options.deleted_at', '=', NULL],
                ])
                ->get();

        return $options;
    }

    private static function getByType($language_id, $country_id, $type) {
        $builder = DB::table('options')
                ->leftJoin('option_data', 'options.id', '=', 'option_data.option_id')
                ->leftJoin('option_price', 'options.id', '=', 'option_price.option_id')
                ->leftJoin('countries', 'option_price.country_id', '=', 'countries.id')
                ->leftJoin('currencies', 'countries.currency_id', '=', 'currencies.id')
                ->select('options.*', 'option_data.*', "option_price.price", "currencies.name as currency")
                ->where([
            ['option_data.language_id', '=', $language_id],
            //   ['options.deleted_at', '=', NULL],
            ["type", "=", "lenses"],
            //  ["currencies.language_id", "=", $language_id],
            //   ["currencies.language_id", "=", $language_id],
            ["country_id", "=", $country_id]
        ]);
//        echo $builder->toSql().$language_id."-".$country_id;
        $options = $builder->get();
        return $options;
    }

    public static function getLenses($language_id, $country_id) {

        $options = self::getByType($language_id, $country_id, "lenses");
//        dd($options);
        return $options;
    }

    public static function getTint($language_id, $country_id) {
        $options = $options = self::getByType($language_id, $country_id, "tint");

        return $options;
    }

    public static function getCoating($language_id, $country_id) {
        $options = $options = self::getByType($language_id, $country_id, "coating");
        if (count($options) > 0)
            return $options[0];
        return null;
    }

}
