<?php

namespace App\Http\Controllers\Hr\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Hr\Course\Course;
use App\Hr\Course\ApplicantResult;
use App\Hr\Course\Applicant;

class ApplicantResultController extends Controller
{
    //
    public function index()
    {
        $courses = Course::all('id', 'title');
        return view('admin.hr.course.ApplicantResult.index', ['courses' => $courses]);
    }
    public function store(Request $request)
    {
        foreach ($request->input('applicant_ids') as $key => $app_id) {

            $app_result = ApplicantResult::where('course_id', $request->input('course_id'))->where('applicant_id', $app_id)->first();
            $app_result->course_id = $request->input('course_id');
            $app_result->applicant_id = $app_id;
            $app_result->degree = $request->input('applicants_degrees')[$key];
            $app_result->save();
        }
        return redirect()->back();
    }
    
    public function getApplicants(Request $request)
    {

        $course = Course::findOrFail($request->input('id'));
        $applicants_courses =  $course->applicantCourses;
        $applicants = [];
        /* Get course applicants  */
        foreach ($applicants_courses as $applicant_course) {
            $result = [];
            $applicant =  $applicant_course->applicant;
            $result['app_id'] = $applicant->id;
            $result['first_name'] = $applicant->first_name;
            $result['last_name'] = $applicant->last_name;
            $result['is_active'] = $applicant->is_active;
            /* Get result or Create New Result */
            $app_result = ApplicantResult::where('course_id',$course->id)->where('applicant_id', $applicant->id)->first();
            if ($app_result==null) {
                $applicantResult = new ApplicantResult();
                $applicantResult->applicant_id = $applicant->id;
                $applicantResult->course_id = $course->id;
                $applicantResult->degree = '';
                $applicantResult->save();
                $app_result = $applicantResult;
            }
            $result['app_result_id'] = $app_result->id;
            $result['app_result_degree'] = $app_result->degree;
            array_push($applicants, $result);
        }

        return $applicants;
    }
}
