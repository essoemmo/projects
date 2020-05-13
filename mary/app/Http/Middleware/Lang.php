<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Xinax\LaravelGettext\Facades\LaravelGettext;

class Lang
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
        if (!request()->ajax()) {

            if (!empty($request->selLanguage)) {
                $language = Language::where('name', $request->selLanguage)->first();
                session(['language' => $language->id]);
                LaravelGettext::setLocale($language->code);
            } else if ($request->selLanguage == null && session('language')==null) {
                $language = Language::where('code', 'en')->first();
                session(['language' => $language->id]);
                LaravelGettext::setLocale($language->code);
            }
        }
        else if(session('language')==null){
            $language = Language::where('name', 'en')->first();
            session(['language' => $language->id]);
            LaravelGettext::setLocale($language->code);
        }

        if($request->is('*admin*')){
            LaravelGettext::setDomain('back');
        }
        else{
            LaravelGettext::setDomain('front');
        }
        //dd(session());
        return $next($request);
    }
}
