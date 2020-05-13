<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Bll\Utility;
use App\Http\Controllers\Controller;
use App\Models\Settings\Setting;
use App\Models\Settings\SettingsData;
use App\Models\settings\StoreOption;
use Illuminate\Http\Request;

class StoreOptionController extends Controller
{
    public function index()
    {
        $setting = Utility::getStoreSettigs();
        $storeOptions = StoreOption::where('store_id', $setting->stores_id)->first();
        if ($storeOptions == null) {
            $storeOptions = StoreOption::create([
                'store_id' => $setting->stores_id
            ]);
        }
        return view('admin.settings.storeOptions.index', compact('setting', 'storeOptions'));
    }

    public function storeMaintenance(Request $request, $id)
    {
        $this->validate($request, [
            'maintenance' => ['sometimes'],
            'maintenance_message' => ['sometimes', 'string', 'min:3', 'max:200'],
            'maintenance_title' => ['sometimes', 'string', 'min:3', 'max:50'],
        ]);

        $setting = Setting::findOrFail($id);
        $setting_data = SettingsData::where('setting_id', $setting->id)->where('source_id', null)->first();

        if ($request->maintenance == 'on') {
            $maintenance = 1;
        } else {
            $maintenance = 0;
        }

        $setting->update([
            'maintenance' => $maintenance,
        ]);

        $setting_data->update([
            'maintenance_title' => $request->maintenance_title,
            'maintenance_message' => $request->maintenance_message,
        ]);

        return redirect()->back()->with('success', _i('Update Successfully !'));

    }

    public function storeOptions(Request $request, $id)
    {
        $storeOptions = StoreOption::findOrfail($id);

        if ($request->order_accept == 'on') {
            $order_accept = 1;
        } else {
            $order_accept = 0;
        }

        if ($request->product_rating == 'on') {
            $product_rating = 1;
        } else {
            $product_rating = 0;
        }

        if ($request->product_outStock == 'on') {
            $product_outStock = 1;
        } else {
            $product_outStock = 0;
        }

        if ($request->discount_codes == 'on') {
            $discount_codes = 1;
        } else {
            $discount_codes = 0;
        }

        if ($request->product_purchases_count == 'on') {
            $product_purchases_count = 1;
        } else {
            $product_purchases_count = 0;
        }

        if ($request->similar_products == 'on') {
            $similar_products = 1;
        } else {
            $similar_products = 0;
        }

        $storeOptions->update([
            'order_accept' => $order_accept,
            'product_rating' => $product_rating,
            'product_outStock' => $product_outStock,
            'discount_codes' => $discount_codes,
            'product_purchases_count' => $product_purchases_count,
            'similar_products' => $similar_products,
        ]);

        return redirect()->back()->with('success', _i('Update Successfully !'));
    }
}
