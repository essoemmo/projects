<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Article\Article;
use App\Models\bank_transfer;
use App\Models\Category;
use App\Models\Content\ContentSection;
use App\Models\Front\Contact;
use App\Models\Front\Newsletter;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\rating\userRating;
use App\Models\shippingCompanies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class dashboardController extends Controller
{
    public function index(){
        $productCount = Product::count();
        $category = Category::count();
        $contacts = Contact::count();
        $newsletter = Newsletter::count();
        $rates = userRating::count();
        $products = Product::count();
        $product_cat = ProductCategory::count();
        $shipping_company = shippingCompanies::count();
        $bank_transfer = bank_transfer::count();
        $articles = Article::count();
        $content_sections = ContentSection::count();

        return view('admin.layout.home',compact('productCount','category','contacts','newsletter','rates','products','product_cat',
            'shipping_company','bank_transfer','articles','content_sections'));
    }
}
