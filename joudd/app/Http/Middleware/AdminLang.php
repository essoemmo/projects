<?php


namespace App\Http\Middleware;


use Closure;
use Xinax\LaravelGettext\Facades\LaravelGettext;

class AdminLang
{

    public function handle($request, Closure $next)
    {
//        app()->setLocale(lang());
        LaravelGettext::setLocale(adminLang());
        return $next($request);
    }
}