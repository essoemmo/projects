<?php


namespace App\Http\Controllers\Admin;


use App\DataTables\GameLanguagesDataTables;
use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\GenreTranslation;
use App\Models\Languages;
use App\Models\LanguageTranslation;
use App\Models\SiteLanguage;
use Illuminate\Http\Request;

class GameLanguagesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:GameLanguage-Add'])->only('index');
        $this->middleware(['permission:GameLanguage-Add'])->only('store');
        $this->middleware(['permission:GameLanguage-Edit'])->only('update');
        $this->middleware(['permission:GameLanguage-Delete'])->only('delete');
    }

    public function index(GameLanguagesDataTables $languagesDataTables)
    {
        $langs = SiteLanguage::all();
        return $languagesDataTables->render('admin.game_languages.index' , compact('langs'));
    }


    public function store(Request $request)
    {
        $rules = [
            '*_title' => 'sometimes',
        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $language = Languages::create([]);
        $langs = SiteLanguage::all();
        foreach ($langs as $lang){
            $languageTranslation = LanguageTranslation::create([
                'title' => $request->get($lang->locale.'_title'),
                'locale' => $lang->locale,
            ]);
            $language->translations()->save($languageTranslation);
        }
        return response()->json(true);
    }

    public function update(Request $request, $id)
    {
        $game_language =  Languages::findOrFail($id);
        $rules = [
            // '*_title' => ['sometimes' ,'unique:genre_translations,title,NULL,id,genre_id,'.$id],
            '*_title' => ['sometimes'],
        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        $langs = SiteLanguage::all();
        foreach ($langs as $lang){
            if ($game_language->translate($lang->locale)){
                $game_languageTranslation = LanguageTranslation::where('locale',$lang->locale)->where('language_id',$game_language->id)->first();
            }else{
                $game_languageTranslation = new LanguageTranslation();
            }
            $game_languageTranslation->title = $request->get($lang->locale.'_title');
            $game_languageTranslation->locale = $lang->locale;
            $game_language->translations()->save($game_languageTranslation);
        }
        return response()->json(true);
    }

    public function destroy($id)
    {
        $game_language = Languages::findOrFail($id);
        $game_languageTranslation = LanguageTranslation::where('language_id', $game_language->id)->delete();
        $game_language->delete();
        return redirect(aurl('game_languages'))->with('success',_i('success delete'));
    }

}
