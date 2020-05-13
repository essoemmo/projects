<?php

namespace App\Http\Middleware;

use App\Help\Utility;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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
        if (Utility::admin()->check()){
            if (Utility::admin()->user()->guard == 'admin'){
                return $next($request);
            }else{
                //return redirect()->route('MasterLogin');
                return view('master.auth.login');
            }
        }else{
            //return redirect()->route('MasterLogin');
            return view('master.auth.login');
        }

    }
}
