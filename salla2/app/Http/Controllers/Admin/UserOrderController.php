<?php

namespace App\Http\Controllers\Admin;

use App\Bll\Email;
use App\Bll\SMS;
use App\Http\Controllers\Controller;
use App\Models\CityData;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\product\orders;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class UserOrderController extends Controller
{

    public function ActiveUser($id)
    {
        $store_id = \App\Bll\Utility::getStoreId();
        $user = User::where('id',$id)->where('store_id', $store_id)->first();

        $user->email_verified_at = Carbon::now();
        $user->save();

            return redirect()->back()->with('flash_message', _i('Activiated Successfully !'));
    }

    public function showStoreUsers()
    {
        //dd('ghcmhghm');
        $store_id = \App\Bll\Utility::getStoreId();
        $users = User::where('store_id', $store_id)->get();
        $groups = Group::where('store_id', $store_id)->get();
        $City = CityData::all();
        return view('admin.userOrders.index', compact('users', 'groups', 'City'));
    }

    public function createGroup(Request $request)
    {
        $store_id = \App\Bll\Utility::getStoreId();
        $validator = Validator::make($request->all(), [
            'title' => ['required', Rule::unique('groups', 'title')->where(function ($q) use ($store_id) {
                return $q->where('store_id', $store_id);
            }),
            ],
            'icon' => 'required',
        ]);

        if ($validator->passes()) {

            $group = Group::create(['title' => $request->title,
                'store_id' => $store_id,
            ]);

            if ($request->hasFile('icon')) {
                $image_file = $request->file('icon');
                $filename = time() . '.' . $image_file->getClientOriginalExtension();
                $request->icon->move(public_path('uploads/groups/' . $group->id), $filename);
                $group->icon = '/uploads/groups/' . $group->id . '/' . $filename;
                $group->save();
            }

            if ($request->users != null) {
                for ($ii = 0; $ii < count($request->users); $ii++) {
                    $user = $request->users[$ii];
                    GroupUser::create([
                        'group_id' => $group->id,
                        'user_id' => $user,
                    ]);
                }
            }

            return response()->json(true);
        }
        return response()->json(['errors' => $validator->errors()]);

    }

    public function showUserOrder($id)
    {
        $user = User::findOrFail($id);
        $orders = orders::where('user_id', $user->id)->where('store_id', \App\Bll\Utility::getStoreId())->get();
        return view('admin.userOrders.UserOrders', compact('user', 'orders'));
    }

    public function smsStore(Request $request, $id)
    {
        $store_id = \App\Bll\Utility::getStoreId();
        $user = User::findOrFail($id);
        $model_type = 'customer';
        $message = $request->message;
        $phone = $user->phone;
        $user_id = $user->id;
        $sms = new SMS();
        $data = $sms->smsSave($message, $store_id, $phone, $user_id, $model_type);
        return response()->json(true);
    }

    public function sendStore(Request $request)
    {
        if ($request->users != null) {
            if (count($request->users) > 0) {
                $store_id = \App\Bll\Utility::getStoreId();
                $model_type = 'customer';
                $message = $request->message;
                $users = $request->users;
                foreach ($users as $item) {
                    $user = User::findOrFail($item);
                    $phone = $user->phone;
                    $user_email = $user->email;
                    $user_id = $user->id;
                    if ($request->type == 'sms') {
                        $sms = new SMS();
                        $data = $sms->smsSave($message, $store_id, $phone, $user_id, $model_type);
                    } else {
                        $email = new Email();
                        $data = $email->emailSave($message, $store_id, $user_email, $user_id, $model_type);
                    }
                }
                return response()->json([true]);
            } else {
                return response()->json([false]);
            }
        } else {
            return response()->json([false, 'message' => _i('PLease Select Users')]);
        }
    }

    public function groupFilter(Request $request)
    {
        if ($request->ajax()) {
            $store_id = \App\Bll\Utility::getStoreId();
            if ($request->id == 'all' || $request->id == null) {
                $users = User::where('store_id', $store_id)->get();
            } else {
                $users = User::leftJoin('groups_users', 'groups_users.user_id', 'users.id')
                    ->where('groups_users.group_id', $request->id)
                    ->get();
            }
            return view('admin.userOrders.ajax.users', compact('users'))->render();
        }
    }


    public function genderFilter(Request $request)
    {
        if ($request->ajax()) {
            $store_id = \App\Bll\Utility::getStoreId();
            if ($request->id == 'all' || $request->id == null) {
                $users = User::where('store_id', $store_id)->get();
            } else {
                $users = User::where('store_id', $store_id)
                    ->where('gender', $request->id)
                    ->get();
            }
            return view('admin.userOrders.ajax.users', compact('users'))->render();
        }
    }

    public function cityFilter(Request $request)
    {
        if ($request->ajax()) {
            $store_id = \App\Bll\Utility::getStoreId();
            if ($request->id == 'all' || $request->id == null) {
                $users = User::where('store_id', $store_id)->get();
            } else {
                $users = User::leftJoin('city_datas', 'city_datas.id', 'users.city_id')
                    ->where('users.city_id', $request->id)
                    ->where('users.store_id', $store_id)
                    ->get();
            }
            return view('admin.userOrders.ajax.users', compact('users'))->render();
        }
    }

    public function purchaseFilter(Request $request)
    {
        if ($request->ajax()) {
            $store_id = \App\Bll\Utility::getStoreId();
            if ($request->id == 'all' || $request->id == null) {
                $users = User::where('store_id', $store_id)->get();
            } elseif ($request->id == 'Most') {
                $users = array();
                $best_pay = orders::select(DB::raw('`user_id` as clint_id , sum(`total`) as total_count'))
                    ->groupBy('user_id')
                    ->where('orders.store_id', session()->get('StoreId'))
                    ->orderBy('total_count', 'desc')
                    ->get();

                foreach ($best_pay as $single) {
                    $data = DB::table('users')
                        ->where('id', $single->clint_id)->get();
                    $users[] = $data;
                }
                //dd($users);
            } else {

                $users = array();
                $best_pay = orders::select(DB::raw('`user_id` as clint_id , sum(`total`) as total_count'))
                    ->groupBy('user_id')
                    ->where('orders.store_id', session()->get('StoreId'))
                    ->orderBy('total_count', 'asc')
                    ->get();

                foreach ($best_pay as $single) {
                    $data = DB::table('users')
                        ->where('id', $single->clint_id)->get();
                    $users[] = $data;
//dd($users);
                }
                return view('admin.userOrders.ajax.users', compact('users'))->render();
            }
        }

    }


    

}
