<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Bll\Utility;
use App\Http\Controllers\Controller;
use App\Models\product\products;
use App\Models\Seo\Seo;
use App\Models\Seo\SeoTranslation;
use App\Models\Settings\Setting;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function StoreSeo()
    {
        return view('admin.settings.seo.index');
    }

    public function settingStore(Request $request)
    {
        $setting = Setting::findOrFail($request->item_id);
        $seo = Seo::where('itemable_id', $setting->id)->where('itemable_type', get_class($setting))->first();
        if ($seo == null) {
            $seo = Seo::create([
                'itemable_id' => $setting->id,
                'itemable_type' => get_class($setting),
                'store_id' => session()->get('StoreId'),
            ]);

            SeoTranslation::create([
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'seo_id' => $seo->id,
                'lang_id' => getLang(session('adminlang')),
            ]);
        } else {
            $seo->update([
                'itemable_id' => $setting->id,
                'itemable_type' => get_class($setting),
                'store_id' => session()->get('StoreId'),
            ]);

            SeoTranslation::where('seo_id', $seo->id)->update([
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'seo_id' => $seo->id,
                'lang_id' => getLang(session('adminlang')),
            ]);
        }
        return redirect()->back()->with('success', _i('Added Successfully !'));
    }

    public function getProductSeo(Request $request)
    {
        $product = products::findOrFail($request->id);

        $productSeo = Utility::storeSeo(session()->get('StoreId'), $product->id, get_class($product));

        if ($productSeo != null) {
            return response()->json(['data' => $productSeo, 'status' => 'success']);
        } else {
            return response()->json(['data' => null, 'status' => 'error']);
        }
    }

    public function productStore(Request $request)
    {
        $product = products::findOrFail($request->item_id);
        $seo = Seo::where('itemable_id', $product->id)->where('itemable_type', get_class($product))->first();
        if ($seo == null) {
            $seo = Seo::create([
                'itemable_id' => $product->id,
                'itemable_type' => get_class($product),
                'store_id' => session()->get('StoreId'),
            ]);

            SeoTranslation::create([
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'seo_id' => $seo->id,
                'lang_id' => getLang(session('adminlang')),
            ]);
        } else {
            $seo->update([
                'itemable_id' => $product->id,
                'itemable_type' => get_class($product),
                'store_id' => session()->get('StoreId'),
            ]);

            SeoTranslation::where('seo_id', $seo->id)->update([
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'seo_id' => $seo->id,
                'lang_id' => getLang(session('adminlang')),
            ]);
        }
        return response()->json('success');
    }
}
