<?php


namespace App\Http\Controllers\Master\Articles;


use App\DataTables\ArticleDataTable;
use App\Http\Controllers\Controller;
use App\Models\Article\Article;
use App\Models\Article\ArticleCategory;
use App\Models\Article\ArticleData;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ArticlesController extends Controller
{

    public function index(ArticleDataTable $articles)
    {
        return $articles->render('master.article_management.articles.index');
    }

    public function create()
    {
        $langs = Language::get();
        return view('master.article_management.articles.create', compact('langs'));
    }

    public function store(Request $request)
    {
        $request['published'] = $request['published'] ?? 0;
        $request['lang_id'] = $request['lang_id'] ?? Language::first()->id;
        $request['created'] = $request['created'] ?? date('Y-m-d');
        $article = Article::create([
         'store_id' => null,
         'category_id' => $request->category_id,
         'published' =>  $request['published'],
         'created' => $request['created'],
        ]);

        if ($request->hasFile('img_url')) {
            $image = $request->file('img_url');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $request->img_url->move(public_path('uploads/articles/'.$article->id), $filename);

            $article->img_url = '/uploads/articles/'. $article->id .'/'. $filename;
            $article->save();
        }

        $article_data = ArticleData::create([
            'article_id' => $article->id,
            'lang_id' => $request['lang_id'],
            'source_id' => null,
            'title' => $request['title'],
            'content' => $request['content'],
        ]);
        return redirect()->back()->with('success' ,_i('Saved Successfully !'));
    }

    public function edit($id)
    {
        $langs = Language::get();
        $article = Article::findOrFail($id);
        $article_data = ArticleData::where('article_id' , $article->id)->where('source_id' , null)->first();
        $categories = ArticleCategory::leftJoin('article_category_data' ,'article_category_data.category_id','article_category.id')
            ->select('article_category.*','article_category_data.category_id','article_category_data.lang_id','article_category_data.source_id',
                'article_category_data.title')
            ->where('article_category_data.lang_id' , $article_data->lang_id)
            ->where('article_category.store_id' , null)
            ->get();
        return view('master.article_management.articles.edit', compact('langs','article','article_data','categories'));
    }

    public function update($id , Request $request)
    {
        //dd($request->all());
        $request['published'] = $request['published'] ?? 0;
        $request['lang_id'] = $request['lang_id'] ?? Language::first()->id;

        $article = Article::findOrFail($id);
        $article_data = ArticleData::where('article_id' , $article->id)->where('source_id' , null)->first();

        $article->update([
            'store_id' => null,
            'category_id' => $request->category_id,
            'published' =>  $request['published'],
            'created' => $request['created'],
        ]);
        if ($request->hasFile('img_url')) {
            $image_path = $article->img_url;
            if (File::exists(public_path($image_path))) {
                File::delete(public_path($image_path));
            }
            $image = $request->file('img_url');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $request->img_url->move(public_path('uploads/articles/' . $article->id), $filename);

            $article->img_url = '/uploads/articles/' . $article->id . '/' . $filename;
            $article->save();
        }

        $article_data->update([
            //'article_id' => $article->id,
            'lang_id' => $request['lang_id'],
            'source_id' => null,
            'title' => $request['title'],
            'content' => $request['content'],
        ]);

        return redirect()->back()->with('success' ,_i('Updated Successfully !'));
    }

    public function getLangvalue(Request $request){
        //dd($request->all());
        $rowData = ArticleData::where('article_id',$request->transRowId)
            //->where('lang_id',$request->lang_id)
            ->where('lang_id',$request->lang_id)
            ->first(['title','content']);
        if (!empty($rowData)){
            return \response()->json(['data' => $rowData]);
        }else{
            return \response()->json(['data' => false]);
        }
    }

    public function storelangTranslation(Request $request){
        //dd($request);
        $rowData = ArticleData::where('article_id',$request->id)
            //->where('lang_id',$request->lang_id_data)
            ->where('source_id',"!=" , null)
            ->first();

        if ($rowData !== null) {

            $rowData->update([
                'title' => $request->title,
                'content' => $request->input('content'),
                'lang_id' => $request->lang_id_data,
            ]);

        }else{
            $parentRow = ArticleData::where('article_id',$request->id)->where('source_id' , null)->first();
            //dd($parentRow);
            ArticleData::create([
                'title' => $request->title,
                'content' => $request->input('content'),
                'lang_id' => $request->lang_id_data,
                'article_id' => $request->id,
                'source_id' => $parentRow->id,
            ]);
        }
        return \response()->json("SUCCESS");
    }

    public function delete($id)
    {
        $article_data = ArticleData::where('article_id',$id)->delete();
        $article = Article::destroy($id);
        return redirect()->back()->with('success' ,_i('Deleted Successfully !'));
    }

}