<?php

namespace App\Http\Controllers\Admin\Setting;

use App\DataTables\SectionProductDataTable;
use App\Models\Content\ContentSectionData;
use App\Models\Content\SectionCountry;
use App\Models\ContentSection;
use App\Models\ContentSectionProduct;
use App\Models\ContentSectionTranslation;
use App\Models\Country;
use App\Models\Languages;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\SiteLanguage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

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
        $langs = SiteLanguage::all();
        $products = Product::query()->select('products_translations.title as title' ,'products.id as id','products_translations.locale' )
        ->leftJoin('products_translations','products_translations.product_id','products.id')
            ->where('products_translations.locale', App::getLocale())
            ->pluck('products_translations.title','products.id');

//        $country = Country::query()->select('countries_translations.title as title' ,'countries.id as id' )
//            ->leftJoin('countries_translations','countries_translations.country_id','=','countries.id')
//            ->where('locale',App::getLocale())->pluck('countries_translations.title','countries.id');
        //dd($products);
        return view('admin.section_products.create',compact('langs','products' ));
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
            //'title' => 'required',
           // 'lang_id' => 'required',
            'order' => 'required',
            'product_id' => 'required',
        ]);

        $content = ContentSection::create([
            //'title' => $request->title,
            'order' => $request->order,
            'columns' => 0,
            'type' => 'home',
        ]);
        $content->save();

        $languages = SiteLanguage::all();

        foreach ($languages as $lang){
            $section_content = ContentSectionTranslation::create([
                'content_section_id' => $content->id,
                'locale' => $lang->locale, // this value is code (en / ar)
                'title' => $request->get($lang->locale.'_title'),
            ]);
            $section_content->save();
        }


        if ($request->product_id != null) {
            for ($ii = 0; $ii < count($request->product_id); $ii++) {
                $product_id = $request->product_id[$ii];
                $section_id = $content->id;
                ContentSectionProduct::create([
                    'product_id' => $product_id,
                    'content_section_id' => $section_id,
                ]);
            }
        }
        return redirect()->route('section_products.edit', $content->id)->with('success' ,_i('success save'));
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
        $content_data = ContentSectionTranslation::where('content_section_id', $content->id)->first();
        $section_product = ContentSectionProduct::where('content_section_id', $content->id)->get();
        $contents_title = ContentSectionTranslation::where('content_section_id' ,$content->id)->get();
        // ->where('locale' , App::getLocale());
       // dd($section_product);
        $languages = SiteLanguage::all();

        $products = Product::query()->select('products_translations.title as title' ,'products.id as id','products_translations.locale' )
            ->leftJoin('products_translations','products_translations.product_id','products.id')
            ->where('products_translations.locale', App::getLocale())
            ->pluck('products_translations.title','products.id');

        return view('admin.section_products.edit',compact('languages','products','content','content_data','section_product','contents_title'));
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
            //'title' => 'required',
            //'lang_id' => 'required',
            'order' => 'required',
            'product_id' => 'required',
        ]);

        $content = ContentSection::findOrFail($id);

        $content->update([
           // 'title' => $request->title,
            'order' => $request->order,
            'columns' => 0,
            'type' => 'home',
        ]);



        $languages = SiteLanguage::all();
        foreach ($languages as $lang){
            $section_content = ContentSectionTranslation::where('content_section_id', $content->id)->where('locale' ,$lang->locale )->first();
            $section_content->title = $request->get($lang->locale.'_title');
            $section_content->save();
        }



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
