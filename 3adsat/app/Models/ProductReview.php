<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
/**
 * @property int $id
 * @property int $product_id
 * @property string $author
 * @property string $review_text
 * @property int $rating
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property Product $product
 */
class ProductReview extends Model
{
    protected $guarded = ['id'];
    /**
     * @var array
     */
    protected $fillable = ['product_id', 'author', 'review_text', 'rating', 'status', 'date_added'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

}
