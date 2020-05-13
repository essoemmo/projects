<?php

namespace App\Http\Controllers\Admin\Article;

use App\DataTables\articleDataTable;
use App\Help\Utility;
use App\Http\Controllers\Controller;
use App\Models\Article\Artcl_category;
use App\Models\Article\Article;
use App\Models\Article\Article_category;
use App\Models\Article\Article_data;
use App\Models\Language;
use App\Models\product\stores;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Xinax\LaravelGettext\Facades\LaravelGettext;

class ArticleController extends Controller
{

    public function index(articleDataTable $article)
    {
        //dd(Article::where('store_id', \App\Bll\Utility::getStoreId())->get());

        return $article->render('admin.articles.article.all');
    }

    public function create()
    {

        $categories = Artcl_category::where("store_id", \App\Bll\Utility::getStoreId())->get();
        return view('admin.articles.article.create', compact('categories'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $rules = [
            'title' => ['required', 'max:150', 'unique:articles'],
            'content' => ['required'],
            'category_id' => ['required'],
            'img_url' => ['required', 'image', 'mimes:jpeg,jpg,png,bmp,gif,svg'],
        ];

        // $validator = validator()->make($request->all() , $rules);
        // if($validator->fails())
        //     return redirect()->back()->withErrors($validator)->withInput();

        $sessionStore = \App\Bll\Utility::getStoreId();
        if($sessionStore== \App\Bll\Utility::$demoId){
            return redirect()->back()->with('flash_message' , _i('Added Successfully'));
        }


       // $store = stores::where('id', \App\Bll\Utility::getStoreId())->first();
//        dd($store->languages);
        //$lang = $store->languages->where('title', strtolower(LaravelGettext::getLocale()))->first();
//        dd($lang);
        //session()->put('langId', $lang['id']);
//        dd(session()->get('langId'));

        //$guard = Utility::get_guard();

        $article = Article::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'store_id' => $sessionStore,
            'created' => $request->created,
            'content' => $request->input('content'),
        ]);

        if ($request->has('published')) {
            $article->published = $request->published;
        }
        //   dd($article);
        $image = $request->file('img_url');

        if ($image && $file = $image->isValid()) {
            $destinationPath = public_path('uploads/articles/' . $article->id);
            $fileName = $image->getClientOriginalName();
            $image->move($destinationPath, $fileName);
            $request->img_url = $fileName;
        }
        $article->img_url = $request->img_url;

        $article->save();

//        $article_data = Article_data::create([
//            'title' => $article->title,
//            'content' => $article->content,
//            'created' => $article->created,
//            'lang_id' => Language::first()->id,
//        ]);
//        $article_data->save();
        //        $article_data->source_id = $article_data->id;
        //        $article_data->save();

//        $artcl_cat = Article_category::create([
//            'category_id' => $request->category_id,
//            'article_id' => $article->id,
//        ]);
//        $artcl_cat->save();

        return redirect()->back()->with('flash_message', _i('Added Successfully !'));
    }

    public function edit($id)
    {
        $categories = Artcl_category::where("store_id", session()->get("StoreId"))->get();
        //dd($categories);
        $article = Article::findOrFail($id);
        return view('admin.articles.article.edit', compact('categories', 'article'));
    }

    public function show($id)
    {
        $categories = Artcl_category::where("store_id", \App\Bll\Utility::getStoreId())->get();
        $article = Article::findOrFail($id);
        return view('admin.articles.article.show', compact('categories', 'article'));
    }

    public function update(Request $request, $id)
    {

        // $article = Article::findOrFail($id);

        $sessionStore = \App\Bll\Utility::getStoreId();
        if ($sessionStore == \App\Bll\Utility::$demoId) {
            return redirect()->back()->with('flash_message', _i('Updated Successfully !'));
        }

        $article = Article::where("store_id", $sessionStore)->where("id", $id)->first();

        if ($article == null) {
            return response()->json(['fail' => _i('not found')]);
        }

       // $artcl_data = Article_data::where('title', '=', $article->title)->first();
        $artcl_cat = Article_category::where('category_id', $article->category_id)
            ->where('article_id', $article->id)->first();

        $rules = [
            'title' => ['required', 'max:150', Rule::unique('articles')->ignore($article->id)],
            'content' => ['required'],
            'category_id' => ['required'],
            'img_url' => ['sometimes', 'image', 'mimes:jpeg,jpg,png,bmp,gif,svg'],
        ];
        // $validator = validator()->make($request->all() , $rules);
        // if($validator->fails())
        //     return redirect()->back()->withErrors($validator)->withInput();

        if ($request->has('img_url')) {
            $image = $request->file('img_url');

            if ($image && $file = $image->isValid()) {
                $destinationPath = public_path('uploads/articles/store_img/' . $article->id);
                $fileName = $image->getClientOriginalName();
                $image->move($destinationPath, $fileName);
                $request->img_url = $fileName;

                if (!empty($article->img_url)) {
                    //delete old image
                    $file = public_path('uploads/articles/' . $article->id . '/') . $article->img_url;
                    @unlink($file);
                }
            }
            $article->img_url = $request->img_url;
        }

        $article->title = $request->title;
        $article->category_id = $request->category_id;
        $article->content = $request->input('content');
        $article->created = $request->created;
        if ($request->has('published')) {
            $article->published = $request->published;
        } else {
            $article->published = 0;

        }
//        $article->img_url = $request->img_url;
        $article->save();

        // edit article data table
//        $artcl_data->title = $article->title;
//        $artcl_data->content = $article->content;
//        $artcl_data->save();

//         edit arrticle category data
       /* $artcl_cat->category_id = $article->category_id;
        $artcl_cat->save();*/

        return redirect()->back()->with('flash_message', _i('Updated Successfully !'));
    }

    public function delete($id)
    {
        //  $article = Article::findOrFail($id);

        $sessionStore = \App\Bll\Utility::getStoreId();
        if ($sessionStore == \App\Bll\Utility::$demoId) {
            return redirect()->back()->with('flash_message', _i('Deleted Successfully !'));
        }

        $article = Article::where("store_id", $sessionStore)->where("id", $id)->first();
        if ($article == null) {
            return response()->json(['fail' => _i('not found')]);
        }
//        $artcl_data = Article_data::where('title', $article->title)->first();
//        $artcl_data->delete();
        $article->delete();
        return redirect()->back()->with('flash_message', _i('Deleted Successfully !'));
    }

}
