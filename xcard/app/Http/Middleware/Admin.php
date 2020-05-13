<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next = null,$guard = null)
    {
        if (admin()->check()){
            if (admin()->user()->guard == 'admin'){
                return $next($request);
            }else{
                return redirect()->route('AdminLogin');
            }
        }else{
            return redirect()->route('AdminLogin');
        }

    }
}
