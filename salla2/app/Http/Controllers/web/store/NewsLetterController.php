<?php

namespace App\Http\Controllers\web\store;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\product\stores;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Models\Settings\Setting;


class NewsLetterController extends Controller
{

    public function userSubscribeNewsLetters(Request $request) {
        $email = $request->email;
        $store = stores::findOrFail(\App\Bll\Utility::getStoreId());
        $subscriber = Newsletter::where('email', '=', $email)
        ->where('store_id', $store->id)
        ->first();
        $categoriesnav = Category::where('lang_id', getLang(session('lang')))->where('store_id', $store->id)->whereNull("parent_id")->get();

        

        if (!$subscriber) {
            $rules = [
                'email' => ['required', 'string', 'email', 'max:100', 'unique:newsletters'],
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
                return redirect()->back()->withErrors($validator)->withInput();

            $subscriber = Newsletter::create([
                'email' => $request->email ,
                'store_id' => session()->get("StoreId")
            ]);

            $subscriber->save();
            $request->session()->put('email', $email);
            // dd( $subscriber );
            return view('store.newsletter.subscribe')->with(compact('setting1',
                 'categoriesnav','store' 
            ));
        } else {
            $request->session()->put('email', $email);
            return view('store.newsletter.subscribe-before')->with(compact('setting1',
            'categoriesnav', 'store'
       ));
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
