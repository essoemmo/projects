<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $product_id
 * @property int $language_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property string $name
 * @property string $description
 * @property string $tag
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keyword
 * @property Language $language
 * @property Product $product
 */
class ProductDescription extends Model
{
   // use SoftDeletes;
    protected $guarded = ['id'];
    /**
     * @var array
     */
    protected $fillable = ['product_id', 'language_id', 'created_at', 'updated_at', 'deleted_at', 'name', 'description', 'tag', 'meta_title', 'meta_description', 'meta_keyword'];

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
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public static function getAllById($product_id)
    {               
        $rowTranslation = \App\Models\ProductDescription::where([
                    ['deleted_at', '=', NULL],
                    ['product_id', '=', $product_id],
                   ])->get();
        return $rowTranslation;
    }

    public static function getOneByIdAndLanguage($product_id, $language_id)
    {               
        $rowTranslation = \App\Models\ProductDescription::select('name')->where('product_id', '=', $product_id)
                    ->where('language_id', '=', $language_id)
                    ->where('deleted_at', '=', NULL)->first();
        return $rowTranslation;
    }
}
