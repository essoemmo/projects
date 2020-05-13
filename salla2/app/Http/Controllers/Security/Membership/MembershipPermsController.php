<?php
/**
 * Created by PhpStorm.
 * User: misr computer
 * Date: 20/07/2019
 * Time: 01:59 ã
 */

namespace App\Http\Controllers\Security\Membership;


use App\Help\Utility;
use App\Http\Controllers\Controller;
use App\Models\Membership\Membership;
use App\Models\Membership\Membership_perm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class MembershipPermsController extends  Controller
{

    public function index()
    {
        return view('security.membership.membership_perms.index');
    }

    public function datatableMemberPer(){
        $membership = DB::table('memberships')
                        ->join('membership_perms','membership_perms.membership_id','=','memberships.id')
                        ->select(['membership_perms.id as mp','title', 'is_active', 'price', 'duration','membership_perms.created_at']);

        return DataTables::of($membership)
            ->addColumn('action', function ($membership) {
                return "&nbsp;&nbsp;".'<a href="' . $membership->mp. '/edit"  >
                        <button type="button" class="btn btn-primary "> <i class="fa fa-edit"></i> '._i("Edit").'</button></a>' ."&nbsp;";
//                '<a href="' . $membership->mp. '/edit" class="btn btn-icon waves-effect waves-light btn-primary" title="' . _i("Edit") . '"><i class="fa fa-edit"></i> </a>' . "&nbsp;&nbsp;&nbsp;" .
//                '<a href="' . $membership->mp. '/delete" class="btn btn-icon waves-effect waves-light btn-pink" title="' . _i("Delete") . '"><i class="fa fa-remove"></i> </a>';
            })
            ->editColumn('is_active' ,function ($membership){
                return $membership->is_active == 1 ? 'yes' : 'no';
            })
            ->editColumn('duration' ,function ($membership){
                return $membership->duration ." " .  'Year';
            })
            ->make(true);
    }

    public function create()
    {
        $get_guard = new Utility();
        $guard_name = $get_guard->get_guard(); // return guard name of current user
        $permissionNames = auth()->guard($guard_name)->user()->permissions; // return collection of permission objects
        return view('security.membership.membership_perms.create' ,compact('guard_name','permissionNames'));
    }

    public function store(Request $request)
    {
//        dd($request->groups);
        $rules = [
            'title' => ['required', 'max:150','min:3', 'unique:memberships'],
            'price' => 'required|integer',
            'duration' => 'required|integer',
        ];

        $validator = validator()->make($request->all() ,$rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $membership = Membership::create([
            'title' => $request->title,
            'price' => $request->price,
            'duration' => $request->duration,
            'is_active' => $request->is_active,
        ]);
        $membership->save();

        // attach membership withpermission & store in membership_perms table
        foreach($request->groups as $key => $value)
        {
            $membership_permissions = Membership_perm::create([
                'membership_id' => $membership->id,
                'prm_id' => $value,
            ]);
            $membership_permissions->save();
        }

        return redirect()->back()->with('flash_message' , _i('Added Successfully !'));
    }

    public function edit($id)
    {

        $get_guard = new Utility();
        $guard_name = $get_guard->get_guard(); // return guard name of current user
        $permissionNames = auth()->guard($guard_name)->user()->permissions; // return collection of permission objects

        $membership_Perm = Membership_perm::findOrFail($id);
        $membership = Membership::where('id','=',$membership_Perm->membership_id)->first();
        $permissions = Membership_perm::where('membership_id' ,'=' ,$membership_Perm->membership_id)->get();

        foreach($permissions as $key => $value)
        {
            $permission_details = Permission::where('id' ,'=' ,$value->prm_id)->first();
            $permission_group[] = $permission_details->id; // permission_group[] contain ids of permissions token by membership
        }
        return view('security.membership.membership_perms.edit' ,compact('membership','membership_Perm','permission_group','permissionNames'));
    }

    public function update($id ,Request $request)
    {
        $membership = Membership::find($id);
        $permissions = Membership_perm::where('membership_id' ,'=' ,$membership->id)->get();
        foreach($permissions  as $per)
        {
            $per->delete();
        }
//        dd('done');
//        foreach($permissions as $key => $value)
//        {
//            $permission_details = Permission::where('id' ,'=' ,$value->prm_id)->first();
//            $permission_group[] = $permission_details->id; // permission_group[] contain ids of permissions token by membership
//        }
//

        $rules = [
            'title' => ['required', 'max:150','min:3', Rule::unique('memberships')->ignore($membership->id)],
            'price' => 'required|integer',
            'duration' => 'required|integer',
        ];
        $validator = validator()->make($request->all() ,$rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        $membership->title = $request->title;
        $membership->price = $request->price;
        $membership->duration = $request->duration;
        $membership->is_active = $request->is_active;
        $membership->save();


        foreach($request->groups as $key => $value)
        {
            $membership_permissions = Membership_perm::create([
                'membership_id' => $membership->id,
                'prm_id' => $value,
            ]);
            $membership_permissions->save();
        }
        return redirect()->back()->with('flash_message' , _i('Updated Successfully !'));

//        $membership->permissions()->detach($permission_group);

    }

}