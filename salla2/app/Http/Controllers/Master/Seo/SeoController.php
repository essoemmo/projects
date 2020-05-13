<?php

namespace App\Http\Controllers\Master\Seo;

use App\Bll\Utility;
use App\Http\Controllers\Controller;
use App\Models\Seo\Seo;
use App\Models\Seo\SeoTranslation;
use App\Models\Settings\Setting;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function index()
    {
        return view('master.seo.index');
    }

    public function store(Request $request)
    {
        $setting = Setting::findOrFail($request->item_id);
        $seo = Seo::where('itemable_id', $setting->id)->where('itemable_type', get_class($setting))->first();
        if ($seo == null) {
            $seo = Seo::create([
                'itemable_id' => $setting->id,
                'itemable_type' => get_class($setting),
            ]);

            SeoTranslation::create([
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'seo_id' => $seo->id,
                'lang_id' => getLang(Utility::lang()),
            ]);
        } else {
            $seo->update([
                'itemable_id' => $setting->id,
                'itemable_type' => get_class($setting),
            ]);

            SeoTranslation::where('seo_id', $seo->id)->update([
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'seo_id' => $seo->id,
                'lang_id' => getLang(Utility::lang()),
            ]);
        }
        return redirect()->back()->with('success', _i('Added Successfully !'));
    }
}
