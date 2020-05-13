<?php


namespace App\Http\Controllers\Admin;


use App\DataTables\GenresDataTable;
use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\GenreTranslation;
use App\Models\SiteLanguage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GenresController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Genres-Add'])->only('index');
        $this->middleware(['permission:Genres-Add'])->only('store');
        $this->middleware(['permission:Genres-Edit'])->only('update');
        $this->middleware(['permission:Genres-Delete'])->only('delete');
    }

    public function index(GenresDataTable $genresDataTable)
    {
        $langs = SiteLanguage::all();
        return $genresDataTable->render('admin.genres.index' , compact('langs'));
    }

    public function store(Request $request)
    {
        $rules = [
            '*_title' => 'sometimes',
        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $genre = Genre::create([]);
        $langs = SiteLanguage::all();
        foreach ($langs as $lang){
            $genreTranslation = GenreTranslation::create([
                'title' => $request->get($lang->locale.'_title'),
                'locale' => $lang->locale,
            ]);
            $genre->translations()->save($genreTranslation);
        }
        //session()->flash('success','success save');
        return response()->json(true);
    }

    public function update(Request $request, $id)
    {
        $genre =  Genre::findOrFail($id);
        $rules = [
           // '*_title' => ['sometimes' ,'unique:genre_translations,title,NULL,id,genre_id,'.$id],
            '*_title' => ['sometimes'],
        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        $langs = SiteLanguage::all();
        foreach ($langs as $lang){
            if ($genre->translate($lang->locale)){
                $genreTranslation = GenreTranslation::where('locale',$lang->locale)->where('genre_id',$genre->id)->first();
            }else{
                $genreTranslation = new GenreTranslation();
            }
            $genreTranslation->title = $request->get($lang->locale.'_title');
            $genreTranslation->locale = $lang->locale;
            $genre->translations()->save($genreTranslation);
        }
        //session()->flash('success','success update');
        return response()->json(true);
    }


    public function destroy($id)
    {
        $genre = Genre::findOrFail($id);
        $regionTraslation = GenreTranslation::where('genre_id', $genre->id)->delete();
        $genre->delete();
        return redirect(aurl('genres'))->with('success',_i('success delete'));
    }

}
