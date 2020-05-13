<?php

namespace App\Http\Middleware;

use Closure;

class mentance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (settings()->mantance == '0'){
            return redirect()->route('maintance');
        }else{
            return $next($request);
        }
    }
}
