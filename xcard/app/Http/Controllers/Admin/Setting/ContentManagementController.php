<?php


namespace App\Http\Controllers\Admin\Setting;


//use App\Models\Content\ContentSection;
//use App\Models\Content\ContentSectionData;
//use App\Models\Content\SectionCountry;
//use App\Models\Language;
use App\Http\Controllers\Controller;
use App\Models\ContentSection;
use App\Models\ContentSectionTranslation;
use App\Models\Country;
use App\Models\SiteLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class ContentManagementController extends Controller
{

    public function index()
    {
        //dd($section = ContentSection::where('id' , 6)->first()->title);
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
                    <div class="pull-left" style="display:inline-block; !important;">
                    <a href="'.url("admin/content_management/".$query->id."/edit").'" class="btn btn-primary btn-sm"  title="' . _i("Edit") . '">
                   <i class="ti-pencil-alt"></i></a></div>
                   <form class="inline"  action="'.route('content_management.destroy',$query->id) .'"  method="POST"  style=" display: inline-block; right: 50px; bottom: 29px;">
                   <input type="hidden" name="_method" value="DELETE">
                   <input type="hidden" name="_token" value="' . csrf_token() . '">
                   <button type="submit" class="btn btn-danger  btn-sm "  title="' . _i("Delete") . '"> <span> <i class="ti-trash"></i></span></button>
                    </form>
                   </div> </div>';
                    return $html;
                })
                ->editColumn('order' , function($query){
                    $html = ' <div class="inline"> <div class="pull-left " style="display:inline-block; !important;"> '.$query['order'].'</div>
                    <div class="pull-right" style="display: inline-block;">
                    <a href="javascript:void(0)" class="btn  btn-sm sort_hight " data-id="'.$query['id'].'"   title="' . _i("Sort Up") . '">
                   <i class="ti-arrow-up "></i></a>
                    <a href="javascript:void(0)" class="btn  btn-sm sort_bottom" data-id="'.$query['id'].'" title="' . _i("Sort Down") . '">
                   <span style="color: #F00;" ><i class="ti-arrow-down "></i></span></a> </div> </div>
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
        $langs = SiteLanguage::all();
//        $country = Country::query()->select('countries_translations.title as title' ,'countries.id as id' )
//            ->leftJoin('countries_translations','countries_translations.country_id','=','countries.id')
//            ->where('locale',App::getLocale());

        return view('admin.content_management.create' ,compact('langs'));
    }

    public function store(Request $request)
    {
        //dd($request);
        $type = $request->get('type');
        if(!$type)
            $type = "home";

        $rules = [
           // 'title' =>  ['required', 'max:191', 'unique:content_sections'],
            //'type' =>  ['required'],
           // 'order' =>  ['required', 'unique:content_sections'],
            //'order' => 'unique:content_sections,order,NULL,id,type,'.$type //unique, when order is equal, but other field is different ('type')

        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        $content_section = ContentSection::create([
            //'title' => $request->title,
            'order' => $request->order,
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
        $langs = SiteLanguage::all();
        foreach ($langs as $lang){

            foreach ($request->get($lang->locale.'_content') as $single_content){
                if($single_content != null){
                    $contentTranslation = ContentSectionTranslation::create([
                        'content' => $single_content,
                        'title' => $request->get($lang->locale.'_title'),
                        'section_id' => $content_section->id,
                        'locale' => $lang->locale,
                    ]);
                    $content_section->translations()->save($contentTranslation);
                }
            }

        }

        return redirect(aUrl('content_management'))->with(['success' => 'success save']);
    }

    public function edit($id)
    {
        //dd(app()->getLocale());
        $content_section = ContentSection::findOrFail($id);
        $content_data = ContentSectionTranslation::where('content_section_id' ,$content_section['id'])
            ->where('locale', \app()->getLocale())->get();
        $langs = SiteLanguage::all();
        $content_data_title = ContentSectionTranslation::where('content_section_id' ,$content_section['id'])->get();
        //dd($content_section->translate('ar')->content);
      //  dd($content_section->translate('ar')->get());
        //dd(!empty($content_data[0]));
        return view('admin.content_management.edit' ,compact('langs','content_section','content_data','content_data_title'));
    }

    public function update(Request $request , $id)
    {
        //dd($request->ar_content);
        $content_section = ContentSection::findOrFail($id);
        $rules = [
          //  'title' =>  ['required', 'max:191', Rule::unique('content_sections')->ignore($id)],
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
       // $content_section->title = $request->title;
        $content_section->columns = $request->columns;
        $content_section->type = $request->type;
        $content_section->save();
        // save content section data
        $content_data_saved = ContentSectionTranslation::where('content_section_id' ,$content_section['id'])->get();
        foreach($content_data_saved as $one){
            ContentSectionTranslation::Destroy($one['id']);
        }

        $langs = SiteLanguage::all();
        foreach ($langs as $lang){

            foreach ($request->get($lang->locale.'_content') as $single_content){
                if($single_content != null){
                    $contentTranslation = ContentSectionTranslation::create([
                        'content' => $single_content,
                        'title' => $request->get($lang->locale.'_title'),
                        'locale' => $lang->locale,
                    ]);
                    $content_section->translations()->save($contentTranslation);
                }
            }
        }

        return redirect(aUrl('content_management'))->with(['success' => 'success update']);
    }

    public function destroy($id)
    {
        ContentSection::Destroy($id);
        return back()->with(['success' => 'success delete']);
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
