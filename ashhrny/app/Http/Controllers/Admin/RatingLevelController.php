<?php


namespace App\Http\Controllers\Admin;


use App\DataTables\RatingDataTable;
use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\RatingTranslation;
use App\Models\SiteLanguage;
use Illuminate\Http\Request;

class RatingLevelController extends Controller
{


    public function __construct()
    {
        $this->middleware(['permission:RatingLevel-Add'])->only('index');
        $this->middleware(['permission:RatingLevel-Add'])->only('store');
        $this->middleware(['permission:RatingLevel-Edit'])->only('update_rate');
        $this->middleware(['permission:RatingLevel-Delete'])->only('delete');
    }

    public function index(RatingDataTable $rate)
    {
        $langs = SiteLanguage::all();
        return $rate->render('admin.ratings.index' , compact('langs'));
    }


    public function store(Request $request)
    {
        $rules = [
            '*_title' => 'sometimes',
        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $rate = Rating::create();

        $langs = SiteLanguage::all();
        foreach ($langs as $lang){
            $rateTranslation = RatingTranslation::create([
                'title' => $request->get($lang->locale.'_title'),
                'locale' => $lang->locale,
            ]);
            $rate->translations()->save($rateTranslation);
        }
        return response()->json(true);
    }

    public function update_rate(Request $request,$id)
    {
        if ($request->ajax()) {
            $rate =  Rating::findOrFail($id);
            $rules = [
                '*_title' => ['sometimes'],
            ];
            $validator = validator()->make($request->all() , $rules);
            if($validator->fails())
                return redirect()->back()->withErrors($validator)->withInput();

            $langs = SiteLanguage::all();
            foreach ($langs as $lang){
                if ($rate->translate($lang->locale)){
                    $rateTranslation = RatingTranslation::where('locale',$lang->locale)->where('rating_id',$rate->id)->first();
                }else{
                    $rateTranslation = new RatingTranslation();
                }
                $rateTranslation->title = $request->get($lang->locale.'_title');
                $rateTranslation->locale = $lang->locale;
                $rate->translations()->save($rateTranslation);
            }
            return response()->json(true);
        }
    }


    public function destroy($id)
    {
        $rate = Rating::findOrFail($id);
        $rateTranslations = RatingTranslation::where('rating_id' , $rate->id)->delete();
        return redirect(aurl('rating_levels'))->with('success',_i('success delete'));
    }

}