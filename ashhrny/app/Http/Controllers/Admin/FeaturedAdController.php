<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\FeaturedAdDataTable;
use App\Models\FeaturedAd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeaturedAdController extends Controller
{
    public function index(FeaturedAdDataTable $featuredAdDataTable)
    {
        return $featuredAdDataTable->render('admin.featured_ads.index');
    }

    public function store(Request $request)
    {
        $featured_ad = FeaturedAd::create(['price' => $request->price, 'place' => $request->place]);
        return response()->json(true);
    }

    public function update(Request $request, $id)
    {
        $featured_ad = FeaturedAd::findOrFail($id);
        $featured_ad->place = $request->place;
        $featured_ad->price = $request->price;
        $featured_ad->save();
        return response()->json(true);
    }
}
