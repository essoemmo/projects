<?php


namespace App\Http\Controllers\Front\User;

use App\Front\Category;
use App\Hr\Course\Course;
use App\Http\Controllers\Api\Courses\CourseController;
use App\Http\Controllers\Controller;
use App\Models\Admin\CourseComments;
use App\Models\Admin\CourseMedia;
use App\Models\Admin\EducationLevel;
use App\Models\rating\rating;
use App\Models\rating\userRating;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function educationLevelList(Request $request)
    {
        $education_levels = EducationLevel::where('lang_id', getLang(session('lang')))
            ->where('country_id', $request->country_id)
            ->pluck("title","id");
        return $education_levels;
    }

    public function myPendingCourses()
    {
        $id = auth()->user()->id;
        $user = User::findOrFail($id);
        return view('front.user.pending-courses', compact('user'));
    }

    public function myCourses()
    {
        $id = auth()->user()->id;
        $user = User::findOrFail($id);
        return view('front.user.courses', compact('user'));
    }


    // return evaluate course form
    protected function evaluateCourse($course_id) {
        return view('front.user.evaluate-course', ["courseId" => $course_id, "api" => "course"]);
    }

    protected function evaluateCoursePost($course_id) {

        if (is_array(request()->input("q"))) {
            $questions = request()->input("q");
        }
        if (is_array(request()->input("answer"))) {
            if (is_array($questions))
                $questions = array_merge(request()->input("q"), request()->input("answer"));
            else {
                $questions = request()->input("answer");
            }
        }
        if (!isset($questions))
            return view("not_found");
        $params = ["questions" => $questions,
            "userId" => auth()->user()->email,
            "course" => $course_id
        ];
//        $api = new \App\Model\Api();
//        $res = $api->callApiPost("course/evaluate", $params);
//        $json = \GuzzleHttp\json_decode($res->getStatusCode());

        $send = new CourseController();
        $response= $send->evaluate($params);
        $json = json_encode($response);
//
        dd( response()->json($response) );
        if ($json->status == "ok")
            return view('front.user.courses', ["user" => auth()->user()])->with("msg", _i("Thanks"));
        return view('front.user.evaluate-course', ["courseId" => $course_id])->withErrors("Error");
    }

    // return evaluate trainer form
    public function evaluateTrainer($course_id) {

        return view('front.user.evaluate-course', ["courseId" => $course_id, "api" => "trainer"]);
    }

    public function course_attachments($course_id)
    {
        return view('front.user.course_attachment', compact('course_id'));

    }


    public function rating(Request $request){
        if ($request->ajax()){
            $user = User::findOrFail($request->user);
            $exists = rating::where('course_id',$request->course)->exists();
            if ($exists){
                $rating = rating::where('course_id',$request->course)->first();
                $exuserRating = userRating::where('rating_id',$rating['id'])->where('user_id',$request->user)->where('approve',1)->exists();
                if (!$exuserRating){
                    $user->ratings()->attach($rating['id'],['rating'=>$request->stars]);
                }else{
                    $user->ratings()->updateExistingPivot($rating['id'],['rating'=>$request->stars]);
                }
            }else{
                $rating = rating::create(['course_id'=>$request->course]);
                $user->ratings()->attach($rating['id'],['rating'=>$request->stars]);
            }
            $userscount = userRating::where('rating_id',$rating['id'])->where('approve',1)->count();
            $RatingUsers = userRating::where('rating_id',$rating['id'])->where('approve',1)->sum('rating') * 20;
            if ($userscount > 0){
                $rating->update(['rating'=> ($RatingUsers / $userscount)]);
            }
            $userRating = userRating::where('rating_id',$rating['id'])->where('user_id',$request->user)->where('approve',1)->first();
            return response()->json($userRating);
        }
    }


    public function sendComment(Request $request){
        $data = $this->validate($request,[
            'comment'=>'required'
        ]);
        $rating = rating::where('course_id',$request->id)->first();
        $userRating = userRating::where('rating_id',$rating['id'])->where('user_id',auth()->id())->first();
        $userRating->update(['comment'=>$request->comment]);
        return redirect()->back();
    }
    public function addToFavorite(Request $request){

        if ($request->ajax()){

            $user = auth()->user();
            if( $request->courseId ){
                $courseId = $request->courseId;
                $course = Course::findOrFail($courseId);
                $user->toggleFavorite($course);
                return response()->json($course->isFavorited());
            }

            if( $request->catId ){
                $catId = $request->catId;
                $category = Category::findOrFail($catId);
                $user->toggleFavorite($category);

                return response()->json($category->isFavorited());
            }

            if( $request->mediaId ){
                $co_mediaId = $request->mediaId;
                $course_media = CourseMedia::findOrFail($co_mediaId);
                $user->toggleFavorite($course_media);

                return response()->json($course_media->isFavorited());
            }


        }
    }

    public function favorite(){
        $user = auth()->user();
        if (auth()->check()){
            $courses = $user->favorite(Course::class);
            $categories = $user->favorite(Category::class);
            $course_media = $user->favorite(CourseMedia::class);
            return view('front.favorite.index',compact('courses','categories','course_media'));
        }
    }



    public function storeCourseComment(Request $request ,$course_id)
    {
        $rules= [
            'name' => ['required', 'string', 'max:150', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:100'],
            'message' => ['required', 'string', 'min:10'],
        ];

        $validator = validator()->make($request->all() ,$rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $course_comment = CourseComments::create([
            'name' => $request->name,
            'email' => $request->email,
            'course_id' => $course_id,
            'message' => $request->message,
        ]);
        $course_comment->save();
        return  redirect()->back()->with('info' , _i('Your message has been sent successfully'));
    }

}