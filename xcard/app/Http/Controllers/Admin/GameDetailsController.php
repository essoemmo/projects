<?php


namespace App\Http\Controllers\Admin;


use App\DataTables\GameDetailsDataTable;
use App\Http\Controllers\Controller;
use App\Models\GameDetail;
use App\Models\GameDetailTranslation;
use App\Models\SiteLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GameDetailsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:GameDetails-Add'])->only('index');
        $this->middleware(['permission:GameDetails-Add'])->only('store');
        $this->middleware(['permission:GameDetails-Edit'])->only('update');
        $this->middleware(['permission:GameDetails-Delete'])->only('delete');
    }

    public function index(GameDetailsDataTable $gameDetailsDataTables)
    {
        $langs = SiteLanguage::all();
        return $gameDetailsDataTables->render('admin.game_details.index' , compact('langs'));
    }


    public function store(Request $request)
    {
        $rules = [
            '*_title' => 'sometimes',
        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $game_details = GameDetail::create([]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/game_details/'.$game_details->id), $filename);
            $game_details->image = '/uploads/game_details/'. $game_details->id .'/'. $filename;
            $game_details->save();
        }
        $langs = SiteLanguage::all();
        foreach ($langs as $lang){
            $game_detailsTranslation = GameDetailTranslation::create([
                'title' => $request->get($lang->locale.'_title'),
                'locale' => $lang->locale,
            ]);
            $game_details->translations()->save($game_detailsTranslation);
        }
        return response()->json(true);
    }


    public function update(Request $request, $id)
    {
        //dd($request->file('logo'));
        if ($request->ajax()) {
            $game_details =  GameDetail::findOrFail($id);
            $rules = [
                '*_title' => ['sometimes'],
            ];
            $validator = validator()->make($request->all() , $rules);
            if($validator->fails())
                return redirect()->back()->withErrors($validator)->withInput();

            if ($request->hasFile('image')) {
                $image_path = $game_details->image;  // Value is not URL but directory file path
                if (File::exists(public_path($image_path))) {
                    File::delete(public_path($image_path));
                }
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/game_details/' . $game_details->id), $filename);
                $game_details->image = '/uploads/game_details/' . $game_details->id . '/' . $filename;
                $game_details->save();
            }

            $langs = SiteLanguage::all();
            foreach ($langs as $lang){
                if ($game_details->translate($lang->locale)){
                    $game_detailsTranslation = GameDetailTranslation::where('locale',$lang->locale)->where('game_detail_id',$game_details->id)->first();
                }else{
                    $game_detailsTranslation = new GameDetailTranslation();
                }
                $game_detailsTranslation->title = $request->get($lang->locale.'_title');
                $game_detailsTranslation->locale = $lang->locale;
                $game_details->translations()->save($game_detailsTranslation);
            }
            return response()->json(true);
        }

    }


    public function destroy($id)
    {
        $game_details =  GameDetail::findOrFail($id);
        $image_path = $game_details->image;  // Value is not URL but directory file path
        if(File::exists(public_path($image_path))) {
            File::delete(public_path($image_path));
        }
        $game_detailsTraslation = GameDetailTranslation::where('game_detail_id', $game_details->id)->delete();
        $game_details->delete();
        return redirect(aurl('game_details'))->with('success',_i('success delete'));
    }

}
