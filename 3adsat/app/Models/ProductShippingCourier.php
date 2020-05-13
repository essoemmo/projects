<?php

namespace App\Models;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $shipping_courier_id
 * @property int $product_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property float $cost
 * @property Product $product
 * @property ShippingCourier $shippingCourier
 */
class ProductShippingCourier extends Model
{
//    use SoftDeletes;
    /**
     * @var array
     */
    protected $fillable = ['shipping_courier_id', 'product_id', 'cost','country_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shippingCourier()
    {
        return $this->belongsTo('App\Models\ShippingCourier');
    }

    public static function getAllByProductId($product_id)
    {
        $shipping_couriers = DB::table('shipping_couriers')
            ->leftJoin('product_shipping_couriers', 'shipping_couriers.id', '=', 'product_shipping_couriers.shipping_courier_id')
            ->select('shipping_couriers.*', 'product_shipping_couriers.id as product_shipping_courier_id', 'product_shipping_couriers.shipping_courier_id', 'product_shipping_couriers.cost','product_shipping_couriers.country_id')
            ->where([
                    ['product_shipping_couriers.product_id', '=', $product_id],
                    ['shipping_couriers.deleted_at', '=', NULL],
                   ])
            ->get();
        return $shipping_couriers;
    }
}
