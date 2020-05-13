<?php

use App\Hr\Course\Course;
use App\Models\rating\rating;
use App\Models\Settings\Setting;

if (!function_exists('lang')){
    function lang(){
        $firstLang = \App\Models\Language::first();
        if(session()->has('lang')){
            return session('lang');
        }else{
            session()->put('lang',$firstLang->code);
            return session('lang');
        }
    }
}
if (!function_exists('adminLang')){
    function adminLang(){
        $firstLang = \App\Models\Language::first();

        if(session()->has('adminLang')){
            return session('adminLang');
        }else{
            session()->put('adminLang',$firstLang->code);
            return session('adminLang');
        }
    }
}

if (!function_exists('getLang')){
    function getLang($session){
        $language = \App\Models\Language::where('code',$session)->first();
        if ($language == null){
            return;
        }else{
            return $language['id'];
        }
    }
}


if (!function_exists('getLangCode')){
    function getLangCode($lang_id){
        $language = \App\Models\Language::where('id',$lang_id)->first();
            return $language['code'];
    }
}

if (!function_exists('getTags')){
    function getTags($media_id){
       $tags = \App\Models\Admin\CourseMediaTags::where('media_id' , $media_id) ->where('lang_id', getLang(session('lang')))->get();
       return $tags;
    }
}

if (!function_exists('users_group')){
    function users_group($group_id){
       $users = \App\Model\UsersGroup::where('group_id' , $group_id)->get();
       return $users;
    }
}

function responseJson($status , $message , $data = null)
{
    $response =
        [
            'status'    => $status,
            'msg'   => $message,
            'data'      => $data
        ];
    return response()->json($response,JSON_UNESCAPED_UNICODE );
}

function relations(){

    $array = [
        'Father'  =>  'Father',
        'Mother'  =>  'Mother',
        'GrandFather'  =>  'GrandFather',
        'GrandMother'  =>  'GrandMother',
        'Husband'  =>  'Husband',
        'Wife'  =>  'Wife',
        'Sister'  =>  'Sister',
        'Brother'  =>  'Brother',
        'Son'  =>  'Son',
        'Daughter' => 'Daughter',
        'Uncle' => 'Uncle',
        'Nephew' => 'Nephew',
        'Son of a Sister' => 'Son of a Sister',
        'Niece' => 'Niece',
        'Cousin' => 'Cousin',
    ];

    return $array;
}

if (!function_exists('setting')){
    function setting($value = null){
//        return Setting::where('lang_id',getLang(session('lang')))->first();
        return Setting::first();
    }
}


if (!function_exists('Rate')){
    function Rate($id,$course_id){
        $rating = App\Models\rating\rating::where('course_id',$course_id)->first();
        $exist = \App\Models\rating\userRating::where('user_id',$id)->where('rating_id',$rating['id'])->first();
        if ($exist['rating'] != null){
            return true;
        }
        return false;
    }
}

if (!function_exists('existRate')){
    function existRate($id,$course_id){
        $rating = App\Models\rating\rating::where('course_id',$course_id)->first();
        $exist = \App\Models\rating\userRating::where('user_id',$id)->where('rating_id',$rating['id'])->first();
        if ($exist['comment'] != null){
            return true;
        }
        return false;
    }
}

if (!function_exists('courseRate')){
    function courseRate($course_id){
        $rating = App\Models\rating\rating::where('course_id',$course_id)->first()['rating'];
        return $rating;
    }
}


if (!function_exists('userRating')){
    function userRating($course_id , $user_id){
        $rating = App\Models\rating\rating::where('course_id',$course_id)->first();
        $user_rating = $rating->userRating->where('user_id' , $user_id)->first();
        return $user_rating;
    }
}

if(!function_exists('couseRating')){
    function couseRating($course_id){
        $rating = rating::where('course_id',$course_id)->first();
        return $rating['rating'];
    }
}

if(!function_exists('course_details')){
    function course_details($course_id){
        $course = Course::FindOrFail($course_id);
        return $course;
    }
}

if(!function_exists('media_details')){
    function media_details($media_id){
        $media_data = \App\Models\Admin\CourseMediaData::where('media_id' , $media_id)->first();
        return $media_data;
    }
}

if(!function_exists('media')){
    function media($media_id){
        $media = \App\Models\Admin\CourseMedia::where('id' , $media_id)->first();
        return $media;
    }
}


if(!function_exists('applicant_details')){
    function applicant_details($user_id){
        $applicant = \App\Hr\Course\Applicant::where('user_id' , $user_id)->first();
        return $applicant;
    }
}



//public function uploadFile($request , $path = '/public/uploads/finances/' )
//{
//    $fileName = $request->getClientOriginalName();
//    $request->move(
//        base_path().$path , $fileName
//    );
//
//    return $fileName ;
//
//}

function deleteImage($deleteFileWithName){
    if(file_exists($deleteFileWithName)){
        \Illuminate\Support\Facades\File::delete($deleteFileWithName);
    }

}
?>
