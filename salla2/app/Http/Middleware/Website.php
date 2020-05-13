<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Website {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {//!Auth::guest()
        $arr = explode(".", request()->getHttpHost());
        if (count($arr) > 0) {
            $sub = $arr[0];
            // dd($sub);
            $store = \App\StoreData::where("domain", $sub)->first();
            if ($store != null) {
                session()->put(\App\Bll\Constants::StoreId, $store->id);
            } else {

                abort(404);
            }
        }

//        dd(auth()->check());
//        if(auth()->guest()){
//            return redirect('/user/login');
////            return redirect('/user/register');
//        }elseif(!auth()->guest()){
//            return redirect('/user/register');
////            return redirect('/user/login');
//        }else{
//            return $next($request);
//        }
//        dd(auth()->user()->id);
//        if ($request->user()->is_admin == 0) {
////            return redirect('/user/login');
//            return route('website');
//        }
        return $next($request);
    }

}
