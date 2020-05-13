<?php


namespace App\Http\Controllers\Front\User;


use App\Help\Buy;
use App\Hr\Course\Bank_transfer;
use App\Hr\Course\Course;
use App\Http\Controllers\Controller;
use App\Models\Admin\CourseMedia;
use App\Models\Admin\CourseMediaData;
use App\Models\Countries;
use App\Models\Currency;
use App\Models\CurrencyConvertor;
use App\Models\OrderCourses;
use App\Models\Orders;
use App\Models\transactions;
use App\Models\Settings\PriceSettings;
use App\Models\transaction_types;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class BuyController extends  Controller
{

    public function buy($type , $id)
    {
        // Buy::ID ;
        $item_id = session()->put('ID',$id);
        //   // dd(session('ID'));

        $user = auth()->user();
        $price_setting = PriceSettings::first();

        if($type == "course"){

            $item = Course::where('id' , $id)->where('lang_id' , getLang(session('lang')))->first();
            if($item==null)
                abort (404);
            $title = $item->title;
            $user_id = $item->user_id;
            $course = $item;
        }
        else if($type == "media")
        {
            $item = CourseMedia::where('id' , $id)->first();   // $item is course media
             if($item==null)
                abort (404);
            $course_media_data = CourseMediaData::where('media_id' ,$item->id)
                ->where('lang_id' , getLang(session('lang')))->first();
            $title = $course_media_data->title;
            $course = Course::where('id' ,$item->course_id)->where('lang_id' , getLang(session('lang')))->first();
            $user_id = $course->user_id;
        }
        else
             abort (404);
        $instructor = User::where('id' ,$user_id)->first();

        if(request()->cookie('country_id') != null) {
            $country_id = request()->cookie('country_id');
        } else {
//            $country_id = 1;
            $country_id = Countries::where('lang_id' , getLang(session('lang')))->first()->id;
        }

        $country = Countries::findOrFail($country_id);
        $convert = CurrencyConvertor::where('country_code',$country->code)->first();
        if($convert==null)
        {
            $convert = new \stdClass();
            $convert->rate =1;
            $convert->code ="usd";
        }
        $currency = Currency::where('country_id' , $country->id)->first()->code;

        $cost = $item->cost * $convert->rate;
        $net_price = $item->cost;

//        dd($price_setting);

        if($price_setting->type == "perc")
        {
            $price = $cost * ($price_setting->price / 100) + $cost;
        }else{
            $price = $cost + $price_setting->price;
        }
        $vars = new Buy($id , $type , $title , $currency , $price ,$net_price );
        $data = $vars->data();

        $banks = Bank_transfer::where('lang_id' ,getLang(session('lang')))->get();
        $transactions = transaction_types::where('lang_id' ,getLang(session('lang')))->get();


        return view('front.user.buy' , compact('user','type','title','price' ,'net_price','currency','instructor','course',
            'banks','transactions' ,'data'));
    }



    public function payment_offline(Request $request)
    {
        if($request->item_type == 'course') {

            if($request->bank_id)
            {
                $order = Orders::create([
                    'user_id' => auth()->user()->id,
                ]);
                $order->save();

                $id = $request->item_id;

                $transaction = transactions::create([
                    'order_id' => $order->id,
                    'status' => "pending",
                    'bank_id' => $request->bank_id,
                    'transaction_no' => $request->transaction_no,
                    'total' => $request->item_price,
                    'currency_id' => Currency::where('title' ,$request->item_currency)->first()->id,
                ]);
                $transaction->save();

                $order_course = OrderCourses::create([
                    'course_id' => $request->item_id,
                    'type' => $request->item_type,
                    'order_id' => $order->id,
                    'price' => $request->item_net_price,
                    'currency_id' => Currency::where('title' ,$request->item_currency)->first()->id,
                ]);
                $order_course->save();
            }
            return Redirect::route('subscribe', $id);
        }

        if($request->item_type == 'media') {

            if($request->bank_id)
            {
                $order = Orders::create([
                    'user_id' => auth()->user()->id,
                ]);
                $order->save();

                $id = $request->item_id;

                $transaction = transactions::create([
                    'order_id' => $order->id,
                    'status' => "pending",
                    'bank_id' => $request->bank_id,
                    'transaction_no' => $request->transaction_no,
                    'total' => $request->item_price,
                    'currency_id' => Currency::where('title' ,$request->item_currency)->first()->id,
                ]);
                $transaction->save();

                $order_course = OrderCourses::create([
                    'course_id' => $request->item_id,
                    'type' => $request->item_type,
                    'order_id' => $order->id,
                    'price' => $request->item_net_price,
                    'currency_id' => Currency::where('title' ,$request->item_currency)->first()->id,
                ]);
                $order_course->save();
            }

            return Redirect::route('subscribeMedia', $id);
        }

    }


    public function payment_online(Request $request)
    {
        
        if($request->item_type == 'course') {

            //if ($request->transaction_type_id) {
                $order = Orders::create([
                    'user_id' => auth()->user()->id,
                ]);

                $id = $request->item_id;

                $order->save();

                $transaction = transactions::create([
                    'order_id' => $order->id,
                    'type_id' => $request->transaction_type_id,
                    'status' => "paid",
                    'total' => $request->item_price,
                    'currency_id' => Currency::where('title', $request->item_currency)->first()->id,
                    'holder_name' => $request->holder_name,
                    'holder_card_number' => $request->holder_card_number,
                    'holder_cvc' => $request->holder_cvc,
                    'holder_expire' => $request->holder_expire,
                ]);
                $transaction->save();

                $order_course = OrderCourses::create([
                    'course_id' => $request->item_id,
                    'type' => $request->item_type,
                    'order_id' => $order->id,
                    'price' => $request->item_net_price,
                    'currency_id' => Currency::where('title', $request->item_currency)->first()->id,
                ]);
                $order_course->save();
          
            return Redirect::route('subscribe', $id);
        }

        if($request->item_type == 'media') {

           //if ($request->transaction_type_id) {
                $order = Orders::create([
                    'user_id' => auth()->user()->id,
                ]);

                $id = $request->item_id;

                $order->save();

                $transaction = transactions::create([
                    'order_id' => $order->id,
                    'type_id' => $request->transaction_type_id,
                    'status' => "paid",
                    'total' => $request->item_price,
                    'currency_id' => Currency::where('title', $request->item_currency)->first()->id,
                    'holder_name' => $request->holder_name,
                    'holder_card_number' => $request->holder_card_number,
                    'holder_cvc' => $request->holder_cvc,
                    'holder_expire' => $request->holder_expire,
                ]);
                $transaction->save();

                $order_course = OrderCourses::create([
                    'course_id' => $request->item_id,
                    'type' => $request->item_type,
                    'order_id' => $order->id,
                    'price' => $request->item_net_price,
                    'currency_id' => Currency::where('title', $request->item_currency)->first()->id,
                ]);
                $order_course->save();
           //}
            return Redirect::route('subscribeMedia', $id);
        }
    }



    public  function bank_details(Request $request)
    {
       // dd($request);
        $bank = Bank_transfer::where('id' , $request->bank_id)->where('lang_id' ,getLang(session('lang')))->first();
        return $bank;
    }
}
