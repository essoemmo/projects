<?php

namespace App\Http\Controllers\Hr\Course;

use App\Hr\Course\ApplicantCourse;
use App\Hr\Course\Countries_Courses;
use App\Hr\Course\Course_co_category;
use App\Language;
use App\Models\Admin\CourseMedia;
use App\Hr\Course\Co_category;
use App\Hr\Course\Course;
use App\Hr\Course\Trainer;
use App\Http\Controllers\Controller;
use App\Models\Admin\CourseMediaData;
use App\Models\Admin\CourseMediaTags;
use App\Models\Countries;
use App\Models\Currency;
use App\Models\Translation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Help\Setting;

class CourseController extends Controller {

    public function allCourses() {
        if(request()->ajax() && request()->has('courses')){
            return Course::all(['id','title']);
        }
        $langs = \App\Models\Language::all();
        $translation = Translation::where('table_name','courses')->first();
        return view('admin.hr.course.courses.allCourses',compact('translation','langs'));
    }

    public function myCourses() {
        if(request()->ajax() && request()->has('courses')){
            return Course::all(['id','title']);
        }
        return view('admin.hr.course.courses.myCourses');
    }


    public function getDatatableCourses() {
        $course = Course::select([
                    'id', 'title', 'in_company', 'start_date', 'end_date', 'duration', 'cost', 'is_active',
                    'created_at', 'updated_at','user_id','currency_id'
        ]);

        return DataTables::of($course)
                        ->addColumn('action', function ($course) {
                            return '<a href="' . $course->id . '/edit" class="btn btn-icon waves-effect waves-light btn btn-primary" title="'._i("Edit").'"><i class="fa fa-edit"></i> </a>' . "&nbsp;" .
                                '<a href="' . $course->id . '/delete" class="btn btn-icon waves-effect waves-light btn btn-danger" title="'._i("Delete").'"><i class="fa fa-remove"></i> </a>' . "&nbsp;" .
                                '<a href="' . $course->id . '/video" class="btn btn-icon waves-effect waves-light btn btn-info" title="'._i("Add Media").'"><i class="fa fa-gg-circle"></i> </a>'. "&nbsp;" .
                                '<a href="' . $course->id . '/course_exam/create" class="btn btn-icon waves-effect waves-light btn btn-success" title="'._i("Add Course Exam").'"><i class="fa fa-check-square-o"></i> </a>';
                        })
                        ->editColumn('is_active', function($course ) {
                            return $course ->is_active == 1 ? _i('Yes') : _i('No');
//
                         })
                        ->editColumn('trainer', function ($course ){
                            $user = User::where('id',$course->user_id)->first();
                            return $user->first_name . $user->last_name;
                        })
                        ->make(true);
    }


    public function addCourse() {
        $trainers = Trainer::all();
        $courseCategories = Co_category::all();
        $countries = Countries::all();
        $currencies = Currency::where("code","usd")->first();
        $langs = Language::all();
        return view('admin.hr.course.courses.addCourse', compact('trainers', 'courseCategories','countries','currencies','langs'));
    }

// teacher section
    public function createdCourses() {
        if(request()->ajax() && request()->has('courses')){
            return Course::all(['id','title']);
        }
        return view('front.courses.teacher.created');
    }

    public function getUserDataTable() {
        $course = Course::where('user_id', auth()->id())
            ->select([
                'id', 'title', 'in_company', 'start_date', 'end_date', 'duration', 'cost', 'is_active',
                'created_at', 'updated_at','user_id','currency_id'
            ]);
        if(\request()->is('admin/myCourses/get_user_datatable'))
        {
            $course->where('is_active' , 1);
        }
        if(\request()->is('admin/myCourses/get_user_pendingCourse_datatable'))
        {
            $course->where('is_active' , 0);
        }

        return DataTables::of($course)
            ->addColumn('action', function ($course) {
                return
//                    '<a href="course/' . $course->id . '/edit" class="btn btn-icon waves-effect waves-light btn btn-primary" title="'._i("Edit").'"><i class="fa fa-edit"></i> </a>' . "&nbsp;" .
                    '<a href="'.url('/admin/course/' . $course->id . '/delete').'" class="btn btn-icon waves-effect waves-light btn btn-danger" title="'._i("Delete").'"><i class="fa fa-remove"></i> </a>' . "&nbsp;" .
                    '<a href="course/' . $course->id . '/video" class="btn btn-icon waves-effect waves-light btn btn-info" title="'._i("Add Media").'"><i class="fa fa-gg-circle"></i> </a>' . "&nbsp;" .
                    '<a href="course/' . $course->id . '/course_exam/create" class="btn btn-icon waves-effect waves-light btn btn-info" title="'._i("Add Course Exam").'"><i class="fa fa-check-square-o"></i> </a>';
            })
            ->editColumn('is_active', function($course ) {
                return $course ->is_active == 1 ? _i('Active') : _i('Not Active');
            })
            ->make(true);
    }

    public function create() {
        $trainers = Trainer::all();
        $courseCategories = Co_category::where('lang_id', getLang(session('lang')))->get();
        $countries = Countries::where('lang_id', getLang(session('lang')))->get();
        $currencies = Currency::where("code","usd")->first();

        $langs = Language::all();
        return view('front.courses.teacher.create', compact('trainers', 'courseCategories','countries','currencies','langs'));
    }

    protected function postCreate(Request $request) {
        //dd($request->file('file')->getClientOriginalName());

         $rules = [
            'title' => ['required', 'max:150', 'unique:courses'],
            'start_date' => array('required', 'date'),
            'end_date' => array('required', 'date'),
            'duration' => array('required'),
            'cost' => array('required'),
            // 'description' => array('required', 'min:3'),
//            'is_active' => array('required'),
            'country_id' => array('required'),
            'lang_id' => array('required'),
            'video' => ['required', 'max:100000'],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator);



        $this->save($request);
        return redirect()->back()->with(["success"=>_i('Added Successfully !')]);
    }

//    public function teacherEditCourse($id)
//    {
//        $course = Course::find($id);      // fetch course through course id
//        $categories = Co_category::all();
//        $countries = Countries::all();
//        $currencies = Currency::all();
//        $langs = Language::all();
//        $course_country = Countries_Courses::where('course_id',$course->id)->get();
//        $course_category = Course_co_category::where('course_id',$course->id)->get();
//        if(count($course->co_categories) > 0) {
//            foreach ($course->co_categories as $category) {
//                $category_id = $category->id;        // fetch trainer id that selected for course
//            }
//        } else {
//            $category_id = null;
//        }
//        $path = "course_media/" . $course->id;
//        $files = Storage::allFiles($path); // return all files in the folderName=>course->id
//        return view('front.courses.teacher.editCourse', compact('course','categories', 'category_id','countries','currencies','course_country','langs','files'));
//    }


    public function teacherAddCourseVideo($id)
    {
        $course = Course::findOrFail($id);
        $currencies = Currency::all();
        $course_videos = DB::table('course_media')
            ->where('course_id' , $course->id)
            ->paginate(3);
        //dd($course_videos);
        return view('front.courses.teacher.video.course_video' , compact('course' ,'course_videos','currencies'));
    }

    public function teacherEditVideo($id)
    {
        $video = CourseMedia::findOrFail($id);
        $course = Course::where('id' , $video->course_id)->first();
        $currencies = Currency::all();

        $ar_lang = \App\Models\Language::where('code' ,"ar")->first()->id;
        $en_lang = \App\Models\Language::where('code' ,"en")->first()->id;
        $course_data_ar = CourseMediaData::where('media_id' , $video->id)->where('lang_id' , $ar_lang)->first();
        $course_data_en = CourseMediaData::where('media_id' , $video->id)->where('lang_id' , $en_lang)->first();
        $course_tags_ar = CourseMediaTags::where('media_id' , $video->id)->where('lang_id' , $ar_lang)->get();
        $course_tags_en = CourseMediaTags::where('media_id' , $video->id)->where('lang_id' , $en_lang)->get();
        return view('front.courses.teacher.video.edit_video' ,compact('video','course','currencies','course_data_ar','course_data_en','course_tags_ar','course_tags_en'));
    }

    private function save($request)
    {
        $rules = [
            'title' => ['required', 'max:150', 'unique:courses'],
            'start_date' => array('required', 'date'),
            'end_date' => array('required', 'date'),
            'duration' => array('required'),
            'cost' => array('required'),
            // 'description' => array('required', 'min:3'),
//            'is_active' => array('required'),
            'country_id' => array('required'),
            'lang_id' => array('required'),
            'video' => ['required', 'max:100000'],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator);
        $params = [
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'duration' => $request->duration,
            'cost' => $request->cost,
            'description' => $request->description,
            'is_active' => 0,
            'user_id' => auth()->id(),
            'currency_id' => $request->currency_id,
            'lang_id' => $request->lang_id,
            "img" => "",
        ];
//        dd($params);
        if ($request->file('file') != null)
            $params["img"] = $request->file('file')->getClientOriginalName();


        $course = Course::create($params);

//        dd($request->video);
        if ($request->file('video') && $request->video != null )
        {
            $video = $request->file('video');

            if ($video && $file = $video->isValid()) {
                $destinationPath = public_path('uploads/courses/'.$course->id.'/');

                $fileName = $video->getClientOriginalName();
                $video->move($destinationPath, $fileName);
                $request->video = $fileName;

                if(!empty($course->video)){
                    //delete old video
                    $file = public_path('uploads/courses/'.$course->id.'/').$course->video;
                    @unlink($file);
                }
            }
            $course->video = $request->video;
        }
//        dd($course);

        $category = Co_category::find($request->co_category_id);  // fetch selected category
        $course->co_categories()->attach($category->id);  // attach course with category selected

        for($ii = 0; $ii < count($request->country_id) ; $ii++) {
            $country = Countries::find($request->country_id[$ii]);
            Countries_Courses::create([
                  'country_id' => $country->id,
                  'course_id' => $course->id,
            ]);
        }


        $course->save();
        $course->setAttachments($request->file('file'));

        // save uploaded files media
        $files = $request->file('files');
        $path = "course_media";

        if(!empty($files))
        {
            foreach($files as  $f)
            {
                $f->storeAs($path . '/' . $course->id, $f->getClientOriginalName());
            }
        }

    }
    public function store(Request $request) {
        //dd($request->file('file')->getClientOriginalName());
       $rules = [
            'title' => ['required', 'max:150', 'unique:courses'],
            'start_date' => array('required', 'date'),
            'end_date' => array('required', 'date'),
            'duration' => array('required'),
            'cost' => array('required'),
            'country_id' => array('required'),
            'lang_id' => array('required'),
           // 'video' => ['required', 'max:100000'],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator);
        $params = [
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'duration' => $request->duration,
            'cost' => $request->cost,
            //'description' => $request->description,
            'is_active' => 0,
            'user_id' => auth()->id(),
            'currency_id' => $request->currency_id,
            'lang_id' => $request->lang_id,
            "img" => "",
        ];
        if($request->description!=null)
            $params["description"]= $request->description;
//        dd($params);
        if ($request->file('file') != null)
            $params["img"] = $request->file('file')->getClientOriginalName();


        $course = Course::create($params);

//        if ($request->file('video') && $request->video != null )
//        {
//            $video = $request->file('video');
//
//            if ($video && $file = $video->isValid()) {
//                $destinationPath = public_path('uploads/courses/'.$course->id.'/');
//
//                $fileName = $video->getClientOriginalName();
//                $video->move($destinationPath, $fileName);
//                $request->video = $fileName;
//
//                if(!empty($course->video)){
//                    //delete old video
//                    $file = public_path('uploads/courses/'.$course->id.'/').$course->video;
//                    @unlink($file);
//                }
//            }
//            $course->video = $request->video;
//        }


        $category = Co_category::find($request->category_id);  // fetch selected category
        $course->co_categories()->attach($category->id);  // attach course with category selected

        for($ii = 0; $ii < count($request->country_id) ; $ii++) {
            $country = Countries::find($request->country_id[$ii]);
            Countries_Courses::create([
                'country_id' => $country->id,
                'course_id' => $course->id,
            ]);
        }


        $course->save();
        $course->setAttachments($request->file('file'));

        // save uploaded files media
        $files = $request->file('files');
        $path = "course_media";

        if(!empty($files))
        {
            foreach($files as  $f)
            {
                $f->storeAs($path . '/' . $course->id, $f->getClientOriginalName());
            }
        }
        return redirect('/admin/course/' . $course->id . '/edit')->withFlashMessage(_i('Thanks, your course is waitin approval !'));
    }


    public function editCourse($id) {
        $course = Course::find($id);      // fetch course through course id
        $categories = Co_category::all();
        $countries = Countries::all();
        $currencies = Currency::where("code","usd")->first();
        $langs = Language::all();
        $course_country = Countries_Courses::where('course_id',$course->id)->get();
        $course_category = Course_co_category::where('course_id',$course->id)->get();
        if(count($course->co_categories) > 0) {
            foreach ($course->co_categories as $category) {
                $category_id = $category->id;        // fetch trainer id that selected for course
            }
        } else {
            $category_id = null;
        }

        $path = "course_media/" . $course->id;
        $files = Storage::allFiles($path); // return all files in the folderName=>course->id
        return view('admin.hr.course.courses.editCourse', compact('course_category','course','categories', 'category_id','countries','currencies','course_country','langs','files'));
    }

    public function updateCourse($id, Request $request) {
        //dd($request->is_active);
        $course = Course::find($id);
        $trainer = Trainer::find($request->trainer_id);   // find trainer id that attached with course
        $category = Co_category::find($request->category_id); // find category id that attached with course

        $rules = [
            'title' => ['required', 'max:150', Rule::unique('courses')->ignore($course->id)],
            'start_date' => array('required', 'date'),
            'end_date' => array('required', 'date'),
            'duration' => array('required'),
            'cost' => array('required'),
            //'description' => array('required', 'min:3'),
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator);

        $course->title = $request->title;
        $course->start_date = $request->start_date;
        $course->end_date = $request->end_date;
        $course->duration = $request->duration;
        $course->cost = $request->cost;
        $course->description = $request->description;
        $course->currency_id = $request->currency_id;
        $course->lang_id = $request->lang_id;
        $course->user_id = auth()->id();
//        $course->is_active = $request->is_active;

        if($request->is_active)
        {
        $course->is_active = $request->is_active;
        }
//        dd($course);
        if ($request->file('file') != null) {
            $course->img = $request->file('file')->getClientOriginalName();
            $course->destroyAttachments();
            $course->setAttachments($request->file('file'));
        }

//        if ($request->file('video') != null) {
//            $course->img = $request->file('video')->getClientOriginalName();
//            $course->destroyAttachments();
//            $course->setAttachments($request->file('video'));
//        }

//        if ($request->file('video') && $request->video != null )
//        {
//            $video = $request->file('video');
//
//            if ($video && $file = $video->isValid()) {
//                $destinationPath = public_path('uploads/courses/'.$course->id.'/');
//
//                $fileName = $video->getClientOriginalName();
//                $video->move($destinationPath, $fileName);
//                $request->video = $fileName;
//
//                if(!empty($course->video)){
//                    //delete old video
//                    $file = public_path('uploads/courses/'.$course->id.'/').$course->video;
//                    @unlink($file);
//                }
//            }
//            $course->video = $request->video;
//        }
//

//        dd($course);

//        $course->trainers()->attach($trainer->id);      // attach course with trainer selected

        $course_category = Course_co_category::where('course_id',$course->id)->first();

        if($course_category == null) {
            $course->co_categories()->attach($request->category_id);
        } else {
            if($request->category_id == $course_category->co_category_id) {

            } else {
                $course_category = Course_co_category::where('course_id',$course->id)->delete();
                $course->co_categories()->attach($request->category_id);      // attach course with category selected
            }
        }

        $course_country = Countries_Courses::where('course_id', $course->id)->delete();
        for($ii = 0; $ii < count($request->country_id) ; $ii++) {
//            dd($request->country_id);
            $country = Countries::find($request->country_id[$ii]);
            Countries_Courses::create([
                'country_id' => $country->id,
                'course_id' => $course->id,
            ]);
        }

        // save uploaded files media
        $files = $request->file('files');
        $path = "course_media";
        if(!empty($files))
        {
            foreach($files as  $f)
            {
                $f->storeAs($path . '/' . $course->id, $f->getClientOriginalName());
            }
        }
        $course->save();

//        return redirect('/admin/course/' . $course->id . '/edit')->withFlashMessage(_i('Updated Successfully !'));
        return redirect()->back()->with('flash_message' , _i('Updated Successfully !'));
    }

//    public function teacherUpdateCourse($id, Request $request) {
//        //dd($request->is_active);
//        $course = Course::find($id);
//        $trainer = Trainer::find($request->trainer_id);   // find trainer id that attached with course
//        $category = Co_category::find($request->category_id); // find category id that attached with course
//
//        $rules = [
//            'title' => ['required', 'max:150', Rule::unique('courses')->ignore($course->id)],
//            'start_date' => array('required', 'date'),
//            'end_date' => array('required', 'date'),
//            'duration' => array('required'),
//            'cost' => array('required'),
//            //'description' => array('required', 'min:3'),
//        ];
//        $validator = Validator::make($request->all(), $rules);
//        if ($validator->fails())
//            return redirect()->back()->withErrors($validator);
//
//        $course->title = $request->title;
//        $course->start_date = $request->start_date;
//        $course->end_date = $request->end_date;
//        $course->duration = $request->duration;
//        $course->cost = $request->cost;
//        $course->description = $request->description;
//        $course->currency_id = $request->currency_id;
//        $course->lang_id = $request->lang_id;
//        $course->user_id = auth()->id();
////        $course->is_active = $request->is_active;
//
//        if($request->is_active)
//        {
//            $course->is_active = $request->is_active;
//        }
////        dd($course);
//        if ($request->file('file') != null) {
//            $course->img = $request->file('file')->getClientOriginalName();
//            $course->destroyAttachments();
//            $course->setAttachments($request->file('file'));
//        }
//
////        if ($request->file('video') != null) {
////            $course->img = $request->file('video')->getClientOriginalName();
////            $course->destroyAttachments();
////            $course->setAttachments($request->file('video'));
////        }
//
//        if ($request->file('video') && $request->video != null )
//        {
//            $video = $request->file('video');
//
//            if ($video && $file = $video->isValid()) {
//                $destinationPath = public_path('uploads/courses/'.$course->id.'/');
//
//                $fileName = $video->getClientOriginalName();
//                $video->move($destinationPath, $fileName);
//                $request->video = $fileName;
//
//                if(!empty($course->video)){
//                    //delete old video
//                    $file = public_path('uploads/courses/'.$course->id.'/').$course->video;
//                    @unlink($file);
//                }
//            }
//            $course->video = $request->video;
//        }
////        dd($course);
//
////        $course->trainers()->attach($trainer->id);      // attach course with trainer selected
//
//        $course_category = Course_co_category::where('course_id',$course->id)->first();
//        if($course_category == null) {
//            $category = Co_category::find($request->co_category_id);
//            Course_co_category::create([
//                'course_id' => $course->id,
//                'co_category_id' => $category->id,
//            ]);
//        } else {
//            if($request->co_category_id == $course_category->co_category_id) {
//
//            } else {
//                $course_category = Course_co_category::where('course_id',$course->id)->delete();
//                $category = Co_category::find($request->co_category_id);
//                Course_co_category::create([
//                    'course_id' => $course->id,
//                    'co_category_id' => $category->id,
//                ]);
//            }
//        }
//
//        $course_country = Countries_Courses::where('course_id', $course->id)->delete();
//        for($ii = 0; $ii < count($request->country_id) ; $ii++) {
////            dd($request->country_id);
//            $country = Countries::find($request->country_id[$ii]);
//            Countries_Courses::create([
//                'country_id' => $country->id,
//                'course_id' => $course->id,
//            ]);
//        }
//
//        // save uploaded files media
//        $files = $request->file('files');
//        $path = "course_media";
//        if(!empty($files))
//        {
//            foreach($files as  $f)
//            {
//                $f->storeAs($path . '/' . $course->id, $f->getClientOriginalName());
//            }
//        }
//        $course->save();
//
////        return redirect('/admin/course/' . $course->id . '/edit')->withFlashMessage(_i('Updated Successfully !'));
//        return redirect()->back()->with('flash_message' , _i('Updated Successfully !'));
//    }

    public function deleteCourse($id) {
        $course_found = ApplicantCourse::where('course_id' , $id)->first();
        if($course_found){
            return redirect()->back()->with('danger' , _i('Can`t Delete this Course because it contained Applicants'));
        }else{
            $course = Course::findOrFail($id);
            $course->destroyAttachments();
            $course->destroyMediaAttachments();
            $course->delete();
//        return redirect('/admin/course/all')->withFlashMessage(_i('Deleted Successfully !'));
            return redirect()->back()->with('flash_message' , _i('Deleted Successfully !'));
        }
    }

    //Delete Attachments By Id
    public function deleteAttachments($id) {
        $course = Course::findOrFail($id);
        $course->destroyAttachments();
    }

    // delete media attachments
    public function deleteMediaAttach(Request $request) {
        $course = Course::findOrFail($request->id);
        $course->deleteMediaAttachmentByUrl($request->url);
        return 'Attachment is Deleted';
    }

    public function downloadAttachments(Request $request) {
        $course = Course::findOrFail($request->id);
        return $course->getAttachments();
    }



    public function addCourseVideo($id)
    {
        $course = Course::findOrFail($id);
        $langs = Language::all();
//        $course_videos = CourseMedia::where('course_id' , $course->id)->get();
        $course_videos = DB::table('course_media')
            ->where('course_id' , $course->id)
            ->paginate(3);
        return view('admin.hr.course.courses.video.course_video' , compact('course' ,'course_videos','langs'))->render();
    }

    // add video through dropzone
    public function dropzoneUploadVideo(Request $request,$id){

        if($request->file)
        { // $id => coursemedia->id
            $course_media = CourseMedia::where('id' , $id)->first();
            $file = $request->file('file');
            if ($file &&  $file->isValid()) {
                $old_file = public_path('uploads/course/course_videos/'.$course_media->course_id.'/').$course_media->file;
                @unlink($old_file);

                $destinationPath = public_path('uploads/course/course_videos/'.$course_media->course_id);
                $fileName = time().$file->getClientOriginalName();
                $file->move($destinationPath, $fileName);
            }
            $course_media->file = $fileName;
            $course_media->save();
        }
        if($request->videoCourse)
        {
            $file = $request->file('videoCourse');
            $course = Course::find($id);
            if ($file && $file->isValid()) {
                $destinationPath = public_path('uploads/courses/'.$course->id.'/');

                $fileName = time().$file->getClientOriginalName();
                $file->move($destinationPath, $fileName);
                $request->video = $fileName;

                if(!empty($course->video)){
                    //delete old video
                    $file = public_path('uploads/courses/'.$course->id.'/').$course->video;
                    @unlink($file);
                }
            }
            $course->video = $fileName;
            $course->save();
        }
        return response()->json($file);
    }

    public function dropzoneDeleteVideo(Request $request)
    {
        if($request->mediaId){
            $video = CourseMedia::findOrFail($request->mediaId);
            $file = public_path('uploads/course/course_videos/'.$video->course_id.'/').$video->file;
        }
        if($request->courseId){
           // dd('course');
            $course = Course::findOrFail($request->courseId);
            $file = public_path('uploads/courses/'.$course->id.'/').$course->video;
        }
        @unlink($file);
    }


    public function storeCourseVideo($id ,  Request $request)
    {
//        dd($request->tag_ar[0] != null);
        $rules =  [
            'title_en' => [ 'max:191', 'unique:course_media_data,title,'.$id],
            'title_ar' => [ 'max:191', 'unique:course_media_data,title,'.$id],
//            'img' => ['required'],
//            'file' => 'max:1000000',
            ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
                   return redirect()->back()->withErrors($validator);
        $currency = Currency::where("code","usd")->first()->id;
        $course_media = CourseMedia::create([
            'course_id' => $id,
            'currency_id' => $currency,
            'cost' => $request->cost,
            'is_active' => $request->is_active,
        ]);
        $course_media->save();

        //$this->uploadVideo($request ,$course_media->id);

//        if($request->file)
//        {
//            $file = $request->file('file');
//            if ($file &&  $file->isValid()) {
//                $destinationPath = public_path('uploads/course/course_videos/'.$id);
//                $fileName = $file->getClientOriginalName();
//                $file->move($destinationPath, $fileName);
//            }
//            $course_media->file = $fileName;
//        }

//        if ($request->img) {
//            $image = $request->file('img');
//            if ($image &&  $image->isValid()) {
//                $destinationPath = public_path('uploads/course/course_videos/'.$id);
//                $imgName = $image->getClientOriginalName();
//                $image->move($destinationPath, $imgName);
//            }
//            $course_media->img = $imgName;
//        }
        $course_media->save();

        // save course media data (en & ar)
        $course_media_data_ar = CourseMediaData::create([
            'media_id' => $course_media->id,
            'title' => $request->title_ar,
            'description' => $request->description_ar,
            'lang_id' => \App\Models\Language::where('code' ,"ar")->first()->id,
        ]);
        $course_media_data_ar->save();

        $course_media_data_en = CourseMediaData::create([
            'media_id' => $course_media->id,
            'title' => $request->title_en,
            'description' => $request->description_en,
            'lang_id' => \App\Models\Language::where('code' ,"en")->first()->id,
            'source_id' => $course_media_data_ar->id
        ]);
        $course_media_data_en->save();

        // save course media tags
        if( $request->tag_ar[0] != null)
        {
            foreach($request->tag_ar as $key => $itemArTag)
            {
                $course_media_tags_ar = CourseMediaTags::create([
                    'tag' => $itemArTag,
                    'media_id' => $course_media->id,
                    'lang_id' => \App\Models\Language::where('code' ,"ar")->first()->id,
                ]);
                $course_media_tags_ar->save();

                // save uploaded files media tags arabic
                $tag_ar_files = $request->file('tag_ar_files');
                $path_ar = "course_media_tags";
                $path_ar_folder = "ar";
                if(!empty($tag_ar_files))
                {
                    $file_ar_name = $tag_ar_files[$key]->getClientOriginalName();
                    $tag_ar_files[$key]->storeAs($path_ar . '/' . $course_media->id .'/'.$path_ar_folder , $file_ar_name);
                }
                $course_media_tags_ar->url = $file_ar_name;
                $course_media_tags_ar->save();
            }
        }

        if($request->tag_en[0] != null)
        {
            foreach($request->tag_en as $key => $itemEnTag)
            {
                $course_media_tags_en = CourseMediaTags::create([
                    'tag' => $itemEnTag,
                    'media_id' => $course_media->id,
                    'lang_id' => \App\Models\Language::where('code' ,"en")->first()->id,
                ]);
                $course_media_tags_en->save();

                // save uploaded files media tags english
                $tag_en_files = $request->file('tag_en_files');
                $path_en = "course_media_tags";
                $path_en_folder = "en";
                if(!empty($tag_en_files))
                {
                    $file_en_name = $tag_en_files[$key]->getClientOriginalName();
                    $tag_en_files[$key]->storeAs($path_en . '/' . $course_media->id .'/'.$path_en_folder , $file_en_name);
             $course_media_tags_en->url = $file_en_name;
                    }
               
                $course_media_tags_en->save();
            }
        }


//        return redirect('/admin/course/'.$id.'/video')->withFlashMessage(_i('Added Successfully !'));
        return redirect(url('admin/course/video/'.$course_media->id.'/edit'))->with('flash_message' , _i('Added Successfully !'));
    }

    public function editVideo($id)
    {

        $video = CourseMedia::findOrFail($id);
        $course = Course::where('id' , $video->course_id)->first();
        $currencies = Currency::all();

        $ar_lang = \App\Models\Language::where('code' ,"ar")->first()->id;
        $en_lang = \App\Models\Language::where('code' ,"en")->first()->id;
        $course_data_ar = CourseMediaData::where('media_id' , $video->id)->where('lang_id' , $ar_lang)->first();
        $course_data_en = CourseMediaData::where('media_id' , $video->id)->where('lang_id' , $en_lang)->first();
        $course_tags_ar = CourseMediaTags::where('media_id' , $video->id)->where('lang_id' , $ar_lang)->get();
        $course_tags_en = CourseMediaTags::where('media_id' , $video->id)->where('lang_id' , $en_lang)->get();
        return view('admin.hr.course.courses.video.edit_video' ,compact('video','course','currencies','course_data_ar','course_data_en','course_tags_ar','course_tags_en'));
    }

    public function updateVideo($id ,Request $request)
    {
        //dd($request);
        $video = CourseMedia::findOrFail($id);
        $video->cost = $request->cost;
        $video->currency_id = $request->currency_id;
        $video->is_active = $request->is_active;

//        if($request->file)
//        {
//            $file = $request->file('file');
//            if ($file &&  $file->isValid()) {
//                $destinationPath = public_path('uploads/course/course_videos/'.$id);
//                $fileName = $file->getClientOriginalName();
//                $file->move($destinationPath, $fileName);
//                //delete old video
//                if(!empty($video->file))
//                {
//                    $old_file = public_path('uploads/course/course_videos/'.$video->course_id.'/').$video->file;
//                    @unlink($old_file);
//                }
//            }
//            $video->file = $fileName;
//        }

        if ($request->img)
        {
            $image = $request->file('img');
            if ($image && $image->isValid()) {
                $destinationPath = public_path('uploads/course/course_videos/'.$id);
                $imgName = $image->getClientOriginalName();
                $image->move($destinationPath, $imgName);
                $request->img = $imgName;
                if(!empty($video->img)){
                    //delete old image
                    $old_img = public_path('uploads/course/course_videos/'.$video->course_id.'/').$video->img;
                    @unlink($old_img);
                }
            }
            $video->img = $imgName;
        }
        $video->save();

// update course data english & arabic
        $ar_lang = \App\Models\Language::where('code' ,"ar")->first()->id;
        $en_lang = \App\Models\Language::where('code' ,"en")->first()->id;
        $course_data_ar = CourseMediaData::where('media_id' , $video->id)->where('lang_id' , $ar_lang)->first();
        $course_data_ar->title = $request->title_ar;
        $course_data_ar->description = $request->description_ar;
        $course_data_ar->save();

        $course_data_en = CourseMediaData::where('media_id' , $video->id)->where('lang_id' , $en_lang)->first();
        $course_data_en->title = $request->title_en;
        $course_data_en->description = $request->description_en;
        $course_data_en->save();

        // save course media tags
        if($request->tag_ar[0] != null)
        {
            foreach($request->tag_ar as $key => $itemArTag)
            {
                $course_media_tags_ar = CourseMediaTags::create([
                    'tag' => $itemArTag,
                    'media_id' => $video->id,
                    'lang_id' => \App\Models\Language::where('code' ,"ar")->first()->id,
                ]);
                $course_media_tags_ar->save();

                // save uploaded files media tags arabic
                $tag_ar_files = $request->file('tag_ar_files');
                $path_ar = "course_media_tags";
                $path_ar_folder = "ar";
                if(!empty($tag_ar_files))
                {
                    $file_ar_name = $tag_ar_files[$key]->getClientOriginalName();
                    $tag_ar_files[$key]->storeAs($path_ar . '/' . $video->id .'/'.$path_ar_folder , $file_ar_name);
                }
                $course_media_tags_ar->url = $file_ar_name;
                $course_media_tags_ar->save();
            }
        }

        if($request->tag_en[0] != null)
        {
            foreach($request->tag_en as $key => $itemEnTag)
            {
                $course_media_tags_en = CourseMediaTags::create([
                    'tag' => $itemEnTag,
                    'media_id' => $video->id,
                    'lang_id' => \App\Models\Language::where('code' ,"en")->first()->id,
                ]);
                $course_media_tags_en->save();

                // save uploaded files media tags english
                $tag_en_files = $request->file('tag_en_files');
                $path_en = "course_media_tags";
                $path_en_folder = "en";
                if(!empty($tag_en_files))
                {
                    $file_en_name = $tag_en_files[$key]->getClientOriginalName();
                    $tag_en_files[$key]->storeAs($path_en . '/' . $video->id .'/'.$path_en_folder , $file_en_name);
                }
                $course_media_tags_en->url = $file_en_name;
                $course_media_tags_en->save();
            }
        }
        return redirect()->back()->with('flash_message' ,_i('Updated Successfully !'));
    }

    public function deleteVideo($id)
    {
        $video = CourseMedia::findOrFail($id);
//delete old video
        $file = public_path('uploads/course/course_videos/'.$video->course_id.'/').$video->file;
        @unlink($file);
        CourseMedia::destroy($id);
        return response()->json([
            'success' => _i('Video has been deleted successfully!')
        ]);
    }


    public function datatableVideos($course_id){

        $course_videos = CourseMedia::where('course_id'  ,$course_id)->orderBy('id', 'desc');
//        $course_videos = CourseMedia::select(['id','course_id','title','img','description','file','lang_id','source_id'])->where('course_id'  ,$course_id)->orderBy('id', 'desc');

        return DataTables::of($course_videos )
            ->addColumn('video', function ($course_videos) use($course_id) {
                $src = asset('uploads/course/course_videos/'.$course_id.'/'.$course_videos->file);
                if(auth()->user()->type == "trainer"){
                    $edit = url('/user/course/video/'.$course_videos->id.'/edit');
                }else{
                    $edit = url('/admin/course/video/'.$course_videos->id.'/edit');
                }
                return '<div class="video"> <video class="text-center" width="350px"  controls style="padding-right:20px;" > 
 <input type="hidden" name="course_id" id="course_id" value="{{$course->id}}" > <source src='.$src.' >   </video> <br />
  <div class="text-center"> <a  href="'.$edit.'" target="_blank"> '.$course_videos['title'].' </a> <a href="'.$edit.'" target="_blank">
  <button type="button" class="btn btn-primary"  title="'._i('Edit').'"> <i class="fa fa-edit"></i> </button> </a>  
  <input name="_method" type="hidden" value="'._i('DELETE').'">
   <button type="button" class="btn btn-danger deleteVideo"  data-id="'.$course_videos->id.'" > <i class="fa fa-trash"></i> </button>  </div> </div> <br />';
            })
            ->rawColumns([
                'video',
            ])

            ->make(true);

    }

    public function deleteTag(Request $request)
    {
       $course_tag = CourseMediaTags::findOrFail($request->id);
       $code = Language::where('id' ,$course_tag->lang_id)->first()->code;
        if(!empty($course_tag->url)){
            //delete old sound
            $old_sound = public_path('uploads/course_media_tags/'.$course_tag->media_id.'/'.$code.'/').$course_tag->url;
            @unlink($old_sound);
        }
       $course_tag->delete();
        return 'tag is Deleted';
    }

}
