<?php


namespace App\Http\Controllers\Admin;


use App\DataTables\RegionsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\RegionTranslation;
use App\Models\SiteLanguage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegionsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Region-Add'])->only('index');
        $this->middleware(['permission:Region-Add'])->only('store');
        $this->middleware(['permission:Region-Edit'])->only('update');
        $this->middleware(['permission:Region-Delete'])->only('delete');
    }

    public function index(RegionsDataTable $regionsDataTable)
    {
        return $regionsDataTable->render('admin.regions.index');
    }


    public function create()
    {
        $langs = SiteLanguage::all();
        return view('admin.regions.create',compact('langs'));
    }

    public function store(Request $request)
    {
        $rules = [
            '*_title' => 'sometimes',
            'code' =>  ['required','unique:regions'],
        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $langs = SiteLanguage::all();
        $region = Region::create([
            'code'=>$request->code,
        ]);

        foreach ($langs as $lang){
            $regionTranslation = new RegionTranslation();
            $regionTranslation->title = $request->get($lang->locale.'_title');
            $regionTranslation->locale = $lang->locale;
            $region->translations()->save($regionTranslation);
        }
        return redirect(aurl('regions'))->with('success',_i('success save'));
    }


    public function edit($id)
    {
        $region = Region::findOrFail($id);
        $langs = SiteLanguage::all();
        return view('admin.regions.edit',compact('langs','region'));
    }

    public function update(Request $request, $id)
    {
        $region = Region::findOrFail($id);
        $rules = [
            '*_title' => 'sometimes',
            'code' =>  ['required', Rule::unique('regions')->ignore($id)],
        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $langs = SiteLanguage::all();

        $region->update([
            'code'=>$request->code,
        ]);

        foreach ($langs as $lang){
            if ($region->translate($lang->locale)){
                $regionTranslation = RegionTranslation::where('locale',$lang->locale)->where('region_id',$region->id)->first();
            }else{
                $regionTranslation = new RegionTranslation();
            }
            $regionTranslation->title = $request->get($lang->locale.'_title');
            $regionTranslation->locale = $lang->locale;
            $region->translations()->save($regionTranslation);
        }
        return redirect(aurl('regions'))->with('success',_i('success update'));
    }



    public function destroy($id)
    {
        $region = Region::findOrFail($id);
        $regionTraslation = RegionTranslation::where('region_id', $region->id)->delete();
        $region->delete();
        return redirect(aurl('regions'))->with('success',_i('success delete'));
    }





}
