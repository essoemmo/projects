<?php

namespace App\Models;

//use Carbon\Carbon;
//use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $product_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property string $image
 * @property string $color
 * @property int $sort_order
 * @property Product $product
 */
class ProductShowOptions extends Model
{
    public $timestamps = false;
//    use SoftDeletes;
    protected $guarded = ['id'];
    /**
     * @var array
     */
    protected $fillable = ['product_id', 'code',"value"];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    
}
