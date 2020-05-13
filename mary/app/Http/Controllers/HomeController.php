<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function logOut()
    {
        $guard_admin = 'Admin';
        if(\auth()->user()->guard == $guard_admin)
        {
            Auth::logout();
            return redirect('/admin/login');
        }else{
            Auth::logout();
            return redirect('/login');
        }

    }
}
