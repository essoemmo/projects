<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class notLoggedIn {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {//!Auth::guest()
     
      if(auth()->guard(\App\Help\Utility::Store)->user()==null|| \App\Bll\Utility::IsDemoStore())
      {
        
         return $next($request);
      }
    
      abort(401);
      
    }

}
