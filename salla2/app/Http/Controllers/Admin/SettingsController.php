<?php


namespace App\Http\Controllers\Admin;

use App\BannerData;
use App\Bll\Domain;
use App\BLL\Utility;

use App\DataTables\homepageDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Language;
use App\Models\product\stores;
use App\Models\Settings\Banner;
use App\Models\Settings\Counter;
use App\Models\Settings\Currency;
use App\Models\Settings\CurrencyData;
use App\Models\Settings\homepage;
use App\Models\Settings\Setting;
use App\Models\Settings\SettingsData;
use App\Models\Settings\Slider;
use App\SliderData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class  SettingsController extends Controller
{

    public function index()
    {
        $counter = Counter::all()->take(3);
        $site_settings = Setting::where('store_id', null)->first();
        $sliders = Slider::where('store_id', null)->get();
        return view('admin.settings.index', compact('counter', 'site_settings', 'sliders'));
    }

    public function getlang(Request $request)
    {
        $lang = Language::where('id', $request->lang_id)->first();
        if ($lang) {
            return Response::json($lang->title);
        }
    }

    //setting
    public function get_settings()
    {
        $store = stores::findOrFail(\App\Bll\Utility::getStoreId());

        if (auth()->user()->guard == 'admin') {
            $counter = Counter::all()->take(3);
            $site_settings = Setting::where('store_id', Utility::getStoreId())->first();
            $sliders = Slider::where('store_id', Utility::getStoreId())->get();
            return view('admin.settings.index', compact('counter', 'site_settings', 'sliders'));
        } else {
            $site_settings = Setting::where('store_id', session()->get('StoreId'))->first();
            $site_settings2 = Setting::
            leftJoin('settings_data', 'settings.id', '=', 'settings_data.setting_id')
                ->select('settings_data.id as id', 'settings_data.title as title', 'settings_data.description as description', 'settings_data.lang_id as lang_id')
                ->where('store_id', session()->get('StoreId'))->where('settings_data.lang_id', 1)->get();
            //dd($site_settings2 );
            $store_settings = stores::whereId(session()->get('StoreId'))->first();
            $categories = Category::where('store_id', session()->get('StoreId'))->where('lang_id', 1)->pluck('title', 'id');
            return view('allStore.settings.index', compact('site_settings', 'store_settings', 'site_settings2', 'categories', 'store'));
        }


    }

    public function store_settings(Request $request)
    {

        $rules = [
            'title' => 'required|string',
            'logo' => 'sometimes|image|mimes:jpeg,jpg,png,bmp,gif,svg'
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $sessionStore = session()->get('StoreId');
            if ($sessionStore == \App\Bll\Utility::$demoId) {
                return redirect()->back()->with('flash_message', _i('Added Successfully !'));
            }
            $settings = Setting::where('store_id', session()->get('StoreId'))->first();
            if ($settings) {
                if ($request->has('logo')) {
                    $image = $request->file('logo');

                    if ($image && $file = $image->isValid()) {
                        $destinationPath = public_path('uploads/settings/site_settings/' . $settings->id);
                        $fileName = $image->getClientOriginalName();
                        $image->move($destinationPath, $fileName);
                        $request->logo = $fileName;

                        if (!empty($settings->logo)) {

                            $file = public_path('uploads/settings/site_settings/' . $settings->id . '/') . $settings->logo;
                            @unlink($file);
                        }
                    }
                    $settings->logo = '/uploads/settings/site_settings/' . $settings->id . '/' . $fileName;
                }
                $settings->email = $request->email;
                $settings->phone1 = $request->phone1;
                $settings->phone2 = $request->phone2;
                $settings->facebook_url = $request->facebook_url;
                $settings->instagram_url = $request->instagram_url;
                $settings->twitter_url = $request->twitter_url;
                $settings->work_time = $request->work_time;
                $settings->address = $request->address;
                $settings->description = $request->description;
                SettingsData::where('setting_id', $settings->id)->update([
                    'description' => $request->description,
                    'title' => $request->title,
                    'setting_id' => $settings->id,
                    'lang_id' => getLang(session('adminlang')),
                ]);

                stores::whereId(session()->get('StoreId'))->update([
                    'title' => $request->title,
                    //'domain' => $request->domain,
                ]);

                $settings->update();

                return redirect()->back()->with('flash_message', _i('Updated Successfully !'));
            } else {

                $settings = Setting::create([
                    'email' => $request->email,
                    'phone1' => $request->phone1,
                    'phone2' => $request->phone2,
                    'facebook_url' => $request->facebook_url,
                    'instagram_url' => $request->instagram_url,
                    'twitter_url' => $request->twitter_url,
                    'work_time' => $request->work_time,
                    'address' => $request->address,
                    'description' => $request->description,
                    'store_id' => session()->get('StoreId'),
                ]);

                SettingsData::create([
                    'title' => $request->title,
                    'setting_id' => $settings->id,
                    'lang_id' => getLang(session('adminlang')),
                ]);

                if ($request->has('logo')) {
                    $image = $request->file('logo');

                    if ($image && $file = $image->isValid()) {
                        $destinationPath = public_path('uploads/settings/site_settings/' . $settings->id);
                        $fileName = $image->getClientOriginalName();
                        $image->move($destinationPath, $fileName);
                        $request->logo = $fileName;

                        if (!empty($settings->logo)) {
                            $file = public_path('uploads/settings/site_settings/' . $settings->id . '/') . $settings->logo;
                            @unlink($file);
                        }
                    }
                    $settings->logo = '/uploads/settings/site_settings/' . $settings->id . '/' . $fileName;
                }


                $settings->save();
                return redirect()->back()->with('flash_message', _i('Added Successfully !'));

            }
        }
    }

    public function store_domain(Request $request)
    {
        //dd($request->all());
        $domain = $request->domain;
        $find_domain = stores::where('domain', $domain)->first();
        // change domain
        if ($find_domain == null) {
            stores::whereId(session()->get('StoreId'))->update(['domain' => $domain]);
            Domain::CreateSubDomain($domain);
        }

        return redirect()->back()->with('flash_message', _i('Updated Successfully'));
    }

    //banner
    public function get_banners()
    {
        $banners = Banner::leftJoin('banners_data', 'banners_data.banner_id', 'banners.id')
            ->select('banners.*', 'banners_data.banner_id', 'banners_data.lang_id', 'banners_data.source_id',
                'banners_data.name', 'banners_data.description')
            ->where('banners_data.source_id', null)
            ->where('store_id', session()->get('StoreId'))->get();
        //$categories = Category::where('store_id', session('StoreId'))->pluck('title', 'id');
        $langs = Language::get();
        return view('allStore.settings.banners.index', compact('banners', 'langs'));
    }

    public function store_banner(Request $request)
    {

        $sessionStore = \App\Bll\Utility::getStoreId();
        if ($sessionStore == \App\Bll\Utility::$demoId) {
            return redirect()->back()->with('flash_message', _i('Added Successfully'));
        }

        $rules = [
            'name' => ['required', 'string', 'max:150'],
            'link' => 'required|max:191',

            'sort_order' => 'required',

            'image' => 'image|mimes:jpeg,jpg,png,bmp,gif,svg',
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $banner = Banner::create([
                'sort_order' => $request->sort_order,
                'link' => $request->link,
                'published' => $request->published,

                'store_id' => session('StoreId'),
            ]);
            $image = $request->file('image');

            if ($image && $file = $image->isValid()) {
                $destinationPath = public_path('uploads/settings/banners/' . $banner->id . '/');
                $extension = $image->getClientOriginalExtension();
                $fileName = $image->getClientOriginalName();
                $image->move($destinationPath, $fileName);
                $request->image = $fileName;
            }

            $banner->image = $request->image;

            $banner_data = BannerData::create([
                'banner_id' => $banner->id,
                'name' => $request->name,
                'description' => $request->description,
                'lang_id' => $request->lang_id,
                'source_id' => null,
            ]);

            $banner->save();
            return redirect()->back()->with('flash_message', _i('Added Successfully !'));
        }

    }

    public function edit_banner($id)
    {
        $banner = Banner::where("id", $id)->where("store_id", \App\Bll\Utility::getStoreId())->firstOrFail();
        $banner_data = BannerData::where('banner_id', $banner->id)->where('source_id', null)->first();
        $langs = Language::get();
        $categories = Category::where('store_id', session('StoreId'))->pluck('title', 'id');
        return view('allStore.settings.banners.edit_banner', compact('banner_data', 'banner', 'categories', 'langs'));

    }

    public function update_banner(Request $request, $id)
    {

        $sessionStore = \App\Bll\Utility::getStoreId();
        if ($sessionStore == \App\Bll\Utility::$demoId) {
            return redirect()->back()->with('flash_message', _i('Added Successfully'));
        }

        $banner = Banner::where("id", $id)->where("store_id", \App\Bll\Utility::getStoreId())->firstOrFail();

        $rules = [
            'name' => ['required', 'string', 'max:150'],
            'link' => 'sometimes|max:191',

            'sort_order' => 'sometimes',

            'image' => 'image|mimes:jpeg,jpg,png,bmp,gif,svg',
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        if ($request->has('image')) {
            $image = $request->file('image');

            if ($image && $file = $image->isValid()) {
                $destinationPath = public_path('uploads/settings/banners/' . $banner->id . '/');
                $fileName = $image->getClientOriginalName();
                $image->move($destinationPath, $fileName);
                $request->image = $fileName;


            }
            $banner->image = $request->image;
        }

        if ($request->has('published')) {
            $banner->published = $request->published;
        } else {
            $banner->published = 0;

        }

        $banner->link = $request->link;
        $banner->sort_order = $request->sort_order;

        $banner->store_id = $sessionStore;

        $banner_data = BannerData::where('banner_id', $banner->id)->where('source_id', null);
        $banner_data->update([
            'banner_id' => $banner->id,
            'lang_id' => $request['lang_id'],
            'source_id' => null,
            'name' => $request['name'],
            'description' => $request['description'],
        ]);

        $banner->save();
        return redirect('/adminpanel/settings/banners')->with('flash_message', _i('Updated Successfully !'));
    }


    public function banner_destroy($id)
    {
        $sessionStore = session()->get('StoreId');

        if ($sessionStore == \App\Bll\Utility::$demoId)
            return redirect()->back()->with('success', _i('Deleted Successfully !'));

        $banner = Banner::findOrFail($id);
        $banner->delete();
        $banner_data = BannerData::where('banner_id', $id)->delete();
        return redirect()->back()->with('flash_message', _i('Deleted Successfully !'));
    }

    public function getLangvalue(Request $request)
    {
        $rowData = BannerData::where('banner_id', $request->transRow)
            ->where('source_id', "=", null)
            ->first(['name', 'description']);
        if (!empty($rowData)) {
            return \response()->json(['data' => $rowData]);
        } else {
            return \response()->json(['data' => false]);
        }
    }


    public function storelangTranslation(Request $request)
    {
        $rowData = BannerData::where('banner_id', $request->id)
            ->where('source_id', "!=", null)
            ->first();
        if ($rowData != null) {

            $rowData->update([
                'name' => $request->name,
                'description' => $request->input('description'),
                'lang_id' => $request->lang_id_data,
            ]);

        } else {
            $parentRow = BannerData::where('banner_id', $request->id)->where('source_id', null)->first();
            //dd($parentRow);
            BannerData::create([
                'name' => $request->name,
                'description' => $request->input('description'),
                'lang_id' => $request->lang_id_data,
                'banner_id' => $request->id,
                'source_id' => $parentRow->id,
            ]);
        }
        return \response()->json("SUCCESS");
    }


    public function getDatatablebanners()
    {
        $banners = Banner::leftJoin('banners_data', 'banners_data.banner_id', 'banners.id')
            ->select('banners.*', 'banners_data.banner_id', 'banners_data.lang_id', 'banners_data.source_id',
                'banners_data.name', 'banners_data.description')
            ->where('banners_data.source_id', null)
            ->where('store_id', \App\Bll\Utility::getStoreId())->get();

        return DataTables::of($banners)
            ->addColumn('image', function ($query) {
                $url = asset('/uploads/settings/banners' . '/' . $query->id . '/' . $query->image);
                return '<img src=' . $url . ' border="0" style=" width: 80px; height: 80px;" class="img-responsive img-rounded" align="center" />';
            })
            ->addColumn('action', function ($banners) {

                $html = '<a href =' . url('adminpanel/settings/banner/') . "/" . $banners->id . '/edit' . ' target="blank"
             class="btn waves-effect waves-light btn-primary edit text-center" title="{{_i("Edit")}}"><i class="ti-pencil-alt"></i></a>  &nbsp;' . '
                <form class=" delete"  action="' . route("banner.destroy", $banners->id) . '"  method="POST" id="deleteRow"
                style="display: inline-block; right: 50px;" >
                <input name="_method" type="hidden" value="DELETE">
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <button type="submit" class="btn btn-danger" title=" ' . _i('Delete') . ' "> <span> <i class="ti-trash"></i></span></button>
                 </form>
                </div>';

                $langs = Language::get();
                $options = '';
                foreach ($langs as $lang) {
                    if ($lang->id != $banners->lang_id) {
                        $options .= '<li ><a href="#" data-toggle="modal" data-target="#langedit" class="lang_ex" data-id="' . $banners->id . '" data-lang="' . $lang->id . '"
                 style="display: block; padding: 5px 10px 10px;">' . $lang->title . '</a></li>';
                    }
                }
                $html = $html . '
             <div class="btn-group">
               <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"  title=" ' . _i('Translation') . ' ">
                 <span class="ti ti-settings"></span>
               </button>
               <ul class="dropdown-menu" style="right: auto; left: 0; width: 5em; " >
                 ' . $options . '
               </ul>
             </div> ';

                return $html;
            })
            ->rawColumns([
                'action',
                'image',

            ])
            ->make(true);
    }

    //slider

    public function get_sliders()
    {
        $sliders = Slider::leftJoin('sliders_data', 'sliders_data.slider_id', 'sliders.id')
            ->select('sliders.*', 'sliders_data.slider_id', 'sliders_data.lang_id', 'sliders_data.source_id',
                'sliders_data.name', 'sliders_data.description')
            ->where('sliders_data.source_id', null)
            ->where('store_id', session()->get('StoreId'))->get();
        $langs = Language::get();
        return view('allStore.settings.sliders.index', compact('sliders', 'langs'));
    }


    public function store_slider(Request $request)
    {

        $sessionStore = \App\Bll\Utility::getStoreId();
        if ($sessionStore == \App\Bll\Utility::$demoId) {
            return redirect()->back()->with('flash_message', _i('Added Successfully'));
        }

        $rules = [
            'name' => ['required', 'string', 'max:150'],
            'link' => 'required|max:191',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,jpg,png,bmp,gif,svg',
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $slider = Slider::create([
                'status' => $request->status,
                'link' => $request->link,
                'published' => $request->published,
                'store_id' => session('StoreId'),
            ]);
            $image = $request->file('image');

            if ($image && $file = $image->isValid()) {
                $destinationPath = public_path('uploads/settings/sliders/' . $slider->id . '/');
                $extension = $image->getClientOriginalExtension();
                $fileName = $image->getClientOriginalName();
                $image->move($destinationPath, $fileName);
                $request->image = $fileName;
            }

            $slider->image = $request->image;

            $slider_data = SliderData::create([
                'slider_id' => $slider->id,
                'name' => $request->name,
                'description' => $request->description,
                'lang_id' => $request->lang_id,
                'source_id' => null,
            ]);

            $slider->save();
            return redirect()->back()->with('flash_message', _i('Added Successfully !'));
        }

    }

    // make datatable for slider
    public function getDatatableSlider()
    {
        $sliders = Slider::leftJoin('sliders_data', 'sliders_data.slider_id', 'sliders.id')
            ->select('sliders.*', 'sliders_data.slider_id', 'sliders_data.lang_id', 'sliders_data.source_id',
                'sliders_data.name', 'sliders_data.description')
            ->where('sliders_data.source_id', null)
            ->where('store_id', session()->get('StoreId'))->get();
        return DataTables::of($sliders)
            ->addColumn('image', function ($query) {
                $url = asset('/uploads/settings/sliders' . '/' . $query->id . '/' . $query->image);
                return '<img src=' . $url . ' border="0" style=" width: 80px; height: 80px;" class="img-responsive img-rounded" align="center" />';
            })
            ->addColumn('action', function ($sliders) {

                $html = '<a href =' . '/adminpanel/settings/slider/' . $sliders->id . '/edit' . ' target="blank"
         class="btn waves-effect waves-light btn-primary edit text-center" title="{{_i("Edit")}}"><i class="ti-pencil-alt"></i></a>  &nbsp;' . '
            <form class=" delete"  action="' . route("slider.destroy", $sliders->id) . '"  method="POST" id="deleteRow"
            style="display: inline-block; right: 50px;" >
            <input name="_method" type="hidden" value="DELETE">
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <button type="submit" class="btn btn-danger" title=" ' . _i('Delete') . ' "> <span> <i class="ti-trash"></i></span></button>
             </form>
            </div>';

                $langs = Language::get();
                $options = '';
                foreach ($langs as $lang) {
                    if ($lang->id != $sliders->lang_id) {
                        $options .= '<li ><a href="#" data-toggle="modal" data-target="#langedit" class="lang_ex" data-id="' . $sliders->id . '" data-lang="' . $lang->id . '"
             style="display: block; padding: 5px 10px 10px;">' . $lang->title . '</a></li>';
                    }
                }
                $html = $html . '
         <div class="btn-group">
           <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"  title=" ' . _i('Translation') . ' ">
             <span class="ti ti-settings"></span>
           </button>
           <ul class="dropdown-menu" style="right: auto; left: 0; width: 5em; " >
             ' . $options . '
           </ul>
         </div> ';

                return $html;
            })
            ->rawColumns([
                'action',
                'image',
            ])
            ->make(true);
    }


    public function edit_slider($id)
    {
        $slider = Slider::findOrFail($id);
        $slider_data = SliderData::where('slider_id', $slider->id)->where('source_id', null)->first();
        $langs = Language::get();
        return view('allStore.settings.sliders.edit_slider', compact('slider_data', 'langs', 'slider'));
    }

    public function update_slider(Request $request, $id)
    {

        $sessionStore = \App\Bll\Utility::getStoreId();
        if ($sessionStore == \App\Bll\Utility::$demoId) {
            return redirect()->back()->with('flash_message', _i('Added Successfully'));
        }

        $slider = Slider::findOrFail($id);
        $rules = [
            'name' => ['required', 'string', 'max:150'],
            'link' => 'sometimes|max:191',
            'description' => 'sometimes|string',
            'image' => 'image|mimes:jpeg,jpg,png,bmp,gif,svg',
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        if ($request->has('image')) {
            $image = $request->file('image');
            if ($image && $file = $image->isValid()) {
                $destinationPath = public_path('uploads/settings/sliders/' . $slider->id . '/');
                $fileName = $image->getClientOriginalName();
                $image->move($destinationPath, $fileName);
                $request->image = $fileName;
            }
            $slider->image = $request->image;
        }
        if ($request->has('published')) {
            $slider->published = $request->published;
        } else {
            $slider->published = 0;
        }
        $slider->link = $request->link;
        $slider->sort_order = $request->sort_order;
        $slider->status = $request->status;
        $slider->store_id = $sessionStore;
        $slider_data = SliderData::where('slider_id', $slider->id)->where('source_id', null);
        $slider_data->update([
            'slider_id' => $slider->id,
            'lang_id' => $request['lang_id'],
            'source_id' => null,
            'name' => $request['name'],
            'description' => $request['description'],
        ]);
        $slider->save();
        return redirect('/adminpanel/settings/sliders')->with('flash_message', _i('Updated Successfully !'));
    }

    public function slider_destroy($id)
    {
        $sessionStore = session()->get('StoreId');
        if ($sessionStore == \App\Bll\Utility::$demoId)
            return redirect()->back()->with('success', _i('Deleted Successfully !'));

        $slider = Slider::findOrFail($id);
        $slider->delete();
        $slider_data = SliderData::where('slider_id', $id)->delete();
        return redirect()->back()->with('flash_message', _i('Deleted Successfully !'));
    }

    public function slidergetLangvalue(Request $request)
    {

        $rowData = SliderData::where('slider_id', $request->transRow)
            ->where('source_id', "=", null)
            ->first(['name', 'description']);
        if (!empty($rowData)) {
            return \response()->json(['data' => $rowData]);
        } else {
            return \response()->json(['data' => false]);
        }
    }


    public function sliderstorelangTranslation(Request $request)
    {

        $rowData = SliderData::where('slider_id', $request->id)
            ->where('source_id', "!=", null)
            ->first();
        if ($rowData != null) {

            $rowData->update([
                'name' => $request->name,
                'description' => $request->input('description'),
                'lang_id' => $request->lang_id_data,
            ]);

        } else {
            $parentRow = SliderData::where('slider_id', $request->id)->where('source_id', null)->first();
            SliderData::create([
                'name' => $request->name,
                'description' => $request->input('description'),
                'lang_id' => $request->lang_id_data,
                'slider_id' => $request->id,
                'source_id' => $parentRow->id,
            ]);
        }
        return \response()->json("SUCCESS");
    }


    // make datatable
    public function getDatatableCounter()
    {
        $query = Counter::select(['id', 'title', 'counter']);

        return datatables($query)
            ->addColumn('delete', 'admin.settings.counter.delete')
            ->rawColumns([
                'delete'
            ])
            ->make(true);
    }


    public function store_counter(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:150',
            'counter' => 'required',
            'icon' => 'required|image|mimes:jpeg,jpg,png,bmp,gif,svg',
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $counter = Counter::create([
                'title' => $request->title,
                'counter' => $request->counter,
            ]);
            $icon = $request->file('icon');

            if ($icon && $file = $icon->isValid()) {
                $destinationPath = public_path('uploads/settings/counter/' . $counter->id . '/');
                $extension = $icon->getClientOriginalExtension();
                $fileName = $icon->getClientOriginalName();
                $icon->move($destinationPath, $fileName);
                $request->icon = $fileName;
            }

            $counter->icon = $request->icon;
            $counter->save();
            return redirect()->back()->with('flash_message', _i('Added Successfully !'));
        }

    }

    public function edit_counter($id)
    {
        $counter = Counter::findOrFail($id);
        return view('admin.settings.counter.edit_counter', compact('counter'));

    }

    public function update_counter(Request $request, $id)
    {
        $counter = Counter::findOrFail($id);
        $rules = [
            'title' => 'required|string|max:150',
            'counter' => 'required',
            'icon' => 'required|image|mimes:jpeg,jpg,png,bmp,gif,svg',
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        if ($request->has('icon')) {
            $image = $request->file('icon');

            if ($image && $file = $image->isValid()) {
                $destinationPath = public_path('uploads/settings/counter/' . $counter->id . '/');
                $fileName = $image->getClientOriginalName();
                $image->move($destinationPath, $fileName);
                $request->icon = $fileName;

                if (!empty($counter->icon)) {
                    //delete old image
                    $file = public_path('uploads/settings/counter/' . $counter->id . '/') . $counter->icon;
                    @unlink($file);
                }
            }
            $counter->icon = $request->icon;
        }
        $counter->title = $request->title;
        $counter->counter = $request->counter;
        $counter->save();
        return redirect()->back()->with('flash_message', _i('Updated Successfully !'));
    }


    public function counter_destroy($id) 
    {
        $slider = Counter::findOrFail($id);
        $slider->delete();
        return redirect()->back()->with('flash_message', _i('Deleted Successfully !'));
    }

//        end counter


    //currency

    public function get_currency()
    {
        $currency = Currency::leftJoin('currency_data', 'currency_data.currency_id', 'currencies.id')
            ->select('currencies.*', 'currency_data.currency_id', 'currency_data.lang_id', 'currency_data.source_id','currency_data.title')
            ->where('currency_data.source_id', null)
            ->where('store_id', session()->get('StoreId'))->get();
        $langs = Language::get();
        return view('allStore.settings.currency.index', compact('currency', 'langs'));
    }


    public function store_currency(Request $request)
    {
        $sessionStore = \App\Bll\Utility::getStoreId();
        if ($sessionStore == \App\Bll\Utility::$demoId) {
            return redirect()->back()->with('flash_message', _i('Added Successfully'));
        }

        $rules = [
            'title' => ['required', 'string', 'max:150'],
            'code' => ['required', 'string', 'max:150']
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $currency = Currency::create([
                'code' => $request->code,
                'show' => $request->show,
                'store_id' => session('StoreId'),
            ]);
 
            $currency_data = CurrencyData::create([
                'currency_id' => $currency->id,
                'title' => $request->title,
                'lang_id' => $request->lang_id,
                'source_id' => null,
            ]);

            $currency->save();
            return redirect()->back()->with('flash_message', _i('Added Successfully !'));
        }

    }


    public function getDatatablecurrency()
    {
        $currency = Currency::leftJoin('currency_data', 'currency_data.currency_id', 'currencies.id')
            ->select('currencies.*', 'currency_data.currency_id', 'currency_data.lang_id', 'currency_data.source_id','currency_data.title')
            ->where('currency_data.source_id', null)
            ->where('store_id', session()->get('StoreId'))->get();

        return DataTables::of($currency)
            ->addColumn('action', function ($currency) {

                $html = '<a href =' . '/adminpanel/settings/currency/' . $currency->id . '/edit' . ' target="blank"
               class="btn waves-effect waves-light btn-primary edit text-center" title="{{_i("Edit")}}"><i class="ti-pencil-alt"></i></a>  &nbsp;'.
               '<form class=" delete"  action="' . route("currency.destroy", $currency->id) . '"  method="POST" id="deleteRow"
               style="display: inline-block; right: 50px;" >
            <input name="_method" type="hidden" value="DELETE">
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <button type="submit" class="btn btn-danger" title=" ' . _i('Delete') . ' "> <span> <i class="ti-trash"></i></span></button>
             </form>
            </div>';

                $langs = Language::get();
                $options = '';
                foreach ($langs as $lang) {
                    if ($lang->id != $currency->lang_id) {
                        $options .= '<li ><a href="#" data-toggle="modal" data-target="#langedit" class="lang_ex" data-id="' . $currency->id . '" data-lang="' . $lang->id . '"
             style="display: block; padding: 5px 10px 10px;">' . $lang->title . '</a></li>';
                    }
                }
                $html = $html . '
         <div class="btn-group">
           <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"  title=" ' . _i('Translation') . ' ">
             <span class="ti ti-settings"></span>
           </button>
           <ul class="dropdown-menu" style="right: auto; left: 0; width: 5em; " >
             ' . $options . '
           </ul>
         </div> ';

                return $html;
            })
            ->rawColumns([
                'action',
                'image',
            ])
            ->make(true);
    }


    public function edit_currency($id)
    {
        $currency = Currency::findOrFail($id);
        $currency_data = CurrencyData::where('currency_id', $currency->id)->where('source_id', null)->first();
        $langs = Language::get();
        return view('allStore.settings.currency.edit_currency', compact('currency_data', 'langs', 'currency'));
    }


    public function update_currency(Request $request, $id)
    {
        $sessionStore = \App\Bll\Utility::getStoreId();
        $currency = Currency::findOrFail($id);
        $rules = [
            'title' => ['required', 'string', 'max:150'],
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        if ($request->has('show')) {
            $currency->show = $request->show;
        } else {
            $currency->show = 0;
        }
        $currency->code = $request->code;
        $currency->show = $request->show;
        $currency->store_id = $sessionStore;
        $currency_data = CurrencyData::where('currency_id', $currency->id)->where('source_id', null);
        $currency_data->update([
            'currency_id' => $currency->id,
            'lang_id' => $request['lang_id'],
            'source_id' => null,
            'title' => $request['title'],
        ]);
        $currency->save();
        return redirect('adminpanel/settings/currency')->with('flash_message', _i('edited Done'));
    }


    public function currency_destroy($id)
    {
        $sessionStore = session()->get('StoreId');
        if ($sessionStore == \App\Bll\Utility::$demoId)
            return redirect()->back()->with('success', _i('Deleted Successfully !'));

        $currency = Currency::findOrFail($id);
        $currency->delete();
        $currency_data = CurrencyData::where('currency_id', $id)->delete();
        return redirect()->back()->with('flash_message', _i('Deleted Successfully !'));
    }


    public function currency_active(Request $request)
    {
        if ($request->id) {
            $active = Currency::findOrFail($request->id);
            $active->show = 1;

            $unacive = Currency::where('id', '!=', $request->id)->get();

            foreach ($unacive as $un) {
                $un->show = 0;
                $un->save();
            }
            $active->save();

            session()->flash('flash_message', _i('active updated successfully'));
        }
    }



    public function currencygetLangvalue(Request $request)
    {
        $rowData = CurrencyData::where('currency_id', $request->transRow)
            ->where('source_id', "=", null)
            ->first(['title']);
        if (!empty($rowData)) {
            return \response()->json(['data' => $rowData]);
        } else {
            return \response()->json(['data' => false]);
        }
    }


    public function currencystorelangTranslation(Request $request)
    {
        $rowData = CurrencyData::where('currency_id', $request->id)
            ->where('source_id', "!=", null)
            ->first();
        if ($rowData != null) {

            $rowData->update([
                'title' => $request->title,
                'lang_id' => $request->lang_id_data,
            ]);

        } else {
            $parentRow = CurrencyData::where('currency_id', $request->id)->where('source_id', null)->first();
            CurrencyData::create([
                'title' => $request->title,
                'lang_id' => $request->lang_id_data,
                'currency_id' => $request->id,
                'source_id' => $parentRow->id,
            ]);
        }
        return \response()->json("SUCCESS");
    }



//    homepage

    public function homepageTable(homepageDataTable $homepageDataTable)
    {
        $categories = Category::where('store_id', session('StoreId'))->pluck('title', 'id');
        return $homepageDataTable->render('admin.settings.homepage.index', compact('categories'));
    }

    public function homepagestore(Request $request)
    {
        $request->request->add(['store_id' => session('StoreId')]);
        $data = $this->validate($request, [
            'category_id' => 'required',
            'sort' => 'required',
            'template' => 'required',
            'store_id' => 'required',
        ]);
        homepage::create($data);
        return back()->with('flash_message', _i('success save'));
    }

    public function homepageupdate(Request $request, $id)
    {
        $homepage = homepage::findOrFail($id);
        $data = $this->validate($request, [
            'category_id' => 'required',
            'sort' => 'required',
            'template' => 'required',
        ]);
        $homepage->update($data);
        return back()->with('flash_message', _i('success update'));
    }

    public function homepagedelete(Request $request, $id)
    {
        $homepage = homepage::findOrFail($id);
        $homepage->delete();
        return back()->with('flash_message', _i('success delete'));
    }

    public function connectServices()
    {
        return view('admin.settings.connectServices.index');
    }

}
