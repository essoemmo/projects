<?php

namespace App\Models;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $product_id
 * @property int $pr_attribute_id
 * @property int $language_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property string $text
 * @property Language $language
 * @property PrAttribute $prAttribute
 * @property Product $product
 */
class ProductAttribute extends Model
{
 //   use SoftDeletes;
    protected $guarded = ['id'];
    /**
     * @var array
     */
    protected $fillable = ['product_id', 'pr_attribute_id', 'language_id', 'created_at', 'updated_at', 'deleted_at', 'text'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language()
    {
        return $this->belongsTo('App\Models\Language');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prAttribute()
    {
        return $this->belongsTo('App\Models\PrAttribute');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public static function getAllGroupBy($product_id)
    {       
        $productAttributes = DB::table('product_attributes')
                ->groupBy('pr_attribute_id', 'product_id')
                ->having('product_id', '=', $product_id)
                ->where('deleted_at', '=', NULL)
                ->get();

        // DB::table('product_attributes')
        //     ->select('pr_attribute_id', 'product_id')            
        //     ->groupBy('pr_attribute_id', 'product_id')
        //     ->where([
        //             ['product_attributes.product_id', '=', $product_id],
        //             ['product_attributes.deleted_at', '=', NULL],
        //            ])
        //     ->get();

        return $productAttributes;    
    }

    public static function getByProductIdAndLanguage($product_id, $language_id)
    {        
        $attributes = ProductAttribute::join('pr_attributes', 'pr_attributes.id', '=', 'product_attributes.pr_attribute_id')
            ->join('pr_attribute_descriptions', 'pr_attributes.id', '=', 'pr_attribute_descriptions.pr_attribute_id')
            ->select('pr_attribute_descriptions.name as attribute_name', 'product_attributes.*')
            ->where([
                    ['pr_attributes.status', '=', 0],
                    ['product_attributes.product_id', '=', $product_id],
                    ['pr_attribute_descriptions.language_id', '=', $language_id],
                    ['product_attributes.language_id', '=', $language_id],
                    ['pr_attributes.deleted_at', '=', NULL],
                   ])
            ->orderBy('pr_attributes.sort_order', 'asc')
            ->get();

        return $attributes;      
    }
}