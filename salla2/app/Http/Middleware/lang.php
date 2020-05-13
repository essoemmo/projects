<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Ratchet\App;
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

        $locale=$request->segment(1) ;
        if (Cookie::get('lang') != null) {
            app()->setLocale(Cookie::get('lang'));
        }
        else {
            app()->setLocale($locale);
        }
        return $next($request);



//        $locale=$request->segment(1) ;
//        app()->setLocale($locale);
//        LaravelGettext::setLocale($locale);
//        return $next($request);
    }
}
