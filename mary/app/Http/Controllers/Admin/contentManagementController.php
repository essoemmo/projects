<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ContentSectionDataTable;
use App\Models\Content_section;
use App\Models\Content_section_data;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class contentManagementController extends Controller
{
        public function index(){
            if (request()->ajax()) {
                $section = Content_section::query();

                if(\request()->type){
                    $section = Content_section::query()->where('system_type' , \request()->type);
                }
                return DataTables::eloquent($section)
                    ->order(function ($query) {
                        $query->orderBy('order', 'asc');
                    })
                    ->addColumn('action' ,function($query) {
                        $html = '<div class="inline">
                    <div class="pull-left" style="display:inline-block; !important;">
                    <a href="'.route("contentManagement.edit",$query->id).'" class="btn btn-primary btn-sm"  title="' . _i("Edit") . '">
                   <i class="fa fa-edit"></i></a></div>
                   <form class="inline"  action="'.route('contentManagement.destroy',$query->id) .'"  method="POST"  style=" display: inline-block; right: 50px; bottom: 29px;">
                   <input type="hidden" name="_method" value="DELETE">
                   <input type="hidden" name="_token" value="' . csrf_token() . '">
                   <button type="submit" class="btn btn-danger  btn-sm "  title="' . _i("Delete") . '"> <span> <i class="fa fa-trash"></i></span></button>
                    </form>
                   </div> </div>';
                        return $html;
                    })
                    ->editColumn('order' , function($query){
                        $html = ' <div class="inline"> <div class="pull-left " style="display:inline-block; !important;"> '.$query['order'].'</div>
                    <div class="pull-right" style="display: inline-block;">
                    <a href="javascript:void(0)" class="btn  btn-sm sort_hight " data-id="'.$query['id'].'"   title="' . _i("Sort Up") . '">
                   <i class="fas fa-arrow-circle-up"></i></a>
                    <a href="javascript:void(0)" class="btn  btn-sm sort_bottom" data-id="'.$query['id'].'" title="' . _i("Sort Down") . '">
                   <span style="color: #F00;" ><i class="fas fa-arrow-circle-down"></i></span></a> </div> </div>
                    ';
                        return $html;
                    })
                    ->rawColumns([
                        'order',
                        'action',
                    ])
                    ->make(true);
            }
            return view('admin.contentSection.index');

        }

    public function create()
    {
        $langs = Language::get();
//        $country = Country::query()->select('countries_translations.title as title' ,'countries.id as id' )
//            ->leftJoin('countries_translations','countries_translations.country_id','=','countries.id')
//            ->where('locale',App::getLocale());

        return view('admin.contentSection.create' ,compact('langs'));
    }

    public function store(Request $request)
    {

        $type = $request->get('type');
        if(!$type)
            $type = "home";

        $rules = [
            'title' =>  ['required', 'max:191', 'unique:content_section'],
            // 'type' =>  ['required'],
            // 'order' =>  ['required', 'unique:content_sections'],
            //'order' => 'unique:content_sections,order,NULL,id,type,'.$type //unique, when order is equal, but other field is different ('type')

        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $content_section = Content_section::create([
            'title' => $request->title,
            'order' => $request->order,
            'columns' => $request->columns,
            'type' => $type,
            'system_type' => $request->system_type,
        ]);

        $order_request = $request->order;
        $order_found = Content_section::where('type' ,$content_section['type'])->where('order', $order_request)->first();
        if(!$order_found){
            $content_section->order = $order_request;
            $content_section->save();
        }else{
            $last_order = Content_section::where('type' ,$content_section['type'])->orderBy('order', 'desc')->first();
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
//dd($request->lang_id);
        foreach ($request->input('content') as $single_content){
            if($single_content != null){
                $defaultlang= Language::where('code' , "ar")->first()->id;
                $content_data = Content_section_data::create([
                    'section_id' => $content_section->id,
                    'content' => $single_content,
                    'lang_id' =>$request->lang_id == null ? $defaultlang  : $request->lang_id,
                ]);
            }
        }
        $message = _i('add_successflly');
        return back()->with(['success' => $message]);
    }

    public function edit($id)
    {
        $content_section = Content_section::findOrFail($id);
        $content_data = Content_section_data::where('section_id' ,$content_section['id'])->get();
        $languages = Language::all();
        return view('admin.contentSection.edit' ,compact('languages','content_section','content_data'));
    }
    public function update(Request $request , $id)
    {
        $content_section = Content_section::findOrFail($id);
        $rules = [
            'title' =>  ['required', 'max:191', Rule::unique('content_section')->ignore($id)],
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
            $order_found = Content_section::where('order' , $request['order'])->where('type' , $type)->first();
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
        $content_section->system_type = $request->system_type;
        $content_section->save();
        // save content section data
        $content_data_saved = Content_section_data::where('section_id' ,$content_section['id'])->get();
        foreach($content_data_saved as $one){
            Content_section_data::Destroy($one['id']);
        }
        foreach ($request->input('content') as $single_content){
            if($single_content != null) {
                $defaultlang= Language::where('code' , "ar")->first()->id;
                $content_data_new = Content_section_data::create([
                    'section_id' => $content_section->id,
                    'content' => $single_content,
                    'lang_id' =>$request->lang_id == null ? $defaultlang  : $request->lang_id,
                ]);
                $content_data_new->save();
            }
        }
        $message = trans('edit_suc');
        return back()->with(['success' => $message]);
    }// end update function



    public function destroy($id)
    {
        Content_section::Destroy($id);
        $message = trans('delete_suc');
        return back()->with(['success' => $message]);
    }// end destroy function



    public function sort(Request $request)
    {
        if($request->ajax()){

            if($request->row_sort_hightId){
                $row_id = $request->row_sort_hightId;
                $content_section = Content_section::findOrFail($row_id);
                $old_order = $content_section->order;
                if($old_order != 1){
                    $new_order = $content_section['order'] - 1 ;
                    $replace_content = Content_section::where('order' , $new_order)->where('type' ,$content_section['type'])->first();
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
                $content_section = Content_section::findOrFail($row_id);
                $old_order = $content_section->order;
                if($old_order != 10){
                    $new_order = $content_section['order'] + 1 ;
                    $replace_content = Content_section::where('order' , $new_order)->where('type' ,$content_section['type'])->first();
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
