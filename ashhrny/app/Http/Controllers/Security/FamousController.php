<?php


namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use App\Models\AccountContent;
use App\Models\Social_link;
use App\Models\SocialLinkUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class FamousController extends Controller
{

    // function to show all users
    public function showUsers()
    {
        if (request()->ajax()) {
            $users = User::query()->where('guard', 'web')->where('user_type', "famous")->with('user_social');

            return DataTables::eloquent($users)
                ->order(function ($query) {
                    $query->orderBy('id', 'asc');
                })
                ->addColumn('name', function ($query) {
                    return $query['first_name'] . ' ' . $query['last_name'];
                })
                ->addColumn('membership_number', function ($query) {
                    return membership_number($query->membership_number);
                })
                ->editColumn('status', function ($query) {
                    return $query['status'] == 1 ? "Active" : "Not Active";
                })
                ->editColumn('image', function ($query) {
                    if ($query->image)
                        return '<img class="img-fluid"  style="max-height: 100px; max-height: 60px; !important;" align="center" src="' . asset($query->image) . '">';
                    return '<img class="img-fluid"  style="max-height: 100px; max-height: 60px; !important;" align="center" src="' . url('front/personal_image.png') . '">';
                })
                ->editColumn('user_social', function ($query) {
                    $socials = '';
                    if (count($query->user_social) > 0) {
                        foreach ($query->user_social as $social) {
                            $socials .= '<li>' . $social->url . '</li>';
                        }
                    } else {
                        $socials .= '<li>' . _i('No Accounts') . '</li>';
                    }
                    return '<ul class="a">' . $socials . '</ul>';
                })
                ->editColumn('gender', function ($query) {
                    return $query['gender'];
                })
                ->editColumn('phone', function ($query) {
                    return country_call_code_with_id($query->country_id) . $query['mobile'] ?? _i('No data');
                })
                ->addColumn('edit', function ($query) {
                    return '<a href="../famous/' . $query->id . '/edit" class="btn btn-success"><i class="ti-eye"></i> ' . _i('Show') . '</a>';
                })
                ->addColumn('delete', 'security.famous.btn.delete')
                ->rawColumns([
                    'status',
                    'user_social',
                    'gender',
                    'phone',
                    'image',
                    'edit',
                    'delete',
                ])
                ->make(true);
        }
        return view('security.famous.index');
    }

    public function createUser()
    {
        $content_type = AccountContent::leftJoin('account_contents_translations', 'account_contents_translations.account_content_id', 'account_contents.id')
            ->where('account_contents_translations.locale', \app()->getLocale())->select('account_contents_translations.title', 'account_contents.id')->get();
        $socialLinks = Social_link::LeftJoin('social_links_translations', 'social_links_translations.social_id', '=', 'social_links.id')
            ->select('social_links_translations.title as title', 'social_links.id as id', 'social_links.icon')
            ->where('locale', App::getLocale())->get();
        return view('security.famous.create', compact('content_type', 'socialLinks'));
    }

    public function storeUser(Request $request)
    {
        $rules = [
            'first_name' => ['required', 'string', 'max:191', 'min:3'],
            'last_name' => ['required', 'string', 'max:191', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'cost' => ['required', 'integer'],
            'social.*' => 'unique:social_link_user,url',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $number = User::where('user_type', "famous")
                ->orWhere('user_type', "normal")
                ->orderBy('id', 'desc')->first();
            if ($number) {
                $membership_number = $number['membership_number'] + 1;
            } else {
                $membership_number = 1;
            }
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'guard' => "web",
                'user_type' => $request->user_type,
                'membership_number' => $membership_number,
                'password' => Hash::make('Ashhrny'),
                'cost' => $request->cost,
            ]);
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
                    }
                }
            }
            $user->assignRole('registered-users');
//            Mail::to($user->email)->send(new WelcomeMail($user));
            return redirect(route('famousUser'))->with('success', _i('Added Successfully'));
        }
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $content_type = AccountContent::leftJoin('account_contents_translations', 'account_contents_translations.account_content_id', 'account_contents.id')
            ->where('account_contents_translations.locale', \app()->getLocale())->select('account_contents_translations.title', 'account_contents.id')->get();
        $socialLinks = Social_link::LeftJoin('social_links_translations', 'social_links_translations.social_id', '=', 'social_links.id')
            ->select('social_links_translations.title as title', 'social_links.id as id', 'social_links.icon')
            ->where('locale', App::getLocale())->get();
        $user_social = SocialLinkUser::where('user_id', $user->id)->get();
        $user_social_array = SocialLinkUser::where('user_id', $user->id)->pluck('social_link_user.social_id')->toArray();
        return view('security.famous.edit', compact('user', 'content_type', 'socialLinks', 'user_social', 'user_social_array'));
    }


    public function updateUser(Request $request, $id)
    {

        $user = User::findOrFail($id);
        $rules = [
            'first_name' => ['required', 'string', 'max:191', 'min:3'],
            'last_name' => ['required', 'string', 'max:191', 'min:3'],
            'email' => ['required', Rule::unique('users', 'email')->ignore($user->id), 'email', 'max:191'],
            'cost' => ['required', 'integer'],
            'social.*' => 'unique:social_link_user,url,' . $user->id . ',user_id',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'guard' => "web",
                'user_type' => $request->user_type,
                'status' => $request->status,
                'cost' => $request->cost,
            ]);
            if ($request->social != null) {
                SocialLinkUser::where('user_id', $user->id)->delete();
                $socials = $request->social;
                foreach ($socials as $key => $value) {
                    if ($value != null) {
                        $user_social = SocialLinkUser::create([
                            'user_id' => $user->id,
                            'social_id' => $key,
                            'content' => $request->contentType[$key],
                            'url' => $value,
                        ]);
                    }
                }
            }

            return redirect(url('admin/famous/all'))->with('success', _i('Updated Successfully !'));
        }

    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/admin/famous/all')->with('success', _i('Deleted Successfully !'));
    }

    public function DefaultUrl(Request $request)
    {
        $user_social_default = SocialLinkUser::where('user_id', $request->id)->first();
        if ($user_social_default) {
            $user_social_default->default = null;
            $user_social_default->save();
        }
        $user_social = SocialLinkUser::findOrFail($user_social_default->id);
        $user_social->default = 1;
        $user_social->save();
        return response()->json(true);
    }

}
