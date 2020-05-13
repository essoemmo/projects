<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\FeaturedAd;
use App\Models\FeaturedAdUser;
use App\Models\Order;
use App\Models\Point;
use App\Models\PointUser;
use App\Models\SocialAdvertisement;
use App\Models\SocialAdvertisementUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function saveOrder(Request $request)
    {

        $number = Order::orderBy('id', 'desc')->first();
        if ($number) {
            $orderNumber = $number['orderNumber'] + 1;
        } else {
            $orderNumber = 1;
        }

        $user = User::findOrFail(auth()->id());
        $feature = FeaturedAd::where('place', $request->feature_id)->first();
//        $bank = $request->bank_id;
//        $bank_transactions_num = $request->get('bank_transactions_num_' . $bank);
//        $holder_name = $request->get('holder_name_' . $bank);
        $currency = $request->currency;
//        $payment_type = $request->payment_type;
//        $image = $request->file('image_' . $bank);
        $social_link_id = $request->social_link_id;
//        $duration = $request->duration;
        $feature_id = $feature->id;
        $feature_type = $feature->place;
        $feature_price = $feature->price;
        $total = $feature_price;


        if ($orderNumber != null && $user->id != null) {
            DB::beginTransaction();
//            session()->put('orderNumber',$orderNumber);
            try {
                $order = Order::create(['user_id' => $user->id, 'orderNumber' => $orderNumber, 'total' => $total, 'status' => 'wait']);
//                dd($orderNumber,$feature,$feature_type,$feature_id);
                $feature_user = FeaturedAdUser::create([
                    'orderNumber' => $orderNumber,
                    'user_id' => $user->id,
                    'featured_id' => $feature_id,
                    'featured_type' => $feature_type,
                    'publish' => 0,
                    'social_link_id' => $social_link_id,
//                    'duration' => $duration,
                    'price' => $feature_price,
                    'total' => $total,
                ]);
                $point = Point::where('code', 'website')->first();
                if ($point != null) {
                    $user_point = PointUser::create([
                        'user_id' => $user->id,
                        'point_id' => $point->id,
                        'point' => $point->points_number,
                        'code' => $point->code,
                    ]);
                }
//                if ($image) {
//                    $numberrand = rand(11111, 99999);
//                    $randname = time() . $numberrand;
//                    $imageName = $randname . '.' . $image->getClientOriginalExtension();
//                    $image->move(public_path('uploads/payment'), $imageName);
//                }
//                if ($payment_type == 'bank') {
//                    $transaction = Transaction::create(['holder_name' => $holder_name, 'order_id' => $order->id, 'payment_type' => $payment_type, 'status' => 'pending', 'bank_id' => $bank, 'bank_transactions_num' => $bank_transactions_num, 'currency' => $currency, 'image' => '/uploads/payment/' . $imageName]);
//                }
                DB::commit();
            } catch (\Exception $e) {
                return $e;
                DB::rollBack();
            }
            $order;
            $feature_user;
//            $transaction;
        }
        return redirect()->back()->with('success', _i('Your Request Is Pending Approval'));
    }

    public function celebrityAdsStore(Request $request)
    {
//        $this->validate($request, [
//            'holder_name_*' => 'sometimes',
//            'bank_transactions_num_*' => 'sometimes',
//            'image_*' => 'sometimes',
//        ]);

        $number = Order::orderBy('id', 'desc')->first();
        if ($number) {
            $orderNumber = $number['orderNumber'] + 1;
        } else {
            $orderNumber = 1;
        }

        $user = User::findOrFail(auth()->id());
        $famous = User::findOrFail($request->famous_user);
        $advertise = SocialAdvertisement::where('type', $request->advertisement_type)->first();
//        $bank = $request->bank_id;
//        $bank_transactions_num = $request->get('bank_transactions_num_' . $bank);
//        $holder_name = $request->get('holder_name_' . $bank);
        $currency = $request->currency;
//        $payment_type = $request->payment_type;
//        $image = $request->file('image_' . $bank);
        $social_link_id = $request->social_link_id;
//        $duration = $request->duration;
        $advert_type = $advertise->type;
        $advertise_price = $advertise->price;
        $famous_cost = $famous->cost;
        $total = $advertise_price + $famous_cost;
        $gender = $request->gender;
        $account_content_type = $request->account_content_type;
        $content = $request->ad_text;

        if ($orderNumber != null && $user->id != null) {
            DB::beginTransaction();
            try {
                $order = Order::create(['user_id' => $user->id, 'orderNumber' => $orderNumber, 'total' => $total, 'status' => 'wait']);
                $advert_user = SocialAdvertisementUser::create([
                    'orderNumber' => $orderNumber,
                    'user_id' => $user->id,
                    'social_link_id' => $social_link_id,
                    'famous_id' => $famous->id,
                    'account_type_id' => $account_content_type,
                    'advert_type' => $advert_type,
                    'publish' => 0,
                    'content' => $content,
                    'price' => $advertise_price,
                    'total' => $total,
                ]);
                $point = Point::where('code', 'famous')->first();
                if ($point != null) {
                    $user_point = PointUser::create([
                        'user_id' => $user->id,
                        'point_id' => $point->id,
                        'point' => $point->points_number,
                        'code' => $point->code,
                    ]);
                }
                if ($request->hasFile('file')) {
                    $image_file = $request->file('file');
                    $filename = time() . '.' . $image_file->getClientOriginalExtension();
                    $request->file->move(public_path('uploads/advert_user/' . $advert_user->id), $filename);
                    $advert_user->file = '/uploads/advert_user/' . $advert_user->id . '/' . $filename;
                    $advert_user->save();
                }
//                if ($image) {
//                    $numberrand = rand(11111, 99999);
//                    $randname = time() . $numberrand;
//                    $imageName = $randname . '.' . $image->getClientOriginalExtension();
//                    $image->move(public_path('uploads/payment'), $imageName);
//                }
//                if ($payment_type == 'bank') {
//                    $transaction = Transaction::create(['holder_name' => $holder_name, 'order_id' => $order->id, 'payment_type' => $payment_type, 'status' => 'pending', 'bank_id' => $bank, 'bank_transactions_num' => $bank_transactions_num, 'currency' => $currency, 'image' => '/uploads/payment/' . $imageName]);
//                }
                DB::commit();
            } catch (\Exception $e) {
                return $e;
                DB::rollBack();
            }
            $order;
            $advert_user;
//            $transaction;
        }
        return redirect()->back()->with('success', _i('Your Request Is Pending Approval'));
    }

    public function ourAccountAdsStore(Request $request)
    {
//        $this->validate($request, [
//            'holder_name_*' => 'sometimes',
//            'bank_transactions_num_*' => 'sometimes',
//            'image_*' => 'sometimes',
//        ]);

        $number = Order::orderBy('id', 'desc')->first();
        if ($number) {
            $orderNumber = $number['orderNumber'] + 1;
        } else {
            $orderNumber = 1;
        }
//        dd($request->all());

        $user = User::findOrFail(auth()->id());
        $advertise = SocialAdvertisement::where('type', $request->advertisement_type)->first();
//        $bank = $request->bank_id;
//        $bank_transactions_num = $request->get('bank_transactions_num_' . $bank);
//        $holder_name = $request->get('holder_name_' . $bank);
        $currency = $request->currency;
        $payment_type = $request->payment_type;
//        $image = $request->file('image_' . $bank);
        $social_link_id = $request->social_link_id;
//        $duration = $request->duration;
        $advert_type = $advertise->type;
        $advertise_price = $advertise->price;
        $total = $advertise_price;
        $account_content_type = $request->account_content_type;
        $content = $request->ad_text;

        if ($orderNumber != null && $user->id != null) {
            DB::beginTransaction();
//            session()->put('orderNumber',$orderNumber);
            try {
                $order = Order::create(['user_id' => $user->id, 'orderNumber' => $orderNumber, 'total' => $total, 'status' => 'wait']);
//                dd($orderNumber,$feature,$feature_type,$feature_id);
                $advert_user = SocialAdvertisementUser::create([
                    'orderNumber' => $orderNumber,
                    'user_id' => $user->id,
                    'social_link_id' => $social_link_id,
                    'account_type_id' => $account_content_type,
                    'advert_type' => $advert_type,
                    'publish' => 0,
                    'content' => $content,
//                    'duration' => $duration,
                    'price' => $advertise_price,
                    'total' => $total,
                ]);
                $point = Point::where('code', 'ourAccounts')->first();
                if ($point != null) {
                    $user_point = PointUser::create([
                        'user_id' => $user->id,
                        'point_id' => $point->id,
                        'point' => $point->points_number,
                        'code' => $point->code,
                    ]);
                }
                if ($request->hasFile('file')) {
                    $image_file = $request->file('file');
                    $filename = time() . '.' . $image_file->getClientOriginalExtension();
                    $request->file->move(public_path('uploads/advert_user/' . $advert_user->id), $filename);
                    $advert_user->file = '/uploads/advert_user/' . $advert_user->id . '/' . $filename;
                    $advert_user->save();
                }
//                if ($image) {
//                    $numberrand = rand(11111, 99999);
//                    $randname = time() . $numberrand;
//                    $imageName = $randname . '.' . $image->getClientOriginalExtension();
//                    $image->move(public_path('uploads/payment'), $imageName);
//                }
//                if ($payment_type == 'bank') {
//                    $transaction = Transaction::create(['holder_name' => $holder_name, 'order_id' => $order->id, 'payment_type' => $payment_type, 'status' => 'pending', 'bank_id' => $bank, 'bank_transactions_num' => $bank_transactions_num, 'currency' => $currency, 'image' => '/uploads/payment/' . $imageName]);
//                }
                DB::commit();
            } catch (\Exception $e) {
                return $e;
                DB::rollBack();
            }
            $order;
            $advert_user;
//            $transaction;
        }
        return redirect()->back()->with('success', _i('Your Request Is Pending Approval'));
    }

    public function famousFees(Request $request)
    {
        $famous_user = User::findOrFail($request->famous_user);
        return response()->json(['cost' => $famous_user->cost]);
    }
}
