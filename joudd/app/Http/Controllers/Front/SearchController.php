<?php


namespace App\Http\Controllers\Front;


use App\Hr\Course\Co_category;
use App\Hr\Course\Course;
use App\Hr\Course\Course_co_category;
use App\Http\Controllers\Controller;
use App\Models\Countries;
use App\Models\CurrencyConvertor;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    private function getRate($country_code)
    {
        $convert = CurrencyConvertor::where('country_code',$country_code)->first();
        if($convert==null)
        {
            $convert = new \stdClass();
            $convert->rate =1;
            $convert->code ="usd";
        }
        return $convert ;
    }

    public function search(Request $request)
    {
        if($request->cookie('country_id') != null) {
            $country_id = $request->cookie('country_id');
        } else {
            $country_id = Countries::where('lang_id' , getLang(session('lang')))->first()->id;
        }

        $country = Countries::findOrFail($country_id);
        $convert = $this->getRate($country->code);


        if($request->parent_cat && $request->child_cat == null && $request->search_key == null)
        {
            $categories = Co_category::where('parent_id' , '=', $request->parent_cat)
                ->where('lang_id' , getLang(session('lang')))
                ->orderBy('id', 'desc')->paginate(6);
            return view('front.categories.parent_category' , compact('categories'));
        }
        elseif($request->parent_cat && $request->child_cat && $request->search_key == null)
        {
            $category = Co_category::where('id' , $request->child_cat)->where('parent_id' , $request->parent_cat)->first();
            $courses = Course_co_category::leftJoin('courses','courses.id','co_category_course.course_id')
                ->leftJoin('countries_courses','countries_courses.course_id','courses.id')
                ->where('co_category_course.co_category_id', $category->id)
                ->where('countries_courses.country_id',$country_id)
                ->where('courses.is_active', 1)
                ->where('courses.lang_id', getLang(session('lang')))
                ->select('courses.*','countries_courses.country_id','co_category_course.co_category_id')
                ->paginate(6);
            return view('front.categories.courses_category',compact('convert','courses','category'));
        }
        elseif($request->parent_cat && $request->child_cat && $request->search_key)
        {
            $category = Co_category::where('id' , $request->child_cat)->where('parent_id' , $request->parent_cat)->first();
            $courses = Course_co_category::leftJoin('courses','courses.id','co_category_course.course_id')
                ->leftJoin('countries_courses','countries_courses.course_id','courses.id')
                ->where('co_category_course.co_category_id', $category->id)
                ->where('countries_courses.country_id',$country_id)
                ->where('courses.is_active', 1)
                ->where('courses.lang_id', getLang(session('lang')))
                ->where('courses.title','like', "%$request->search_key%")
                ->select('courses.*','countries_courses.country_id','co_category_course.co_category_id')
                ->paginate(6);
//            dd(count($courses));
            return view('front.categories.courses_category',compact('convert','courses','category'));
        }
        elseif( ($request->parent_cat && $request->search_key) || ($request->search_key ) )
        {
            $courses = Course::leftJoin('countries_courses','countries_courses.course_id','courses.id')
                ->where('countries_courses.country_id',$country_id)
                ->where('courses.is_active', '=', 1)
                ->where('courses.lang_id', getLang(session('lang')))
                ->where('courses.title','like', "%$request->search_key%")
                ->orderBy('courses.id', 'desc')
                ->select('courses.*','countries_courses.country_id')
                ->paginate(6);
            return view('front.courses.courses',compact('courses','convert'));
        }else{

            return view('front.layout.not_found');
        }

    }


    public function child_categories(Request $request)
    {
        $cats = Co_category::where('parent_id' , $request->parent_id)
            ->where('lang_id' , getLang(session('lang')))
            ->orderBy('id', 'desc')
            ->pluck("cat_name","id");

        return $cats;
    }


}
