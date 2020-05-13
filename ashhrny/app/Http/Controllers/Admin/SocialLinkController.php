<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SocialLinkDataTable;
use App\Http\Controllers\Controller;
use App\Models\SiteLanguage;
use App\Models\Social_link;
use App\Models\SocialLinkTranslation;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:SocialLink-Add'])->only('index');
        $this->middleware(['permission:SocialLink-Add'])->only('store');
        $this->middleware(['permission:SocialLink-Edit'])->only('update');
        $this->middleware(['permission:SocialLink-Delete'])->only('delete');
    }

    public function index(SocialLinkDataTable $social)
    {
        $langs = SiteLanguage::all();
        return $social->render('admin.social_link.index', compact('langs'));
    }


    public function store(Request $request)
    {
        $rules = [
            '*_title' => 'sometimes',
            'icon' => 'required'
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $social = Social_link::create(['icon' => $request->icon]);
//        if ($request->hasFile('icon')) {
//            $image = $request->file('icon');
//            $filename = time() . '.' . $image->getClientOriginalExtension();
//            $request->icon->move(public_path('uploads/social_link/'.$social->id), $filename);
//            $social->icon = '/uploads/social_link/'. $social->id .'/'. $filename;
//            $social->save();
//        }
        $langs = SiteLanguage::all();
        foreach ($langs as $lang) {
            $socialTranslation = SocialLinkTranslation::create([
                'title' => $request->get($lang->locale . '_title'),
                'locale' => $lang->locale,
            ]);
            $social->translations()->save($socialTranslation);
        }
        return response()->json(true);
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            $social = Social_link::findOrFail($id);
            $rules = [
                '*_title' => ['sometimes'],
            ];
            $validator = validator()->make($request->all(), $rules);
            if ($validator->fails())
                return redirect()->back()->withErrors($validator)->withInput();

            $social->update(['icon' => $request->icon]);
//            if ($request->hasFile('icon')) {
//                $image_path = $social->icon;  // Value is not URL but directory file path
//                if (File::exists(public_path($image_path))) {
//                    File::delete(public_path($image_path));
//                }
//                $image = $request->file('icon');
//                $filename = time() . '.' . $image->getClientOriginalExtension();
//                $request->icon->move(public_path('uploads/social_link/' . $social->id), $filename);
//                $social->icon = '/uploads/social_link/' . $social->id . '/' . $filename;
//                $social->save();
//            }

            $langs = SiteLanguage::all();
            foreach ($langs as $lang) {
                if ($social->translate($lang->locale)) {
                    $socialTranslation = SocialLinkTranslation::where('locale', $lang->locale)->where('social_id', $social->id)->first();
                } else {
                    $socialTranslation = new SocialLinkTranslation();
                }
                $socialTranslation->title = $request->get($lang->locale . '_title');
                $socialTranslation->locale = $lang->locale;
                $social->translations()->save($socialTranslation);
            }
            return response()->json(true);
        }
    }

    public function destroy($id)
    {
        $social = Social_link::findOrFail($id);
        $socialTranslations = SocialLinkTranslation::where('social_id', $social->id)->delete();
        $social->delete();
        return redirect(aurl('social_links'))->with('success', _i('success delete'));
    }
}
