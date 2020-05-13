<?php

namespace App\Http\Middleware;

use Closure;

class Applicant
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
        if($request->user()->hasRole("registered-users") && $request->user()->type == "applicant")
        {
            return $next($request);
        }
        return redirect('/');
    }
}
