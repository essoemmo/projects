<?php

namespace App\Http\Controllers\Front\User;

use App\Models\CourseRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CourseRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courseRequest = CourseRequest::where('user_id',auth()->id())->select(['id', 'title', 'created_at'])->get();
//        dd($courseRequest);
        return view('front.user.courseRequests.all',compact('courseRequest'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => ['required','max:150','min:3', 'unique:course_requests,title'],
            'description' => ['required','max:150','min:3'],
        ];

        $validator = Validator::make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator);

        $courseRequests = CourseRequest::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'lang_id' => getLang(session('lang')),
        ]);
        $courseRequests->save();
        $url = url('/admin/courseRequest');
        $user = User::findOrFail(auth()->id());
        $admin = User::where('is_admin', 1)->first();
        $admin->notify(new \App\Notifications\CourseRequest($admin->id,$user->first_name,$user->last_name,$courseRequests->description,$url));
        return redirect('/user/courseRequest')->withFlashMessage(_i('Added Successfully !'));
    }

    public function showForm(Request $request) {
        if($request->ajax()) {
            $courseRequest = CourseRequest::findOrfail($request->item_id);
            return response()->json($courseRequest);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $courseRequest = CourseRequest::findOrFail($id);
        $rules = [
            'title' => ['required','max:150','min:3', 'unique:course_requests,title'],
            'description' => ['required','max:150','min:3'],
        ];

        $validator = Validator::make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator);

        $courseRequest->title = $request->title;
        $courseRequest->description = $request->description;
        $courseRequest->save();
        return redirect('/user/courseRequest')->withFlashMessage(_i('edited Successfully !'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $courseRequest = CourseRequest::findOrFail($id);
        $courseRequest->delete();
        return redirect('/user/courseRequest')->with('flash_message' ,_i('Deleted Successfully !'));
    }
}
