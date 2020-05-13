<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use DB;

/**
 * @property int $id
 * @property int $product_option_parent_id
 * @property int $product_option_value_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property ProductOptionParent $productOptionParent
 * @property ProductOptionValue $productOptionValue
 */
class ProductOptionParentValue extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    /**
     * @var array
     */
    protected $fillable = ['product_option_parent_id', 'product_option_value_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productOptionParent()
    {
        return $this->belongsTo('App\Models\ProductOptionParent');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productOptionValue()
    {
        return $this->belongsTo('App\Models\ProductOptionValue');
    }    

    public function getName($language_id) {
      $rowData = $this->getOneById($this->id, $language_id);
      return $rowData->name;
    }

    public static function getOneById($id, $language_id)
    {   
      $data = DB::table('product_option_parent_values')
            ->join('option_value_descriptions', 'product_option_parent_values.product_option_value_id', '=', 'option_value_descriptions.option_value_id')
            ->select('option_value_descriptions.name','product_option_parent_values.*')
            ->where([
                    ['product_option_parent_values.id', '=', $id],
                    ['option_value_descriptions.language_id', '=', $language_id],
                    ['option_value_descriptions.deleted_at', '=', NULL],
                   ])
            ->first();
      return $data;
    }

    public static function getByLanguageAndProductOptionParentId($product_option_parent_id, $language_id)
    {        
        $data = DB::table('product_option_parent_values')
            ->join('product_option_parents', 'product_option_parents.id', '=', 'product_option_parent_values.product_option_parent_id')
            ->join('product_option_values', 'product_option_parent_values.product_option_value_id', '=', 'product_option_values.id')
            ->join('option_value_descriptions', 'product_option_values.option_value_id', '=', 'option_value_descriptions.option_value_id')
            ->select('product_option_parent_values.*', 'option_value_descriptions.name')
            ->where([
                    ['option_value_descriptions.language_id', '=', $language_id],
                    ['product_option_parent_values.product_option_parent_id', '=', $product_option_parent_id],
                    ['product_option_parent_values.deleted_at', '=', NULL],
                    ['option_value_descriptions.deleted_at', '=', NULL],
                   ])
            ->get();
        return $data;      
    }

    public static function getProductOptionValues($product_option_id)
    {        
        $data = DB::table('product_option_parent_values')
            ->join('product_option_parents', 'product_option_parents.id', '=', 'product_option_parent_values.product_option_parent_id')
            ->select('product_option_parent_values.product_option_value_id')
            ->where([
                    ['product_option_parents.product_option_id', '=', $product_option_id],
                    ['product_option_parent_values.deleted_at', '=', NULL],
                   ])
            ->get();
        return $data;      
    }
}
