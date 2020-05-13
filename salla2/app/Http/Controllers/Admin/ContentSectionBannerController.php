<?php


namespace App\Http\Controllers\Admin;


use App\Bll\Utility;
use App\DataTables\SectionBannerDataTable;
use App\Http\Controllers\Controller;
use App\Models\Content_section;
use App\Models\Content_section_title;
use App\Models\ContentSectionBanner;
use App\Models\ContentSectionProduct;
use App\Models\Language;
use App\Models\product\products;
use App\Models\Settings\Banner;
use Illuminate\Http\Request;

class ContentSectionBannerController extends Controller
{


    public function index(SectionBannerDataTable $sectionBannerDataTable)
    {
        return $sectionBannerDataTable->render('admin.section_banner.index');
    }

    public function edit($id)
    {
        $content = Content_section::findOrFail($id);
        $content_data = Content_section_title::where('section_id', $content->id)->first();
        $section_banner = ContentSectionBanner::where('content_section_id', $content->id)->get();

        $banners = Banner::query()->select('banners_data.name as name' ,'banners.id as id','banners_data.source_id' )
            ->leftJoin('banners_data','banners_data.banner_id','banners.id')
            ->where('banners_data.source_id', null)
            ->where('banners.published', 1)
            ->where('banners.store_id', Utility::getStoreId())
            ->pluck('banners_data.name','banners.id');
        $langs = Language::get();

        //dd($content);
        return view('admin.section_banner.edit',compact('langs','banners','content','content_data','section_banner'));
    }

    public function update(Request $request, $id)
    {
        $sessionStore = session()->get('StoreId');
        if($sessionStore== \App\Bll\Utility::$demoId){
            return redirect()->back()->with('success' , _i('Updated Successfully'));
        }

        $content = Content_section::findOrFail($id);

        if ($request->banners_ids != null) {
            ContentSectionBanner::where('content_section_id', $content->id)->delete();
            for ($ii = 0; $ii < count($request->banners_ids); $ii++) {
                $banner_id = $request->banners_ids[$ii];
                $section_id = $content->id;
                ContentSectionBanner::create([
                    'banner_id' => $banner_id,
                    'content_section_id' => $section_id,
                ]);
            }
        }
        return redirect()->route('section_banners.edit', $content->id)->with( 'success' , _i('Updated Successfully !'));
    }
}