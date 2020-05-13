<?php


namespace App\Http\Middleware;


use App\Help\Utility;
use Closure;

class Store
{

    public function handle($request, Closure $next = null,$guard = null)
    {
        if (Utility::store()->check()){
            if (Utility::store()->user()->guard == 'store'){
                return $next($request);
            }else{
                return view('auth.login');
            }
        }else{
            return view('auth.login');
        }

    }
}