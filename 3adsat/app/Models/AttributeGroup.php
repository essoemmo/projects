<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Scope;
use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class AttributeGroup extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'sort_order', 'status'
    ];

    public function attributes()
    {
        return $this->hasMany('App\Models\Attribute');
    }

    public function hasDescription()
    {
        return $this->hasMany('App\Models\AttributeGroupDescription', 'attribute_group_id');
    }

    public function translation($language_id)
    {
        return $this->hasMany('App\Models\AttributeGroupDescription')
                ->where('language_id', '=', $language_id);
    }

    //get names by language
    public static function getByLanguage($language_id)
    {
        $attributeGroups = DB::table('attribute_groups')
            ->join('attribute_group_descriptions', 'attribute_groups.id', '=', 'attribute_group_descriptions.attribute_group_id')
            ->select('attribute_groups.*', 'attribute_group_descriptions.name')
            ->where([
                    ['attribute_groups.status', '=', 0],
                    ['attribute_group_descriptions.language_id', '=', $language_id],
                    ['attribute_groups.deleted_at', '=', NULL],
                   ])
            ->get();

        return $attributeGroups;
    }

    public static function getByProductIdAndLanguage($product_id, $language_id)
    {
        $attributeGroups = AttributeGroup::join('attribute_group_descriptions', 'attribute_groups.id', '=', 'attribute_group_descriptions.attribute_group_id')
            ->join('pr_attributes', 'attribute_groups.id', '=', 'pr_attributes.attribute_group_id')
            ->join('product_attributes', 'pr_attributes.id', '=', 'product_attributes.pr_attribute_id')
            ->select('attribute_groups.*', 'attribute_group_descriptions.name')
            ->where([
                    ['attribute_groups.status', '=', 0],
                    ['pr_attributes.status', '=', 0],
                    ['attribute_group_descriptions.language_id', '=', $language_id],
                    ['pr_attributes.deleted_at', '=', NULL],
                    ['product_attributes.product_id', '=', $product_id],
                    ['product_attributes.deleted_at', '=', NULL],
                   ])
            ->distinct('attribute_groups.id')
            ->orderBy('attribute_groups.sort_order', 'asc')
            ->get();
        return $attributeGroups;
    }
}
