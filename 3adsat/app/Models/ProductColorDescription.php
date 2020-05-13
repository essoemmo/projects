<?php

namespace App\Models;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $product_color_id
 * @property int $language_id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Language $language
 * @property ProductColor $productColor
 */
class ProductColorDescription extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    /**
     * @var array
     */
    protected $fillable = ['product_color_id', 'language_id', 'name'];

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
    public function productColor()
    {
        return $this->belongsTo('App\Models\ProductColor');
    }

    public static function getAllById($product_color_id)
    {               
        $rowTranslation = \App\Models\ProductColorDescription::where([
                    ['deleted_at', '=', NULL],
                    ['product_color_id', '=', $product_color_id],
                   ])->get();
        return $rowTranslation;
    }
    
    public static function getOneByIdAndLanguage($product_color_id, $language_id)
    {               
        $rowTranslation = \App\Models\ProductColorDescription::select('name')->where('product_color_id', '=', $product_color_id)
                    ->where('language_id', '=', $language_id)
                    ->where('deleted_at', '=', NULL)->first();
        return $rowTranslation;
    }
}
