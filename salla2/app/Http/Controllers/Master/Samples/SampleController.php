<?php

namespace App\Http\Controllers\Master\Samples;

use App\Http\Controllers\Controller;
use App\Models\product\stores;
use App\Sample;
use App\Models\Language;
use App\SampleData;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SampleController extends Controller
{

    public function get_samples()
    {
        $languages = Language::get();
        $samples = Sample::
             leftJoin('master_samles_data' ,'master_samles_data.sample_id','master_samples.id')
            ->leftJoin('stores', 'stores.id', '=', 'master_samples.store_id')
            ->select('master_samples.id as id', 'master_samples.img_url as img_url', 'master_samples.created_at as created_at', 'stores.title as title','master_samles_data.description as description')
            ->where('master_samles_data.source_id' , null)
            ->get();
        $stores = stores::all();
        return view('master.samples.index', compact('stores', 'samples','languages'));
    }

    public function getDatatableSamples()
    {
        $samples = Sample::
             leftJoin('master_samles_data' ,'master_samles_data.sample_id','master_samples.id')
            ->leftJoin('stores', 'stores.id', '=', 'master_samples.store_id')
            ->select('master_samples.id as id', 'master_samples.img_url as img_url', 'master_samples.created_at as created_at', 'stores.title as title','master_samles_data.description as description', 'master_samles_data.lang_id as lang_id')
            ->where('master_samles_data.source_id' , null)
            ->get();

        return DataTables::of($samples)
            ->addColumn('img_url', function ($query) {
                $url = asset('uploads/samples/' . $query->id . '/' . $query->img_url);
                return '<img src=' . $url . ' border="0" style="width: 80px; height: 80px;" class="img-responsive img-rounded" align="center" />';
            })
            ->addColumn('action', function ($samples) {

                $html = '<a href ='. $samples->id . '/edit'.' target="blank"
                class="btn waves-effect waves-light btn-primary edit text-center" title="{{_i("Edit")}}"><i class="ti-pencil-alt"></i></a>  &nbsp;'.'
                   <form class=" delete"  action="'.route("sample.destroy",$samples->id) .'"  method="POST" id="deleteRow"
                   style="display: inline-block; right: 50px;" >
                   <input name="_method" type="hidden" value="DELETE">
                   <input type="hidden" name="_token" value="' . csrf_token() . '">
                   <button type="submit" class="btn btn-danger" title=" '._i('Delete').' "> <span> <i class="ti-trash"></i></span></button>
                    </form>
                   </div>';

                $langs = Language::get();
                $options = '';
                foreach ($langs as $lang) {
                    if ($lang->id != $samples->lang_id){
                        $options .= '<li ><a href="#" data-toggle="modal" data-target="#langedit" class="lang_ex" data-id="'.$samples->id.'" data-lang="'.$lang->id.'"
                    style="display: block; padding: 5px 10px 10px;">'.$lang->title.'</a></li>';
                    }
                }
                $html = $html.'
                <div class="btn-group">
                  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"  title=" '._i('Translation').' ">
                    <span class="ti ti-settings"></span>
                  </button>
                  <ul class="dropdown-menu" style="right: auto; left: 0; width: 5em; " >
                    '.$options.'
                  </ul>
                </div> ';

                return $html;
            })
            ->rawColumns([
                'action',
                'img_url',

            ])
            ->make(true);
    }

    public function store_sample(Request $request)
    {

        $request['lang_id'] = $request['lang_id'] ?? Language::first()->id;

        $samples = Sample::
        leftJoin('master_samles_data' ,'master_samles_data.sample_id','master_samples.id')
       ->leftJoin('stores', 'stores.id', '=', 'master_samples.store_id')
       ->select('master_samples.id as id', 'master_samples.img_url as img_url', 'master_samples.created_at as created_at', 'stores.title as title','master_samles_data.description as description')
       ->get();
        $stores = stores::all();

        $rules = [
            'description' => 'required|string',
            'img_url' => 'required|image|mimes:jpeg,jpg,png,bmp,gif,svg',
        ];

        $sample = Sample::create([
            'store_id' => $request->store_id,
        ]);

        $image = $request->file('img_url');

        if ($image && $file = $image->isValid()) {
            $destinationPath = public_path('uploads/samples/'. $sample->id .'/');
            $extension = $image->getClientOriginalExtension();
            $fileName = $image->getClientOriginalName();
            $image->move($destinationPath, $fileName);
            $request->img_url = $fileName;
        }

        $sample->img_url = $request->img_url;

        $slider_data = SampleData::create([
            'sample_id' => $sample->id,
            'description' => $request->description,
            'lang_id' => $request->lang_id,
            'source_id' => null,
        ]);

        $sample->save();
        //dd($sample);
        return redirect()->back()->with(\compact('stores', 'samples'))->with(_i('flash_message', 'Added Successfully !'));

    }

    public function edit_sample($id)
    {
        $languages = Language::get();
        $sample = Sample::findOrFail($id);
        $sample_data = SampleData::where('sample_id' , $sample->id)->where('source_id',null)->first();
        $stores = stores::all();
        return view('master.samples.edit_sample', compact('stores', 'sample_data', 'sample', 'languages'));
    }

    public function update_sample(Request $request, $id)
    {
        $languages = Language::get();
        $sample = Sample::findOrFail($id);
        $stores = stores::all();
        $request['lang_id'] = $request['lang_id'] ?? Language::first()->id;
        $rules = [
            'description' => 'required|string',
            'img_url' => 'required|image|mimes:jpeg,jpg,png,bmp,gif,svg',
        ];

        if ($request->has('img_url')) {
            $image = $request->file('img_url');

            if ($image && $file = $image->isValid()) {
                if (!empty($sample->img_url)) {
                    //delete old image
                    $file = public_path('uploads/samples/' . $sample->id . '/') . $sample->img_url;
                    @unlink($file);
                }

                $destinationPath = public_path('uploads/samples/'. $sample->id .'/');
                $extension = $image->getClientOriginalExtension();
                $fileName = $image->getClientOriginalName();
                $image->move($destinationPath, $fileName);
                $request->img_url = $fileName;

//                $destinationPath = public_path('uploads/samples/' . $sample->id . '/');
//                $fileName = $image->getClientOriginalName();
//                $image->move($destinationPath, $fileName);
//                $request->img_url = $fileName;

            }
            $sample->img_url = $request->img_url ;
        }
        $sample->store_id = $request->store_id;

        $sample_data = SampleData::where('sample_id' , $sample->id)->where('source_id',null);
        $sample_data->update([
            'sample_id' => $sample->id,
            'lang_id' => $request['lang_id'],
            'source_id' => null,
            'description' => $request['description'],
        ]);
        $sample->save();
        return redirect('master/samples/all')->with('flash_message', _i('Updated Successfully !'));
    }



    public function sample_destroy($id)
    {
        $sampledata = SampleData::where('sample_id',$id)->delete();
        $sample = Sample::destroy($id);
        return redirect()->back()->with('flash_message', _i('Deleted Successfully !'));
    }

    public function samplegetLangvalue(Request $request){
        $rowData = SampleData::where('sample_id',$request->transRowId)
        ->where('source_id',"=" , null)
            ->first()->description;
        if (!empty($rowData)){
            return \response()->json(['data' => $rowData]);
        }else{
            return \response()->json(['data' => false]);
        }
    }

    public function samplestorelangTranslation(Request $request){
        //dd($request->all());
        $rowData = SampleData::where('sample_id',$request->id)
        ->where('source_id',"!=" , null)
            ->first();
        if ($rowData !== null) {
            $rowData->update([
                'description' => $request->input('description'),
                'lang_id' => $request->lang_id_data,
            ]);

        }else{

            $parentRow = SampleData::where('sample_id',$request->id)->where('source_id' , null)->first();
          //  dd($parentRow);
            SampleData::create([
                'description' => $request->input('description'),
                'lang_id' => $request->lang_id_data,
                'sample_id' => $request->id,
                'source_id' => $parentRow->id,
            ]);
        }
        return \response()->json("SUCCESS");
    }

}
