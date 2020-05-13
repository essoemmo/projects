<?php

namespace App\Models;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $product_option_id
 * @property int $product_id
 * @property int $option_id
 * @property int $option_value_id
 * @property int $quantity
 * @property int $subtract_stock
 * @property float $price
 * @property string $price_prefix
 * @property float $weight
 * @property string $weight_prefix
 * @property Option $option
 * @property OptionValue $optionValue
 * @property ProductOption $productOption
 * @property Product $product
 */
class ProductOptionValue extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    /**
     * @var array
     */
    protected $fillable = ['product_option_id', 'product_id', 'option_id', 'option_value_id', 'quantity', 'subtract_stock', 'price', 'price_prefix', 'weight', 'weight_prefix'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function option()
    {
        return $this->belongsTo('App\Models\Option');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function optionValue()
    {
        return $this->belongsTo('App\Models\OptionValue');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productOption()
    {
        return $this->belongsTo('App\Models\ProductOption');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public static function getOneById($id, $language_id)
    {   
      $option = DB::table('product_option_values')
            ->join('option_values', 'option_values.id', '=', 'product_option_values.option_value_id')
            ->join('option_value_descriptions', 'option_values.id', '=', 'option_value_descriptions.option_value_id')
            ->select('option_value_descriptions.name','product_option_values.*')
            ->where([
                    ['product_option_values.id', '=', $id],
                    ['option_value_descriptions.language_id', '=', $language_id],
                    ['option_value_descriptions.deleted_at', '=', NULL],
                   ])
            ->first();
      return $option;
    }
    
    public static function getByLanguageAndProductOptionId($product_option_id, $language_id)
    {        
                    // dd($product_option_id);

        $product_option_values = DB::table('product_option_values')
            ->join('product_options', 'product_options.id', '=', 'product_option_values.product_option_id')
            ->join('option_values', 'option_values.id', '=', 'product_option_values.option_value_id')
            ->join('option_value_descriptions', 'product_option_values.option_value_id', '=', 'option_value_descriptions.option_value_id')
            ->select('product_option_values.*', 'option_value_descriptions.name', 'option_values.image')
            ->where([
                    ['option_value_descriptions.language_id', '=', $language_id],
                    ['product_option_values.product_option_id', '=', $product_option_id],
                    ['product_option_values.deleted_at', '=', NULL],
                   ])
            ->get();


        // $product_option_values = DB::table('product_option_values')
        //     ->leftJoin('product_options', 'product_options.id', '=', 'product_option_values.product_option_id')
        //     ->leftJoin('option_values', 'option_values.option_id', '=', 'product_options.option_id')
        //     ->leftJoin('option_value_descriptions', 'option_values.id', '=', 'option_value_descriptions.option_value_id')
        //     ->select('product_option_values.*', 'option_value_descriptions.name')
        //     ->where([
        //             ['option_value_descriptions.language_id', '=', $language_id],
        //             ['product_option_values.product_option_id', '=', $product_option_id],
        //             ['option_value_descriptions.deleted_at', '=', NULL],
        //             ['product_option_values.deleted_at', '=', NULL],
        //             ['option_values.deleted_at', '=', NULL],
        //             ['product_options.deleted_at', '=', NULL],
        //            ])
        //     ->get();

        return $product_option_values;      
    }
}
