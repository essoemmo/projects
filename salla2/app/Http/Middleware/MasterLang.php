<?php


namespace App\Http\Middleware;


use App\Help\Utility;
use Closure;
use Xinax\LaravelGettext\Facades\LaravelGettext;

class MasterLang
{

    public function handle($request, Closure $next)
    {
        //dd(LaravelGettext::getLocale());
        LaravelGettext::setLocale(Utility::MasterLang());
        return $next($request);
    }
}