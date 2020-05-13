<?php

namespace App\Http\Controllers;

use App\Hr\Course\Co_category;
use App\Hr\Course\Exam;
use App\Models\Admin\CourseMedia;
use App\Front\Category;
use App\Hr\Course\Applicant;
use App\Hr\Course\Applicant_course_pending;
use App\Hr\Course\ApplicantCourse;
use App\Hr\Course\Course;
use App\Hr\Course\Course_co_category;
use App\Models\Article\Artcl_category;
use App\Models\Article\Article;
use App\Models\Competition;
use App\Models\Contact;
use App\Models\Countries;
use App\Models\CurrencyConvertor;
use App\Models\OrderCourses;
use App\Models\Orders;
use App\Models\rating\rating;
use App\Models\transactions;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class HomeController extends Controller {

    public function lang($lang) {
        //dd($lang);
        session()->has('lang') ? session()->forget('lang') : '';
        $lang == 'ar' ? session()->put('lang', 'ar') : session()->put('lang', 'en');
        return Redirect::to(URL::previous());
    }

    public function index(Request $request) {
        
        // dd(getLang(session('lang')));
        if ($request->cookie('country_id') != null) {
            $country_id = $request->cookie('country_id');
        } else {
//            $country_id = 1;
            $country_id = Countries::where('lang_id', getLang(session('lang')))->first()->id;
        }

        $country = Countries::findOrFail($country_id);
        $convert = $this->getRate($country->code);

//        dd($request->a);
        //student register form
        $categories_nav = Category::limit(6)->get();
        $countries = countries::where('lang_id', getLang(session('lang')))->get();
        $courses = Course::where('is_active', '=', 1)->get();
        $edu_levels = \App\Models\Admin\EducationLevel::where('lang_id', getLang(session('lang')))->where('country_id', $country_id)->get();

        $gallery = DB::table('galleries')->where('published', '=', 1)
                        ->where('lang_id', getLang(session('lang')))->latest()->paginate(3);

        $courses = Course::leftJoin('countries_courses', 'countries_courses.course_id', 'courses.id')
                ->where('countries_courses.country_id', $country_id)
                ->where('courses.is_active', '=', 1)
                ->where('courses.lang_id', getLang(session('lang')))
                ->orderBy('courses.id', 'desc')
                ->select('courses.*', 'countries_courses.country_id')
                ->paginate(6);
        if (count($courses) == 0) {
            $courses = Course::leftJoin('countries_courses', 'countries_courses.course_id', 'courses.source_id')
                    ->where('countries_courses.country_id', $country_id)
                    ->where('courses.is_active', '=', 1)
                    ->where('courses.lang_id', getLang(session('lang')))
                    ->orderBy('courses.id', 'desc')
                    ->select('courses.*', 'countries_courses.country_id')
                    ->paginate(6);
        }
        $categories_nav = Co_category::where('lang_id', getLang(session('lang')))->limit(6)->get();
        $categories = Co_category::where('parent_id', '=', null)->where('lang_id', getLang(session('lang')))->orderBy('id', 'desc')->paginate(6);
        $competitions = Competition::leftJoin('exams', 'exams.type_id', 'competition.id')
                ->leftJoin('exam_data', 'exam_data.exam_id', 'exams.id')
                ->where('competition.is_active', 1)
                ->where('exam_data.lang_id', getLang(session('lang')))
                ->where('competition.end', '>=', Carbon::today())
                ->select('competition.*', 'exam_data.exam_id', 'exam_data.description')
                ->limit(4)
                ->get();
        return view('front.home', compact('convert', 'gallery', 'courses', 'categories_nav', 'categories', 'competitions', 'categories_nav', 'countries', 'courses', 'edu_levels'));
    }

    public function category_parent($parent_id) {
        $categories = Co_category::where('parent_id', '=', $parent_id)
                        ->where('lang_id', getLang(session('lang')))
                        ->orderBy('id', 'desc')->paginate(6);
        if (count($categories) == 0) {
            return \redirect('category/' . $parent_id);
        }
        return view('front.categories.parent_category', compact('categories'));
    }

    private function getRate($country_code) {
        $convert = CurrencyConvertor::where('country_code', $country_code)->first();
        if ($convert == null) {
            $convert = new \stdClass();
            $convert->rate = 1;
            $convert->code = "usd";
        }
        return $convert;
    }

    public function courses(Request $request) {
        if ($request->cookie('country_id') != null) {
            $country_id = $request->cookie('country_id');
        } else {
//            $country_id = 1;
            $country_id = Countries::where('lang_id', getLang(session('lang')))->first()->id;
        }

        $country = Countries::findOrFail($country_id);
        $convert = $this->getRate($country->code);

        $categories_nav = Co_category::where('lang_id', getLang(session('lang')))->limit(6)->get();
        $courses = Course::leftJoin('countries_courses', 'countries_courses.course_id', 'courses.id')
                ->where('countries_courses.country_id', $country_id)
                ->where('courses.is_active', '=', 1)
                ->where('courses.lang_id', getLang(session('lang')))
                ->orderBy('courses.id', 'desc')
                ->select('courses.*', 'countries_courses.country_id')
                ->paginate(6);
        return view('front.courses.courses', compact('convert', 'courses', 'categories_nav'));
    }

    public function course($id, Request $request) {
        $categories_nav = Co_category::where('lang_id', getLang(session('lang')))->limit(6)->get();
        $course = Course::FindOrFail($id);
        $trainer = User::findOrFail($course->user_id);
        $quiz = Exam::where('type_id', $course->id)->first();
        $applicants_count = ApplicantCourse::where('course_id', $course->id)->count('applicant_id');
        $course_owned = ApplicantCourse::where('applicant_id', auth()->id())->where('course_id', $course->id)->exists();
        $course_pending = Applicant_course_pending::where('applicant_id', auth()->id())->where('course_id', $course->id)->exists();
        $media = CourseMedia::leftJoin('course_media_data', 'course_media_data.media_id', 'course_media.id')
                ->where('course_id', $course->id)
                ->where('is_active', 1)
                ->where('course_media_data.lang_id', getLang(session('lang')))
                ->get();
        $media_buy = CourseMedia::leftJoin('course_media_data', 'course_media_data.media_id', 'course_media.id')
                ->where('course_id', $course->id)
                ->where('is_active', 1)
                ->where('course_media_data.lang_id', getLang(session('lang')))
                ->pluck('course_media.id')
                ->toArray();
        $media_owned = DB::table(\App\Model\Views::$vwUsermedia)
                ->where('user_id', auth()->id())
                ->where('course_id', $course->id)
                ->pluck('media_id')
                ->toArray();
        $rating = rating::where('course_id', $course->id)->first();
        $path = "course_media/" . $course->id;
        $files = Storage::allFiles($path);
        if ($request->cookie('country_id') != null) {
            $country_id = $request->cookie('country_id');
        } else {
            $country_id = Countries::where('lang_id', getLang(session('lang')))->first()->id;
        }
        $country = Countries::findOrFail($country_id);
        $convert = $this->getRate($country->code);
        $category = Course_co_category::leftJoin('co_categories', 'co_categories.id', 'co_category_course.co_category_id')
                ->where('co_category_course.course_id', $course->id)
                ->first();
        if ($category == null) {
            $category = Course_co_category::leftJoin('co_categories', 'co_categories.id', 'co_category_course.co_category_id')
                    ->where('co_category_course.course_id', $course->source_id)
                    ->first();
        }
        $courses = Course_co_category::leftJoin('courses', 'courses.id', 'co_category_course.course_id')
                ->leftJoin('co_categories', 'co_categories.id', 'co_category_course.co_category_id')
                ->leftJoin('countries_courses', 'countries_courses.course_id', 'courses.id');
        if (isset($category)) {
            $courses = $courses->where('co_category_course.co_category_id', $category->id);
        }
        if (isset($course)) {
            $courses = $courses->where('co_category_course.course_id', '!=', $course->id);
        }

        $courses = $courses->where('countries_courses.country_id', $country_id)
                ->where('courses.is_active', 1)
                ->where('courses.lang_id', getLang(session('lang')))
                ->limit(4)
                ->get();
        if ($course->is_active == 1) {
            if ($course_owned) {
                return view('front.courses.course_after_enroll', compact('quiz', 'files', 'trainer', 'rating', 'course', 'categories_nav', 'category', 'courses', 'media', 'applicants_count'));
            }
            if ($course_pending == true) {
                return Redirect::route('enroll', $id);
            }
            foreach ($media_buy as $item) {
                if (in_array($item, $media_owned)) {
                    return Redirect::route('single_courseMedia', $course->id);
                }
            }
            return view('front.courses.single_course', compact('convert', 'course_owned', 'files', 'trainer', 'rating', 'course', 'categories_nav', 'category', 'courses', 'media', 'applicants_count', 'quiz'));
        } else {
            return view('not-found');
        }
    }

    public function courseMedia($id, Request $request) {
        if ($request->cookie('country_id') != null) {
            $country_id = $request->cookie('country_id');
        } else {
            $country_id = Countries::where('lang_id', getLang(session('lang')))->first()->id;
        }
        $categories_nav = Co_category::where('lang_id', getLang(session('lang')))->limit(6)->get();
        $course = Course::findOrFail($id);
        $trainer = User::findOrFail($course->user_id);
        $quiz = Exam::where('type_id', $course->id)->first();
        $applicants_count = ApplicantCourse::where('course_id', $course->id)->count('applicant_id');
        $category = Course_co_category::leftJoin('co_categories', 'co_categories.id', 'co_category_course.co_category_id')
                ->where('co_category_course.course_id', $course->id)
                ->first();
        $rating = rating::where('course_id', $course->id)->first();
        $path = "course_media/" . $course->id;
        $files = Storage::allFiles($path);
        $courses = Course_co_category::leftJoin('courses', 'courses.id', 'co_category_course.course_id')
                ->leftJoin('co_categories', 'co_categories.id', 'co_category_course.co_category_id')
                ->leftJoin('countries_courses', 'countries_courses.course_id', 'courses.id')
                ->where('co_category_course.co_category_id', $category->id)
                ->where('co_category_course.course_id', '!=', $course->id)
                ->where('countries_courses.country_id', $country_id)
                ->where('courses.is_active', 1)
                ->where('courses.lang_id', getLang(session('lang')))
                ->limit(4)
                ->get();
        $course_media = CourseMedia::leftJoin('course_media_data', 'course_media_data.media_id', 'course_media.id')
                ->where('course_id', $course->id)
                ->where('is_active', 1)
                ->where('course_media_data.lang_id', getLang(session('lang')))
                ->get();
        $allMedia = DB::table(\App\Model\Views::$vwUsermedia)
                ->leftJoin('course_media', 'course_media.id', \App\Model\Views::$vwUsermedia . '.media_id')
                ->leftJoin('course_media_data', 'course_media_data.media_id', 'course_media.id')
                ->where('course_media.is_active', 1)
                ->where('course_media_data.lang_id', getLang(session('lang')))
                ->where(\App\Model\Views::$vwUsermedia . '.user_id', auth()->id())
                ->where(\App\Model\Views::$vwUsermedia . '.course_id', $course->id)
                ->get();
        $media_buy = CourseMedia::leftJoin('course_media_data', 'course_media_data.media_id', 'course_media.id')
                ->where('course_id', $course->id)
                ->where('is_active', 1)
                ->where('course_media_data.lang_id', getLang(session('lang')))
                ->pluck('course_media.id')
                ->toArray();
        $media_owned = DB::table(\App\Model\Views::$vwUsermedia)
                ->where('user_id', auth()->id())
                ->where('course_id', $course->id)
                ->pluck('media_id')
                ->toArray();
        if ($course->is_active == 1) {
            if ($course->lang_id == getLang(session('lang'))) {
                return view('front.courses.course_media_after_enroll', compact('course_media', 'media_buy', 'media_owned', 'allMedia', 'quiz', 'files', 'trainer', 'rating', 'course', 'categories_nav', 'category', 'courses', 'applicants_count'));
            } else {
                return view('not-found');
            }
        } else {
            return view('not-found');
        }
    }

    public function subscribe($id) {
        if (auth()->check()) {
            $course = Course::FindOrFail($id);
            $user = User::findOrFail(auth()->id());
            $applicant = Applicant::where('user_id', $user->id)->firstOrFail();
            if ($course->cost == 0) {
                $pending = new ApplicantCourse();
                $pending->applicant_id = $applicant->id;
                $pending->course_id = $course->id;
                $pending->is_paid = 1;
                $pending->created = Carbon::now();
                $pending->cost = $course->cost;
                $pending->amount = 1;
                $pending->cert_no = 0;
                $pending->save();
                return Redirect::route('single_course', $id);
            }
            $order = OrderCourses::where('course_id', $course->id)->first();
            $transaction = transactions::where('order_id', $order->id)->first();
            if ($transaction->bank_id != null) {
                $pending = new Applicant_course_pending();
                $pending->applicant_id = $applicant->id;
                $pending->course_id = $course->id;
                $pending->is_paid = 0;
                $pending->amount = 1;
                $pending->cost = $course->cost;
                $pending->created = Carbon::now();
                $pending->transaction_id = $transaction->transaction_no;
                $pending->transaction_type = 0;
                $pending->holder_name = $user->first_name . ' ' . $user->last_name;
                $pending->save();
                return Redirect::route('enroll', $id);
            }
            if ($transaction->type_id != null) {
                $pending = new ApplicantCourse();
                $pending->applicant_id = $applicant->id;
                $pending->course_id = $course->id;
                $pending->is_paid = 1;
                $pending->amount = 1;
                $pending->cost = $course->cost;
                $pending->transaction_id = $transaction->transaction_no;
                $pending->transaction_type = 1;
                $pending->holder_name = $user->first_name . ' ' . $user->last_name;
                $pending->created = Carbon::now();
                $pending->save();
                return Redirect::route('single_course', $id);
            }
        } else {
            return redirect('user/login');
        }
    }

    public function subscribeMedia($id) {
        if (auth()->check()) {
            $media = CourseMedia::FindOrFail($id);
            $course = Course::FindOrFail($media->course_id);
            $user = User::findOrFail(auth()->id());
            $applicant = Applicant::where('user_id', $user->id)->firstOrFail();
            if ($media->cost == 0) {
                $pending = new ApplicantCourse();
                $pending->applicant_id = $applicant->id;
                $pending->media_id = $media->id;
                $pending->is_paid = 1;
                $pending->created = Carbon::now();
                $pending->cost = $media->cost;
                $pending->amount = 1;
                $pending->cert_no = 0;
                $pending->save();
                return Redirect::route('single_course', $course->id);
            }
            $order = OrderCourses::where('course_id', $media->id)->first();
            $transaction = transactions::where('order_id', $order->id)->first();
            if ($transaction->bank_id != null) {
                $pending = new Applicant_course_pending();
                $pending->applicant_id = $applicant->id;
                $pending->media_id = $media->id;
                $pending->is_paid = 0;
                $pending->amount = 1;
                $pending->cost = $media->cost;
                $pending->created = Carbon::now();
                $pending->transaction_id = $transaction->transaction_no;
                $pending->transaction_type = 0;
                $pending->holder_name = $user->first_name . ' ' . $user->last_name;
                $pending->save();
                return Redirect::route('enrollMedia', $id);
            }
            if ($transaction->type_id != null) {
                $pending = new ApplicantCourse();
                $pending->applicant_id = $applicant->id;
                $pending->media_id = $media->id;
                $pending->is_paid = 1;
                $pending->amount = 1;
                $pending->cost = $media->cost;
                $pending->transaction_id = $transaction->transaction_no;
                $pending->transaction_type = 1;
                $pending->holder_name = $user->first_name . ' ' . $user->last_name;
                $pending->created = Carbon::now();
                $pending->save();
                return Redirect::route('single_course', $course->id);
            }
        } else {
            return redirect('user/login');
        }
    }

    public function enroll($id, Request $request) {
        if (auth()->check()) {
            if ($request->cookie('country_id') != null) {
                $country_id = $request->cookie('country_id');
            } else {
                $country_id = Countries::where('lang_id', getLang(session('lang')))->first()->id;
            }

            $categories_nav = Co_category::where('lang_id', getLang(session('lang')))->limit(6)->get();
            $course = Course::FindOrFail($id);
            $path = "course_media/" . $course->id;
            $files = Storage::allFiles($path);

            $trainer = User::findOrFail($course->user_id);
            $category = Course_co_category::leftJoin('co_categories', 'co_categories.id', 'co_category_course.co_category_id')
                    ->where('co_category_course.course_id', $course->id)
                    ->first();
            $user = auth()->id();
            $applicant = Applicant::where('user_id', $user)->first();
            $pending = Applicant_course_pending::where('applicant_id', $applicant->id)->where('course_id', $course->id)->first();
            $media = CourseMedia::where('course_id', $course->id)->where('is_active', 1)->get();
            $courses = Course_co_category::leftJoin('courses', 'courses.id', 'co_category_course.course_id')
                    ->leftJoin('co_categories', 'co_categories.id', 'co_category_course.co_category_id')
                    ->leftJoin('countries_courses', 'countries_courses.course_id', 'courses.id')
                    ->where('co_category_course.co_category_id', $category->id)
                    ->where('co_category_course.course_id', '!=', $course->id)
                    ->where('countries_courses.country_id', $country_id)
                    ->where('courses.is_active', 1)
                    ->where('courses.lang_id', getLang(session('lang')))
                    ->limit(4)
                    ->get();
            $rating = rating::where('course_id', $course->id)->first();
            $applicant = ApplicantCourse::where('course_id', $course->id)->where('applicant_id', auth()->id())->first();
            $course_owned = ApplicantCourse::where('applicant_id', auth()->id())->where('course_id', $course->id)->exists();
            if ($course_owned == true) {
                return Redirect::route('single_course', $id);
            }
            return view('front.courses.enroll_course', compact('applicant', 'files', 'trainer', 'course', 'categories_nav', 'pending', 'media', 'courses', 'rating'));
        } else {
            return redirect('user/login');
        }
    }

    public function enrollMedia($id, Request $request) {
        if (auth()->check()) {
            if ($request->cookie('country_id') != null) {
                $country_id = $request->cookie('country_id');
            } else {
//                $country_id = 1;
                $country_id = Countries::where('lang_id', getLang(session('lang')))->first()->id;
            }

            $categories_nav = Co_category::where('lang_id', getLang(session('lang')))->limit(6)->get();
            $media = CourseMedia::FindOrFail($id);
            $course = Course::findOrFail($media->course_id);
            $path = "course_media/" . $course->id;
            $files = Storage::allFiles($path);

            $trainer = User::findOrFail($course->user_id);
            $category = Course_co_category::leftJoin('co_categories', 'co_categories.id', 'co_category_course.co_category_id')
                    ->where('co_category_course.course_id', $course->id)
                    ->first();
            $user = auth()->id();
            $applicant = Applicant::where('user_id', $user)->first();
            $pending = Applicant_course_pending::where('applicant_id', $applicant->id)->where('media_id', $media->id)->first();
            $media = CourseMedia::where('course_id', $course->id)->where('is_active', 1)->get();
            $courses = Course_co_category::leftJoin('courses', 'courses.id', 'co_category_course.course_id')
                    ->leftJoin('co_categories', 'co_categories.id', 'co_category_course.co_category_id')
                    ->leftJoin('countries_courses', 'countries_courses.course_id', 'courses.id')
                    ->where('co_category_course.co_category_id', $category->id)
                    ->where('co_category_course.course_id', '!=', $course->id)
                    ->where('countries_courses.country_id', $country_id)
                    ->where('courses.is_active', 1)
                    ->where('courses.lang_id', getLang(session('lang')))
                    ->limit(4)
                    ->get();
            $rating = rating::where('course_id', $course->id)->first();
            $applicant = ApplicantCourse::where('course_id', $course->id)->where('applicant_id', auth()->id())->first();
            $media_buy = CourseMedia::leftJoin('course_media_data', 'course_media_data.media_id', 'course_media.id')
                    ->where('course_id', $course->id)
                    ->where('is_active', 1)
                    ->where('course_media_data.lang_id', getLang(session('lang')))
                    ->pluck('course_media.id')
                    ->toArray();
            $media_owned = DB::table(\App\Model\Views::$vwUsermedia)
                    ->where('user_id', auth()->id())
                    ->where('course_id', $course->id)
                    ->pluck('media_id')
                    ->toArray();
            foreach ($media_buy as $item) {
                if (in_array($item, $media_owned)) {
                    return Redirect::route('single_courseMedia', $course->id);
                }
            }
            return view('front.courses.enroll_course', compact('applicant', 'files', 'trainer', 'course', 'categories_nav', 'pending', 'media', 'courses', 'rating'));
        } else {
            return redirect('user/login');
        }
    }

    public function categories() {
        $categories_nav = Co_category::where('lang_id', getLang(session('lang')))->limit(6)->get();
        $categories = Co_category::where('parent_id', '=', null)
                        ->where('lang_id', getLang(session('lang')))
                        ->orderBy('id', 'desc')->paginate(6);

        foreach ($categories as $category) {
            $count = Course_co_category::where('co_category_id', $category->id)->count();
        }
        return view('front.categories.categories', compact('categories_nav', 'categories', 'count'));
    }

    public function category($id, Request $request) {
        if ($request->cookie('country_id') != null) {
            $country_id = $request->cookie('country_id');
        } else {
//            $country_id = 1;
            $country_id = Countries::where('lang_id', getLang(session('lang')))->first()->id;
        }
        $country = Countries::findOrFail($country_id);
        $convert = $this->getRate($country->code);
        $categories_nav = Co_category::where('lang_id', getLang(session('lang')))->limit(6)->get();
        $category = Co_category::where('id', $id)->where('lang_id', getLang(session('lang')))->first();
        if (!$category) {
            $category = Co_category::where('source_id', $id)->where('lang_id', getLang(session('lang')))->first();
        }
        if (!$category) {
            $cat = Co_category::where('id', $id)->first();
            if($cat==null)
                return view("not-found");
            $category = Co_category::where('id', $cat->source_id)->where('lang_id', getLang(session('lang')))->first();
        }
        $courses = Course_co_category::leftJoin('courses', 'courses.id', 'co_category_course.course_id')
                ->leftJoin('countries_courses', 'countries_courses.course_id', 'courses.id')
                ->where('co_category_course.co_category_id', $category->id)
                ->where('countries_courses.country_id', $country_id)
                ->where('courses.is_active', 1)
                ->where('courses.lang_id', getLang(session('lang')))
                ->select('courses.*', 'countries_courses.country_id', 'co_category_course.co_category_id')
                ->paginate(6);
        if (count($courses) == 0) {
            $courses = Course_co_category::leftJoin('courses', 'courses.id', 'co_category_course.course_id')
                    ->leftJoin('countries_courses', 'countries_courses.course_id', 'courses.id')
                    ->where('co_category_course.co_category_id', $category->source_id)
                    ->where('countries_courses.country_id', $country_id)
                    ->where('courses.is_active', 1)
                    ->where('courses.lang_id', getLang(session('lang')))
                    ->select('courses.*', 'countries_courses.country_id', 'co_category_course.co_category_id')
                    ->paginate(6);
        }
        return view('front.categories.courses_category', compact('convert', 'categories_nav', 'courses', 'category'));
    }

    public function showVideo(Request $request) {
        if ($request->ajax()) {
//            dd($request->video_id);
            $video = CourseMedia::FindOrFail($request->video_id);
            return response()->json($video);
        }
    }

    public function contact() {
        $gallery = DB::table('galleries')->where('published', '=', 1)
                        ->where('lang_id', getLang(session('lang')))->latest()->paginate(3);
        $categories_nav = Co_category::where('lang_id', getLang(session('lang')))->limit(6)->get();
        return view('front.contact', compact('gallery', 'categories_nav'));
    }

    public function storeContact(Request $request) {
        $rules = [
            'name' => ['required', 'string', 'max:150', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:100'],
            'message' => ['required', 'string', 'min:3'],
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        $contact = Contact::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'title' => $request->title,
                    'message' => $request->message,
        ]);
        $contact->save();
        return redirect()->back()->with('info', _i('Your message has been sent successfully'));
    }

    public function article_categories() {
        $categories = Artcl_category::where('published', 1)
                        ->where('lang_id', getLang(session('lang')))
                        ->orderBy('id', 'desc')->paginate(6);
        return view('front.articles.article_categories', compact('categories'));
    }

    public function article_cat($cat_id) {
        $category = Artcl_category::where('id', $cat_id)->where('lang_id', getLang(session('lang')))->first();
        if (!$category) {
            $category = Artcl_category::where('source_id', $cat_id)->where('lang_id', getLang(session('lang')))->first();
        }
        if (!$category) {
            $cat = Artcl_category::where('id', $cat_id)->first();
            $category = Artcl_category::where('id', $cat->source_id)->where('lang_id', getLang(session('lang')))->first();
        }
        $articles = Article::leftJoin('article_category', 'article_category.article_id', 'articles.id')
                ->where('article_category.category_id', $category->id)
                ->where('articles.lang_id', getLang(session('lang')))
                ->where('published', 1)
                ->orderBy('articles.id', 'desc')
                ->paginate(6);
        if (count($articles) < 1) {
            $articles = Article::leftJoin('article_category', 'article_category.article_id', 'articles.id')
                    ->where('article_category.category_id', $category->source_id)
                    ->where('articles.lang_id', getLang(session('lang')))
                    ->where('published', 1)
                    ->orderBy('articles.id', 'desc')
                    ->paginate(6);
        }
        return view('front.articles.articles', compact('articles', 'category'));
    }

    public function article($article_id) {
        $article = Article::leftJoin('article_category', 'article_category.article_id', 'articles.id')->where('articles.id', $article_id)->where('lang_id', getLang(session('lang')))->first();
        if (!$article) {
            $article = Article::leftJoin('article_category', 'article_category.article_id', 'articles.id')->where('articles.source_id', $article_id)->where('lang_id', getLang(session('lang')))->first();
        }
        if (!$article) {
            $article = Article::leftJoin('article_category', 'article_category.article_id', 'articles.id')->where('articles.id', $article_id)->first(); //->where('lang_id' ,getLang(session('lang')))
            if ($article->source_id != null) {
                $article = Article::leftJoin('article_category', 'article_category.article_id', 'articles.id')->where('articles.id', $article->source_id)->where('lang_id', getLang(session('lang')))->first();
            }
        }
        if ($article == null) {
            return view('not_found');
        }
        $category = Artcl_category::where('id', $article->category_id)->where('lang_id', getLang(session('lang')))->first();
        if (!$category) {
            $category = Artcl_category::where('source_id', $article->category_id)->where('lang_id', getLang(session('lang')))->first();
        }

        $articles = Article::leftJoin('article_category', 'article_category.article_id', 'articles.id')->where('article_category.category_id', $article->category_id)->where('articles.id', '!=', $article->id)
                ->where('lang_id', getLang(session('lang')))
                ->limit(4)
                ->get();


        return view('front.articles.single_article', compact('article', 'category', 'articles'));
    }

    public function competitions() {
        $competitions = Competition::leftJoin('exams', 'exams.type_id', 'competition.id')
                ->leftJoin('exam_data', 'exam_data.exam_id', 'exams.id')
                ->where('competition.is_active', 1)
                ->where('exams.type', 'competition')
                ->where('exam_data.lang_id', getLang(session('lang')))
                ->where('competition.end', '>=', Carbon::today())
                ->select('competition.*', 'exam_data.exam_id', 'exam_data.description')
                ->paginate(10);
        return view('front.competitions', compact('competitions'));
    }

}
