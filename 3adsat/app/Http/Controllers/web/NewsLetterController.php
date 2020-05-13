<?php


namespace App\Http\Controllers\web;


use App\Http\Controllers\Controller;
use App\Models\Front\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsLetterController extends Controller
{

    public function userSubscribeNewsLetters(Request $request) {
        $email = $request->email;
        $subscriber = Newsletter::where('email', '=', $email)->first();
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

            return view('web.user.newsletter.subscribe');
        } else {
            $request->session()->put('email', $email);
            return view('web.user.newsletter.subscribe-before');
        }
    }

    public function deleteSubscriber(Request $request) {
        $email = $request->session()->get('email', $request->email);
        $subscriber = Newsletter::where('email', '=', $email)->first();
        if ($subscriber) {
            $subscriber->delete();
            return redirect('/')->with('info' , _i('Subscribe in Newsletter Deleted Successfully'));
        } else {
            return redirect('/')->with('danger' , _i('Your Email Not Subscribed in Newsletter'));
        }
    }
}