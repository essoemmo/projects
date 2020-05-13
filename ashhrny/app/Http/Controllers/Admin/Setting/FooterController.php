<?php


namespace App\Http\Controllers\Admin\Setting;


use App\DataTables\FooterDatatable;
use App\Http\Controllers\Controller;
use App\Models\Footer;
use App\Models\FooterTranslation;
use App\Models\SiteLanguage;
use Illuminate\Http\Request;

class FooterController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Footer-Add'])->only('index');
        $this->middleware(['permission:Footer-Add'])->only('store');
        $this->middleware(['permission:Footer-Edit'])->only('update');
        $this->middleware(['permission:Footer-Delete'])->only('delete');
    }

    public function index(FooterDatatable $footer)
    {
        $langs = SiteLanguage::all();
        return $footer->render('admin.footer.index' , compact('langs'));
    }

    public function store(Request $request)
    {
        $rules = [
            '*_title' => 'sometimes',
        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $footer = Footer::create(["url" => $request->url]);

        $langs = SiteLanguage::all();
        foreach ($langs as $lang){
            $footerTranslation = FooterTranslation::create([
                'title' => $request->get($lang->locale.'_title'),
                'locale' => $lang->locale,
            ]);
            $footer->translations()->save($footerTranslation);
        }
        return response()->json(true);
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            $footer = Footer::findOrFail($id);
            $rules = [
                '*_title' => ['sometimes'],
            ];
            $validator = validator()->make($request->all() , $rules);
            if($validator->fails())
                return redirect()->back()->withErrors($validator)->withInput();

            $footer->update(["url" => $request->url]);
            $langs = SiteLanguage::all();
            foreach ($langs as $lang){
                if ($footer->translate($lang->locale)){
                    $footerTranslation = FooterTranslation::where('locale',$lang->locale)->where('footer_id',$footer->id)->first();
                }else{
                    $footerTranslation = new FooterTranslation();
                }
                $footerTranslation->title = $request->get($lang->locale.'_title');
                $footerTranslation->locale = $lang->locale;
                $footer->translations()->save($footerTranslation);
            }
            return response()->json(true);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $footer = Footer::findOrFail($id);
        $footerTranslations = FooterTranslation::where('footer_id' , $footer->id)->delete();
        return redirect(aurl('footer'))->with('success',_i('success delete'));
    }


}