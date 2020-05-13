<?php

namespace App\Models;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PrAttribute extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'attribute_group_id', 'sort_order', 'status'
    ];

    public function attributeGroup()
    {
        return $this->belongsTo('App\Models\AttributeGroup', 'attribute_group_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productAttributes()
    {
        return $this->hasMany('App\Models\ProductAttribute');
    }


    public function hasDescription()
    {
        return $this->hasMany('App\Models\PrAttributeDescription', 'pr_attribute_id');
    }

    function get_hasDescription(){
      // print_r($this->relations['PostMeta']);
      return $this->relations['hasDescription'];
    }

    public static function translation($language_id)
    {
        return $this->hasMany('App\Models\AttributeDescription')
                ->where('language_id', '=', $language_id);
    }

    //get names by language
    public static function getByLanguage($language_id)
    {
        $attributes = DB::table('pr_attributes')
            ->leftJoin('pr_attribute_descriptions', 'pr_attributes.id', '=', 'pr_attribute_descriptions.pr_attribute_id')
            ->leftJoin('attribute_groups', 'pr_attributes.attribute_group_id', '=', 'attribute_groups.id')
            ->leftJoin('attribute_group_descriptions', 'attribute_groups.id', '=', 'attribute_group_descriptions.attribute_group_id')
            ->select('pr_attributes.*', 'pr_attribute_descriptions.name', 'attribute_group_descriptions.name as group_name')
            ->where([
                    ['pr_attributes.status', '=', 0],
                    ['pr_attribute_descriptions.language_id', '=', $language_id],
                    ['attribute_group_descriptions.language_id', '=', $language_id],
                    ['pr_attributes.deleted_at', '=', NULL],
                   ])
            ->get();

        return $attributes;
    }
}
