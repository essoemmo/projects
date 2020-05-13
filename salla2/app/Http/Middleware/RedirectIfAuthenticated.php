<?php

namespace App\Http\Middleware;

use App\Models\product\stores;
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
//        if (Auth::guard($guard)->check()) {
////            if($request->session()->exists('StoreId') && $guard == 'store'){
////                return redirect('/adminpanel');
////            }elseif($guard == 'admin'){
////                return redirect('/adminpanel');
////            }else{
////                return redirect('/adminpanel/login');
////            }
//        }

        return $next($request);

    }
}
