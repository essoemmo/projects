<?php

namespace App\Http\Controllers\Admin;

use App\Bll\Utility;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Language;
use App\Models\Pages\Page;
use App\Models\Pages\PageData;
use App\Models\product\product_details;
use App\Models\Settings\CustomDesign;
use App\Models\Settings\DesignOption;
use App\Models\Settings\Setting;
use App\Models\Template;
use App\Models\UserTemplate;
use App\StoreData;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Editor\Fields\Options;

class DesignController extends Controller {

    public function index() {
        $storeId = Utility::getStoreId();
        $lang = Language::where('code', session('adminlang'))->first();
        if ($lang == null)
            $lang = Language::first();

//        $get_custom_designs = CustomDesign::where('store_id' , $storeId)->where('option_type' ,"custom_list")->get();
//dd($get_custom_designs);

        $templates = Template::leftJoin('template_data', 'template_data.template_id', 'templates.id')
                        ->select('templates.*', 'template_data.template_id', 'template_data.lang_id', 'template_data.title')
                        ->where('template_data.lang_id', $lang->id)
                        ->where('price' ,"<=" ,0)->get();

        $user_id = StoreData::where('id' , $storeId)->first()->owner_id;
        $user_templates = UserTemplate::leftJoin('templates','templates.id','user_template.template_id')
            ->leftJoin('template_data', 'template_data.template_id', 'templates.id')
            ->where('template_data.lang_id', $lang->id)
            ->where('user_template.user_id' , $user_id)
            ->select('templates.*','template_data.title')
            ->get();


        $setting_template = Setting::where('store_id', Utility::getStoreId())->first();
        $store = StoreData::where('id', Utility::getStoreId())->first();


        $categories = Category::select(['id', 'title', 'store_id', 'parent_id',])
                        ->where('parent_id', '=', null)
                        ->where('store_id', $storeId)->get();

        $products = product_details::select('products.id as prod_id', 'product_details.title as title')
                        ->join('products', 'products.id', '=', 'product_details.product_id')
                        ->where('products.store_id', $storeId)->get();

        $pages = Page::join('pages_data', 'pages_data.page_id', 'pages.id')
                        ->where('pages.store_id', $storeId)
                        ->where('pages_data.source_id', null)
                        ->select('pages.id', 'pages_data.title')->get();
        //$design_options = DesignOption::where('store_id' ,$storeId)->first();
        //dd($store);
        $custom_design_list = CustomDesign::where('store_id', $storeId)->where('option_type', "custom_list")->get();
        //dd(count($custom_design_list) ==0 );

        return view('admin.design.index', compact('templates', 'setting_template', 'store', 'categories', 'products',
                        'pages', 'custom_design_list' ,'user_templates'));
    }

    public function change_design(Request $request) {
        $setting_template = Setting::where('store_id', Utility::getStoreId())->first();
        $setting_template->update(['template_id' => $request->template_id]);

        return response()->json('true');
    }

    public function save_options(Request $request) {
        //dd($request->font);
        $storeId = Utility::getStoreId();
        //$found = DesignOption::where('store_id' ,$storeId)->first();

        if ($request->main_menu == "classification_list") {
            $found = CustomDesign::where('store_id', $storeId)->delete();
        }

        if ($request->show_all_button) {
            $setting = Setting::where('store_id', $storeId)->first();
            $setting->update([
                'show_all_button' => $request->show_all_button,
            ]);
        }


        $bll = new \App\Bll\Design();
//dd($request->default_color);
        if ($request->color_default==null) {
            echo "000000000";
            if ($request->color) {
                $bll->setColor($request->input("color"));
            }
        }


        if ($request->font) {
            $bll->setFont($request->input("font"));
        }
      //   dd($bll,$request->input("color"));

        $destinationPath = \App\Bll\FileLocation::CSS();
        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 755, true);
        }

        $destinationPath = \App\Bll\FileLocation::CSS();
        file_put_contents($destinationPath . '/css.css', $bll->render());
        return redirect()->back()->with('flash_message', _i('Saved Succesfully'));
    }

    public function save_menu_link(Request $request) {
        //dd($request->all());
        $storeId = Utility::getStoreId();
        $code = $request->code_list;
        $custom_design = CustomDesign::create([
                    'store_id' => $storeId,
                    'option_type' => "custom_list",
                    'code' => $code, //code_list_product
                    'value' => $request->get('code_list_' . $code),
                    'title' => $request->title_link,
                    'integer_value' => $request->separate_window,
        ]);

        //$get_custom_designs = CustomDesign::where('store_id' , $storeId)->where('option_type' ,"custom_list")->get();

        return response()->json($custom_design);
    }

    public function delete_custom_option(Request $request) {
        $custom_option = CustomDesign::destroy($request->rowId);
        return response()->json(true);
    }

}
