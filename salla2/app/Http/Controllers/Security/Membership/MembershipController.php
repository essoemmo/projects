<?php
/**
 * Created by PhpStorm.
 * User: misr computer
 * Date: 15/07/2019
 * Time: 10:36 �
 */

namespace App\Http\Controllers\Security\Membership;


use App\DataTables\MembershipDataTable;
use App\Help\Utility;
use App\Http\Controllers\Controller;
use App\Models\Membership\Membership;
use App\Models\Membership\Membership_perm;
use App\Models\Membership\User_membership;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class MembershipController extends Controller
{


    public function index(MembershipDataTable $membership)
    {
        return $membership->render('security.membership.memberships.index');
    }

    public function create(MembershipDataTable $membership)
    {
//        return view('security.membership.memberships.create');
        $guard_store = Utility::Store;
        $get_guard = new Utility();
//        $guard_name = $get_guard->get_guard(); // return guard name of current user
//        $permissionNames = auth()->guard($guard_name)->user()->permissions; // return collection of permission objects
        $permissionNames = Permission::where('type', '=', "pkg")
            ->join('permission_data', 'permission_data.permission_id', '=', 'permissions.id')
            ->select('permissions.id', 'permission_data.title')
            ->get();
//        dd($permissionNames);
        return view('security.membership.membership_perms.create', compact('permissionNames'));
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => ['required', 'max:150', 'min:3', 'unique:memberships'],
            'price' => 'required|integer',
            'duration' => 'required|integer',
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $membership = Membership::create([
            'title' => $request->title,
            'price' => $request->price,
            'duration' => $request->duration,
            'is_active' => $request->is_active,
        ]);
        $membership->save();

        // attach membership withpermission & store in membership_perms table
        foreach ($request->groups as $key => $value) {
            $membership_permissions = Membership_perm::create([
                'membership_id' => $membership->id,
                'prm_id' => $value,
            ]);
            $membership_permissions->save();
        }

        return redirect()->back()->with('flash_message', _i('Added Successfully !'));
    }

    public function edit($id)
    {
        $guard_store = Utility::Store;
        $get_guard = new Utility();
        $guard_name = $get_guard->get_guard(); // return guard name of current user
//        $permissionNames = auth()->guard($guard_name)->user()->permissions; // return collection of permission objects
        $permissionNames = Permission::where('type', '=', "pkg")
            ->join('permission_data', 'permission_data.permission_id', '=', 'permissions.id')
            ->select('permissions.id', 'permission_data.title')
            ->get();

        $permission_group = [];
        $membership = Membership::find($id);
        $permissions = Membership_perm::where('membership_id', '=', $membership->id)->get();

        foreach ($permissions as $key => $value) {
            $permission_details = Permission::where('id', '=', $value->prm_id)->first();
            $permission_group[] = $permission_details->id; // permission_group[] contain ids of permissions token by membership
        }
//        dd($permission_group);

        return view('security.membership.membership_perms.edit', compact('membership', 'permission_group', 'permissionNames'));
    }

    public function update(Request $request, $id)
    {
        $membership = Membership::find($id);
        $permissions = Membership_perm::where('membership_id', '=', $membership->id)->get();
        foreach ($permissions as $per) {
            $per->delete();
        }

        $rules = [
            'title' => ['required', 'max:150', 'min:3', Rule::unique('memberships')->ignore($membership->id)],
            'price' => 'required|integer',
            'duration' => 'required|integer',
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        $membership->title = $request->title;
        $membership->price = $request->price;
        $membership->duration = $request->duration;
        $membership->is_active = $request->is_active;
        $membership->save();


        foreach ($request->groups as $key => $value) {
            $membership_permissions = Membership_perm::create([
                'membership_id' => $membership->id,
                'prm_id' => $value,
            ]);
            $membership_permissions->save();
        }
        return redirect()->back()->with('flash_message', _i('Updated Successfully !'));

    }

    public function delete(Request $request, $id)
    {
        $membership = Membership::findOrFail($id);
        $membership_user = User_membership::where('membership_id', '=', $membership->id)->first();

        if ($membership_user != null) {
            return redirect()->back()->with('danger', _i('Can`t Delete Membership delete User From Membership First !'));
        } else {

            if ($membership) {
                $membership->delete();
                return redirect()->back()->with('flash_message', _i('Deleted Successfully !'));
            } else {
                return redirect()->back()->with('flash_message', _i('Not Found !'));
            }
        }

    }

    public function AddMember(Request $request)
    {
        if (session()->has('memebr_id')) {
            session()->forget('memebr_id');
        }

        session()->put('memebr_id', $request->member_id);

        // dd(session('memebr_id'));

        return redirect()->route('registerurl', \Xinax\LaravelGettext\Facades\LaravelGettext::getLocale());
    }


}
