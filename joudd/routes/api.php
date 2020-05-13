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
 */

Route::post('login', 'JoudController@login');
Route::post('register', 'JoudController@register');
// get the contacts
// slider
Route::get('slider','JoudController@slider');
// sub-category
Route::get('category/{id}','JoudController@getSubCategory');
// get the cource have the category
Route::get('category/{id}/course','JoudController@getcategoryCourse');
//get instructor in the cource
Route::get('instructor/course/{id}','JoudController@getinstructor');
// get all course
Route::get('courses','JoudController@getallcources');
// get the course review
Route::get('course/{id}','JoudController@getreviewCourse');

Route::get('search/course','JoudController@search');

// get the edulevel
Route::get('edu/level','JoudController@edulevel');

Route::post('contacts','JoudController@contacts');
// category
Route::get('category','JoudController@getCategory');
//get the bank transfer
Route::get('bank/transfer','JoudController@getbank');
//get the currency data
Route::get('currency','JoudController@getcurrency');
// get the countries data
Route::get('country','JoudController@getcountrydata');

Route::get('lang','JoudController@lang');

// popualr course

Route::get('popular/course','JoudController@popularCourse');
// popular category course
Route::get('popular/category/course/{id}','JoudController@popularCategoryCourse');


//Route::get('clear', function () {
//    \Artisan::call('route:cache');
////    \Artisan::call('optimize');
////    dd("Cache is cleared");
//
//});

Route::group(['middleware' => 'auth:api'], function(){
    //course users
    Route::get('myCourses', 'JoudController@myCourses');
    // quizz user
    Route::get('myQuizz','JoudController@myQuizz');
    //get profile user
    Route::get('get-details', 'JoudController@getDetails');
    // get the questions
    Route::get('quizz/{id}','JoudController@getquizz');
    // post quizz answer
    Route::post('answer/quizz','JoudController@answerquizz');
    //getthe answer of questions
    Route::post('get/answer/question','JoudController@getanswer');
    //payment the cources
    Route::post('payment','JoudController@getpayment');
    //get the result of quize
    Route::get('result-quizz','JoudController@quiz_result');

});





