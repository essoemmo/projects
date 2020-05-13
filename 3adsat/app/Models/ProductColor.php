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
 * @property string $image
 * @property string $color
 * @property int $sort_order
 * @property Product $product
 */
class ProductColor extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    /**
     * @var array
     */
    protected $fillable = ['product_id', 'image', 'color', 'sort_order'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productColorDescriptions()
    {
        return $this->hasMany('App\Models\ProductColorDescription');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Description($languageId)
    {
        return $this->hasMany('App\Models\ProductColorDescription')->where("product_color_descriptions.language_id","=", $languageId)->first();
    }

    public static function getOneById($id, $language_id)
    {   
      $option = \Illuminate\Support\Facades\DB::table('product_colors')
            ->join('product_color_descriptions', 'product_colors.id', '=', 'product_color_descriptions.product_color_id')
            ->select('product_color_descriptions.name','product_colors.*')
            ->where([
                    ['product_color_descriptions.product_color_id', '=', $id],
                    ['product_color_descriptions.language_id', '=', $language_id],
                    ['product_color_descriptions.deleted_at', '=', NULL],
                   ])
            ->first();
      return $option;
    }

    //get names by language
    public static function getByLanguage($language_id)
    {  
        $product_colors = DB::table('product_colors')
            ->leftJoin('product_color_descriptions', 'product_colors.id', '=', 'product_color_descriptions.product_color_id')
            ->select('product_colors.*', 'product_color_descriptions.name')
            ->where([
                    ['product_color_descriptions.language_id', '=', $language_id],
                    ['product_colors.deleted_at', '=', NULL],
                    ['product_color_descriptions.deleted_at', '=', NULL],
                   ])
            ->get();

        return $product_colors;      
    }
}
