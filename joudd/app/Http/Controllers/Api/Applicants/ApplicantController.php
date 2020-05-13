<?php

namespace App\Http\Controllers\Api\Applicants;

use App\Hr\Course\Applicant;
use App\Hr\Course\Applicant_course_pending;
use App\Hr\Course\Course;
use App\Hr\Nationality;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ApplicantController extends \App\Http\Controllers\Api\BaseController {

    public function getNationality() {

        $nationalities = Nationality::all();
//        return responseJson(1,'Nationalities' ,$nationalities);
//'Access-Control-Allow-Origin' => config("app.origin"),
        return \Response::json(["status" => "ok", "data" => $nationalities], 200, ['Content-Type' => 'application/json']);
    }

    private function applyToCourse($request, $applicant_id) {
        $applicantCourse = new \App\Hr\Course\Applicant_course_pending();
        $course = Course::find($request->input('course_id'));
        $applicantCourse->applicant_id = $applicant_id;
        $applicantCourse->course_id = $course->id;
     //   $applicantCourse->cert_id = \App\Utility::serialNumber();
        $applicantCourse->cost = $course->cost;
        /* Amount */
        $amount = $course->cost;
        if ($request->input('coupon_id') != null) {
            $discountCode = \App\Hr\Course\DiscountCode::where("code", $request->input('coupon_id'))->first();
            if ($discountCode != null) {
                if ($discountCode->is_active) {
                    return ('Coupon is Used Before');
                }
                $discountCode->is_active = true;
                $discountCode->save();
                $amount = $course->cost - ($course->cost * ($discountCode->discount / 100));
                $applicantCourse->coupon_id = $discountCode->id;
            }
        }

        $applicantCourse->amount = $amount;
        /* ================= */
        $applicantCourse->is_paid = false;
        $applicantCourse->created = date('Y-m-d');
        $applicantCourse->transaction_id = $request->input('transaction_id');
        $applicantCourse->transaction_type = $request->input('transaction_type');
        $applicantCourse->holder_name = $request->input('holder_name'); // holder name from apply to course form

        $applicantCourse->save();

        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $file->storeAs("payment" . '/' . $applicantCourse->id, $file->getClientOriginalName());
        }
        return 1;
    }

    protected function apply() {
        $request = request();
        $found = Applicant::where("email", $request->email)->first();

        // dd($found);
        if ($found == null) {
            $applicant = new Applicant();
            $applicant->first_name = $request->first_name;
            $applicant->last_name = $request->last_name;
            $applicant->personal_id = $request->personal_id;
            $applicant->email = $request->email;
//            $applicant->password = Hash::make($request->password);
            $applicant->password = $request->password;
            $applicant->mobile = $request->mobile;
            $applicant->address = $request->address;
            $applicant->dob = $request->dob;
            $applicant->gender = $request->gender;
            $applicant->is_active = 1;
            $applicant->website = 1;
            $applicant->api_token = md5($applicant->email . rand());

            $applicant->save();

            //  dd($applicant);
            $applicantId = $applicant->id;
        } else {
            $applicantId = $found->id;
        }

        $result = $this->applyToCourse($request, $applicantId);
        //dd($request);
        if ($result == 1) {
            return \Response::json(["status" => "ok", "data" => "saved"], 200, ['Content-Type' => 'application/json']);
        }
        return \Response::json(["status" => "fail", "data" => $result], 200, ['Content-Type' => 'application/json']);
    }

    protected function ApplicantApproval($id) {

        $applicant = Applicant::where("email", $id)->first();
        if ($applicant == null)
            return \Response::json(["status" => "ok", "data" => []], 200, ['Content-Type' => 'application/json']);

        $query = DB::select("select  courses.id as course_id,courses.title,a.transaction_id,discount_codes.discount,a.amount ,
          a.created , a.id 
          from applicant_course_pendings as a
         inner join courses on courses.id = a.course_id
         left join discount_codes on discount_codes.id = a.coupon_id
          where   a.applicant_id ='" . $applicant->id . "' order by a.id desc");
//       
        return \Response::json(["status" => "ok", "data" => $query], 200, ['Content-Type' => 'application/json']);
    }

    protected function myCourses($id) {
//dd($id);
        $applicant = Applicant::where("email", $id)->first();
        if ($applicant == null)
            return \Response::json(["status" => "ok", "data" => []], 200, ['Content-Type' => 'application/json']);

        $query = DB::select("select  courses.id,courses.title, courses.start_date,courses.end_date,a.transaction_id,discount_codes.discount,a.amount ,
          a.created , ev.ev_num ,evt.evt_num  , applicant_results.id as result_id
/*         , a.cert_no as cert_id */
          from applicant_course as a
         inner join courses on courses.id = a.course_id
         left join discount_codes on discount_codes.id = a.coupon_id
         left join applicant_results on applicant_results.applicant_id= a.applicant_id and applicant_results.course_id=courses.id
         left join (select count(course_evaluations.id) as ev_num ,course_id , applicant_id 
         from course_evaluations inner join questions on questions.id=course_evaluations.question_id where type='course' group by course_id , applicant_id) as ev 
        on ev.course_id=courses.id  and ev.applicant_id=" . $applicant->id . "
          
left join (select count(course_evaluations.id) as evt_num ,course_id , applicant_id 
 
         from course_evaluations inner join questions on questions.id=course_evaluations.question_id where type='trainer' group by course_id , applicant_id) as evt 
       on evt.course_id=courses.id  and evt.applicant_id=" . $applicant->id . "
           
          where   a.applicant_id =" . $applicant->id);
        return \Response::json(["status" => "ok", "data" => $query], 200, ['Content-Type' => 'application/json']);
    }

    // applicant delete course pending
    public function deleteCoursePending(Request $request)
    {
        $courseId = request()->input("course_id");
        $applicant_email = request()->input("applicant_email");
        $applicant = Applicant::where('email' , $applicant_email)->first();

        $query = Applicant_course_pending::where('course_id' ,'=' , $courseId)->where('applicant_id' , $applicant->id)->delete();
//        return \Response::json(["status" => "ok", "data" => "Deleted"], 200, ['Content-Type' => 'application/json']);
        return redirect()->back()->with('msg' , _i('Deleted Successfully'));
    }


}
