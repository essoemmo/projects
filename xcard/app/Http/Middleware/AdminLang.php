<?php


namespace App\Http\Middleware;


use Closure;
use Xinax\LaravelGettext\Facades\LaravelGettext;

class AdminLang
{

    public function handle($request, Closure $next)
    {
//        app()->setLocale(lang());
//        dd(getLang());
        LaravelGettext::setLocale(app()->getLocale());
        return $next($request);
    }
}
