<?php

namespace App\Http\Middleware;

use App\Bll\Utility;
use Closure;

class StoreMaintenance
{

    public function handle($request, Closure $next)
    {
        $setting = Utility::getStoreSettigs();
        if ($setting->maintenance == 1) {
            return redirect()->route('storeMaintenance');
        } else {
            return $next($request);
        }
    }
}
