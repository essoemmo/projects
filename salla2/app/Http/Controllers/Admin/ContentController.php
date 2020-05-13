<?php

namespace App\Http\Controllers\Admin;

use App\Bll\Constants;
use App\Bll\Utility;
use App\Models\Content_section;
use App\Models\Content_section_data;
use App\Models\Content_section_title;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\ContentSectionProduct;
use App\Models\Language;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class ContentController extends Controller {

    public function index() {
        //dd(auth()->guard('store')->user());
        if (request()->ajax()) {
            $section = Content_section::query()
                    ->leftJoin('content_section_titles', 'content_sections.id', '=', 'content_section_titles.section_id')
                    ->select('content_sections.*', 'content_sections.title', 'content_section_titles.lang_id')
                    ->where('store_id', Utility::getStoreId());

            if (\request()->type) {
                $section = Content_section::query()
                        ->leftJoin('content_section_titles', 'content_sections.id', '=', 'content_section_titles.section_id')
                        ->select('content_sections.*', 'content_sections.title', 'content_section_titles.lang_id')
                        ->where('type', \request()->type)->
                        where('store_id', Utility::getStoreId());
            }
            return DataTables::eloquent($section)
                            ->order(function ($query) {
                                $query->orderBy('order', 'asc');
                            })
                            ->addColumn('action', function($query) {
                                $options = '';
                                $html = '<div class="inline">
                    <div class="pull-left" style="padding-right:40px;"> 
                    
                     <div class="btn-group">
                  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"  title=" ' . _i('Translation') . ' ">
                    <span class="ti-view-list"></span>
                  </button>
                  <ul class="dropdown-menu" style="right: auto; left: 0; width: 5em; " >
                    <li><a href="' . url("adminpanel/section_products/" . $query->id . "/edit") . '" style="display: block; padding: 5px 10px 10px;">' . _i('Product') . '</a></li>
                    <li><a href="' . url("adminpanel/section_banners/" . $query->id . "/edit") . '" style="display: block; padding: 5px 10px 10px;">' . _i('Banner') . '</a></li>
                  </ul>
                </div> 
                                    
                <a href="' . url("adminpanel/content_management/" . $query->id . "/edit") . '" class="btn btn-primary btn-sm"  target="_blank"  title="' . _i("Edit") . '">
                   <i class="ti-pencil-alt"></i></a>
                  
                <form action="' . url("adminpanel/content_management/" . $query->id) . '"  method="POST" style="display:inline">
                   <input name="_method" type="hidden" value="DELETE">
                   <input type="hidden" name="_token" value="' . csrf_token() . '">
                   <button type="submit" class="btn btn-danger btn-sm"  title="' . _i("Delete") . '"> <span> <i class="ti-trash"></i></span></button>
                    </form>                   
                </div></div> </div>';
                                return $html;
                            })
                            ->editColumn('order', function($query) {
                                $html = ' 
                    <div class="pull-right"><a href="javascript:void(0)" class="btn btn-icon btn-sm sort_hight" data-id="' . $query['id'] . '"   title="' . _i("Up") . '">
                   <i class="ti-arrow-up"></i></a>' . $query['order'] . '
                    <a href="javascript:void(0)" class="btn btn-icon btn-sm sort_bottom" data-id="' . $query['id'] . '" title="' . _i("Down") . '">
                   <span style="color: #F00;" ><i class="ti-arrow-down"></i></span></a> </div> </div>
                    ';
                                return $html;
                            })
                            ->rawColumns([
                                'order',
                                'action',
                            ])
                            ->make(true);
        }
        return view('admin.content_management.index');
    }

    public function create() {
        $languages = Language::get();
        // $country = \App\Models\Country::with('hasDescription')->get();
        return view('admin.content_management.create', compact('languages'));
    }

    public function store(Request $request) {
        //dd($request->title);
        $request['lang_id'] = $request['lang_id'] ?? Language::first()->id;
        $type = $request->get('type');
        if (!$type)
            $type = "home";

        $rules = [
            'title' => ['sometimes', 'max:191'],
                //'type' =>  ['required'],
                // 'order' =>  ['required', 'unique:content_sections'],
                //'order' => 'unique:content_sections,order,NULL,id,type,'.$type //unique, when order is equal, but other field is different ('type')
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $sessionStore = session()->get('StoreId');
        if ($sessionStore == \App\Bll\Utility::$demoId) {
            return redirect()->back()->with('flash_message', _i('Added Successfully'));
        }

        $content_section = Content_section::create([
                    'order' => $request->order,
                    'columns' => $request->columns,
                    'type' => $type,
                    'store_id' => Utility::getStoreId(),
                    "title" => $request->title,
        ]);

        $order_request = $request->order;
        $order_found = Content_section::where('type', $content_section['type'])->where('order', $order_request)
                        ->where('store_id', Utility::getStoreId())->first();
        if (!$order_found) {
            $content_section->order = $order_request;
            $content_section->save();
        } else {
            $last_order = Content_section::where('type', $content_section['type'])->orderBy('order', 'desc')
                            ->where('store_id', Utility::getStoreId())->first();
            if ($last_order['order'] != 10) {
                $new_order = $last_order['order'] + 1;
                $last_order['order'] = $new_order;
                $last_order->save();
                $content_section['order'] = $order_request;
                $content_section->save();
            } else {
                $content_section['order'] = 10;
                $content_section->save();
            }
        }
        if ($request->show_title != null) {
            Content_section_title::create([
                'title' => $request->title,
                'section_id' => $content_section->id,
                'lang_id' => $request['lang_id'],
            ]);
        }

        foreach ($request->input('content') as $single_content) {
            if ($single_content != null) {
                $content_data = Content_section_data::create([
                            'section_id' => $content_section->id,
                            'lang_id' => $request['lang_id'],
                            'content' => $single_content,
                ]);
                $content_data->save();
            }
        }


        $message = _i('Added Successfully !');
        return back()->with(['success' => $message]);
    }

    public function edit($id) {
        // $_SESSION['StoreId'] = session()->get("StoreId");
        //dd ($_SESSION['store_id']);
//        $content_section = Content_section::findOrFail($id);
        $content_section = Content_section::
                        leftJoin('content_section_titles', 'content_sections.id', '=', 'content_section_titles.section_id')
                        ->select('content_sections.*', 'content_section_titles.title as title_trans', 'content_section_titles.lang_id')
                        ->where('content_sections.id', $id)->first();

//        dd($content_section);
        $content_data = Content_section_data::where('section_id', $content_section->id)->get();
        $languages = Language::get();
        $languag = Language::pluck('id')->toArray();

        return view('admin.content_management.edit', compact('languages', 'languag', 'content_section', 'content_data'));
    }

    public function update(Request $request, $id) {
        $request['lang_id'] = $request['lang_id'] ?? Language::first()->id;
        $content_section = Content_section::findOrFail($id);
        $rules = [
            'title' => ['sometimes', 'max:191'],
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $sessionStore = session()->get('StoreId');
        if ($sessionStore == \App\Bll\Utility::$demoId) {
            return redirect()->back()->with('flash_message', _i('Updated Successfully'));
        }

        $order_no = $content_section['order'];
        $type = $request['type'];
        if (!$type)
            $type = "home";
        // check if found ContentSection['order'] or with same of $request['order'] if found replace between them
        if ($order_no != $request['order']) {
            $order_found = Content_section::where('order', $request['order'])->where('type', $type)
                            ->where('store_id', Utility::getStoreId())->first();
            if ($order_found) {
                $content_section->order = $request['order'];
                $order_found->order = $order_no;
                $order_found->save();
            } else {
                $content_section['order'] = $request['order'];
            }
        }
        $content_section->columns = $request->columns;
        $content_section->type = $request->type;
        $content_section->title = $request->title;
        $content_section->store_id = Utility::getStoreId();

        $content_section->save();

         if ($request->show_title != null) {
        Content_section_title::where('section_id', $content_section->id)->update([
            'title' => $request->title,
            'section_id' => $content_section->id,
            'lang_id' => $request['lang_id'],
         ]);
        
         }else
         {
              Content_section_title::where('section_id', $content_section->id)->delete();
         }
        // save content section data
        $content_data_saved = Content_section_data::where('section_id', $content_section['id'])->get();
        foreach ($content_data_saved as $one) {
            Content_section_data::Destroy($one['id']);
        }
        foreach ($request->input('content') as $single_content) {
            if ($single_content != null) {
                $content_data_new = Content_section_data::create([
                            'section_id' => $content_section->id,
                            'content' => $single_content,
                            'lang_id' => $request['lang_id'],
                ]);
                $content_data_new->save();
            }
        }
        $message = _i('Updated Successfully !');
        return back()->with(['success' => $message]);
    }

    public function destroy($id) {
        $sessionStore = session()->get('StoreId');
        if ($sessionStore == \App\Bll\Utility::$demoId) {
            return redirect()->back()->with('flash_message', _i('Deleted Successfully'));
        }

        $section = Content_section::findOrFail($id);
        $section->destroy($id);
        $message = _i('Deleted Successfully !');
        return back()->with(['success' => $message]);
    }

    public function sort(Request $request) {
        if ($request->ajax()) {
            if ($request->row_sort_hightId) {
                $row_id = $request->row_sort_hightId;
                $content_section = Content_section::findOrFail($row_id);
                $old_order = $content_section->order;
                if ($old_order != 1) {
                    $new_order = $content_section['order'] - 1;
                    $replace_content = Content_section::where('order', $new_order)->where('type', $content_section['type'])
                                    ->where('store_id', Utility::getStoreId())->first();
                    if ($replace_content) {
                        $replace_content->order = $old_order;
                        $replace_content->save();
                    }
                    $content_section->order = $new_order;
                    $content_section->save();
                    return response()->json(true);
                }
            } else {
                $row_id = $request->row_sort_bottomId;
                $content_section = Content_section::findOrFail($row_id);
                $old_order = $content_section->order;
                if ($old_order != 10) {
                    $new_order = $content_section['order'] + 1;
                    $replace_content = Content_section::where('order', $new_order)->where('type', $content_section['type'])
                                    ->where('store_id', Utility::getStoreId())->first();
                    if ($replace_content) {
                        $replace_content->order = $old_order;
                        $replace_content->save();
                    }
                    $content_section->order = $new_order;
                    $content_section->save();
                    return response()->json(true);
                }
            }
        }
    }

}
