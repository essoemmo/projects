<?php
/**
 * Created by PhpStorm.
 * User: misr computer
 * Date: 15/07/2019
 * Time: 02:19 �
 */

namespace App\Http\Controllers\Security\Membership;


use App\DataTables\MembershipUserDataTable;
use App\Http\Controllers\Controller;
use App\Models\Membership\Membership;
use App\Models\Membership\User_membership;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class UserMembershipController extends Controller
{
//'user_id', 'membership_id', 'price', 'created', 'expire_at
    public function index(MembershipUserDataTable $membership)
    {
        return $membership->render('security.users.allUsers');
    }

    public function create()
    {
        $users = User::all();
        $memberships = Membership::all();
        return view('security.membership.user_membership.create' , compact('users' ,'memberships'));
    }

    public function store(Request $request)
    {
        $user_membership = User_membership::where('user_id','=',$request->user_id)->first();
        // check if user_id not found in user_membership table
        if($user_membership != null)
        {
            return redirect()->back()->with('danger' , _i('This User Is Added to Membership Before !'));

        }else{
            $membership = Membership::findOrFail($request->membership_id);
            $start =  strtotime($request->created);
            $expire = date('Y-m-d', strtotime("+$membership->duration years",$start));

            $user_membership = User_membership::create([
                'user_id' => $request->user_id,
                'membership_id' => $request->membership_id,
                'price' => $membership->price,
                'created' => $request->created,
                'expire_at' => $expire,
            ]);
            $user_membership->save();
            return redirect()->back()->with('flash_message' , _i('Added Successfully !'));
        }
    }

    public function edit($id)
    {
        $user_memberships = User_membership::findOrFail($id);
        $users = User::all();
        $memberships = Membership::all();
        return view('security.membership.user_membership.edit' , compact('user_memberships','users','memberships'));
    }

    public function update($id , Request $request)
    {
        $user_memberships = User_membership::findOrFail($id);

        // check if user_id not found in user_membership table
        $rules = [
            'user_id' => ['required', Rule::unique('user_membership')->ignore($user_memberships->id)],
        ];
        $validator = validator()->make($request->all() ,$rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $membership = Membership::findOrFail($request->membership_id);
        $start =  strtotime($request->created);
        $expire = date('Y-m-d', strtotime("+$membership->duration years",$start)); // adding duration(years) to created date

        $user_memberships->user_id = $request->user_id;
        $user_memberships->membership_id = $request->membership_id;
        $user_memberships->created = $request->created;
        $user_memberships->price = $membership->price;
        $user_memberships->expire_at = $expire;
        $user_memberships->save();
        return redirect()->back()->with('flash_message' , _i('Updated Successfully !'));
    }

    public function delete($id)
    {
        $user_memberships = User_membership::findOrFail($id);
        if($user_memberships){
            $user_memberships->delete();
            return redirect()->back()->with('flash_message' , _i('Deleted Successfully !'));
        }
        return redirect()->back()->with('flash_message' , _i('Not Found !'));

    }


    public function get_membership(Request $request) {
        $membership = Membership::findOrFail($request->input('id'));
        return $membership;
    }



}