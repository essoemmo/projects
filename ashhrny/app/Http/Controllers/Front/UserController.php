<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\VerifyMail;
use App\Models\AccountContent;
use App\Models\Bank;
use App\Models\City;
use App\Models\Country;
use App\Models\EmailTemplate;
use App\Models\EmailTemplateData;
use App\Models\FeaturedAd;
use App\Models\FeaturedAdUser;
use App\Models\Point;
use App\Models\PointUser;
use App\Models\Rating;
use App\Models\RatingUser;
use App\Models\Social_link;
use App\Models\SocialAdvertisement;
use App\Models\SocialAdvertisementUser;
use App\Models\SocialLinkUser;
use App\Models\VerifyUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function afterRegister()
    {
        $user = User::findOrFail(auth()->id());
        if ($user->user_type == null) {
            if (userSetting()->register_section == 1 && userSetting()->register_section != 0) {
                return view('front.user.after_register');
            } else {
                return redirect(route('home'));
            }
        } else {
            return redirect(route('userProfile'));
        }
    }

    public function continueRegister($type)
    {
        $user = User::findOrFail(auth()->id());
        $user->user_type = $type;
        $user->update();
        return redirect(route('userProfile'));
    }

    public function verify($id)
    {
        $user = User::findOrFail($id);
        $emailTemplate = EmailTemplate::where('code', 'VerificationEmail')->first();
        $emailTemplateData = EmailTemplateData::leftJoin('email_templates_data_translations', 'email_templates_data_translations.email_template_data_id', 'email_templates_data.id')
            ->where('email_template_id', $emailTemplate->id)
            ->where('email_templates_data_translations.locale', \app()->getLocale())
            ->select('email_templates_data.id as id', 'email_templates_data.from_email as from_email', 'email_templates_data_translations.body as body', 'email_templates_data_translations.subject as subject')
            ->first();
        if (!$user->email_verified_at) {
            $user_codes = VerifyUser::where('user_id', $user->id)->delete();
            $number = rand(1111, 9999);
            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time()),
                'code' => $number,
            ]);
            \Mail::to($user->email)->send(new VerifyMail(['user' => $user, 'body' => $emailTemplateData->body, 'subject' => $emailTemplateData->subject, 'from_email' => $emailTemplateData->from_email]));
            return view('front.user.verify', compact('user'));
        } else {
            return redirect(route('getLogin'));
        }
    }

    public function resendCode($id)
    {
        $user = User::findOrFail($id);
        $user_codes = VerifyUser::where('user_id', $user->id)->delete();
        $emailTemplate = EmailTemplate::where('code', 'VerificationEmail')->first();
        $emailTemplateData = EmailTemplateData::leftJoin('email_templates_data_translations', 'email_templates_data_translations.email_template_data_id', 'email_templates_data.id')
            ->where('email_template_id', $emailTemplate->id)
            ->where('email_templates_data_translations.locale', App::getLocale())->first();
        $number = rand(1111, 9999);
        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => sha1(time()),
            'code' => $number,
        ]);
        \Mail::to($user->email)->send(new VerifyMail(['user' => $user, 'body' => $emailTemplateData->body, 'subject' => $emailTemplateData->subject, 'from_email' => $emailTemplateData->from_email]));
        return redirect()->back()->with('success', _i('Code Sent Successfully'));
    }

    public function verifyUser(Request $request)
    {

        $verifyUser = VerifyUser::where('code', $request->code)->first();
        if ($verifyUser != null) {
            if ($verifyUser->user_id != $request->id) {
                if (isset($verifyUser)) {
                    $user = $verifyUser->user;
                    if (!$user->verified) {
                        $verifyUser->user->email_verified_at = Carbon::now();
                        $verifyUser->user->save();
                        $status = _i('Your e-mail is verified. You can now login.');
                    } else {
                        $status = _i('Your e-mail is already verified. You can now login.');
                    }
                } else {
                    return redirect(route('getLogin'))->with('warning', _i('Sorry your email cannot be identified.'));
                }
                return redirect(route('joinOurAccounts'))->with('success', $status);
            } else {
                return redirect(route('getLogin'))->with('warning', _i('Sorry your email cannot be identified.'));
            }
        } else {
            return redirect()->back()->with('warning', _i('Wrong Activation Code'));
        }
    }

    public function showProfile($id)
    {
        $user = User::where('id', $id)->first();
        if (!$user) {
            return view('front.not-found');
        }
        $user_social = SocialLinkUser::leftJoin('social_links', 'social_links.id', 'social_link_user.social_id')
            ->leftJoin('social_links_translations', 'social_links_translations.social_id', 'social_links.id')
            ->where('social_links_translations.locale', \app()->getLocale())
            ->where('social_link_user.url', '!=', null)
            ->where('user_id', $user->id)->get();
        $social_links = Social_link::LeftJoin('social_links_translations', 'social_links_translations.social_id', '=', 'social_links.id')
            ->select('social_links_translations.title as title', 'social_links.id as id', 'social_links.icon')
            ->where('locale', App::getLocale())->get();

        $countries = Country::leftJoin('countries_translations', 'countries_translations.country_id', '=', 'countries.id')
            ->select('countries_translations.title as title', 'countries.id as id')
            ->where('locale', App::getLocale())->get();
        return view('front.user.showProfile', compact('user', 'user_social', 'social_links', 'countries'));
    }

    public function profile()
    {
        $user = User::findOrFail(auth()->id());
        $countries = Country::select('countries_translations.title as title', 'countries.id as id', 'countries.logo', 'countries.code')
            ->leftJoin('countries_translations', 'countries_translations.country_id', '=', 'countries.id')->where('locale', App::getLocale())->get();
        $cities = City::select('cities_translations.title as title', 'cities.id as id')
            ->leftJoin('cities_translations', 'cities_translations.city_id', '=', 'cities.id')
            ->where('locale', App::getLocale())
            ->where('cities.country_id', $user->country_id)
            ->get();
        $social_links = Social_link::LeftJoin('social_links_translations', 'social_links_translations.social_id', '=', 'social_links.id')
            ->select('social_links_translations.title as title', 'social_links.id as id', 'social_links.icon')
            ->where('locale', App::getLocale())->get();
        return view('front.user.profile', compact('user', 'countries', 'cities', 'social_links'));
    }

    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        $user = User::findOrFail($user_id);
        $rules = [
            'first_name' => ['required', 'string', 'max:191'],
            'last_name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', Rule::unique('users')->ignore($user->id)],
            'mobile' => ['required', 'max:15', Rule::unique('users', 'mobile')->ignore($user->id)],
            'identify_number' => [Rule::unique('users', 'identify_number')->ignore($user->id)],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            if ($request->hasFile('user_image') && $request->user_image != null) {
                $image_path = $user->image;  // Value is not URL but directory file path

                if (File::exists(public_path($image_path))) {
                    File::delete(public_path($image_path));
                }

                if (!is_dir(public_path('uploads/profiles/' . $user->id))) {
                    mkdir(public_path('uploads/profiles/' . $user->id), 755, true);
                }
                \Intervention\Image\Facades\Image::make($request->user_image)
                    ->resize(248, 330, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save(public_path('/uploads/profiles/' . $user->id . '/' . $request->user_image->hashName()));
            }

            if ($request->user_image != null) {
                $user_logo = '/uploads/profiles/' . $user->id . '/' . $request->user_image->hashName();
            } else {
                $user_logo = $user->image;
            }

            // identification image
            if ($request->hasFile('identify_image')) {
                $image_path = $user->identify_image;  // Value is not URL but directory file path
                if (File::exists(public_path($image_path))) {
                    File::delete(public_path($image_path));
                }
                $image = $request->file('identify_image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $request->identify_image->move(public_path('uploads/profiles/' . $user->id), $filename);

                $user->identify_image = '/uploads/profiles/' . $user->id . '/' . $filename;
                $user->save();
            }

            $user->city_id = null;
            $user->save();

            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->mobile = $request->input('mobile');
            $user->country_id = $request->input('country_id');
            $user->city_id = $request->input('city_id');
            $user->gender = $request->input('gender');
            $user->image = $user_logo;
            $user->alt_image = $user->first_name . $user->last_name;
            $user->identify_number = $request->input('identify_number');

            if ($request->send_email != null && $request->send_email == 1) {
                $user->send_email = $request->send_email;
            } else {
                $user->send_email = 0;
            }

            if ($request->send_sms != null && $request->send_sms == 1) {
                $user->send_sms = $request->send_sms;
            } else {
                $user->send_sms = 0;
            }

            if ($request->none != null && $request->none == 'none') {
                $user->send_email = 0;
                $user->send_sms = 0;
            }

            $user->save();

            if (userSetting()->points == 1 && userSetting()->points != 0) {
                DB::beginTransaction();
                try {
                    $points = PointUser::where('user_id', $user->id)->where('code', 'reg')->first();
                    if ($points == null) {
                        $point = Point::where('code', 'reg')->first();
                        if ($point != null) {
                            //                    dd($user,$point);
                            $user_point = PointUser::create([
                                'user_id' => $user->id,
                                'point_id' => $point->id,
                                'point' => $point->points_number,
                                'code' => $point->code,
                            ]);
                        }
                    }
                    DB::commit();
                } catch (\Exception $e) {
                    return $e->getMessage();
                    DB::rollBack();
                }
            }
            return redirect()->back()->with('success', _i('Your Profile Updated Successfully'));
        }
    }

    public function updatePassword(Request $request)
    {
        $user_id = auth()->user()->id;
        $user = User::findOrFail($user_id);
        $rules = [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'old_password' => ['required', 'string', 'min:8'],
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

//        dd($user->password,Hash::check($request->input('old_password')));

        if (Hash::check($request->input('old_password'), $user->password)) {
            $user->password = bcrypt($request->input('password'));
            $user->save();
            return redirect()->back()->with('success', _i('Password Updated Successfully !'));
        } else {
            return redirect()->back()->with('success', _i('Old Password Doesn\'t Match !'));
        }
    }

    public function getCallCode(Request $request)
    {
        $country = Country::findOrFail($request->country_id);
        if (!$country) {
            return response()->json([false]);
        } else {
            return response()->json([true, $country->call_code]);
        }
    }

    public function getCityList(Request $request)
    {
        $country = Country::findOrFail($request->countryID);
        if ($country->code == 'KSA') {
            $cities = City::leftJoin('cities_translations', 'cities_translations.city_id', 'cities.id')
                ->where('country_id', $country->id)
                ->where('cities_translations.locale', \app()->getLocale())
                ->select('cities.id', 'cities_translations.title')
                ->get();
            return response()->json([true, $cities]);
        } else {
            return response()->json(false);
        }

    }

    public function userAccounts(Request $request)
    {
        $social_links = Social_link::LeftJoin('social_links_translations', 'social_links_translations.social_id', '=', 'social_links.id')
            ->select('social_links_translations.title as title', 'social_links.id as id', 'social_links.icon')
            ->where('locale', App::getLocale())->get();

        $countries = Country::leftJoin('countries_translations', 'countries_translations.country_id', '=', 'countries.id')
            ->select('countries_translations.title as title', 'countries.id as id')
            ->where('locale', App::getLocale())->get();

        if (userSetting()->myAccounts_menu == 1 && userSetting()->myAccounts_menu != 0) {
            $user = User::findOrFail(auth()->id());
            $socialLinks = Social_link::leftJoin('social_links_translations', 'social_links_translations.social_id', 'social_links.id')->where('social_links_translations.locale', \app()->getLocale())->select('social_links_translations.title', 'social_links.id')->orderBy('social_links.id')->get();
            $user_social_array = SocialLinkUser::where('user_id', $user->id)->pluck('social_link_user.social_id')->toArray();
            $user_social = SocialLinkUser::where('user_id', $user->id)->get();
            $user_default = SocialLinkUser::where('user_id', $user->id)->where('default', 1)->first();
            return view('front.user.accounts', compact('user_default', 'user', 'socialLinks', 'user_social', 'user_social_array', 'countries', 'social_links'));
        } else {
            return view('front.not-found', compact('countries', 'social_links'));
        }
    }

    public function changeUrl(Request $request)
    {
        $user_social_default = SocialLinkUser::where('user_id', auth()->id())->where('default', 1)->first();
//        dd($user_social_default);
        if ($user_social_default) {
            $user_social_default->default = null;
            $user_social_default->save();
        }
        $user_social = SocialLinkUser::findOrFail($request->id);
        $user_social->default = 1;
        $user_social->save();
        return response()->json(true);
    }

    public function userAccountsStore(Request $request)
    {
        $user = User::findOrFail(auth()->id());
        $validator = validator()->make($request->all(), [
            'social.*' => 'unique:social_link_user,url',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->social != null) {
            $socials = $request->social;
            foreach ($socials as $key => $value) {
                if ($value != null) {
                    $user_social = SocialLinkUser::create([
                        'user_id' => $user->id,
                        'social_id' => $key,
                        'content' => $request->contentType[$key],
                        'url' => $value
                    ]);
                    if (userSetting()->points == 1 && userSetting()->points != 0) {
                        $point = Point::where('code', 'addAccount')->first();
                        if ($point != null) {
                            $user_point = PointUser::create([
                                'user_id' => $user->id,
                                'point_id' => $point->id,
                                'point' => $point->points_number,
                                'code' => $point->code,
                            ]);
                        }
                    }
                }
            }
        }
        return redirect()->back()->with('success', _i('Your Accounts Updated Successfully'));
    }

    public function userAccountsUpdate(Request $request)
    {
        $user = User::findOrFail(auth()->id());
//        $rules = [
//            'social' => 'unique:social_link_user,url,'.$user->id.',user_id',
//        ];
        $validator = validator()->make($request->all(), [
            'social.*' => 'unique:social_link_user,url,' . $user->id . ',user_id',
        ]);
//        dd($validator);
        if ($validator->fails()) {
//            dd($validator);
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->social != null) {
            SocialLinkUser::where('user_id', $user->id)->delete();
            if (userSetting()->points == 1 && userSetting()->points != 0) {
                PointUser::where('user_id', $user->id)->where('code', 'addAccount')->delete();
            }
            $socials = $request->social;
            foreach ($socials as $key => $value) {
                if ($value != null) {
                    $user_social = SocialLinkUser::create([
                        'user_id' => $user->id,
                        'social_id' => $key,
                        'content' => $request->contentType[$key],
                        'url' => $value,
                    ]);
                    if (userSetting()->points == 1 && userSetting()->points != 0) {
                        $point = Point::where('code', 'addAccount')->first();
                        if ($point != null) {
                            $user_point = PointUser::create([
                                'user_id' => $user->id,
                                'point_id' => $point->id,
                                'point' => $point->points_number,
                                'code' => $point->code,
                            ]);
                        }
                    }
                }
            }
        }
        return redirect()->back()->with('success', _i('Your Accounts Updated Successfully'));
    }

    public function celebrityAds(Request $request)
    {
        $countries = Country::leftJoin('countries_translations', 'countries_translations.country_id', '=', 'countries.id')
            ->select('countries_translations.title as title', 'countries.id as id')
            ->where('locale', App::getLocale())->get();
        $social_links = Social_link::LeftJoin('social_links_translations', 'social_links_translations.social_id', '=', 'social_links.id')
            ->select('social_links_translations.title as title', 'social_links.id as id', 'social_links.icon')
            ->where('locale', App::getLocale())->get();
        if (userSetting()->famous_ads_menu == 1 && userSetting()->famous_ads_menu != 0) {
            $user = User::findOrFail(auth()->id());
            if ($user->user_type == 'normal') {
                $user_social = SocialLinkUser::leftJoin('social_links', 'social_links.id', 'social_link_user.social_id')
                    ->leftJoin('social_links_translations', 'social_links_translations.social_id', 'social_links.id')
                    ->where('user_id', $user->id)
                    ->where('social_links_translations.locale', \app()->getLocale())
                    ->where('social_link_user.url', '!=', null)
                    ->select('social_link_user.url', 'social_links_translations.title', 'social_link_user.id')
                    ->get();
                $content_type = AccountContent::leftJoin('account_contents_translations', 'account_contents_translations.account_content_id', 'account_contents.id')
                    ->where('account_contents_translations.locale', \app()->getLocale())->select('account_contents_translations.title', 'account_contents.id')->get();
                $famous_users = User::where('user_type', 'famous')->get();
                $price = SocialAdvertisement::where('type', 'user')->first();
                $user_adv = SocialAdvertisementUser::where('user_id', $user->id)->where('advert_type', 'user')->where('publish', 1)->get();
                $banks = Bank::select('banks_translations.title as title', 'banks.id as id', 'banks.image as image', 'banks.code as code')
                    ->leftJoin('banks_translations', 'banks_translations.bank_id', '=', 'banks.id')->where('locale', App::getLocale())->get();
                $rates = Rating::select('ratings_translations.title as title', 'ratings.id as id')
                    ->leftJoin('ratings_translations', 'ratings_translations.rating_id', '=', 'ratings.id')->where('locale', App::getLocale())->get();
                $last_ad_created = SocialAdvertisementUser::where('user_id', $user->id)->where('advert_type', 'user')->orderBy('created_at', 'desc')->first();
                if ($last_ad_created != null) {
                    $last_ad = $last_ad_created->created_at->diffInDays();
                } else {
                    $last_ad = null;
                }
                return view('front.user.celebrityAds', compact('user', 'user_social', 'content_type', 'famous_users', 'price', 'user_adv', 'banks', 'countries', 'social_links', 'rates', 'last_ad'));
            } else {
                return view('front.not-found', compact('countries', 'social_links'));
            }
        } else {
            return view('front.not-found', compact('countries', 'social_links'));
        }
    }


    public function featuredAd(Request $request)
    {
        $social_links = Social_link::LeftJoin('social_links_translations', 'social_links_translations.social_id', '=', 'social_links.id')
            ->select('social_links_translations.title as title', 'social_links.id as id', 'social_links.icon')
            ->where('locale', App::getLocale())->get();

        $countries = Country::leftJoin('countries_translations', 'countries_translations.country_id', '=', 'countries.id')
            ->select('countries_translations.title as title', 'countries.id as id')
            ->where('locale', App::getLocale())->get();

        if (userSetting()->featuredAd_menu == 1 && userSetting()->featuredAd_menu != 0) {
            $user = User::findOrFail(auth()->id());
            $user_social = SocialLinkUser::leftJoin('social_links', 'social_links.id', 'social_link_user.social_id')
                ->leftJoin('social_links_translations', 'social_links_translations.social_id', 'social_links.id')
                ->where('user_id', $user->id)
                ->where('social_links_translations.locale', \app()->getLocale())
                ->where('social_link_user.url', '!=', null)
                ->select('social_link_user.url', 'social_links_translations.title', 'social_link_user.id')
                ->get();
            $banks = Bank::select('banks_translations.title as title', 'banks.id as id', 'banks.image as image', 'banks.code as code')
                ->leftJoin('banks_translations', 'banks_translations.bank_id', '=', 'banks.id')->where('locale', App::getLocale())->get();
            return view('front.user.featuredAd', compact('user', 'user_social', 'banks', 'countries', 'social_links'));
        } else {
            return view('front.not-found', compact('countries', 'social_links'));
        }
    }

    public function featurePrice(Request $request)
    {
        if (userSetting()->featuredAd_menu == 1 && userSetting()->featuredAd_menu != 0) {
            $feature_user = FeaturedAdUser::where('user_id', auth()->id())->where('featured_type', $request->feature)->orderby('created_at', 'desc')->first();
            if (!$feature_user) {
                $feature = FeaturedAd::where('place', $request->feature)->first();
                return response()->json([true, $feature]);
            }
            if ($feature_user->publish == 0) {
                return response()->json(['wait']);
            }
            if ($feature_user->publish == 1) {
                return response()->json(['approved', $feature_user]);
            }

            if ($feature_user->publish == 2) {
                $feature = FeaturedAd::where('place', $request->feature)->first();
                return response()->json([true, $feature]);
            }
        }
    }

    public function adInOurAccounts(Request $request)
    {
        $social_links = Social_link::LeftJoin('social_links_translations', 'social_links_translations.social_id', '=', 'social_links.id')
            ->select('social_links_translations.title as title', 'social_links.id as id', 'social_links.icon')
            ->where('locale', App::getLocale())->get();

        $countries = Country::leftJoin('countries_translations', 'countries_translations.country_id', '=', 'countries.id')
            ->select('countries_translations.title as title', 'countries.id as id')
            ->where('locale', App::getLocale())->get();

        if (userSetting()->AdInOurAccounts_menu == 1 && userSetting()->AdInOurAccounts_menu != 0) {
            $user = User::findOrFail(auth()->id());
            $user_social = SocialLinkUser::leftJoin('social_links', 'social_links.id', 'social_link_user.social_id')
                ->leftJoin('social_links_translations', 'social_links_translations.social_id', 'social_links.id')
                ->where('user_id', $user->id)
                ->where('social_links_translations.locale', \app()->getLocale())
                ->where('social_link_user.url', '!=', null)
                ->select('social_link_user.url', 'social_links_translations.title', 'social_link_user.id')
                ->get();
            $content_type = AccountContent::leftJoin('account_contents_translations', 'account_contents_translations.account_content_id', 'account_contents.id')
                ->where('account_contents_translations.locale', \app()->getLocale())->select('account_contents_translations.title', 'account_contents.id')->get();
            $price = SocialAdvertisement::where('type', 'website')->first();
            $user_adv = SocialAdvertisementUser::where('user_id', $user->id)->where('advert_type', 'website')->where('publish', 1)->get();
            $banks = Bank::select('banks_translations.title as title', 'banks.id as id', 'banks.image as image', 'banks.code as code')
                ->leftJoin('banks_translations', 'banks_translations.bank_id', '=', 'banks.id')->where('locale', App::getLocale())->get();

            $rates = Rating::select('ratings_translations.title as title', 'ratings.id as id')
                ->leftJoin('ratings_translations', 'ratings_translations.rating_id', '=', 'ratings.id')->where('locale', App::getLocale())->get();
            $last_ad_created = SocialAdvertisementUser::where('user_id', $user->id)->where('advert_type', 'website')->orderBy('created_at', 'desc')->first();
            if ($last_ad_created != null) {
                $last_ad = $last_ad_created->created_at->diffInDays();
            } else {
                $last_ad = null;
            }
            return view('front.user.ADInOurAccounts', compact('user', 'user_social', 'content_type', 'price', 'user_adv', 'banks', 'countries', 'social_links', 'rates', 'last_ad'));
        } else {
            return view('front.not-found', compact('countries', 'social_links'));
        }
    }

    public function myPoints(Request $request)
    {
        $countries = Country::leftJoin('countries_translations', 'countries_translations.country_id', '=', 'countries.id')
            ->select('countries_translations.title as title', 'countries.id as id')
            ->where('locale', App::getLocale())->get();
        $social_links = Social_link::LeftJoin('social_links_translations', 'social_links_translations.social_id', '=', 'social_links.id')
            ->select('social_links_translations.title as title', 'social_links.id as id', 'social_links.icon')
            ->where('locale', App::getLocale())->get();

        if (userSetting()->myPoints_menu == 1 && userSetting()->myPoints_menu != 0) {
            $user = User::findOrFail(auth()->id());
            $points = Point::leftJoin('points_translations', 'points_translations.point_id', 'points.id')
                ->select('points_translations.title as title', 'points_translations.description as description', 'points.id as id', 'points.points_number as points_number')
                ->where('locale', App::getLocale())->get();
            $user_points = number_format(PointUser::where('user_id', $user->id)->sum('point'), 0);
            return view('front.user.myPoints', compact('user', 'countries', 'social_links', 'user_points', 'points'));
        } else {
            return view('front.not-found', compact('countries', 'social_links'));
        }
    }

    public function userAdRate(Request $request)
    {
        $user = User::FindOrFail(auth()->id());
        $rate = RatingUser::create([
            'user_id' => $user->id,
            'rating_id' => $request->rate_id,
            'social_advertisement_id' => $request->social_adv_id,
            'comment' => $request->comment,
        ]);
        return redirect()->back()->with('success', _i('Rate Added Successfully'));
    }

    public function myAds(Request $request)
    {
        $social_links = Social_link::LeftJoin('social_links_translations', 'social_links_translations.social_id', '=', 'social_links.id')
            ->select('social_links_translations.title as title', 'social_links.id as id', 'social_links.icon')
            ->where('locale', App::getLocale())->get();

        $countries = Country::leftJoin('countries_translations', 'countries_translations.country_id', '=', 'countries.id')
            ->select('countries_translations.title as title', 'countries.id as id')
            ->where('locale', App::getLocale())->get();

        if (userSetting()->myAds_menu == 1 && userSetting()->myAds_menu != 0) {
            $user = User::findOrFail(auth()->id());
            if ($user->user_type == 'famous') {
                $user_ads = SocialAdvertisementUser::where('famous_id', $user->id)->get();
                return view('front.user.myAds', compact('user', 'user_ads', 'social_links', 'countries'));
            } else {
                return view('front.not-found', compact('countries', 'social_links'));
            }
        } else {
            return view('front.not-found', compact('countries', 'social_links'));
        }
    }

    public function advertise(Request $request)
    {
        $ad = SocialAdvertisementUser::findOrFail($request->social_adv_id);
        $ad->from = $request->from;
        $ad->to = $request->to;
        $ad->update();
        return redirect()->back()->with('success', _i('Date Added Successfully'));
    }

    public function joinOurAccounts()
    {
        $setting_socials = \App\Models\SocialLinkSetting::all();
        return view('front.joinOurAccounts', compact('setting_socials'));
    }
}
