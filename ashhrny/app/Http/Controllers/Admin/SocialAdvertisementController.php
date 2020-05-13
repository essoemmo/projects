<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SocialAdvertisementDataTable;
use App\Models\SocialAdvertisement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SocialAdvertisementController extends Controller
{
    public function index(SocialAdvertisementDataTable $socialAdvertisementDataTable) {
        return $socialAdvertisementDataTable->render('admin.social_advert.index');
    }

    public function store(Request $request)
    {
        $featured_ad = SocialAdvertisement::create(['price' => $request->price, 'type' => $request->type]);
        return response()->json(true);
    }

    public function update(Request $request, $id)
    {
        $featured_ad = SocialAdvertisement::findOrFail($id);
        $featured_ad->type = $request->type;
        $featured_ad->price = $request->price;
        $featured_ad->save();
        return response()->json(true);
    }
}
