<?php

namespace App\Http\Middleware;

use Closure;

class Trainer
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
        if($request->user()->hasRole("trainer") && $request->user()->type == "trainer")
        {
            return $next($request);
        }
        return redirect('/');
    }
}
