<?php


namespace App\Http\Controllers\Admin\Article;


use App\DataTables\Artcl_categoriesDataTable;
use App\Front\News;
use App\Help\Utility;
use App\Http\Controllers\Controller;
use App\Models\Article\Artcl_category;
use App\Models\Article\Article;
use App\Models\Language;
use App\Models\rating\rating;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class Artcl_categoriesController extends Controller
{

    public  function index()
    {
         $langs = Language::all();
        $translation = \App\Models\Translation::where('table_name','artcl_categories')->first();
        return view('admin.articles.artcl_category.all', compact('translation','langs'));
    }

    public function getDatatableArticleCats()
    {
        $query = Artcl_category::select(['id','source_id','published', 'lang_id', 'title', 'img_url', 'created']);

        return DataTables::of($query)

            ->editColumn('published', function($query) {
                return $query->published == 1 ? 'Published' : 'Not Published';
            })
            ->editColumn('lang_id', function($query) {
                $language = Language::where('id' , $query->lang_id)->first();
                return _i($language->title);
            })
            ->addColumn('edit', function($query){
                return '<a href="../artcle_category/'.$query->id.'/edit" class="btn btn-success"><i class="fa fa-edit"></i> '._i('Edit').' </a>';
            })
            ->addColumn('img_url', function ($query) {
                $url = asset('uploads/artcl_category/'.$query->id.'/'.$query->img_url);
                return '<img src='.$url.' border="0" class=" img-rounded" align="center" style="max-width:100px; max-height:100px;" />';
            })
            ->addColumn('delete', 'admin.articles.artcl_category.btn.delete')
            ->rawColumns([
                'published',
                'img_url',
                'edit',
                'delete',
            ])
            ->make(true);
    }

    public  function  create()
    {
        $languages = Language::all() ;
        return view('admin.articles.artcl_category.create' , compact('languages'));
    }

    public  function store(Request $request)
    {
        $rules = [
            'title' =>  ['required', 'max:150', 'unique:artcl_categories'],
            'img_url' => ['sometimes','image','mimes:jpeg,jpg,png,bmp,gif,svg']
        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

//        $guard = Utility::get_guard();
//        $store_id = auth()->guard($guard)->user()->id;
        $artcl_category = Artcl_category::create([
            'title' => $request->title,
//            'store_id' => $store_id,
            'created' => date('Y-m-d'),
            'lang_id' => $request->lang_id
        ]);
        if($request->has('published')){
            $artcl_category->published = $request->published;
        }

        $image = $request->file('img_url');
        if ($image && $file = $image->isValid()) {
            $destinationPath = public_path('uploads/artcl_category/'.$artcl_category->id);
//            if (!is_dir($destinationPath)) {
//                mkdir($destinationPath, 0766, true);
//            }
            $fileName = $image->getClientOriginalName();
            $image->move($destinationPath, $fileName);
            $request->img_url = $fileName;
        }
        $artcl_category->img_url = $request->img_url;
        $artcl_category->save();
        return redirect()->back()->with('flash_message' ,_i('Added Successfully !'));
    }

    public  function edit($id)
    {
        $artcl_category = Artcl_category::findOrFail($id);
        $languages = Language::all() ;
        return view('admin.articles.artcl_category.edit', compact('artcl_category' , 'languages'));
    }

    public function update(Request $request , $id)
    {
        $artcl_category = Artcl_category::findOrFail($id);

        $rules = [
            'title' =>  ['required', 'max:150', Rule::unique('artcl_categories')->ignore($artcl_category ->id)],
            'img_url' => ['sometimes','image','mimes:jpeg,jpg,png,bmp,gif,svg']
        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        if ($request->has('img_url'))
        {
            $image = $request->file('img_url');

            if ($image && $file = $image->isValid()) {
                $destinationPath = public_path('uploads/artcl_category/'.$artcl_category->id);
//                if (!is_dir($destinationPath)) {
//                    mkdir($destinationPath, 0766, true);
//                }
                $fileName = $image->getClientOriginalName();
                $image->move($destinationPath, $fileName);
                $request->img_url = $fileName;

                if(!empty($artcl_category->img_url)){
                    //delete old image
                    $file = public_path('uploads/artcl_category/'.$artcl_category->id.'/').$artcl_category->img_url;
                    @unlink($file);
                }
            }
            $artcl_category->img_url = $request->img_url;
        }

        $artcl_category->title = $request->title;
        $artcl_category->lang_id = $request->lang_id;

        if ($request->has('published'))
        {
            $artcl_category->published = $request->published;
        }else{
            $artcl_category->published = 0;

        }
        $artcl_category->save();

        return redirect()->back()->with('flash_message', 'Updated Successfully !');
    }

    public function delete($id)
    {
        $artcl_category = Artcl_category::findOrFail($id);
        $articles = Article::where('category_id','=',$artcl_category->id)->first();
        if($articles != null )
        {
            return redirect()->back()->with('danger' , _i('Can`t Delete This Category becaust it contain Articles delete it first !'));
        }else{
            $artcl_category->delete();
            return redirect()->back()->with('flash_message' , _i('Deleted Successfully !'));
        }

    }

    public function list(Request $request)
    {
        $artcl_category = Artcl_category::where('lang_id' , $request->lang_id)->pluck("title","id");
        return $artcl_category;
    }





}
