<?php


namespace App\Http\Controllers\Security;


use App\Admin;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{


    // function to show all users
    public function showUsers()
    {
        if (request()->ajax()) {
            $users = User::query()->where('guard', 'web')->where('user_type', "normal")->with('user_social');

            return DataTables::eloquent($users)
                ->order(function ($query) {
                    $query->orderBy('membership_number', 'asc');
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
                ->
                addColumn('edit', function ($query) {
                    return '<a href="../user/' . $query->id . '/edit" class="btn btn-success"><i class="ti-pencil-alt"></i> ' . _i('Edit') . '</a>';
                })
                ->addColumn('delete', 'security.users.btn.delete')
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
        return view('security.users.index');
    }


//  admin create new user through view
    public
    function createUser()
    {
        return view('security.users.add');
    }

//  admin store data of new user
    public
    function storeNewUser(Request $request)
    {
        $rules = [
            'first_name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'guard' => "web",
                'password' => Hash::make($request->password),
            ]);
            $user->assignRole('registered-users');
            $user->save();
            return redirect()->back()->with('success', _i('Added Successfully !'));
        }
    }


    public
    function editUser($id)
    {
        $user = User::findOrFail($id);
        $country = Country::leftJoin('countries_translations', 'countries_translations.country_id', '=', 'countries.id')
            ->select('countries_translations.title as title', 'countries.id as id')
            ->where('countries.id', $user['country_id'])
            ->where('locale', App::getLocale())->first();
        return view('security.users.edit', compact('user', 'country'));
    }


    public
    function updateUser(Request $request, $id)
    {
        $user = Admin::findOrFail($id);
        if ($request->status != null) {
            $user->status = $request->status;
            $user->save();
        }
        return redirect('/admin/user/all')->with('success', _i('Updated Successfully !')); // return if is update admin
    }

    public
    function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/admin/user/all')->with('success', _i('Deleted Successfully !'));
    }

}
