<?php

namespace App\Http\Controllers\web\store;

use App\Models\product\feature_option_data;
use App\Models\product\feature_options;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckController extends Controller
{
    public function checkFeaturesOption(Request $request) {
        if($request->option_id != 0) {
            $feature_option = feature_options::findOrFail($request->option_id);
            if($feature_option->count == 1) {
                return response()->json(false);
            } else {
                return response()->json(true);
            }
        } else {
            return response()->json(true);
        }
    }
}
