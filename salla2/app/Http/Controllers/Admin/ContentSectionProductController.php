<?php

namespace App\Http\Controllers\Admin;

use App\Bll\Utility;
use App\DataTables\SectionProductDataTable;
use App\Models\Content_section;
use App\Models\Content_section_title;
use App\Models\ContentSectionProduct;
use App\Models\Language;
use App\Models\product\products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentSectionProductController extends Controller
{

    public function index(SectionProductDataTable $sectionProductDataTable)
    {
        return $sectionProductDataTable->render('admin.section_products.index');
    }

    public function create()
    {
        $langs = Language::get();
        $products = products::query()->select('product_details.title as title' ,'products.id as id','product_details.source_id' )
        ->leftJoin('product_details','product_details.product_id','products.id')
            ->where('product_details.source_id', null)
            ->where('products.store_id', Utility::getStoreId())
            ->pluck('product_details.title','products.id');

        //dd($products);
        return view('admin.section_products.create',compact('langs','products' ));
    }

    public function store(Request $request)
    {
        $sessionStore = session()->get('StoreId');
        if($sessionStore== \App\Bll\Utility::$demoId){
            return redirect()->back()->with('success' , _i('Added Successfully !'));
        }
        //dd($request->all());
        $this->validate($request,[
           // 'order' => 'required',
            'product_id' => 'required',
        ]);

        $content_section = Content_section::create([
            //'title' => $request->title,
            'order' => $request->order,
            'columns' => 0,
            'type' => 'home',
            'store_id' => Utility::getStoreId(),
        ]);
        $request['lang_id'] = $request['lang_id'] ?? Language::first()->id;
        $content_title = Content_section_title::create([
            'title' => $request->title,
            'section_id' => $content_section->id,
            'lang_id' => $request['lang_id']
            ]);

        if ($request->product_id != null) {
            for ($ii = 0; $ii < count($request->product_id); $ii++) {
                $product_id = $request->product_id[$ii];
                $section_id = $content_section->id;
                ContentSectionProduct::create([
                    'product_id' => $product_id,
                    'content_section_id' => $section_id,
                ]);
            }
        }
        return redirect('adminpanel/section_products/'.$content_section->id.'/edit')
           // ->route('section_products.edit', $content_section->id)
            ->with('success' ,_i('success save'));
    }


    public function edit($id)
    {
        $content = Content_section::findOrFail($id);
        $content_data = Content_section_title::where('section_id', $content->id)->first();
        $section_product = ContentSectionProduct::where('content_section_id', $content->id)->get();

        $products = products::query()->select('product_details.title as title' ,'products.id as id','product_details.source_id' )
            ->leftJoin('product_details','product_details.product_id','products.id')
            ->where('product_details.source_id', null)
            ->where('products.store_id', Utility::getStoreId())
            ->pluck('product_details.title','products.id');
        $langs = Language::get();

        return view('admin.section_products.edit',compact('langs','products','content','content_data','section_product'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
           // 'order' => 'required',
            'product_id' => 'required',
        ]);

        $sessionStore = session()->get('StoreId');
        if($sessionStore== \App\Bll\Utility::$demoId){
            return redirect()->back()->with('success' , _i('Updated Successfully'));
        }

        $content = Content_section::findOrFail($id);
//        $content->update([
//           // 'order' => $request->order,
//            //'columns' => 0,
//            'type' => 'home',
//        ]);
        $request['lang_id'] = $request['lang_id'] ?? Language::first()->id;
//        $section_content = Content_section_title::where('section_id', $content->id)->first();
//        $section_content->title = $request->title;
//        $section_content->lang_id = $request['lang_id'] ;
//        $section_content->save();

        if ($request->product_id != null) {
            ContentSectionProduct::where('content_section_id', $content->id)->delete();
            for ($ii = 0; $ii < count($request->product_id); $ii++) {
                $product_id = $request->product_id[$ii];
                $section_id = $content->id;
                ContentSectionProduct::create([
                    'product_id' => $product_id,
                    'content_section_id' => $section_id,
                ]);
            }
        }
        return redirect()->route('section_products.edit', $content->id)->with( 'success' , _i('Updated Successfully !'));
    }


}
