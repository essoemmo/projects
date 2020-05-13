<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductDataTable;
use App\Models\Category;
use App\Models\ContentSectionProduct;
use App\Models\Files;
use App\Models\GameDetail;
use App\Models\Genre;
use App\Models\GenreProduct;
use App\Models\LanguageProduct;
use App\Models\Languages;
use App\Models\Platform;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductCode;
use App\Models\ProductTranslation;
use App\Models\RelatedProduct;
use App\Models\SiteLanguage;
use App\Models\WorkOn;
use App\Models\GameDetailProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use App\Models\Region;
use App\Models\BlogProduct;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Product-Add'])->only('index');
        $this->middleware(['permission:Product-Add'])->only('create');
        $this->middleware(['permission:Product-Edit'])->only('edit');
        $this->middleware(['permission:Product-Delete'])->only('delete');

    }
    public function index(ProductDataTable $productDataTable)
    {
        return $productDataTable->render('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $langs = SiteLanguage::all();
        $categories = Category::leftJoin('categories_translations','categories_translations.category_id','categories.id')->select('categories.id as id', 'categories_translations.title as title')->where('locale',App::getLocale())->get();
        $works_on = WorkOn::all();
        $platforms = Platform::leftJoin('platforms_translations','platforms_translations.platform_id','platforms.id')->select('platforms.id as id', 'platforms_translations.title as title')->where('locale',App::getLocale())->get();
        $regions = Region::leftJoin('regions_translations','regions_translations.region_id','regions.id')->select('regions.id as id', 'regions_translations.title as title')->where('locale',App::getLocale())->get();
        return view('admin.products.create',compact('langs','categories','works_on','platforms','regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request,[
            '*_title' => 'sometimes',
            '*_description' => 'sometimes',
            'quantity' => 'required',
            //'developers' => 'required',
            //'publishers' => 'required',
            //'release_date' => 'required',
            //'works_on_id' => 'required',
            //'region_id' => 'required',
            //'platform_id' => 'required',
            'categories' => 'required',
            'price' => 'required',
        ]);
        $langs = SiteLanguage::all();
        $product = Product::create([
            'quantity' => $request->quantity,
            'release_date' => $request->release_date,
            'developers' => $request->developers,
            'publishers' => $request->publishers,
            'works_on_id' => $request->works_on_id,
            'platform_id' => $request->platform_id,
            'region_id' => $request->region_id,
            'price' => $request->price,
        ]);
        foreach ($langs as $lang){
            $productTranslation = new ProductTranslation();
            $productTranslation->title = $request->get($lang->locale.'_title');
            $productTranslation->description = $request->get($lang->locale.'_description');
            $productTranslation->System_requirements = $request->get($lang->locale.'_System_requirements');
            $productTranslation->product_id = $product->id;
            $productTranslation->locale = $lang->locale;
            $product->translations()->save($productTranslation);
        }

        if($request->categories != null){
            for($ii = 0; $ii < count($request->categories) ; $ii++) {
                $category = $request->categories[$ii];
                $product_id = $product->id;
                ProductCategory::create([
                    'product_id' => $product_id,
                    'category_id' => $category,
                ]);
            }
        }

        return redirect(route('products.edit',['id' => $product->id]))->with('success','Added Successfully !');
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
        $langs = SiteLanguage::all();
        $product = Product::findOrFail($id);
        $related_products = Product::leftJoin('products_translations','products_translations.product_id','products.id')->select('products.id as id', 'products_translations.title as title')->where('locale',App::getLocale())->where('products.id','!=' , $id)->get();
        $categories = Category::leftJoin('categories_translations','categories_translations.category_id','categories.id')->select('categories.id as id', 'categories_translations.title as title')->where('locale',App::getLocale())->get();
        $works_on = WorkOn::all();
        $platforms = Platform::leftJoin('platforms_translations','platforms_translations.platform_id','platforms.id')->select('platforms.id as id', 'platforms_translations.title as title')->where('locale',App::getLocale())->get();
        $regions = Region::leftJoin('regions_translations','regions_translations.region_id','regions.id')->select('regions.id as id', 'regions_translations.title as title')->where('locale',App::getLocale())->get();
        $products_categories = ProductCategory::where('product_id', $product->id)->get();
        $product_files = Files::where('fileable_id', $product->id)->where('main', 0)->get();
        $product_videos = Files::where('fileable_id', $product->id)->where('main', 1)->get();
        $languages = Languages::leftJoin('languages_translations','languages_translations.language_id','languages.id')->select('languages.id as id', 'languages_translations.title as title')->where('locale',App::getLocale())->get();
        $game_details = GameDetail::leftJoin('game_details_translations','game_details_translations.game_detail_id','game_details.id')->select('game_details.id as id', 'game_details_translations.title as title')->where('locale',App::getLocale())->get();
        $genres = Genre::leftJoin('genre_translations','genre_translations.genre_id','genre.id')->select('genre.id as id', 'genre_translations.title as title')->where('locale',App::getLocale())->get();
        $related = RelatedProduct::where('product_id', $product->id);
        $codes = ProductCode::where('product_id', $product->id)->get();
        return view('admin.products.edit', compact('product','related_products','langs','categories','works_on','platforms','regions','products_categories','product_files','languages','game_details','genres','related','codes','product_videos'));
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
        $product = Product::findOrFail($id);

        $rules = [
            '*_title' => 'sometimes',
            '*_description' => 'sometimes',
            'quantity' => 'required',
//            'developers' => 'required',
//            'publishers' => 'required',
//            'release_date' => 'required',
//            'works_on_id' => 'required',
//            'region_id' => 'required',
//            'platform_id' => 'required',
            'categories' => 'required',
            'price' => 'required',
            'video' => 'required',
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            $validate = $validator->getMessageBag()->toArray();
            return response()->json([false, $validate]);
        } else {

            $langs = SiteLanguage::all();

            if ($request->hasFile('main_image') && $request->main_image != null) {
                $image_path = $product->main_image;  // Value is not URL but directory file path

                if(File::exists(public_path($image_path))) {
                    File::delete(public_path($image_path));
                }

                if(!is_dir(public_path('uploads/products/' . $product->id))) {
                    mkdir(public_path('uploads/products/' . $product->id), 755, true);
                }
                \Intervention\Image\Facades\Image::make($request->main_image)
                    ->resize(250, 326)
                    ->save(public_path('/uploads/products/'. $product->id .'/'.$request->main_image->hashName()) , 100);
            }

            if($request->main_image != null) {
                $productImage = '/uploads/products/'. $product->id .'/'.$request->main_image->hashName();
            } else {
                $productImage = $product->main_image;
            }

            $product->update([
                'quantity' => $request->quantity,
                'release_date' => $request->release_date,
                'developers' => $request->developers,
                'publishers' => $request->publishers,
                'works_on_id' => $request->works_on_id,
                'platform_id' => $request->platform_id,
                'region_id' => $request->region_id,
                'price' => $request->price,
                'video' => $request->video,
                'main_image' => $productImage,
            ]);

            foreach ($langs as $lang){
                if ($product->translate($lang->locale)){
                    $productTranslation = ProductTranslation::where('locale',$lang->locale)->where('product_id',$product->id)->first();
                }else{
                    $productTranslation = new ProductTranslation();
                }
                $productTranslation->title = $request->get($lang->locale.'_title');
                $productTranslation->description = $request->get($lang->locale.'_description');
                $productTranslation->product_id = $product->id;
                $productTranslation->locale = $lang->locale;
                $product->translations()->save($productTranslation);
            }

            if($request->categories != null){
                ProductCategory::where('product_id',$product->id)->delete();
                for($ii = 0; $ii < count($request->categories) ; $ii++) {
                    $category = $request->categories[$ii];
                    $product_id = $product->id;
                    ProductCategory::create([
                        'product_id' => $product_id,
                        'category_id' => $category,
                    ]);
                }
            }

            if($request->products != null){
                RelatedProduct::where('product_id',$product->id)->delete();
                for($ii = 0; $ii < count($request->products) ; $ii++) {
                    $related = $request->products[$ii];
                    $product_id = $product->id;
                    RelatedProduct::create([
                        'product_id' => $product_id,
                        'related_id' => $related,
                    ]);
                }
            }

            return response()->json([true]);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $gamedetails = GameDetailProduct::where('product_id', $product->id)->delete();
        $genres = GenreProduct::where('product_id', $product->id)->delete();
        $languages = LanguageProduct::where('product_id', $product->id)->delete();
        $categories = ProductCategory::where('product_id', $product->id)->delete();
        $products_translations = ProductTranslation::where('product_id', $product->id)->delete();
        $related_products = RelatedProduct::where('product_id', $product->id)->delete();
        $files = Files::where('fileable_id', $product->id)->where('fileable_type', get_class($product))->delete();
        $blogs_products = BlogProduct::where('product_id', $product->id)->delete();
        $content_sections_products = ContentSectionProduct::where('product_id', $product->id)->delete();

        $product->delete();

        return redirect()->back()->with('success', _i('Deleted Successfully !'));

    }

    public function uploadImages(Request $request,$id){
        $files = [];
        foreach ($request->file as $file){
            $imageName = time().$file->getClientOriginalName();
            $file->move(public_path('uploads/products/'.$id), $imageName);
            $product = Product::findOrFail($id);
            $files[] = $product->files()->create([
                'fileable_id' => $product->id,
                'fileable_type' => get_class($product),
                'image' => '/uploads/products/'.$id.'/'. $imageName,
                'main' => 0,
                'tag' => $imageName,
            ]);
        }
        return response()->json($files);
    }

    public function deleteImages(Request $request,$id){
        $product = Product::findOrFail($id);
        $file = $request->file;

        $exists = $product->files()->where('fileable_id',$id)->where('fileable_type',get_class($product))->exists();
        if ($exists){
            $photo = $product->files()->where('fileable_id',$id)->where('fileable_type',get_class($product))->where('tag', $file)->where('main',0)->first();
            $image_path = $photo->image;  // Value is not URL but directory file path
            if(File::exists(public_path($image_path))) {
                File::delete(public_path($image_path));
            }
            $photo->delete();
        }
    }

    public function uploadVideos(Request $request,$id){
        $files = [];
        foreach ($request->file as $file){
            $videoName = time().$file->getClientOriginalName();
            $file->move(public_path('uploads/products/'.$id), $videoName);
            $product = Product::findOrFail($id);
            $files[] = $product->files()->create([
                'fileable_id' => $product->id,
                'fileable_type' => get_class($product),
                'image' => '/uploads/products/'.$id.'/'. $videoName,
                'main' => 1,
                'tag' => $videoName,
            ]);
        }
        return response()->json($files);
    }

    public function deleteVideos(Request $request,$id){
        $product = Product::findOrFail($id);
        $file = $request->file;

        $exists = $product->files()->where('fileable_id',$id)->where('fileable_type',get_class($product))->exists();
        if ($exists){
            $photo = $product->files()->where('fileable_id',$id)->where('fileable_type',get_class($product))->where('tag', $file)->where('main',1)->first();
            $photo->delete();
        }
    }

    public function requirements(Request $request, $id) {

        $product = Product::findOrFail($id);
        $langs = SiteLanguage::all();

        foreach ($langs as $lang){
            if ($product->translate($lang->locale)){
                $productTranslation = ProductTranslation::where('locale',$lang->locale)->where('product_id',$product->id)->first();
            }else{
                $productTranslation = new ProductTranslation();
            }
            $productTranslation->System_requirements = $request->get($lang->locale.'_requirements');
            $product->translations()->save($productTranslation);
        }

        return response()->json([true, $productTranslation->System_requirements]);
    }

    public function languages(Request $request, $id) {

        $product = Product::findOrFail($id);
        if($request->langs != null){
            $LanguageProduct = LanguageProduct::where('product_id',$product->id)->get();
            if(count($LanguageProduct) > 0) {
                LanguageProduct::where('product_id',$product->id)->delete();
                for($ii = 0; $ii < count($request->langs) ; $ii++) {
                    $language = $request->langs[$ii];
                    $product_id = $product->id;
                    LanguageProduct::create([
                        'product_id' => $product_id,
                        'language_id' => $language,
                    ]);
                }
            } else {
                for($ii = 0; $ii < count($request->langs) ; $ii++) {
                    $language = $request->langs[$ii];
                    $product_id = $product->id;
                    LanguageProduct::create([
                        'product_id' => $product_id,
                        'language_id' => $language,
                    ]);
                }
            }
        }

        return response()->json(true);
    }

    public function details(Request $request, $id) {

        $product = Product::findOrFail($id);
        if($request->details != null){
            $detailProduct = GameDetailProduct::where('product_id',$product->id)->get();
            if(count($detailProduct) > 0) {
                GameDetailProduct::where('product_id',$product->id)->delete();
                for($ii = 0; $ii < count($request->details) ; $ii++) {
                    $game_detail_id = $request->details[$ii];
                    $product_id = $product->id;
                    GameDetailProduct::create([
                        'product_id' => $product_id,
                        'game_detail_id' => $game_detail_id,
                    ]);
                }
            } else {
                for($ii = 0; $ii < count($request->details) ; $ii++) {
                    $game_detail_id = $request->details[$ii];
                    $product_id = $product->id;
                    GameDetailProduct::create([
                        'product_id' => $product_id,
                        'game_detail_id' => $game_detail_id,
                    ]);
                }
            }
        }

        return response()->json(true);
    }

    public function genre(Request $request, $id) {

        $product = Product::findOrFail($id);
        if($request->genres != null){
            $genresProduct = GenreProduct::where('product_id',$product->id)->get();
            if(count($genresProduct) > 0) {
                GenreProduct::where('product_id',$product->id)->delete();
                for($ii = 0; $ii < count($request->genres) ; $ii++) {
                    $genre = $request->genres[$ii];
                    $product_id = $product->id;
                    GenreProduct::create([
                        'product_id' => $product_id,
                        'genre_id' => $genre,
                    ]);
                }
            } else {
                for($ii = 0; $ii < count($request->genres) ; $ii++) {
                    $genre = $request->genres[$ii];
                    $product_id = $product->id;
                    GenreProduct::create([
                        'product_id' => $product_id,
                        'genre_id' => $genre,
                    ]);
                }
            }
        }

        return response()->json(true);
    }

    public function codes(Request $request, $id) {

        $product = Product::findOrFail($id);
        if($request->codes != null){
            $codes = ProductCode::where('product_id',$product->id)->get();
            if(count($codes) > 0) {
                ProductCode::where('product_id',$product->id)->delete();
                for($ii = 0; $ii < count($request->codes) ; $ii++) {
                    $code = $request->codes[$ii];
                    $status = $request->status[$ii];
                    $product_id = $product->id;
                    ProductCode::create([
                        'product_id' => $product_id,
                        'code' => $code,
                        'status' => $status,
                    ]);
                }
            } else {
                for($ii = 0; $ii < count($request->codes) ; $ii++) {
                    $code = $request->codes[$ii];
                    $status = $request->status[$ii];
                    $product_id = $product->id;
                    ProductCode::create([
                        'product_id' => $product_id,
                        'code' => $code,
                        'status' => $status,
                    ]);
                }
            }
        }

        return response()->json(true);
    }
}
