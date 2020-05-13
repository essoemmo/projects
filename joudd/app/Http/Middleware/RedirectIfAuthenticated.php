<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
//        if (Auth::guard($guard)->check() && $request->user()->is_admin === 1) {
//            return redirect('/home');
//        } elseif(Auth::guard($guard)->check() && $request->user()->type == "trainer"){
//            return redirect('/');
//        }elseif (Auth::guard($guard)->check() && $request->user()->type == "applicant"){
//            return redirect('/');
//        }
//
//        return $next($request);

        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }

        return $next($request);
    }
}
