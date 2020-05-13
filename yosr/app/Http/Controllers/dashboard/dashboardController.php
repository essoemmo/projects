<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\models\Category;
use App\models\File;
use App\models\Subcategory;
use App\models\Upload;
use http\Client\Curl\User;
use Illuminate\Http\Request;

class dashboardController extends Controller
{

    public function index()
    {
        $user = \App\User::count();
        $category = Category::count();
        $subCat = Subcategory::count();
        $file = Upload::count();

        return view('admin.index',compact('user','category','subCat','file'));
    }

}
