<?php

namespace App\Http\Controllers\Api\Courses;

use App\Hr\Course\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Course_evaluationController extends Controller {

    public function getTrainerQuestions($course_id) {
        $query = DB::select("select * from questions where type = 'trainer'  ");
        $course = Course::find($course_id)->where('courses.is_active', '=', 1)
                        ->where("courses.id", $course_id)->get();

        if ($query)
            return \Response::json(["status" => "ok", "data" => $query, "course" => $course], 200, ['Content-Type' => 'application/json']);

        return \Response::json(["status" => "ok", "data" => ["error" => 'Not Found Any Questions Belongs to This Course']], 200, ['Content-Type' => 'application/json']);
    }

    public function getCourseQuestions($course_id) {
        //SELECT * FROM `questions` WHERE `type` = "course"
        $query = DB::select("select * from questions where type = 'course'  ");
        $course = Course::find($course_id)->where('courses.is_active', '=', 1)->where("courses.id", $course_id)->get();

        if ($query)
            return \Response::json(["status" => "ok", "data" => $query, "course" => $course], 200, ['Content-Type' => 'application/json']);

        return \Response::json(["status" => "ok", "data" => ["error" => 'Not Found Any Questions Belongs to This Course']], 200, ['Content-Type' => 'application/json']);
    }

}

?>
