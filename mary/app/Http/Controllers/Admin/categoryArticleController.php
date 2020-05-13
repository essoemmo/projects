<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\categoryArticleDataTable;
use App\Models\Artcl_category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class categoryArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:show-categoryArticle'])->only('index');
        $this->middleware(['permission:ArticleCategory-Add'])->only('store');
        $this->middleware(['permission:ArticleCategory-Edit'])->only('update');
        $this->middleware(['permission:ArticleCategory-Delete'])->only('destroy');
    }


    public function index(categoryArticleDataTable $articleCat){
        return  $articleCat->render('admin.articles.category.index' , ['title' => _i('Article Category')]);
    }


    public function store(Request $request){
        $request->validate([
                'title' => 'required',
            ]);

        $addArticle = new Artcl_category();
        if ($request->image)
        {
            Image::make($request->image)->save(public_path('/uploads/articles/'.$request->image->hashName()));
            $addArticle->img_url = $request->image->hashName();
        }
        $addArticle->title = $request->title;
        $addArticle->lang_id = $request->language;
//        if ($request->published){
//            $addArticle->publishe = 'true';
//        }else{
//            $addArticle->publishe = 'false';
//        }
//        $addArticle->created = Carbon::now();
        $addArticle->save();

        session()->flash('success',_i('added Succfully'));
        return redirect()->route('categoryArticle.index');
    }


    public function update(Request $request){
        $request->validate([
            'title' => 'required',
        ]);

        $addArticle =Artcl_category::findOrFail($request->id);
        if ($request->image)
        {

            if ($addArticle->img_url != 'default.png'){
                Storage::disk('public_uploads')->delete('/articles/'.$addArticle->img_url);
            }

            Image::make($request->image)->save(public_path('/uploads/articles/'.$request->image->hashName()));
            $addArticle->img_url = $request->image->hashName();
        }
        $addArticle->title = $request->title;
        $addArticle->lang_id = $request->language;
//        if ($request->published){
//            $addArticle->publishe = 'true';
//        }else{
//            $addArticle->publishe = 'false';
//        }
//        $addArticle->created = Carbon::now();
        $addArticle->save();

        session()->flash('success',_i('updated Succfully'));
        return redirect()->route('categoryArticle.index');
    }


    public function destroy(Request $request,$id){

     $addArticle =Artcl_category::findOrFail($id);

        if ($addArticle->img_url != 'default.png'){
            Storage::disk('public_uploads')->delete('/articles/'.$addArticle->img_url);
        }

        $addArticle->delete();
        session()->flash('success',_i('deleted Succfully'));
        return redirect()->route('categoryArticle.index');
    }
}
