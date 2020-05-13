<?php

namespace App\Http\Controllers\dashboard;

use App\DataTables\SectionProductDataTable;
use App\Models\Content\ContentSection;
use App\Models\Content\ContentSectionData;
use App\Models\Content\SectionCountry;
use App\Models\ContentSectionProduct;
use App\Models\Language;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentSectionProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SectionProductDataTable $sectionProductDataTable)
    {
        return $sectionProductDataTable->render('admin.section_products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = Language::getEnabledLanguages();
        $country = \App\Models\Country::with('hasDescription')->get();
        $products = Product::leftJoin('product_descriptions','product_descriptions.product_id','products.id')
            ->where('product_descriptions.language_id', checknotsessionlang())
            ->where('products.status', 0)->pluck('product_descriptions.name','products.id');
//        dd($products);
        return view('admin.section_products.create',compact('languages','products' ,'country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'sometimes',
            'lang_id' => 'required',
            'order' => 'required',
            'product_id' => 'required',
        ]);

        $content = ContentSection::create([
            'title' => $request->title,
            'order' => $request->order,
            'columns' => 0,
            'type' => 'home',
        ]);

        if ($request->country_id){
            $country_ids = $request->country_id;
            foreach ($country_ids as $single_id){
                $section_country = SectionCountry::create([
                    'section_id' => $content->id,
                    'country_id' => $single_id,
                ]);
            }
        }

        $section_content = ContentSectionData::create([
            'section_id' => $content->id,
            'lang_id' => $request->lang_id,
        ]);

        if ($request->product_id != null) {
            for ($ii = 0; $ii < count($request->product_id); $ii++) {
                $product_id = $request->product_id[$ii];
                $section_id = $content->id;
                ContentSectionProduct::create([
                    'product_id' => $product_id,
                    'section_id' => $section_id,
                ]);
            }
        }
        return redirect()->route('section_products.edit', $content->id)->with('success' ,_i('Added Successfully !'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $content = ContentSection::findOrFail($id);
        $content_data = ContentSectionData::where('section_id', $content->id)->first();
        $section_product = ContentSectionProduct::where('section_id', $content->id)->get();
        $languages = Language::getEnabledLanguages();
        $country = \App\Models\Country::with('hasDescription')->get();
        $section_country = SectionCountry::where('section_id' , $content['id'])->get();
        $products = Product::leftJoin('product_descriptions','product_descriptions.product_id','products.id')
            ->where('product_descriptions.language_id', checknotsessionlang())
            ->where('products.status', 0)->pluck('product_descriptions.name','products.id');
        return view('admin.section_products.edit',compact('languages','products','content','content_data','section_product',
            'country','section_country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'sometimes',
            'lang_id' => 'required',
            'order' => 'required',
            'product_id' => 'required',
        ]);

        $content = ContentSection::findOrFail($id);

        $content->update([
            'title' => $request->title,
            'order' => $request->order,
            'columns' => 0,
            'type' => 'home',
        ]);

        if ($request->country_id){
            SectionCountry::where('section_id' , $content['id'])->delete();
            $country_ids = $request->country_id;
            foreach ($country_ids as $single_id){
                $section_country = SectionCountry::create([
                    'section_id' => $content->id,
                    'country_id' => $single_id,
                ]);
            }
        }

        $section_content = ContentSectionData::where('section_id', $content->id)->first();

        $section_content->update([
            'section_id' => $content->id,
            'lang_id' => $request->lang_id,
        ]);

        if ($request->product_id != null) {
            ContentSectionProduct::where('section_id', $content->id)->delete();
            for ($ii = 0; $ii < count($request->product_id); $ii++) {
                $product_id = $request->product_id[$ii];
                $section_id = $content->id;
                ContentSectionProduct::create([
                    'product_id' => $product_id,
                    'section_id' => $section_id,
                ]);
            }
        }
        return redirect()->route('section_products.edit', $content->id)->with( 'success' , _i('Updated Successfully !'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
