<?php


namespace App\Http\Controllers\Master;


use App\Bll\Constants;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Template;
use App\Models\TemplateData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;

class TemplatesController extends Controller
{

    public function index(Request $request)
    {
        if($request->ajax())
        {
            $templates = Template::leftJoin('template_data', 'template_data.template_id', 'templates.id')
                ->select('templates.*', 'template_data.template_id', 'template_data.lang_id', 'template_data.title')
                ->where('template_data.source_id', null)->get();

            return DataTables::of($templates)
                ->addColumn('action' ,function($query) {
                    $html = ' <a href="'. url('master/templates/'.$query->id.'/show') .'" id="item_id_' . $query->id . '" class="btn btn-primary btn-sm"  title="' . _i("Show").'">
                   <i class="ti ti-eye"></i></a>  &nbsp;'.'  ';

                    $langs = Language::get();
                    $options = '';
                    foreach ($langs as $lang) {
                        if ($lang->id != $query->lang_id){
                            $options .= '<li ><a href="#" data-toggle="modal" data-target="#langedit" class="lang_ex" data-id="'.$query->id.'" data-lang="'.$lang->id.'"
                    style="display: block; padding: 5px 10px 10px;">'.$lang->title.'</a></li>';
                        }
                    }
                    $html = $html.'
                <div class="btn-group">
                  <button type="button" class="btn btn-warning dropdown-toggle btn-sm" data-toggle="dropdown"  title=" '._i('Translation').' ">
                    <span class="ti ti-settings"></span>
                  </button>
                  <ul class="dropdown-menu" style="right: auto; left: 0; width: 5em; " >
                    '.$options.'
                  </ul>
                </div> ';
                    return $html;
                })
                ->editColumn('img' ,function($query) {
                    $url = asset($query['img']);
                    return '<img src='.$url.' border="0" class="img-responsive img-rounded" width="100px" height="60px" align="center" />';
                })
                ->editColumn('price' ,function($query) {
                    return $query['price']."  ".' <div class="badge badge-info">'. Constants::defaultCurrency .'</div>';
                })
                ->rawColumns(['action' ,'img' ,'price'])
                ->make(true);
        }

        return view('master.templates.index');
    }

    public function show($id)
    {
        $template = Template::findOrFail($id);
        $template_data = TemplateData::where('template_id' ,$id)->where('source_id' , null)->first();
        $langs = Language::get();

        return view('master.templates.show' , compact('template','template_data','langs'));
    }

    public function update($id , Request $request)
    {
        $template = Template::findOrFail($id);
        $template_data = TemplateData::where('template_id' ,$id)->where('source_id' , null)->first();

        $price = $request->price ?? 0;
        $template->update([
           'price' => $price,
        ]);

        $template_data->update([
            'title' => $request->title
        ]);


        if ($request->hasFile('img')) {
            $image_path = $template->img;
            if (File::exists(public_path($image_path))) {
                File::delete(public_path($image_path));
            }
            $image = $request->file('img');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $request->img->move(public_path('uploads/templates/' . $template->id), $filename);

            $template->img = '/uploads/templates/' . $template->id . '/' . $filename;
            $template->save();
        }

        return redirect()->back()->with('success' ,_i('Updated Successfully !'));
    }

    public function getLangvalue(Request $request){
        //dd($request->all());
        $rowData = TemplateData::where('template_id',$request->transRowId)
            //->where('lang_id',$request->lang_id)
            ->where('source_id',"!=", null)
            ->first(['title']);
        if (!empty($rowData)){
            return \response()->json(['data' => $rowData]);
        }else{
            return \response()->json(['data' => false]);

        }
    }

    public function storelangTranslation(Request $request){
        $rowData = TemplateData::where('template_id',$request->id)
            //->where('lang_id',$request->lang_id_data)
            ->where('source_id',"!=" , null)
            ->first();

        if ($rowData !== null) {

            $rowData->update([
                'title' => $request->title,
                'lang_id' => $request->lang_id_data,
            ]);

        }else{
            $parentRow = TemplateData::where('template_id',$request->id)->where('source_id' , null)->first();
            //dd($parentRow);
            TemplateData::create([
                'title' => $request->title,
                'lang_id' => $request->lang_id_data,
                'template_id' => $request->id,
                'source_id' => $parentRow->id,
            ]);
        }
        return \response()->json("SUCCESS");
    }

}