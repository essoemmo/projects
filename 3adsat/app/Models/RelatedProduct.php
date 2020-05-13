<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $product_id
 * @property int $related_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Product $product
// * @property Product $product
 */
class RelatedProduct extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    /**
     * @var array
     */
    protected $fillable = ['product_id', 'related_id', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public static function getByProductIdAndLanguage($product_id, $language_id)
    {
      $data = RelatedProduct::join('products', 'products.id', '=', 'related_products.related_id')
            ->join('product_descriptions', 'products.id', '=', 'product_descriptions.product_id')
              ->join('product_price', function ($join) {
                  $join->on('product_price.product_id', '=', 'products.id');
              })->groupBy('products.id')
            ->where([
                    ['related_products.product_id', '=', $product_id],
                    ['product_descriptions.language_id', '=', $language_id],
                    ['product_descriptions.deleted_at', '=', NULL],
                    ['products.status', '=', 0],
                    ['products.id', '!=', $product_id],
                   ])
             ->select('products.*','product_descriptions.name','product_price.price','product_price.discount')
             ->orderBy('products.sort_order', 'asc')
             ->get();

      return $data;
    }

}
