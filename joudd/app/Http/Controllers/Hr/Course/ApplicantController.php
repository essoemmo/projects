<?php

namespace App\Http\Controllers\Hr\Course;

use App\Hr\Course\Applicant;
use App\Http\Controllers\Controller;
use App\Models\Admin\EducationLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use App\Hr\Course\Course;
use App\Hr\Course\ApplicantCourse;
use App\Help\Coupon;
use App\Hr\Course\DiscountCode;

class ApplicantController extends Controller {

    private $roles = [
        'email' => 'required|unique:applicants,email',
        'password' => 'required|confirmed',
        'personal_id' => 'required|numeric|unique:applicants,personal_id',
    ];

    public function allApplicant() {
        $courses = Course::all();
        $education_levels = EducationLevel::all();
        return view('admin.hr.course.applicants.allApplicant', compact('courses','education_levels'));
    }

    public function getApplicantInfo(Request $request) {
        if($request->ajax()){
            if($request->has('courses')){
                $applicant = Applicant::findOrFail($request->input('id'));
                return $this->courses($applicant->id);
            }
            elseif($request->has('register') && $request->has('course_id')){
                return $this->registerCourse($request);
            }
            elseif($request->has('unregister')&&$request->app_course_id != null){
                return $this->unregisterCourse($request->app_course_id);
            }
            elseif($request->has('eva')){
                return DB::select('select * from course_evaluations join questions on questions.id = course_evaluations.question_id
 where course_evaluations.applicant_id = ?  and course_evaluations.course_id = ? ',[$request['id'],$request['course_id']]);
            }
        }
        $applicant = Applicant::findOrFail($request->input('id'));
        $attached_courses = DB::table('applicant_course')
            ->join('courses' ,'courses.id' , '=' , 'applicant_course.course_id')
            ->select('courses.id' ,'courses.title')
            ->where('applicant_id' ,'=' , $applicant->id)->get();


        return view('admin.hr.course.applicants.info', ['applicant' => $applicant , 'attached_courses' => $attached_courses]);
    }

//    private function get_evaluation_course($courseId , $applicantId){
//        return  DB::table('course_evaluations')
//            ->join('questions' ,'questions.id' ,'=' , 'course_evaluations.question_id')
//            ->where('applicant_id', $applicantId)
//            ->where('course_id', $courseId)
//            ->get('*');
//    }


    private function courses($id){
        $courses = DB::table('applicants')
        ->join("applicant_course","applicant_course.applicant_id","=","applicants.id")
        ->join("courses","courses.id","=","applicant_course.course_id")
        ->select("applicant_course.id","courses.title","courses.duration","courses.cost","applicant_course.amount","applicant_course.is_paid","applicant_course.transaction_id")
        ->where("applicants.id","=",$id)->get();
        return DataTables::of($courses)->editColumn('is_paid',function($course){
            return ($course->is_paid == 1)?'Paid':'UnPaid';
        })->addColumn('remove',function($r){
            return "<a onClick=\"removeCourse({$r->id})\">حذف</a>";
        })->rawColumns(['remove'])->make(true);
    }
    private function unregisterCourse($applicant_course_id){
        ApplicantCourse::destroy($applicant_course_id);
        return 'Applicant Course Deleted';
    }
    private function registerCourse(Request $request){
        // get copon  and set is active 1;
        //set cost for course's cost
        //set amount for cost-(cost*(coupn_discount/100))
        //set transcation_type  bank_transfer
        //set is paid 1;
        $app_course =  new ApplicantCourse();
        $trans_id = $request->input('transaction_id','');
        $course = Course::find($request->course_id);
        $applicant = Applicant::find($request->applicant_id);
        $amount =  $course->cost;
        if($request->coupon_id != null){
            $coupon = DiscountCode::find($request->coupon_id);
            $app_course->coupon_id = $coupon->id;
            $coupon->is_active = 1;
            $coupon->save();
            $amount =  $course->cost-($course->cost*($coupon->discount/100));
        }
        //'course_id', 'applicant_id', 'cost', 'amount', 'coupon_id', 'is_paid', 'transaction_id', 'transaction_type'
        $app_course->course_id = $course->id;
        $app_course->applicant_id = $applicant->id;
        $app_course->cost = $course->cost;
        $app_course->amount = $amount;
        $app_course->is_paid = 1;
        $app_course->transaction_id = $trans_id;
        $app_course->transaction_type = "bank_transfer";
        $app_course->save();

        return 1;
    }

    public function getDatatableApplicant() {
        $applicant = Applicant::leftJoin('users','users.id','applicants.user_id')->select(['applicants.id', 'first_name', 'last_name', 'website', 'email', 'address', 'dob', 'gender', 'is_active', 'applicants.created_at', 'applicants.updated_at']);

        return DataTables::of($applicant)
            ->addColumn('action', function ($applicant) {
                return '<a href="'.url('admin/course/applicant/'.$applicant->id.'/edit').'"  class="btn btn-icon waves-effect waves-light btn-default" title="Edit"><i class="fa fa-edit"></i> </a>'."&nbsp;".
                    '<a href="'.route('info_applicant').'?id='. $applicant->id.'" class="btn btn-icon waves-effect waves-light btn-default" title="Show Info"><i class="fa fa-fw fa-gg-circle"></i> </a>'."&nbsp;".
                    '<a href="'.url('admin/course/applicant/'.$applicant->id.'/delete').'"  class="btn btn-icon waves-effect waves-light btn-pink" title="Delete"><i class="fa fa-remove"></i> </a>';
            })
            ->editColumn('is_active', function($applicant) {
                return $applicant->is_active == 1 ? 'Active' : 'Not Active';
            })
            ->editColumn('website', function($applicants) {
                return $applicants->website == 0 ? 'yes' : 'No';
            })
//            ->addColumn('select_users', function($applicant) {
//
//                return '<input type="checkbox" class="minimal control-label" id="checkbox" name="users[]" value="'.$applicant->id.'" >';
//            })
            ->rawColumns([
                //'select_users',
                'action',
            ])
            ->make(true);
    }

    public function getDatatableApplicantByCourseName(Request $request) {


        $applicants = DB::table('applicants')->leftJoin('users','users.id','applicants.user_id')
            ->select(['applicants.id', 'users.first_name', 'users.last_name', 'applicants.website', 'users.email', 'applicants.address', 'applicants.dob', 'applicants.gender', 'users.is_active', 'applicants.created_at', 'applicants.updated_at']);
        if ($request->input('course_id') > 0)
            $applicants->join('applicant_course', 'applicant_course.applicant_id', '=', 'applicants.id')
                ->where ('applicant_course.course_id', '=', $request->input ('course_id'));

        if($request->education_level)
            $applicants->where ('applicants.education_level' , $request->education_level);

        $applicants->get();

        //dd($applicants);
        return DataTables::of($applicants)
                        ->addColumn('action', function ($applicants) {
                            return '<a href="' . $applicants->id . '/edit" class="btn btn-icon waves-effect waves-light btn-default" title="'._i("Edit").'"><i class="fa fa-edit"></i> </a>' . "&nbsp;&nbsp;&nbsp;" .
                                    '<a href="' . $applicants->id . '/delete" class="btn btn-icon waves-effect waves-light btn-pink" title="'._i("Delete").'"><i class="fa fa-remove"></i> </a>';
                        })
                        ->editColumn('is_active', function($applicants) {
                            return $applicants->is_active == 1 ? 'Active' : 'Not Active';
                        })
                        ->make(true);


//    $course = Course::where('title', 'like', "%$request->input('title')%")
//        ->with('applicants')
//        ->get();
//    return $course;
//    $course = DB::table('courses')->where('title', 'like', "%$request->input('title')%")->get();
//    if(count($course) > 0 ) {
//      $applicants = DB::table('applicants')->select('applicants.first_name', 'applicants.last_name',
//          'applicants.email', 'applicants.mobile', 'applicants.address', 'applicants.is_active', 'applicants.created_at')
//          ->join('applicant_course', 'applicant_course.applicant_id', '=', 'applicants.id')
//          ->join('applicant_course', 'applicant_course.course_id', '=', 'courses.id')
//          ->where('courses.title', 'like', "%$request->input('title')%")
//          ->get();
//    }
//    dd($applicants);
//    $course = DB::table('courses')->where('title', 'like', "%$request->input('title')%")->get();
//
//    if(count($course) > 0 ){
//      $applicants = DB::table('applicants')
//          ->join('applicant_course', 'applicant_course.course_id','=','courses.id')
//          ->join('applicant_course' , 'applicant_course.applicant_id' ,'=','applicants.id')
//          ->select('applicants.*')
//          ->where('courses.title', 'like',"%$request->input('title')%")
//          ->get();
//      return $applicants;
//
//    }
    }

    public function createApplicant() {
        $courses = Course::all(['id', 'title', 'cost']);
        return view('admin.hr.course.applicants.addApplicant', ['courses' => $courses]);
    }

    public function storeApplicant(Request $request) {
//        $request->validate($this->roles);

        $validator = Validator::make($request->all(), $this->roles);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $applicant = new Applicant();
        $applicant->first_name = $request->first_name;
        $applicant->last_name = $request->last_name;
        $applicant->personal_id = $request->personal_id;
        $applicant->email = $request->email;
        $applicant->password = Hash::make($request->password);
        $applicant->mobile = $request->mobile;
        $applicant->address = $request->address;
        $applicant->dob = $request->dob;
        $applicant->gender = $request->gender;
        $applicant->website = 0;
        if ($request->has('is_active')) {
            $applicant->is_active = $request->is_active;
        }

        $applicant->save();
        return $applicant;
    }

    public function showApplicant($id) {
        $applicant = Applicant::find($id);
        return view('admin.hr.course.applicants.editApplicant', compact('applicant'));
    }

    public function updateApplicant($id, Request $request) {
        $applicant = Applicant::find($id);
        $rules = [
            'first_name' => ['required', 'string', 'max:150', 'min:3'],
            'last_name' => ['required', 'string', 'max:150', 'min:3'],
            'personal_id' => ['required','numeric',Rule::unique('applicants')->ignore($applicant->id)],
            'email' => ['required', 'string', 'email', 'max:150', Rule::unique('applicants')->ignore($applicant->id)],
            'password' => ['sometimes', 'confirmed'],
            'mobile' => ['required', 'string', Rule::unique('applicants')->ignore($applicant->id)],
            'address' => ['required', 'string'],
            'dob' => ['required', 'date'],
            'gender' => ['required'],
        ];
        if (!is_null($request->password)) {
            $rules['password'] = ['confirmed', 'min:6', 'string'];
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator);

        $applicant->first_name = $request->first_name;
        $applicant->last_name = $request->last_name;
        $applicant->personal_id = $request->personal_id;
        $applicant->email = $request->email;
        $applicant->mobile = $request->mobile;
        $applicant->address = $request->address;
        $applicant->dob = $request->dob;
        $applicant->gender = $request->gender;

        if ($request->has('password') && $request->input('password') != null) {
            $applicant->password = Hash::make($request->password);
        }
        if ($request->has('is_active')) {
            $applicant->is_active = $request->is_active;
        }
        $applicant->save();

        return redirect('/admin/course/applicant/' . $applicant->id . '/edit')->withFlashMessage(_i('Updated Successfully !'));
    }

    public function deleteApplicant($id) {
        $applicant = Applicant::find($id);
        $applicant->delete();

        return redirect('/admin/course/applicant/all')->withFlashMessage(_i('Deleted Successfully !'));
    }

}
