<?php


namespace App\Http\Controllers\Admin;


use App\DataTables\AccountContentDataTable;
use App\Http\Controllers\Controller;
use App\Models\AccountContent;
use App\Models\AccountContentTranslation;
use App\Models\SiteLanguage;
use Illuminate\Http\Request;

class AccountContentController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:ContentType-Add'])->only('index');
        $this->middleware(['permission:ContentType-Add'])->only('store');
        $this->middleware(['permission:ContentType-Edit'])->only('update');
        $this->middleware(['permission:ContentType-Delete'])->only('delete');
    }

    public function index(AccountContentDataTable $content)
    {
        $langs = SiteLanguage::all();
        return $content->render('admin.account_content.index' , compact('langs'));
    }



    public function store(Request $request)
    {
        $rules = [
            '*_title' => 'sometimes',
        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $content = AccountContent::create([]);

        $langs = SiteLanguage::all();
        foreach ($langs as $lang){
            $contentTranslation = AccountContentTranslation::create([
                'title' => $request->get($lang->locale.'_title'),
                'locale' => $lang->locale,
            ]);
            $content->translations()->save($contentTranslation);
        }
        return response()->json(true);
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            $content = AccountContent::findOrFail($id);
            $rules = [
                '*_title' => ['sometimes'],
            ];
            $validator = validator()->make($request->all() , $rules);
            if($validator->fails())
                return redirect()->back()->withErrors($validator)->withInput();

            $langs = SiteLanguage::all();
            foreach ($langs as $lang){
                if ($content->translate($lang->locale)){
                    $contentTranslation = AccountContentTranslation::where('locale',$lang->locale)->where('account_content_id',$content->id)->first();
                }else{
                    $contentTranslation = new AccountContentTranslation();
                }
                $contentTranslation->title = $request->get($lang->locale.'_title');
                $contentTranslation->locale = $lang->locale;
                $content->translations()->save($contentTranslation);
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
        $content = AccountContent::findOrFail($id);
        $contentTranslations = AccountContentTranslation::where('account_content_id' , $content->id)->delete();
        return redirect(aurl('account_content'))->with('success',_i('success delete'));
    }
}