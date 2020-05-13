<?php

namespace App\Http\Controllers\Front\User;

use App\Hr\Course\Applicant;
use App\Hr\Course\ApplicantCourse;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MyCoursesController extends Controller
{
    public function myCourses() {
        $user = User::findOrFail(auth()->id());
        $applicant = Applicant::where('user_id', $user->id)->first();
        $my_courses = DB::table('vwusercourse')
            ->leftJoin('courses','courses.id','vwusercourse.course_id')
            ->where('vwusercourse.user_id', $user->id)
            ->where('courses.is_active', 1)
            ->where('courses.lang_id', getLang(session('lang')))
            ->groupBy('vwusercourse.course_id')
            ->paginate(6);
        return view('front.user.courses', compact('my_courses'));
    }
}
