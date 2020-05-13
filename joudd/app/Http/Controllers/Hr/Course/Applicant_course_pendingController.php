<?php

namespace App\Http\Controllers\Hr\Course;

use App\Hr\Course\Applicant_course_pending;
use App\Hr\Course\ApplicantCourse;
use App\Hr\Course\DiscountCode;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class Applicant_course_pendingController extends Controller {

    public function all() {
        $applicantPendings = Applicant_course_pending::all();
        return view('admin.hr.course.pendings.all');
    }

    // make datatable for applicant courses pending
    public function getDatatableCoursesPending() {
//    $pending = Applicant_course_pending::select(['id','course_id', 'applicant_id', 'cost', 'amount', 'coupon_id', 'is_paid', 'created',
//        'transaction_id', 'transaction_type', 'nationality_id']);

        $pending = DB::table('applicant_course_pendings')
                        ->join('applicants', 'applicants.id', '=', 'applicant_course_pendings.applicant_id')
                        ->join('users', 'users.id', '=', 'applicants.user_id')
                        ->leftJoin('courses', 'courses.id', '=', 'applicant_course_pendings.course_id')
                        ->leftJoin('course_media', 'course_media.id', '=', 'applicant_course_pendings.media_id')
                        ->leftJoin('course_media_data', 'course_media_data.media_id', '=', 'course_media.id')
                        ->leftJoin('discount_codes', 'discount_codes.id', '=', 'applicant_course_pendings.coupon_id')
                        ->leftJoin('nationalities', 'nationalities.id', '=', 'applicant_course_pendings.nationality_id')
                        ->where('course_media_data.source_id',null)
                        ->select('applicants.id', 'users.first_name', 'users.last_name', 'courses.id', 'courses.title', 'applicant_course_pendings.id as pid',
                                'applicant_course_pendings.cost', 'applicant_course_pendings.coupon_id', 'applicant_course_pendings.amount', 'applicant_course_pendings.is_paid',
                                'applicant_course_pendings.created', 'applicant_course_pendings.transaction_id', 'applicant_course_pendings.transaction_type',
                                'nationalities.country_name', 'discount_codes.code', 'discount_codes.discount','course_media_data.title as media')->get();
        return DataTables::of($pending)
                        ->addColumn('action', function ($pending) {
                            return '<a href="' . $pending->pid . '/edit" class="btn btn-link" title="' . _i("Show") . '"><i class="fa fa-eye"></i> </a>' .
                                    '<form class="inline" method="POST" action="' . $pending->pid . '/approve" >
                                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                                        <button type="submit" class="btn btn-link" title="' . _i("Approve") . '"> <i class="fa fa-check-circle text-success"></i></button>
                            
                                    </form>
          '
                                    . '<a href="' . $pending->pid . '/delete" class="btn btn-link"  title="' . _i("Delete") . '"><i class="fa fa-remove text-danger"></i> </a>';
                        })->editColumn('is_paid', function($pending) {
                            return ($pending->is_paid == 1) ? 'Paid' : 'UnPaid';
                        })
                        ->editColumn('transaction_type', function($pending) {
                            return ($pending->transaction_type == 0) ? 'offline' : 'online';
                        })
                        ->editColumn('first_name', function($pending) {
                            return $pending->first_name . " " . $pending->last_name;
                        })
                        ->editColumn('amount', function($pending) {
                            if ($pending->coupon_id != null) {
                                $amount = $pending->cost - ($pending->cost * ($pending->discount / 100));
                            } else {
                                $amount = $pending->amount;
                            }
                            return $amount;
                        })
                        ->make(true);
    }

    public function edit($id) {
        $pending = Applicant_course_pending::findOrfail($id);
        $query = DB::table('applicant_course_pendings')
                        ->join('applicants', 'applicants.id', '=', 'applicant_course_pendings.applicant_id')
                        ->join('users', 'users.id', '=', 'applicants.user_id')
                        ->join('courses', 'courses.id', '=', 'applicant_course_pendings.course_id')
                        ->leftJoin('discount_codes', 'discount_codes.id', '=', 'applicant_course_pendings.coupon_id')
                        ->leftJoin('nationalities', 'nationalities.id', '=', 'applicant_course_pendings.nationality_id')
                        ->select('applicants.id', 'users.first_name', 'users.last_name', 'courses.id', 'courses.title', 'applicant_course_pendings.cost',
                                'applicant_course_pendings.coupon_id', 'applicant_course_pendings.amount', 'applicant_course_pendings.is_paid',
                                'applicant_course_pendings.created', 'applicant_course_pendings.transaction_id', 'applicant_course_pendings.transaction_type',
                                'applicant_course_pendings.id', 'discount_codes.code', 'discount_codes.discount', 'nationalities.country_name')->where("applicant_course_pendings.id", $id)->get()->first();

        if ($query->coupon_id != null) {
            $amount = $query->cost - ($query->cost * ($query->discount / 100));
        } else {
            $amount = $query->cost;
        }

//      return $amount;
//    dd($query);
        return view('admin.hr.course.pendings.show', compact('pending', 'query', 'amount'));
    }

// store applicant course pending data to applicant course
    protected function approvePayment($id) {
        $pending = Applicant_course_pending::findOrFail($id);
        $applicantCourse = ApplicantCourse::create([
                    'course_id' => $pending->course_id,
                    'media_id' => $pending->media_id,
                    'applicant_id' => $pending->applicant_id,
                    'cost' => $pending->cost,
                    'is_paid' => 1,
                    'created' => $pending->created,
                    'transaction_id' => $pending->transaction_id,
                    'transaction_type' => $pending->transaction_type,
                    'nationality_id' => $pending->nationality_id,
        ]);
        $applicantCourse->cert_no = \App\Utility::serialNumber();
        if ($pending->coupon_id != null) {
            $applicantCourse->coupon_id = $pending->coupon_id;
            $discountCode = DiscountCode::find($pending->coupon_id);
            $amount = $pending->cost - ($pending->cost * ($discountCode->discount / 100));
//        $applicantCourse->amount = $pending->amount;
            $applicantCourse->amount = $amount;
        } else {
            // $applicantCourse->coupon_id = null;
            $applicantCourse->amount = $pending->cost;
        }
//dd($applicantCourse);
        $applicantCourse->save();
        Applicant_course_pending::where('id', $id)->delete();
        //  ( $pending->forceDelete);
        return redirect('/admin/course/applicant/pending/all')->withFlashMessage(_i('Approved Successfully !'));
    }

    public function delete($id) {
        $pending = Applicant_course_pending::find($id);
        $pending->delete();
        return redirect()->back()->withFlashMessage('Deleted Successfully !');
    }

    // not complete yet => this function used for booking course api (edit in the future)
    public function bookingCourse(Request $request) {
        $data = ( $request->all() );

        if (count($data) > 0) {
            $data = $data[0];
            $applicantCourse = new \App\Hr\Course\Applicant_course_pending();
            $applicantCourse->applicant_id = $data["applicantId"];
            $course = Course::find($data["course"]);
            $applicantCourse->course_id = $course->id;
            $applicantCourse->cost = $course->cost;
            /* Amount */
            $amount = $course->cost;
            if ($data('coupon_id') != null) {
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
        }

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
        $applicantCourse->save();
        return 1;
    }

}

?>
