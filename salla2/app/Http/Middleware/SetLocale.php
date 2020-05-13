<?php

namespace App\Http\Middleware;

use Closure;
use Xinax\LaravelGettext\Facades\LaravelGettext;

class SetLocale
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

//        $locale = $request->segment(1);
//        $lang = app()->getLocale();
//        if ($locale != $lang) {
//
//            //Remove .php from the request url
//            $url = str_replace($locale, $lang, $request->url());
//
//            foreach ($request->input() as $key => $value) {
//
//                $url .= "/{$key}/{$value}";
//            }
//
//            return redirect($url);
//        }
//
//        return $next($request);

        $locale = $request->segment(1);
        app()->setLocale($locale);
        LaravelGettext::setLocale($locale);
        //$get_local = \Xinax\LaravelGettext\Facades\LaravelGettext::getLocale();
        return $next($request);


    }
}
