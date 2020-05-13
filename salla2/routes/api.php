<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
// */

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// api/
//Route::group(['namespace' => 'Api'] , function(){
//
//    /*======================= courses =============*/
//
//    Route::get('/applicant/all', 'Applicants\ApplicantController@allApplicants');
//    Route::get('/course/all', 'Courses\CourseController@allCourses');
//    Route::post('/course/coursebynumber', 'Courses\CourseController@getLastCoursesByNumber'); // plus if used it
//    Route::get('/course/last', 'Courses\CourseController@getLastCourses');
//    Route::post('/course/{course_id}', 'Courses\CourseController@courseData');
//    Route::get('/course/all/activate', 'Courses\CourseController@coursesActivated');
//
//
//    /*======================= applicants=============*/
//    Route::post('/applicant/register', 'Applicants\ApplicantController@register');
//    Route::post('/applicant/login', 'Applicants\ApplicantController@login');
//    Route::get('/applicant/{id}/course/details', 'Applicants\ApplicantController@applicantCoursesDetails');
//    Route::get('/applicant/{id}/details', 'Applicants\ApplicantController@applicantDetails');
//    Route::get('/applicant/{id}/approval/details', 'Applicants\ApplicantController@ApplicantApproval');
//
//    /*======================= about =============*/
//    Route::get('/about/show', 'About\AboutController@about');
//
//});
//Route::get('api/route','Api\Controller namespace@function');