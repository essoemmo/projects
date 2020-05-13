<?php


namespace App\Http\Controllers\Master\Articles;


use App\DataTables\ArticleCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Article\ArticleCategory;
use App\Models\Article\ArticleCategoryData;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ArticleCategoryController extends Controller
{

    public function index(ArticleCategoryDataTable $artcl_categories)
    {
        return $artcl_categories->render('master.article_management.category.index');
    }

    public function create()
    {
        $langs = Language::get();
        return view('master.article_management.category.create' , compact('langs'));
    }

    public function store(Request $request)
    {
        //dd( $request->file('img_url'));
        $request['published'] = $request['published'] ?? 0;
        $request['lang_id'] = $request['lang_id'] ?? Language::first()->id;
        $artcle_cat = ArticleCategory::create([
            'published' => $request['published'],
            'store_id' => null,
            'created' => date('Y-m-d'),
        ]);

//        $image = $request->file('img_url');
//        if ($image ) {
//            $destinationPath = public_path('uploads/artcl_category/' . $artcle_cat->id);
//            $fileName = $image->getClientOriginalName();
//            $image->move($destinationPath, $fileName);
//            $request->img_url = $fileName;
//        }
//        $artcle_cat->img_url = $request->img_url;
//        $artcle_cat->save();

        if ($request->hasFile('img_url')) {
            $image = $request->file('img_url');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $request->img_url->move(public_path('uploads/artcl_category/'.$artcle_cat->id), $filename);

            $artcle_cat->img_url = '/uploads/artcl_category/'. $artcle_cat->id .'/'. $filename;
            $artcle_cat->save();
        }

        $artcle_cat_data = ArticleCategoryData::create([
            'category_id' => $artcle_cat->id,
            'lang_id' => $request['lang_id'],
            'source_id' => null,
            'title' => $request->title,
        ]);

        return redirect()->back()->with('success' ,_i('Saved Successfully !'));
    }

    public function edit($id)
    {
        $langs = Language::get();
        $article_cat = ArticleCategory::findOrFail($id);
        $article_cat_data = ArticleCategoryData::where('category_id',$article_cat->id)->where('source_id' , null)->first();

        return view('master.article_management.category.edit' , compact('langs','article_cat','article_cat_data'));
    }

    public function update($id , Request $request)
    {
        $request['published'] = $request['published'] ?? 0;
        $request['lang_id'] = $request['lang_id'] ?? Language::first()->id;

        $article_cat = ArticleCategory::findOrFail($id);
        $article_cat_data = ArticleCategoryData::where('category_id',$article_cat->id)->where('source_id' , null)->first();

        $article_cat->update([
            'published' => $request['published'],
            'store_id' => null,
        ]);

        $article_cat_data->update([
            'lang_id' => $request['lang_id'],
            'source_id' => null,
            'title' => $request->title,
        ]);

        if ($request->hasFile('img_url')) {
            $image_path = $article_cat->img_url;
            if (File::exists(public_path($image_path))) {
                File::delete(public_path($image_path));
            }
            $image = $request->file('img_url');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $request->img_url->move(public_path('uploads/artcl_category/' . $article_cat->id), $filename);

            $article_cat->img_url = '/uploads/artcl_category/' . $article_cat->id . '/' . $filename;
            $article_cat->save();
        }

        return redirect()->back()->with('success' ,_i('Updated Successfully !'));
    }


    public function getLangvalue(Request $request){
        //dd($request->all());
        $rowData = ArticleCategoryData::where('category_id',$request->transRowId)
            //->where('lang_id',$request->lang_id)
            ->where('lang_id',$request->lang_id)
            ->first(['title']);
        if (!empty($rowData)){
            return \response()->json(['data' => $rowData]);
        }else{
            return \response()->json(['data' => false]);

        }
    }

    public function storelangTranslation(Request $request){
        //dd($request);
        $rowData = ArticleCategoryData::where('category_id',$request->id)
           //->where('lang_id',$request->lang_id_data)
            ->where('source_id',"!=" , null)
            ->first();

        if ($rowData !== null) {

            $rowData->update([
                'title' => $request->title,
                'lang_id' => $request->lang_id_data,
            ]);

        }else{
            $parentRow = ArticleCategoryData::where('category_id',$request->id)->where('source_id' , null)->first();
            //dd($parentRow);
            ArticleCategoryData::create([
                'title' => $request->title,
                'lang_id' => $request->lang_id_data,
                'category_id' => $request->id,
                'source_id' => $parentRow->id,
            ]);
        }
        return \response()->json("SUCCESS");
    }

    public function delete($id)
    {

        $article_cat_data = ArticleCategoryData::where('category_id',$id)->delete();
        $article_cat = ArticleCategory::destroy($id);
        return redirect()->back()->with('success' ,_i('Deleted Successfully !'));
    }

    public function get_categories(Request $request)
    {
        //dd(request()->lang_id);
        $query = ArticleCategory::leftJoin('article_category_data' ,'article_category_data.category_id','article_category.id')
            ->select('article_category.*','article_category_data.category_id','article_category_data.lang_id','article_category_data.source_id',
                'article_category_data.title')->where('article_category_data.lang_id' , $request->lang_id)
            ->where('article_category.store_id' , null)
            ->pluck('article_category_data.title','article_category.id');
        return $query;
    }

}