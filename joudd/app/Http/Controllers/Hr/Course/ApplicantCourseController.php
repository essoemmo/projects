<?php

namespace App\Http\Controllers\Hr\Course;

use App\Http\Controllers\Controller;
use App\Hr\Course\Course;
use Symfony\Component\HttpFoundation\Request;
use App\Hr\Course\DiscountCode;
use App\Hr\Course\ApplicantCourse;

class ApplicantCourseController extends Controller {

    private $roles = [];

    public function index() {
        $courses = Course::all(['id', 'title', 'cost']);
        return view('admin.hr.course.applicants.index', ['courses' => $courses]);
    }

    

    public function store(Request $request) {
        $appController = new ApplicantController();
        $applicat = $appController->storeApplicant($request);
        $applicantCourse = new ApplicantCourse();

        $course = Course::findOrFail($request->input('course_id'));
        $applicantCourse->applicant_id = $applicat->id;
        $applicantCourse->course_id = $course->id;
        $applicantCourse->cert_no = \App\Utility::serialNumber();
        $applicantCourse->cost = $course->cost;
        /* Amount */
        if ($request->input('coupon_id') != null) {
            $discountCode = DiscountCode::findOrFail($request->input('coupon_id'));
            if ($discountCode->is_active) {
                return redirect()->back()->withFlashMessage('Coupon is Used Before');
            }
            $discountCode->is_active = true;
            $discountCode->save();
        }
        $amount = $course->cost;
        if ($request->input('coupon_id') != null) {
            $amount = $course->cost - ($course->cost * ($discountCode->discount / 100));
            $applicantCourse->coupon_id = $discountCode->id;
        }
        $applicantCourse->amount = $amount;
        /* ================= */
        $applicantCourse->is_paid = false;
        $applicantCourse->created = date('Y-m-d');
        $applicantCourse->transaction_id = $request->input('transaction_id');
        $applicantCourse->transaction_type = $request->input('transaction_type');
        $applicantCourse->save();
        return redirect()->back()->withFlashMessage('تمت الاضافه');
    }

    public function getDiscountCode(Request $request) {

        $discountCode = DiscountCode::where('code', $request->input('discount_code'))->first();

//        if ($discountCode == null) {
//            $discountCode ="invalid";
//           // $discountCode->is_active = 0;
//        }
        return $discountCode;
    }

    public function getCourse(Request $request) {
        $course = Course::findOrFail($request->input('id'));
        return $course;
    }

}
