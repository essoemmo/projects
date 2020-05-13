<?php

namespace App\Http\Controllers\front\auth;

use App\Front\Category;
use App\Hr\Course\Applicant;
use App\Hr\Course\Course;
use App\Hr\Course\Trainer;
use App\Models\Admin\EducationLevel;
use App\Models\Countries;
use App\Models\student;
use App\Notifications\acceptTrainer;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller {

    public function choose() {
        if (auth()->user() != null) {
            return redirect("profile");
        }
        $categories_nav = Category::limit(6)->get();
        return view('front.users.choose', compact('categories_nav'));
    }

    public function signUp(Request $request) {
        if (auth()->user() != null) {
            return redirect("profile");
        }
        if ($request->cookie('country_id') != null) {
            $country_id = $request->cookie('country_id');
        } else {
//            $country_id = 1;
            $country_id = Countries::where('lang_id', getLang(session('lang')))->first()->id;
        }
//        dd($request->a);
        if ($request->a == 'student') {
            $categories_nav = Category::limit(6)->get();
            $countries = countries::where('lang_id', getLang(session('lang')))->get();
            $courses = Course::where('is_active', '=', 1)->get();
            $edu_levels = EducationLevel::where('lang_id', getLang(session('lang')))->where('country_id', $country_id)->get();
            return view('front.users.student.student_register', compact('categories_nav', 'countries', 'courses', 'edu_levels'));
        } elseif ($request->a == 'instructor') {
            $categories_nav = Category::limit(6)->get();
            $countries = countries::where('lang_id', getLang(session('lang')))->get();
            return view('front.users.teacher.teacher_register', compact('categories_nav', 'countries'));
        }
    }

    private function upload($request, $user) {
        if ($request->has('image') && $request->image != null) {
            $image = $request->file('image');
            if ($image && $file = $image->isValid()) {
                $destinationPath = public_path('uploads/profiles/' . $user->id);
                mkdir($destinationPath);
                $destinationPath .= "/";
                $fileName = $image->getClientOriginalName();
                $image->move($destinationPath, $fileName);
                $request->image = $fileName;

                if (!empty($user->image)) {
                    //delete old image
                    $file = public_path('uploads/profiles/' . $user->id . '/') . $user->image;
                    @unlink($file);
                }
            }
            $user->image = $request->image;
            $user->save();
        }
    }

    private function initUser($request) {
        $user = new User();
        $user->first_name = $request->firstName;
        $user->last_name = $request->LastName;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->is_admin = 0;


        $user->mobile = $request->mobile;
        $user->country_id = $request->input('country_id');
        return $user;
    }

    public function store(Request $request) {
//        dd($request->all());
        $rules = [
            'firstName' => ['required', 'string', 'max:150', 'min:3'],
            'LastName' => ['required', 'string', 'max:150', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:150', 'unique:users'],
            'password' => ['required', 'confirmed'],
            'mobile' => ['required', 'numeric', 'unique:users'],
          //  'image' => ['required', 'image'],
            'country_id' => ['required'],
            'address' => ['required'],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            // $user->save();
            if ($request->type == 'applicant') {
                $user = $this->initUser($request);
                $user->type = "applicant";
                $user->is_active = 1;

                $user->save();
                $this->upload($request, $user);
                $user->assignRole('registered-users');
                $applicant = new Applicant();
                $applicant->user_id = $user->id;
                $applicant->address = $request->address;
                $applicant->country_id = $request->country_id;
                $applicant->grade = $request->grade;
                $applicant->education_level = $request->edu_level;
                $applicant->save();
                return redirect('user/login')->with('success', _i('Thanks for Your Registration'));
            } elseif ($request->type == 'trainer') {
                $user = $this->initUser($request);
                $user->is_active = 0;
                $user->type = "trainer";
                $user->save();
                $this->upload($request, $user);
                $user->assignRole('trainer');
                $trainer = new Trainer();
                $trainer->user_id = $user->id;
                $trainer->address = $request->address;
                $trainer->country_id = $request->country_id;
//
            $url =   url('/admin/trainer/pending');
             
                $description = _i('Please Approve');
                $admin = User::where('is_admin', 1)->first();
                $admin->notify(new acceptTrainer($admin->id, $user->first_name, $user->last_name, $description, $url));

                $trainer->save();
                return redirect('user/login')->with('success', _i('Thanks for Your Registration. Your account will be activated soon.'));
            }
        }
    }

}
