<?php

namespace App\Http\Controllers\Admin;

use App\Models\CourseRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CourseRequestController extends Controller
{
    public function index() {
        $courseRequest = CourseRequest::leftJoin('users', 'users.id' ,'course_requests.user_id')
            ->leftJoin('applicants', 'applicants.user_id', 'users.id')
            ->leftJoin('countries', 'countries.id', 'applicants.country_id')
            ->select('users.first_name', 'users.last_name','users.email','course_requests.description', 'course_requests.title','course_requests.id','countries.title as country')->get();
//        dd($courseRequest);
        return view('admin.courseRequests.all',compact('courseRequest'));
    }

    public function showForm(Request $request) {
        if($request->ajax()) {
            $courseRequest = CourseRequest::leftJoin('users', 'users.id' ,'course_requests.user_id')
            ->leftJoin('applicants', 'applicants.user_id', 'users.id')
            ->leftJoin('countries', 'countries.id', 'applicants.country_id')
            ->where('course_requests.id', $request->item_id)
            ->select('users.first_name', 'users.last_name','users.email','course_requests.description', 'course_requests.title','course_requests.id','countries.title as country')->firstOrFail();
//            dd($courseRequest);
            return response()->json($courseRequest);
        }
    }

    public function update(Request $request, $id)
    {
//        dd($request->all());
        $courseRequest = CourseRequest::findOrFail($id);
        $rules = [
            'response' => ['required','max:150','min:3'],
        ];

        $validator = Validator::make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator);

        $courseRequest->response = $request->response;
        $courseRequest->save();
        return redirect('/admin/courseRequest')->withFlashMessage(_i('edited Successfully !'));
    }

    public function destroy($id)
    {
        $courseRequest = CourseRequest::findOrFail($id);
        $courseRequest->delete();
        return redirect('/admin/courseRequest')->with('flash_message' ,_i('Deleted Successfully !'));
    }
}
