<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Settings\Footer;
use App\Models\Settings\FooterCategory;
use App\Models\Settings\Slider;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FooterController extends Controller
{
    // make datatable for footer category
    public function  getDatatableFooterCategory()
    {
        $query = FooterCategory::select(['id', 'title','created_at'])->where('lang_id' , 1)->where('store_id' , session('StoreId'));

        return DataTables::of($query  )
        ->addColumn('action', function ($query ) {
            return $this->generateHtmlEdit_Delete([$query->id,$query->title],$query->id);
        })
         ->make(true);
    }

    public function footer_category ()
    {
        return view('admin.settings.footer_category.index');
    }

    public function store_category(Request $request)
    {
        $rules = [
            'title' => 'required|string',
        ];

        $validator = validator()->make($request->all() , $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $footer_cat = FooterCategory::create([
            'title' => $request->title,
            'store_id' => session('StoreId'),
            'lang_id' => 1
        ]);
        $footer_cat->save();
        return redirect()->back()->with('flash_message' , _i('Added Successfully !'));
    }

    public function update_category(Request $request)
    {
        $rules = [
            'title' => 'required|string',
        ];

        $validator = validator()->make($request->all() , $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        $footer_cat = FooterCategory::where('id' ,$request->id)->where('store_id' ,session('StoreId'))->first();
        $footer_cat->title = $request->title;
        $footer_cat->save();
        return redirect()->back()->with('flash_message' , _i('Updated Successfully !'));
    }

    public function delete_category(Request $request)
    {
        $id = $request->input('id');
        $footer_category = FooterCategory::findOrFail($id);
        $footer = Footer::where('store_id' , session('StoreId'))->where('category_id' , $footer_category->id)->get();
        if(count($footer) > 0)
        {
            return redirect()->back()->with('danger' , _i('Can`t delete this category because it have footer links under'));
        }else{
            $footer_category->delete();
            return redirect()->back()->with('flash_message' ,  _i('Deleted Successfully !'));
        }
    }



    public function footer()
    {
        $categories = FooterCategory::where('lang_id' , 1)->where('store_id',session('StoreId'))->get();
//        dd($categories);
        return view('admin.settings.footer.index', compact('categories'));
    }

    // make datatable for footer category
    public function  getDatatableFooter()
    {
        $query = Footer::select(['id', 'title','link','category_id','created_at'])->where('lang_id' ,1)->where('store_id',session('StoreId'));

        return DataTables::of($query  )
            ->editColumn('category_id', function ($query) {
                $category = FooterCategory::select(['title'])->where('id' , $query->category_id)->where('store_id' , session('StoreId'))->first();
                return $category->title;

            })
            ->addColumn('action', function ($query ) {
                return $this->generateHtmlEdit_Delete([$query->id,$query->title,$query->link,$query->category_id] , $query->id);
            })
            ->make(true);
    }

    public function store_footer(Request $request)
    {
        $rules = [
            'title' => 'required|string',
            'link' => 'required|string',
            'category_id' => 'required|string',
        ];

        $validator = validator()->make($request->all() , $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        $footer = Footer::create([
            'title' => $request->title,
            'store_id' => session('StoreId'),
            'link' => $request->link,
            'category_id' => $request->category_id,
            'lang_id' => 1
        ]);
        $footer->save();
        return redirect()->back()->with('flash_message' , _i('Added Successfully !'));
    }

    public function update_footer(Request $request)
    {
//        dd($request->input('id'));
        $rules = [
            'title' => 'required|string',
            'link' => 'required|string',
            'category_id' => 'required|string',
        ];

        $validator = validator()->make($request->all() , $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        $footer = Footer::findOrFail($request->input('id'));
        $footer->title = $request->title;
        $footer->link = $request->link;
        $footer->category_id = $request->category_id;
        $footer->save();
        return redirect()->back()->with('flash_message' , _i('Updated Successfully !'));
    }

    public function destroy_footer(Request $request)
    {
        $footer = Footer::findOrFail($request->input('id'));
        $footer->delete();
        return redirect()->back()->with('flash_message' ,  _i('Deleted Successfully !'));
    }



}