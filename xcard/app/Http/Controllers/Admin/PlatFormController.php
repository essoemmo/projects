<?php


namespace App\Http\Controllers\Admin;


use App\DataTables\PlatFormDataTable;
use App\Http\Controllers\Controller;
use App\Models\Platform;
use App\Models\PlatformTranslation;
use App\Models\SiteLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PlatFormController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:PlatForm-Add'])->only('index');
        $this->middleware(['permission:PlatForm-Add'])->only('store');
        $this->middleware(['permission:PlatForm-Edit'])->only('update');
        $this->middleware(['permission:PlatForm-Delete'])->only('delete');
    }

    public function index(PlatFormDataTable $platformDataTable) //platform_id
    {
        $langs = SiteLanguage::all();
        return $platformDataTable->render('admin.platform.index' , compact('langs'));
    }


    public function store(Request $request)
    {
        //dd($request->all());
        $rules = [
            '*_title' => 'sometimes',
        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $platform = Platform::create([]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/platform/'.$platform->id), $filename);

            $platform->image = '/uploads/platform/'. $platform->id .'/'. $filename;
            $platform->save();
        }
        $langs = SiteLanguage::all();
        foreach ($langs as $lang){
            $platFormTranslation = PlatformTranslation::create([
                'title' => $request->get($lang->locale.'_title'),
                'locale' => $lang->locale,
            ]);
            $platform->translations()->save($platFormTranslation);
        }
        //session()->flash('success','success save');
        return response()->json(true);
    }


    public function update(Request $request, $id)
    {
       // dd($request->file('image'));
        if ($request->ajax()) {
            $platform =  Platform::findOrFail($id);
            $rules = [
                '*_title' => ['sometimes'],
            ];
            $validator = validator()->make($request->all() , $rules);
            if($validator->fails())
                return redirect()->back()->withErrors($validator)->withInput();

            if ($request->hasFile('image')) {
                $image_path = $platform->image;  // Value is not URL but directory file path
                if (File::exists(public_path($image_path))) {
                    File::delete(public_path($image_path));
                }
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/platform/' . $platform->id), $filename);

                $platform->image = '/uploads/platform/' . $platform->id . '/' . $filename;
                $platform->save();
            }

            $langs = SiteLanguage::all();
            foreach ($langs as $lang){
                if ($platform->translate($lang->locale)){
                    $platformTranslation = PlatformTranslation::where('locale',$lang->locale)->where('platform_id',$platform->id)->first();
                }else{
                    $platformTranslation = new PlatformTranslation();
                }
                $platformTranslation->title = $request->get($lang->locale.'_title');
                $platformTranslation->locale = $lang->locale;
                $platform->translations()->save($platformTranslation);
            }
            //session()->flash('success','success update');
            return response()->json(true);
        }

    }


    public function destroy($id)
    {
        $platform =  Platform::findOrFail($id);
        $image_path = $platform->image;  // Value is not URL but directory file path
        if(File::exists(public_path($image_path))) {
            File::delete(public_path($image_path));
        }
        $platformTraslation = PlatformTranslation::where('platform_id', $platform->id)->delete();
        $platform->delete();
        return back()->with('success','success delete');
    }

}
