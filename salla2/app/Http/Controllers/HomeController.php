<?php

namespace App\Http\Controllers;

use App\Help\Utility;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('home');
    }

    public function logout()
    {
        //  dd(lang());
//        $guard_admin = Utility::Admin;
        Utility::store()->logout();
        Auth::logout();
        return redirect()->route('webLogin', app()->getLocale());
    }
}
