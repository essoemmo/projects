<?php


namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use App\Http\Middleware\lang;
use App\Models\Category;
use App\Models\ContentSection;
use App\Models\ContentSectionProduct;
use App\Models\Front\NewsLetter;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class WelcomeController extends Controller
{


    public function lang($lang) {
        session()->has('lang') ? session()->forget('lang') : '';
        session()->put('lang', $lang);
        return response()->json([$lang]);
    }

    public function index(){
        $sliders = Slider::leftJoin('sliders_translations','sliders_translations.slider_id','=','sliders.id')
        ->select('sliders_translations.title as title','sliders_translations.description as description',
            'sliders.image as image','sliders.publish as publish','sliders.id as id','sliders.url as url')
            ->where('sliders.publish' , 1)
            ->where('sliders_translations.locale', \app()->getLocale())->get(); // need to selected  lang

        $content = ContentSection::orderBy('order' , "asc")->where('type' , 'home')
            ->get();
        $categories = Category::where('parent_id' , null)->orderBy('id', 'desc')->get();
        return view('front.home' , compact('sliders','content','categories'));
    }

    public function userSubscribeNewsLetters(Request $request) {
        $email = $request->email;
        $subscriber = NewsLetter::where('email', '=', $email)->first();
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

            return view('front.user.subscribe')->with('warning' , _i('Subscribed  successfully'));
        } else {
            $request->session()->put('email', $email);
            return view('front.user.subscribe-before');
        }
    }

    public function deleteSubscriber(Request $request) {
        $email = $request->session()->get('email', $request->email);
        $subscriber = Newsletter::where('email', '=', $email)->first();
        if ($subscriber) {
            $subscriber->delete();
            return redirect('/')->with('warning' , _i('Successfully unsubscribed'));
        } else {
            return redirect('/');
        }
    }

    public function logout() {
        auth()->logout();
        return redirect(route('getLogin'));
    }
}
