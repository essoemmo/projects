<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\URL;

class ChangeController extends Controller
{

    public function changeCountry(Request $request) {
        $country_id = $request->country;
        $minutes = 525948;
        Cookie::queue(Cookie::make('country_id', $country_id, $minutes));
        return \response()->json(true);
    }

}
