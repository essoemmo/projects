<?php

namespace App\Http\Controllers\Api\Courses;

use App\Help\Date2Time;
use App\Help\Greg2HijriDate;
use App\Hr\Course\Applicant;
use App\Hr\Course\ApplicantCourse;
use App\Hr\Course\Bank_transfer;
use App\Hr\Course\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller {

    public function evaluate( $data) {

//        $data = ( $request->all() );
//        dd(count($data) );

        if (count($data) > 0) {
//            $data = $data[0];

            $applicantId = \App\Hr\Course\Applicant::where("email", $data["userId"])->first();
            $courseId = Course::find($data["course"]);
            if ($courseId == null || $applicantId == null) {
                $data = "error";
                return \Response::json(["status" => "fail 1", "data" => $data], 200, ['Content-Type' => 'application/json']);
            }

            $questions = $data["questions"];
           
            foreach ($questions as $q) {
                foreach ($q as $id => $val) {
                    $qId = \App\Hr\Course\Question::find($id);
                    if ($qId == null) {
                        $data = "error";
                        return \Response::json(["status" => "fail 2", "data" => $q], 200, ['Content-Type' => 'application/json']);
                    }
                    $item = new \App\Hr\Course\Course_evaluation();
                    $item->applicant_id = $applicantId->id;
                    $item->course_id = $courseId->id;
                    $item->question_id = $qId->id;
                    $item->answer = $val;
                   
                    $item->save();
                }
            }
        } else {
            $data = "not found";
        }

        return \Response::json(["status" => "ok", "data" => "saved"], 200, ['Content-Type' => 'application/json']);
    }

    public function allCourses() {
//        $courses = DB::table('courses')->where('is_active', '=', 1)->get();
        $courses = Course::where('is_active', '=', 1)->orderBy('id', 'desc')->paginate(9);

        return \Response::json(["status" => "ok", "data" => $courses], 200, ['Content-Type' => 'application/json']);
    }

    // return all courses without pagination
    public function courses() {
        $courses = Course::where('is_active', '=', 1)->orderBy('id', 'desc')->get();

        return \Response::json(["status" => "ok", "data" => $courses], 200, ['Content-Type' => 'application/json']);
    }

    public function getLastCourses() {

        $courses = DB::table('courses')->where('is_active', '=', 1)->latest()->get();
        return \Response::json(["status" => "ok", "data" => $courses], 200, ['Content-Type' => 'application/json']);
    }

    public function getLastCoursesByNumber(Request $request) {

        $courses = DB::table('courses')->where('is_active', '=', 1)->latest()->paginate($request->number);
//        return responseJson(1 , ' Courses Wanted' , $courses);
        return \Response::json($courses, 200, ['Content-Type' => 'application/json']);
    }

    public function courseData($course_id) {
        // $course = Course::find($course_id)->where('courses.is_active', '=', 1)->where("courses.id", $course_id)->get();
        $course = DB::table('courses')
                        ->select('courses.*', 'trainers.first_name', 'trainers.last_name')
                        ->join('course_trainer', 'courses.id', '=', 'course_trainer.course_id')
                        ->join('trainers', 'course_trainer.trainer_id', '=', 'trainers.id')
                        ->where('courses.is_active', '=', 1)
                        ->where("courses.id", $course_id)->get();
        $bankTransfer = Bank_transfer::all();
        if ($course != null) {
                      //    return responseJson(1, 'Course Data' , $course);
//            return \Response::json($course, 200, ['Access-Control-Allow-Origin' => config("app.origin"), 'Content-Type' => 'application/json']);
            return \Response::json(["status" => "ok", "data" => $course, "bankTransfer" => $bankTransfer ], 200, ['Content-Type' => 'application/json', "charset" => "utf-8"]);
        } else {
            return responseJson(0, 'Course Not Active');
        }
    }

    public function coursesActivated() {
        $courses = Course::all()->where('is_active', '=', 1);
        if ($courses)
        // return responseJson(1 ,'Activated Courses',$courses);
            return \Response::json(["status" => "ok", "data" => $courses], 200, ['Content-Type' => 'application/json']);
        return \Response::json(["status" => "ok", "data" => ["error" => 'Not Found Any Course Activated ']], 200, ['Content-Type' => 'application/json']);
//responseJson(0 ,'Not Found Any Course Activated ');
    }

    public function coursesSearch(Request $request) {
        $courses = Course::where('title', 'like', "%$request->title%")->orderBy('id', 'desc')->paginate(9);

        if (count($courses) > 0)
            return \Response::json(["status" => "ok", "data" => $courses], 200, ['Content-Type' => 'application/json']);
        return \Response::json(["status" => "ok", "data" => ["error" => 'Not Found Any Course']], 200, ['Content-Type' => 'application/json']);
    }


    // return applicant course by course_id & applicant_email
    public function applicantCourse($course_id , Request $request)
    {
        $applicant = Applicant::where('email','=',$request->email)->first();
//        dd($applicant->id);
        $course = Course::find($course_id);
        $applicant_course = DB::table('applicant_course')
            ->select('applicant_course.*' ,'courses.title' ,'courses.start_date','courses.end_date','courses.duration')
            ->join('courses', 'applicant_course.course_id' ,'=' ,'courses.id')
            ->where('course_id' ,'=' , $course->id)
            ->where('applicant_id' , '=' ,$applicant->id)
            ->first();
// convert Gregorian date to Hijri
        $start_date =  explode('-',$applicant_course->start_date);
        $year = $start_date[0];
        $month = $start_date[1];
        $day = $start_date[2];
//        dd($day);
        $greg_hijriDate = new Greg2HijriDate();
        $hijriDate = $greg_hijriDate->Greg2Hijri($day,$month,$year,false);
        $hijriMonth = array ("Muharram", "Safar", "Rabi al-Awwal", "Rabi al-Thani", "Jumad al-Ula", "Jumad al-Thani", "Rajab", "Sha'ban", "Ramadan", "Shawwal", "Dhul al-Qa'dah",
            "Dhul al-Hijjah");
        $hijri_year = (int) $hijriDate["year"];
        $hijri_month = $hijriMonth[$hijriDate["month"]-1];
        $hijri_day = (int) $hijriDate["day"];
//        dd($hijri_year);
//        dd($hijriDate);

        // calculate time to course
        $date_to_time = new Date2Time();
        $time = $date_to_time->calulatetime($applicant_course->start_date ,$applicant_course->end_date);

        if ($applicant_course)
            return \Response::json(["status" => "ok", "data" => $applicant_course ,"hijri_year" => $hijri_year ,"hijri_month" => $hijri_month ,
                    "hijri_day" => $hijri_day,"time" => $time], 200, ['Content-Type' => 'application/json']);
        return \Response::json(["status" => "ok", "data" => ["error" => 'Not Found Any Course']], 200, ['Content-Type' => 'application/json']);
    }

    public function downloadMediaAttachments($course_id)
    {
//        return Storage::download($user->resume, 'resume.pdf');
        $course = Course::find($course_id);
        $path = "course_media";
        if (!isset($course))
            return \Response::json(["status" => "ok", "data" => ["error" => 'Not Found Any Course']], 200, ['Content-Type' => 'application/json']);

        $allfiles = Storage::files( $path . '/' . $course->id);
        foreach($allfiles as $file){
            $url= url('/uploads/'.$file);
            $files[] = $url ;
        }

        $video_path = "course/course_videos";
        $allvideos =  Storage::files( $video_path . '/' . $course->id);

        foreach($allvideos as $video){
            $url= url('/uploads/'.$video);
            $files[] .= $url ;
        }
//        return $files ;

//        $allfiles = Storage::files($path . '/' . $course->id);
//        $urls = array_map(function ($fileName) {
//            return Storage::url($fileName);
//        }, $allfiles);
//        return $urls;
        return \Response::json(["status" => "ok", "data" => $files], 200, ['Content-Type' => 'application/json']);


    }

}
