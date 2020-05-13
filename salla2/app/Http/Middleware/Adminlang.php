<?php

namespace App\Http\Middleware;

use Closure;
use Xinax\LaravelGettext\Facades\LaravelGettext;

class Adminlang
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
        LaravelGettext::setlocale(adminlang());
        return $next($request);
    }
}
