<?php


namespace App\Http\Controllers\Admin;


use App\DataTables\PointDataTable;
use App\Http\Controllers\Controller;
use App\Models\Point;
use App\Models\PointTranslation;
use App\Models\SiteLanguage;
use App\Models\SliderTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PointsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Point-Add'])->only('index');
        $this->middleware(['permission:Point-Add'])->only('create');
        $this->middleware(['permission:Point-Edit'])->only('edit');
        $this->middleware(['permission:Point-Delete'])->only('destroy');

    }

    public function index(PointDataTable $point)
    {
        return $point->render('admin.point.index');
    }

    public function create()
    {
        $langs = SiteLanguage::all();
        return view('admin.point.create' , compact('langs'));
    }

    public function store(Request $request)
    {
        $point = Point::create(['points_number' => $request->points_number]);
        $langs = SiteLanguage::all();
        foreach ($langs as $lang){
            $pointTranslation = new PointTranslation();
            $pointTranslation->title = $request->get($lang->locale.'_title');
            $pointTranslation->description = $request->get($lang->locale.'_description');
            $pointTranslation->locale = $lang->locale;
            $point->translations()->save($pointTranslation);
        }
        //return redirect(aurl('points'))->with('success',_i('success save'));
        return redirect()->back()->with('success',_i('success save'));
    }

    public function edit($id)
    {
        $point = Point::findOrFail($id);
        //dd($point->points_number);
        $langs = SiteLanguage::all();
        return view('admin.point.edit' , compact('langs','point'));
    }

    public function update($id , Request $request)
    {
        $point = Point::findOrFail($id);
        $point->update([
            'points_number' => $request->points_number
        ]);
        $langs = SiteLanguage::all();

        foreach ($langs as $lang){
            if ($point->translate($lang->locale)){
                $pointTranslation = PointTranslation::where('locale',$lang->locale)->where('point_id',$point->id)->first();
            }else{
                $pointTranslation = new PointTranslation();
            }
            $pointTranslation->title = $request->get($lang->locale.'_title');
            $pointTranslation->description = $request->get($lang->locale.'_description');
            $pointTranslation->locale = $lang->locale;
            $point->translations()->save($pointTranslation);
        }
        return redirect()->back()->with('success',_i('success update'));
    }

    public function destroy($id)
    {
        $point = Point::findOrFail($id);
        $pointTranslations = PointTranslation::where('point_id' , $point->id)->delete();
        return redirect(aurl('points'))->with('success',_i('success delete'));
    }


}