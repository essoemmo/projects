<?php

namespace App\Http\Middleware;

use Closure;
use Xinax\LaravelGettext\Facades\LaravelGettext;

class lang
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
//        app()->setLocale(lang());
        LaravelGettext::setLocale(app()->getLocale());
        return $next($request);
    }
}
