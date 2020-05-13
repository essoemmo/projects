<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\SendUser;
use App\Models\UserSetting;
use App\User;
use Illuminate\Http\Request;

class UserSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:UserSetting-Add'])->only('showUserSetting');
        $this->middleware(['permission:UserSetting-Add'])->only('storeUserSetting');
    }

    public function sendUsersNoti()
    {
        $users = User::where('guard', 'web')->where('email_verified_at', '!=', null)->where('status', 1)->get();
        return view('admin.setting.sendUsers', compact('users'));
    }

    public function sendUsersNotiStore(Request $request)
    {
        $types = $request->type;
        $users = $request->users;
        foreach ($types as $type) {
            foreach ($users as $user) {
                SendUser::create([
                    'user_id' => $user,
                    'message' => $request->message,
                    'type' => $type,
                ]);
            }
        }
        return redirect()->back()->with('success', _i('Send Successfully'));
    }

    public function showUserSetting()
    {
        $userSetting = UserSetting::first();
        return view('admin.userSetting.show', compact('userSetting'));
    }

    public function storeUserSetting(Request $request)
    {
        $userSetting = UserSetting::first();

        if ($request->send_email != null && $request->send_email == 1) {
            $send_email = 1;
        } else {
            $send_email = 0;
        }

        if ($request->send_sms != null && $request->send_sms == 1) {
            $send_sms = 1;
        } else {
            $send_sms = 0;
        }

        if ($request->send_section != null && $request->send_section == 1) {
            $send_section = 1;
        } else {
            $send_section = 0;
        }

        if ($request->register_section != null && $request->register_section == 1) {
            $register_section = 1;
        } else {
            $register_section = 0;
        }

        if ($request->normal_user_register != null && $request->normal_user_register == 1) {
            $normal_user_register = 1;
        } else {
            $normal_user_register = 0;
        }

        if ($request->famous_user_register != null && $request->famous_user_register == 1) {
            $famous_user_register = 1;
        } else {
            $famous_user_register = 0;
        }

        if ($request->famous_section != null && $request->famous_section == 1) {
            $famous_section = 1;
        } else {
            $famous_section = 0;
        }

        if ($request->famous_ads_front != null && $request->famous_ads_front == 1) {
            $famous_ads_front = 1;
        } else {
            $famous_ads_front = 0;
        }

        if ($request->famous_ads_menu != null && $request->famous_ads_menu == 1) {
            $famous_ads_menu = 1;
        } else {
            $famous_ads_menu = 0;
        }

        if ($request->identification_image != null && $request->identification_image == 1) {
            $identification_image = 1;
        } else {
            $identification_image = 0;
        }

        if ($request->identification_number != null && $request->identification_number == 1) {
            $identification_number = 1;
        } else {
            $identification_number = 0;
        }

        if ($request->myAccounts_menu != null && $request->myAccounts_menu == 1) {
            $myAccounts_menu = 1;
        } else {
            $myAccounts_menu = 0;
        }

        if ($request->myAds_menu != null && $request->myAds_menu == 1) {
            $myAds_menu = 1;
        } else {
            $myAds_menu = 0;
        }

        if ($request->featuredAd_menu != null && $request->featuredAd_menu == 1) {
            $featuredAd_menu = 1;
        } else {
            $featuredAd_menu = 0;
        }

        if ($request->AdInOurAccounts_menu != null && $request->AdInOurAccounts_menu == 1) {
            $AdInOurAccounts_menu = 1;
        } else {
            $AdInOurAccounts_menu = 0;
        }

        if ($request->myPoints_menu != null && $request->myPoints_menu == 1) {
            $myPoints_menu = 1;
        } else {
            $myPoints_menu = 0;
        }

        if ($request->ticketOpen_menu != null && $request->ticketOpen_menu == 1) {
            $ticketOpen_menu = 1;
        } else {
            $ticketOpen_menu = 0;
        }

        if ($request->contact_us != null && $request->contact_us == 1) {
            $contact_us = 1;
        } else {
            $contact_us = 0;
        }

        if ($request->points != null && $request->points == 1) {
            $points = 1;
        } else {
            $points = 0;
        }

        if ($userSetting == null) {
            UserSetting::create([
                'send_email' => $send_email,
                'send_sms' => $send_sms,
                'send_section' => $send_section,
                'register_section' => $register_section,
                'famous_user_register' => $famous_user_register,
                'normal_user_register' => $normal_user_register,
                'famous_section' => $famous_section,
                'famous_ads_front' => $famous_ads_front,
                'famous_ads_menu' => $famous_ads_menu,
                'identification_image' => $identification_image,
                'identification_number' => $identification_number,
                'myAccounts_menu' => $myAccounts_menu,
                'myAds_menu' => $myAds_menu,
                'featuredAd_menu' => $featuredAd_menu,
                'AdInOurAccounts_menu' => $AdInOurAccounts_menu,
                'myPoints_menu' => $myPoints_menu,
                'ticketOpen_menu' => $ticketOpen_menu,
                'contact_us' => $contact_us,
                'points' => $points,
            ]);
        } else {
            $userSetting->send_email = $send_email;
            $userSetting->send_sms = $send_sms;
            $userSetting->send_section = $send_section;
            $userSetting->register_section = $register_section;
            $userSetting->famous_user_register = $famous_user_register;
            $userSetting->normal_user_register = $normal_user_register;
            $userSetting->famous_section = $famous_section;
            $userSetting->famous_ads_front = $famous_ads_front;
            $userSetting->famous_ads_menu = $famous_ads_menu;
            $userSetting->identification_image = $identification_image;
            $userSetting->identification_number = $identification_number;
            $userSetting->myAccounts_menu = $myAccounts_menu;
            $userSetting->myAds_menu = $myAds_menu;
            $userSetting->featuredAd_menu = $featuredAd_menu;
            $userSetting->AdInOurAccounts_menu = $AdInOurAccounts_menu;
            $userSetting->myPoints_menu = $myPoints_menu;
            $userSetting->ticketOpen_menu = $ticketOpen_menu;
            $userSetting->contact_us = $contact_us;
            $userSetting->points = $points;
            $userSetting->update();
        }

        return redirect()->back()->with('success', _i('Updated Successfully !'));
    }
}
