<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class BannerImage extends Model
{
    protected $guarded = ['id'];
    /**
     * The attributes thatBannerImageTranslation are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'banner_id', 'link', 'image', 'sort_order', 'language_id', 'title'
    ];       

    public function banner()
    {
        return $this->belongsTo('App\Models\Banner');
    }

    // public static function getAllByBannerId($banner_id)
    // {               
    //      // DB::enableQueryLog();
    //     $rowTranslation = DB::table('banner_images')->join('banner_image_translations', 'banner_image_translations.banner_image_id', '=', 'banner_images.id')        
    //         ->select('banner_images.*', 'banner_image_translations.title', 'banner_image_translations.language_id', 'banner_image_translations.id as translation_id')
    //         ->where([
    //                 ['banner_images.deleted_at', '=', NULL],
    //                 ['banner_image_translations.deleted_at', '=', NULL],
    //                 ['banner_images.banner_id', '=', $banner_id],
    //                ])->get();
    //         // print_r(DB::getQueryLog());
    //     return $rowTranslation;
    // }

    public static function getAllByBannerId($banner_id)
    {               
        $rowTranslation = \App\Models\BannerImage::where([
                    ['deleted_at', '=', NULL],
                    ['banner_id', '=', $banner_id],
                   ])->get();
        return $rowTranslation;
    }

    public static function getOneByIdAndLanguage($banner_id, $language_id)
    {               
        $rowTranslation = \App\Models\BannerImage::select('title')->where('banner_id', '=', $banner_id)
                    ->where('language_id', '=', $language_id)
                    ->where('deleted_at', '=', NULL)->first();
        return $rowTranslation;
    }
}
