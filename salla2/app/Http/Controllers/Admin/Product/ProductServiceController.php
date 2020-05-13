<?php

namespace App\Http\Controllers\Admin\Product;

use App\Bll\Constants;
use App\Exports\ProductsExport;
use App\Exports\SallatkTemplateExport;
use App\Http\Controllers\Controller;
use App\Imports\SallatkTemplateImport;
use App\Models\Category;
use App\Models\ContentSectionProduct;
use App\Models\product\order_products;
use App\Models\product\products;
use App\Models\product\stores;
use App\Models\Product_card;
use App\Models\Product_digital;
use App\Models\Product_donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ProductServiceController extends Controller
{
    public function arrangeProducts()
    {
        $sessionStore = session()->get('StoreId');

        $store = stores::where('id', $sessionStore)->first();

        $category_tree = Category::where('lang_id', Constants::defaultLanguage)->where('store_id', $sessionStore)->get();

        $cats = [];

        \App\Bll\Utility::getCategories($category_tree, $cats);

        $products = [];
        return view('admin.products.products.services.arrangeProduct', compact('cats', 'products'));
    }

    public function arrangeProductsChange(Request $request)
    {

        $sessionStore = session()->get('StoreId');

        $store = stores::where('id', $sessionStore)->first();

        $category = Category::where('id', $request->id)->where('store_id', $store->id)->first()->id;
//        $products = products::whereHas('categories', function ($query) use ($category) {
//            $query->where('category_id', $category);
//        })->get();
        $products = products::leftJoin('categories_products', 'categories_products.product_id', 'products.id')
            ->where('categories_products.category_id', $category)
            ->select('products.*', 'categories_products.sort', 'categories_products.category_id')
            ->orderBy('categories_products.sort', 'asc')
            ->get();

        $sort = 1;
        return view('admin.products.products.ajax.arrangeProduct_ajax', compact('products', 'sort'))->render();
    }

    public function arrangeProductsSave(Request $request)
    {
        if ($request->product_id != null) {
            $category_id = $request->category_id;
            for ($ii = 0; $ii < count($request->product_id); $ii++) {
                $product_id = $request->product_id[$ii];
                $category_product = DB::table('categories_products')
                    ->where('product_id', $product_id)
                    ->where('category_id', $category_id)
                    ->update(['sort' => $request->sort[$ii]]);
            }
            return redirect()->back()->with('success', _i('Saved Successfully !'));
        } else {
            return redirect()->back()->with('error', _i('Error !'));
        }
    }

    public function productsInventory()
    {
        $products = products::where("store_id", session()->get("StoreId"))->orderBy("id", "desc")->get();
        return view('admin.products.products.services.productsInventory', compact('products'));
    }

    public function productsImport()
    {
        return view('admin.products.products.services.productsImport');
    }

    public function productsExportExcel()
    {
        $headings = [
            'name',
            'description',
            'photo',
            'type',
            'price',
            'quantity',
            'sku',
            'discount',
        ];
        return Excel::download(new ProductsExport($headings), 'sallatk_products.xlsx');
    }

    public function productsExportCVS()
    {
        $headings = [
            'name',
            'description',
            'photo',
            'type',
            'price',
            'quantity',
            'sku',
            'discount',
        ];
        return Excel::download(new ProductsExport($headings), 'sallatk_products.cvs', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
        ]);
    }

    public function productsImportDownload()
    {
        return Excel::download(new SallatkTemplateExport(), 'sallatk products template.xlsx');
    }

    public function productsImportSave(Request $request)
    {
        $this->validate($request, [
            'file_name' => 'required|mimes:xls,xlsx'
        ]);

        $import = new SallatkTemplateImport();
        $import->onlySheets('Products');
        Excel::import($import, $request->file('file_name'));
        return redirect()->route('allProducts')->with('success', _i('Imported successfully !'));
    }

    public function deleteAllProducts(Request $request)
    {
        $products = products::where("store_id", session()->get("StoreId"))->get();
        foreach ($products as $product) {
            $category_products = $product->categories()->detach();
            $mainPhoto = $product->main_product_photo()->delete();
            $features = $product->features()->get();
            if (count($features) > 0) {
                foreach ($features as $feature) {
                    $feature_data = $feature->data->delete();
                    $feature_options_data = $feature->options;
                    foreach ($feature_options_data as $data) {
                        $data->data->delete();
                    }
                    $feature_options = $feature->options()->delete();
                }
                $product->features()->delete();
            }
            $product_details = $product->product_details()->delete();
            $product_photos = $product->product_photos()->delete();
            $comments = $product->comments()->delete();
            $orderProducts = order_products::leftJoin('orders', 'orders.id', 'order_products.order_id')
                ->where('product_id', $product->id)
                ->where('orders.store_id', session()->get("StoreId"))->delete();
            $product_cards = Product_card::where('product_id', $product->id)->delete();
            $product_digitals = Product_digital::where('product_id', $product->id)->delete();
            $product_donations = Product_donation::where('product_id', $product->id)->delete();
            $product_content_section = ContentSectionProduct::where('product_id', $product->id)->delete();
            $product->delete();
        }
        return redirect()->back()->with('success', _i('deleted Successfully !'));
    }
}
