<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Xinax\LaravelGettext\Facades\LaravelGettext;

class LangController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Language-Add'])->only('getLangs');
        $this->middleware(['permission:Language-Edit'])->only('changeLang');
//        $this->middleware(['permission:Membership-Delete'])->only('delete');
    }

    public function getLangs()
    {
        $getLangs = Language::all();
        return response()->json($getLangs);
    }

    public function changeLang($locale=null)
    {
        if(request()->selLanguage != null)
        {
            $locale = request()->selLanguage;
        }
        $language = \App\Models\Language::where('name',$locale)->first();
//        dd($locale,$language->id);
        Request()->session()->put('language', $language->id);
//        LaravelGettext::setLocale($language->name);
        LaravelGettext::setLocale($language->code);

        return Redirect::to(URL::previous());

    }
    public function language($code) {
        $language = \App\Models\Language::where('code',$code)->first();
        Request()->session()->put('language', $language['id']);
        return back();
    }
}
