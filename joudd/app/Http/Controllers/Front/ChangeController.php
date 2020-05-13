<?php

namespace App\Http\Controllers\Front;

use App\Models\Countries;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\URL;

class ChangeController extends Controller
{
    public function countries() {
        $countries = Countries::where('lang_id', getLang(session('lang')))->get();
        return response()->json($countries);
    }

    public function changeCountries(Request $request) {
        $country_id = $request->setCountries;
        $minutes = 525948;
        Cookie::queue(Cookie::make('country_id', $country_id, $minutes));
//        dd(Cookie::get('country_id'));
        return redirect(URL::previous());
    }

}
