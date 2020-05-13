<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use DB;

/**
 * @property int $id
 * @property int $product_option_id
 * @property int $parent_option_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property ProductOption $productOption
 * @property ProductOption $productOption
 * @property ProductOptionParentValue[] $productOptionParentValues
 */
class ProductOptionParent extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    /**
     * @var array
     */
    protected $fillable = ['product_option_id', 'parent_option_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productOptionParent()
    {
        return $this->belongsTo('App\Models\ProductOption', 'parent_option_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productOptionChild()
    {
        return $this->belongsTo('App\Models\ProductOption', 'product_option_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productOption()
    {
        return $this->belongsTo('App\Models\ProductOption');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productOptionParentValues()
    {
        return $this->hasMany('App\Models\ProductOptionParentValue');
    }

    public static function getByLanguageAndProductOptionId($product_option_id, $language_id)
    {        
        $product_option_parents = DB::table('product_option_parents')
            ->join('product_options', 'product_options.id', '=', 'product_option_parents.product_option_id')
            ->join('options', 'product_options.option_id', '=', 'options.id')
            ->join('option_descriptions', 'options.id', '=', 'option_descriptions.option_id')
            ->select('product_option_parents.*', 'option_descriptions.name')
            ->where([
                    ['option_descriptions.language_id', '=', $language_id],
                    ['product_option_parents.product_option_id', '=', $product_option_id],
                    ['product_option_parents.deleted_at', '=', NULL],
                    ['option_descriptions.deleted_at', '=', NULL],
                   ])
            ->get();

        return $product_option_parents;      
    }

    public static function getByLanguageAndParentOptionId($parent_option_id, $language_id)
    {        
        $product_option_parents = DB::table('product_option_parents')
            ->join('product_options', 'product_options.id', '=', 'product_option_parents.product_option_id')
            ->join('options', 'product_options.option_id', '=', 'options.id')
            ->join('option_descriptions', 'options.id', '=', 'option_descriptions.option_id')
            ->select('product_option_parents.*', 'option_descriptions.name')
            ->where([
                    ['option_descriptions.language_id', '=', $language_id],
                    ['product_option_parents.parent_option_id', '=', $parent_option_id],
                    ['product_option_parents.deleted_at', '=', NULL],
                    ['option_descriptions.deleted_at', '=', NULL],
                   ])
            ->get();

        return $product_option_parents;      
    }

    public static function getByLanguageAndProductId($product_id, $language_id)
    {        
        $product_option_parents = DB::table('product_option_parents')
            ->join('product_options', 'product_options.id', '=', 'product_option_parents.product_option_id')
            ->join('options', 'product_options.option_id', '=', 'options.id')
            ->join('option_descriptions', 'options.id', '=', 'option_descriptions.option_id')
            ->select('product_option_parents.*', 'option_descriptions.name')
            ->where([
                    ['option_descriptions.language_id', '=', $language_id],
                    ['product_option_parents.product_id', '=', $product_id],
                    ['product_option_parents.deleted_at', '=', NULL],
                    ['option_descriptions.deleted_at', '=', NULL],
                   ])
            ->get();

        return $product_option_parents;      
    }
}
