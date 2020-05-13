<?php


namespace App\Http\Controllers\dashboard\Basic;


use App\Http\Controllers\Controller;
use App\Models\Content\ContentSection;
use App\Models\Content\ContentSectionData;
use App\Models\Content\SectionCountry;
use App\models\ContentSectionProduct;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class ContentManagementController extends Controller
{

    public function index()
    {
        if (request()->ajax()) {
            $section = ContentSection::query();

            if(\request()->type){
                $section = ContentSection::query()->where('type' , \request()->type);
            }
             return DataTables::eloquent($section)
                 ->order(function ($query) {
                     $query->orderBy('order', 'asc');
                 })
                ->addColumn('action' ,function($query) {
                    $html = '<div class="inline">
                    <div class="pull-left"> <a href="'.url("admin/panel/content_management/".$query->id."/edit").'" class="btn btn-primary btn-sm"  target="_blank"  title="' . _i("Edit") . '">
                   <i class="fa fa-edit"></i></a></div>
                   <form class="inline"  action="'.url("admin/panel/content_management/".$query->id) .'"  method="POST" >
                   <input name="_method" type="hidden" value="DELETE">
                   <input type="hidden" name="_token" value="' . csrf_token() . '">
                   <button type="submit" class="btn btn-danger  btn-sm "  title="' . _i("Delete") . '"> <span> <i class="fa fa-trash"></i></span></button>
                    </form>
                   </div> </div>';
                    return $html;
                })
                ->editColumn('order' , function($query){
                    $html = ' <div class="inline"> <div class="pull-left "> '.$query['order'].'</div>
                    <div class="pull-right"><a href="javascript:void(0)" class="btn btn-icon btn-sm sort_hight " data-id="'.$query['id'].'"   title="' . _i("Edit") . '">
                   <i class="fa fa-arrow-up "></i></a>
                    <a href="javascript:void(0)" class="btn btn-icon btn-sm sort_bottom" data-id="'.$query['id'].'" title="' . _i("Edit") . '">
                   <span style="color: #F00;" ><i class="fa  fa-arrow-down "></i></span></a> </div> </div>
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

    public function create()
    {
        $languages = Language::all();
        $country = \App\Models\Country::with('hasDescription')->get();
        return view('admin.content_management.create' ,compact('languages','country'));
    }

    public function store(Request $request)
    {
        $type = $request->get('type');
        if(!$type)
            $type = "home";

        $rules = [
            'title' =>  ['sometimes', 'max:191'],
            //'type' =>  ['required'],
           // 'order' =>  ['required', 'unique:content_sections'],
            //'order' => 'unique:content_sections,order,NULL,id,type,'.$type //unique, when order is equal, but other field is different ('type')

        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        $content_section = ContentSection::create([
            'title' => $request->title,
//            'order' => $request->order,
            'columns' => $request->columns,
            'type' => $type,
        ]);
        $order_request = $request->order;
        $order_found = ContentSection::where('type' ,$content_section['type'])->where('order', $order_request)->first();
        if(!$order_found){
            $content_section->order = $order_request;
            $content_section->save();
        }else{
            $last_order = ContentSection::where('type' ,$content_section['type'])->orderBy('order', 'desc')->first();
            if($last_order['order'] != 10){
                $new_order = $last_order['order']+1;
                $last_order['order'] = $new_order;
                $last_order->save();
                $content_section['order'] = $order_request;
                $content_section->save();
            }else{
                $content_section['order'] = 10;
                $content_section->save();
            }
        }

        foreach ($request->input('content') as $single_content){
            if($single_content != null){
                $content_data = ContentSectionData::create([
                    'section_id' => $content_section->id,
                    'content' => $single_content,
                ]);
                if($request->lang_id == null)
                    $content_data->lang_id = Language::where('code' , "ar")->first()->id;
                $content_data->lang_id = $request->lang_id;
                $content_data->save();
            }
        }

        // add data to section country table
        if ($request->country_id){
            $country_ids = $request->country_id;
            foreach ($country_ids as $single_id){
                $section_country = SectionCountry::create([
                    'section_id' => $content_section->id,
                    'country_id' => $single_id,
                ]);
            }
        }

        $message = _i('Added Successfully !');
        return back()->with(['success' => $message]);
    }

    public function edit($id)
    {
        $content_section = ContentSection::findOrFail($id);
//        dd($content_section);
        $content_data = ContentSectionData::where('section_id' ,$content_section->id)->get();
        $languages = Language::all();
        $country = \App\Models\Country::with('hasDescription')->get();
        $section_country = SectionCountry::where('section_id' , $content_section['id'])->get();
        return view('admin.content_management.edit' ,compact('languages','content_section','content_data','country','section_country'));
    }

    public function update(Request $request , $id)
    {
        $content_section = ContentSection::findOrFail($id);
        $rules = [
            'title' =>  ['sometimes', 'max:191'],
        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        $order_no = $content_section['order'];
        $type = $request['type'];
        if(!$type)
            $type = "home";
        // check if found ContentSection['order'] or with same of $request['order'] if found replace between them
        if($order_no != $request['order']) {
            $order_found = ContentSection::where('order' , $request['order'])->where('type' , $type)->first();
            if($order_found) {
                $content_section->order = $request['order'];
                $order_found->order = $order_no;
                $order_found->save();
            }else{
                $content_section['order'] = $request['order'];
            }
        }
        $content_section->title = $request->title;
        $content_section->columns = $request->columns;
        $content_section->type = $request->type;
        $content_section->save();
        // save content section data
        $content_data_saved = ContentSectionData::where('section_id' ,$content_section['id'])->get();
        foreach($content_data_saved as $one){
            ContentSectionData::Destroy($one['id']);
        }
        foreach ($request->input('content') as $single_content){
            if($single_content != null) {
                $content_data_new = ContentSectionData::create([
                    'section_id' => $content_section->id,
                    'content' => $single_content,
                ]);
                if ($request->lang_id == null)
                    $content_data_new->lang_id = Language::where('code' , "ar")->first()->id;
                $content_data_new->lang_id = $request->lang_id;
                $content_data_new->save();
            }
        }
        // add data to section country table
        if ($request->country_id){
            $country_ids = $request->country_id;
            foreach ($country_ids as $single_id){
//                $section_country = SectionCountry::update([
//                    'section_id' => $content_section->id,
//                    'country_id' => $single_id,
//                ]);
                $section_country = SectionCountry::where('section_id',$content_section->id)->where('country_id',$single_id)->first();
                $section_country->save();

            }
        }
        $message = _i('Updated Successfully !');
        return back()->with(['success' => $message]);
    }

    public function destroy($id)
    {
        $section = ContentSection::findOrFail($id);
//        $section_products = ContentSectionProduct::where('section_id',$section->id)->get();
//        if(count($section_products) > 0) {
//            $message = _i('cannot delete related with product');
//            return back()->with(['warning' => $message]);
//        } else {
            $section->destroy($id);
            $message = trans('admin.delete_suc');
            return back()->with(['success' => $message]);
//        }
    }

    public function sort(Request $request)
    {
        if($request->ajax()){
            if($request->row_sort_hightId){
                $row_id = $request->row_sort_hightId;
                $content_section = ContentSection::findOrFail($row_id);
                $old_order = $content_section->order;
                if($old_order != 1){
                    $new_order = $content_section['order'] - 1 ;
                    $replace_content = ContentSection::where('order' , $new_order)->where('type' ,$content_section['type'])->first();
                    if($replace_content){
                        $replace_content->order = $old_order;
                        $replace_content->save();
                    }
                    $content_section->order = $new_order;
                    $content_section->save();
                    return response()->json(true);
                }
            }else{
                $row_id = $request->row_sort_bottomId;
                $content_section = ContentSection::findOrFail($row_id);
                $old_order = $content_section->order;
                if($old_order != 10){
                    $new_order = $content_section['order'] + 1 ;
                    $replace_content = ContentSection::where('order' , $new_order)->where('type' ,$content_section['type'])->first();
                    if($replace_content){
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
