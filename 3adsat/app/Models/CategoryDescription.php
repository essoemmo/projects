<?php

namespace App\Models;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CategoryDescription extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'category_id', 'language_id', 'name', 'description', 'meta_title', 'meta_description', 'meta_keyword'
    ];  
  
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function language()
    {
        return $this->belongsTo('App\Models\Language');
    }


    public static function getAllById($category_id)
    {               
        $rowTranslation = \App\Models\CategoryDescription::where([
                    ['deleted_at', '=', NULL],
                    ['category_id', '=', $category_id],
                   ])->get();
        return $rowTranslation;
    }

    public static function getOneByIdAndLanguage($category_id, $language_id)
    {

        $rowTranslation = \App\Models\CategoryDescription::select('name')->where('category_id', '=', $category_id)
                    ->where('language_id', '=', $language_id)
                    ->where('deleted_at', '=', NULL)->first();
        return $rowTranslation;
    }
}
