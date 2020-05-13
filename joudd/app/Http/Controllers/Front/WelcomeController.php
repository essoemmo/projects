<?php

/**
 * Created by PhpStorm.
 * User: misr computer
 * Date: 29/05/2019
 * Time: 11:39 �
 */

namespace App\Http\Controllers\Front;

use App\Front\News;
use App\Front\Newsletter;
use App\Http\Controllers\Controller;
use App\Mail\SendEmail;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class WelcomeController extends Controller {

    protected function getCourse($course_id) {
        $result = file_get_contents(config("app.api_url") . '/api/course/' . $course_id);
        $json = json_decode($result);
        // dd($json->data[0]);
        if (count($json->data) > 0)
            return view('course.show', ["result" => $json->data[0]]);
        return view('not_found');
    }

    public function loginToApi() {
        // $controller = new \App\Http\Controllers\Front\WelcomeController();
        $url = config("app.api_url") . "/oauth/token";
        $fields = ["username" => config("app.api_user"),
            "password" => config("app.api_password"),
            "grant_type" => "password",
            "client_id" => 2,
            "client_secret" => "VhhJLOTCtWmcLJryV988PKk9472eW6gr4CRsAsR4"];
        $response = $this->Post($url, $fields);
        $result = json_decode($response);
        if (isset($result->access_token)) {
            request()->session()->put("access_token", $result->token_type . " " . $result->access_token);
        }
        // return $result ;
    }

//    public function cert() {
//        $id = request()->input("id");
//        if ($id !== null) {
//            //dd($id);
//            return view("front.user.certificate", ["course_id" => $id]);
//        }
//        return view("front.certificate");
//    }

    public static function get_img($id, $img) {

        $url = config("app.api_url") . "/uploads/courses/" . $id . "/" . $img;
//        dd($url);
//print_r(curl_init($url));
        if (curl_init($url) !== False)
            return $url;
        return asset("front/images/demo.jpg");
    }

    // return news-category page =>  all category news orders by desc
    public function allNewsCategory() {
        $bll = new News();
        $news = $bll->GetNews()->orderBy('news.id', 'desc')->paginate(6);
//        $news =  News::select("news.*")->join("categories","categories.id","=","news.category_id")
//                ->where('published', '=', 1)
//                ->where("categories.title" ,"!=" , \App\Model\Utility::$whatWeOffer)
//                ->orderBy('news.id', 'desc')->paginate(6);
//        $news = News::paginate(5);
        return view('front.news-category', compact('news'));
    }

    // return single-article page => one new with group of last news
    public function findNewById($id) {
        $new = News::findOrFail($id);
        $bll = new News();
        $newsLast = $bll->GetNews()->where("news.id", "!=", $id)->orderBy('news.id', 'desc')->take(5)->get();
        return view('front.single-article', compact('new', 'newsLast'));
    }

    public function allCourses() {
        return view('front.all-courses');
    }

//    public function allCourses() {
//        $json = json_decode(file_get_contents(config("app.api_url") . '/api/courses' ), true);
////        dd($json);
//        if (count($json) > 0)
//            return view('front.all-courses', ["result" => $json[0]]);
//        return view('not_found');
//    }

    public function coursesSearch(Request $request) {
//        dd($request->title);
        $title = $request->title;
        return view('front.courses-search', compact('title'));
    }

    public function apply($course_id) {
//        $json = json_decode(file_get_contents(config("app.api_url") . '/api/course/' . $course_id), true);
//        //dd($json);
//        if (count($json["data"]) > 0)
//            return view('front.user.apply', ["result" => $json["data"][0]]);

        $json = json_decode(file_get_contents(config("app.api_url") . '/api/course/' . $course_id), true);

        if (count($json["data"]) > 0)
            return view('front.user.apply', ["result" => $json["data"][0], "banks" => $json["bankTransfer"]]);

        return view('not_found');
    }

    public function Post($url, $fields) {
        if (request()->hasFile("file")) {
            $f = new \CURLFile($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name']);
            $fields["file"] = $f;
        }
//  headers: {"Authorization" : "<?= request()->session()->get("access_token")

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);                //0 for a get request
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        if (request()->session()->get("access_token") !== null) {
            //   echo "kkkkkkk";
            $header[] = 'Authorization:' . request()->session()->get("access_token");
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $response = curl_exec($ch);
        // print "curl response is:" . $response;
        curl_close($ch);
        return $response;
    }

    // this function not used yet
//    protected function applyPost($course_id) {
//        $user = auth()->user();
//        $fields = [
//            "first_name" => $user->name,
//            "last_name" => $user->last_name,
//            "email" => $user->email,
//            "password" => $user->password,
//            "mobile" => $user->mobile,
//            "address" => $user->address,
//            "dob" => $user->dob,
//            "gender" => $user->gender,
//            "course_id" => $course_id,
//            "transaction_id" => request()->input("transaction_id"),
//            "transaction_type" => request()->input("transaction_type"),
//            "coupon_id" => request()->input("coupon_id")
//        ];
//        $response = $this->Post(config("app.api_url") . '/api/applicant/apply', $fields);
//        //   echo $response;
////        die();
//        $result = json_decode($response);
//        // dd($result);
//        if ($result == null)
//            return view('not_found');
//        if ($result->status == "ok")
//            return redirect('user/pendingcourses')->with("msg", _i("Thanks for your registeration."));
//        return redirect('user/pendingcourses')->withErrors(["error" => $result->data]);
//    }



    public function paymentMethodNext(Request $request, $course_id) {
//        dd($request);
//        dd($request["coupon_id"]);
        $json = json_decode(file_get_contents(config("app.api_url") . '/api/course/' . $course_id), true);
        if (count($json["data"]) > 0) {
            return view('front.user.payment-data', ["result" => $json["data"][0], "request" => $request]);
        } else {
            return view('not_found');
        }
    }

    public function paymentSaveData(Request $request, $course_id) { // get all inputs and input hidden from -> payment-data page
//        dd($request->file);
        $user = auth()->user();
        $fields = [
//            'user_id' => $request["user_id"],
            'course_id' => $course_id,
            'holder_name' => $request["holder_name"],
            'transaction_id' => $request["transaction_id"],
            'coupon_id' => $request["coupon_id"],
            'coupon_id_2' => $request["coupon_id_2"],
            'bank_transfer' => $request["bank_transfer"],
            'transaction_type' => $request["transaction_type"],
            "first_name" => $user->name,
            "last_name" => $user->last_name,
            "personal_id" => $user->personal_id,
            "email" => $user->email,
            "password" => $user->password,
            "mobile" => $user->mobile,
            "address" => $user->address,
            "dob" => $user->dob,
            "gender" => $user->gender,
            "personal_id" => $user->pin_code,
//                 "file" => $request["file"],
        ];

        if ($request->hasFile('file')) {
            $fields["file"] = $request["file"];
        }
//dd($fields);
        $response = $this->Post(config("app.api_url") . '/api/applicant/apply', $fields);
        //    dd($response);
//        die();
        $result = json_decode($response);
        // dd($result);
        if ($result == null)
            return view('not_found');
        if ($result->status == "ok")
            return redirect('user/pendingcourses')->with("msg", _i("Thanks for your registeration."));
        return redirect('user/pendingcourses')->withErrors(["error" => $result->data]);
    }

    // not complete yet => this function used for booking course (edit in the future)
    public function bookingCourse(Request $request) {
//    dd($request);
        $user = User::where('email', '=', $request->email)->first();
        if ($user == null) {
            // create new at users table
            $user = User::create([
                        'email' => $request->email,
                        'mobile' => "guest",
                        'name' => "guest",
                        'last_name' => "guest",
                        'personal_id' => "guest",
                        'password' => Hash::make($request->password),
                        'nationality' => "guest",
                        'dob' => date("Y-m-d"),
                        'address' => "guest",
                        'gender' => "guest",
                        'is_admin' => 0,
            ]);
            $user->assignRole('registerd-users');
            $user->save();
        }
        $userdata = array(
            'email' => $user->email, // Input::get('email'),
            'password' => request()->input("password") //Input::get('password')
        );

        // attempt to do the login
        if (\Illuminate\Support\Facades\Auth::attempt($userdata)) {
            $this->loginToApi();

            // validation successful!
            // redirect them to the secure section or whatever
            // return Redirect::to('secure');
            // for now we'll just echo success (even though echoing in a controller is bad)
            // echo 'SUCCESS!';
            // redirect()->to($path)
            return redirect()->to("/course/" . $request->courseId . "/apply");
        }
        return redirect("/user/login")->withErrors(["password" => "Invalid Password"]);
        //echo "fffffffff";
        //$result = \Illuminate\Support\Facades\Auth::login($user, false)   ;
        //dd($result);
    }

    protected function deleteCoursePending() {
        $id = request()->input("id");
        $fields = [
            "id" => $id,
                // "applicantId" => $applicantId
        ];
        $url = config('app.api_url') . '/api/pending/' . 'delete';
        //  echo($url);
        // print_r($fields);
        $response = $this->Post($url, $fields);
        $result = json_decode($response);
        echo $response;
        //dd ($result);
        if ($result == null)
            return view('not_found');
        if ($result->status == "ok")
            return redirect('user/pendingcourses')->with("msg", _i("The Booking Course Deleted Successfully ."));
        return redirect('user/pendingcourses')->withErrors(["error" => $result->data]);
    }

    public function frontAbout() {
        return view('front.about');
    }

    protected function whatWeOffer() {
        return view('front.what-offer.mnu');
    }

    public function mission() {
        return view('front.mission');
    }

    public function userSubscribeNewsLetters(Request $request) {
//        dd($request);
        $email = $request->email;
//        dd($email);
        $subscriber = Newsletter::where('email', '=', $email)->first();
//        dd($subscriber);
        if (!$subscriber) {
            $rules = [
                'email' => ['required', 'string', 'email', 'max:100', 'unique:newsletters'],
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
                return redirect()->back()->withErrors($validator)->withInput();

            $subscriber = Newsletter::create([
                        'email' => $request->email
            ]);

            $subscriber->save();
            $request->session()->put('email', $email);
//            dd($request->session()->get('email', $email));

            return view('front.user.subscribe');
        } else {
            $request->session()->put('email', $email);
            return view('front.user.subscribe-before');
        }
    }

    public function deleteSubscriber(Request $request) {
        $email = $request->session()->get('email', $request->email);
//        dd($email);
        $subscriber = Newsletter::where('email', '=', $email)->first();
//        dd($subscriber);
        if ($subscriber) {
            $subscriber->delete();
            return redirect('/');
        } else {
            return redirect('/');
        }
    }

}
