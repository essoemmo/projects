<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Social_link;
use App\User;
use Illuminate\Support\Facades\App;

class UserNotificationController extends Controller
{
    public function userNotify()
    {
        $social_links = Social_link::LeftJoin('social_links_translations', 'social_links_translations.social_id', '=', 'social_links.id')
            ->select('social_links_translations.title as title', 'social_links.id as id', 'social_links.icon')
            ->where('locale', App::getLocale())->get();

        $countries = Country::leftJoin('countries_translations', 'countries_translations.country_id', '=', 'countries.id')
            ->select('countries_translations.title as title', 'countries.id as id')
            ->where('locale', App::getLocale())->get();
        $user = User::findOrFail(auth()->user()->id);
        $notifications = $user->notifications()->get();
        return view('front.user.notifications', compact('notifications', 'user', 'countries', 'social_links'));
    }

    public function userReadNotify($id)
    {
        $user = User::findOrFail(auth()->user()->id);
        $notification = $user->unreadNotifications()->where('id', $id)->first()->update(['read_at' => now()]);
        return redirect()->back()->with('success', _i('Updated Successfully'));
    }

    public function userDeleteNotify($id)
    {
        $user = User::findOrFail(auth()->user()->id);
        $user->notifications()->where('id', $id)->get()->first()->delete();
        return redirect()->back()->with('success', _i('Deleted Successfully'));
    }
}
