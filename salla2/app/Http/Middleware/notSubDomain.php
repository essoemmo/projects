<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class notSubDomain {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {//!Auth::guest()
       
        $arr = explode(".", request()->getHttpHost());
       $len = 1;
       //echo \Config::get('app.env');
       if(\Config::get('app.env')!=="local")
       {
           $len=2;
       }
        if (count($arr) > $len) {
           return redirect(config("app.url"));
        }
 
        return $next($request);
    }

}
