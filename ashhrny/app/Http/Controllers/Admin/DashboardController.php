<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Models\Bank;
use App\Models\blog;
use App\Models\ContentSection;
use App\Models\NewsLetter;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Rating;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use phpDocumentor\Reflection\DocBlock\Tags\Author;
use Xinax\LaravelGettext\Facades\LaravelGettext;

class DashboardController extends Controller
{
    public function home() {

           if (!\admin()->check()){
               return view('admin.layout.login');
           }else{


//               $blogs = blog::count();
//               $content_sections = ContentSection::count();
//               $newsletter = NewsLetter::count();
//               $admins = User::where('guard' , "admin")->get()->count();
//               $products = Product::count();
//               $product_cats = ProductCategory::count();
//               $orders = Order::count();
//               $banks = Bank::count();
//               $ratings = Rating::count();
               return view('admin.home');
//               return view('admin.home' , compact('blogs' ,'content_sections' ,'newsletter','admins','products','product_cats','orders','banks','ratings'));

           }
    }

    public function lang($lang) {
        session()->has('adminLang') ? session()->forget('adminLang') : '';
        session()->put('adminLang', $lang);
        return redirect()->back();
    }

    public function editProfile()
    {
        $user = admin()->user();
        return view('admin.profile' , compact('user'));
    }


    public function updateProfile(Request $request )
    {
        $id = admin()->user()->id;
        $user = Admin::findOrFail($id);
        $rules = [
            'first_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            //'password' => ['sometimes', 'confirmed'],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {


            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->mobile = $request->input('mobile');

            $user->save();

            return redirect()->back()->with( 'success',_i('Updated Successfully !'));

        }
    }



}
