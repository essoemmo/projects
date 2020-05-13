<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $product_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property float $price
 * @property string $date_start
 * @property string $date_end
 * @property Product $product
 */
class ProductDiscount extends Model
{
//    use SoftDeletes;
    protected $guarded = ['id'];
    /**
     * @var array
     */
    protected $fillable = ['product_id', 'created_at', 'updated_at', 'deleted_at', 'price', 'date_start', 'date_end', 'priority'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
    public static function getDiscountedPrice($product_id)
    {
        $currentDate = date("Y-m-d");
        $productDiscount = ProductDiscount::whereDate('product_discounts.date_start', '<=', $currentDate)
                            ->whereDate('product_discounts.date_end', '>=', $currentDate)
                            ->where('product_discounts.product_id', '=', $product_id)
                            ->orderBy('product_discounts.priority', 'asc')
                            ->first();
        return $productDiscount;
    }
}
