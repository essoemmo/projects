<?php

namespace App\Http\Middleware;

use Closure;

class DemoCheck
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $storeId = \App\Bll\Utility::getStoreId();
//        dd($request->method(), $storeId);
        if ($storeId == \App\Bll\Utility::$demoId) {
            if ($request->method() == 'POST') {
                return redirect()->back()->with('success', _i('Added Successfully'));
            } elseif ($request->method() == 'PUT') {
                return redirect()->back()->with('success', _i('Updated Successfully'));
            } elseif ($request->method() == 'PATCH') {
                return redirect()->back()->with('success', _i('Updated Successfully'));
            } elseif ($request->method() == 'DELETE') {
                return redirect()->back()->with('success', _i('Deleted Successfully'));
            } else {
                return $next($request);
            }
        } else {
            return $next($request);
        }
    }
}
