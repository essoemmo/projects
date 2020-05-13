<?php

namespace App\Http\Middleware;

use Closure;
use Xinax\LaravelGettext\Facades\LaravelGettext;

class isSubDomain {

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
        if (\Config::get('app.env') !== "local") {
            $len = 2;
        }
        if (count($arr) > $len) {
            $sub = $arr[0];
         
            $store = \App\StoreData::where("domain", $sub)->first();
            if ($store != null) {
                session()->put(\App\Bll\Constants::StoreId, $store->id);
                //return redirect("/home");
//                $locale = "ar";
//                app()->setLocale($locale);
//                LaravelGettext::setLocale($locale);

                // set local language
//                $locale = $request->segment(1);
//                app()->setLocale($locale);
//                LaravelGettext::setLocale($locale);
               // $get_local = \Xinax\LaravelGettext\Facades\LaravelGettext::getLocale();

                return $next($request);
            } else {

                abort(404);
            }
        } else {

            abort(404);
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
