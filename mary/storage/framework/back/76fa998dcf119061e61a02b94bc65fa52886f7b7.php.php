<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\MemberShipdataTable;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class membershipController extends Controller
{
        public function __construct()
        {
            $this->middleware(['permission:Membership-Add'])->only('store');
            $this->middleware(['permission:Membership-Edit'])->only('update');
            $this->middleware(['permission:Membership-Delete'])->only('delete');
        }

    public function index(MemberShipdataTable $memberShip)
    {
        return $memberShip->render('admin.memberShip.index', ['title' => _i('Member Ship')]);

    }

    public function store(Request $request)
    {
        $request->validate([
           'language' => 'required',
           'title' => 'required',
           'cost' => 'required|regex:/^\d+(\.\d{1,2})?$/',
           'years' => 'required|numeric',
        ],[
            'title.required'=>_i('title required'),
            'cost.required'=>_i('Cost required'),
            'years.required'=>_i('years required'),
            'years.numeric'=>_i('must be numeric'),
        ]);

        $addMember = new Membership();
        $addMember->name = $request->title;
        $addMember->cost = $request->cost;
        $addMember->years = $request->years;
        $addMember->lang_id = $request->language;

        $addMember->save();

        session()->flash('success',_i('Add Succfully'));
        return redirect()->route('memberships.index');

    }


    public function update(Request $request)
    {
        $request->validate([
            'language' => 'required',
            'title' => 'required',
            'cost' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'years' => 'required|numeric',
        ],[
            'title.required'=>_i('title required'),
            'cost.required'=>_i('Cost required'),
            'years.required'=>_i('years required'),
            'years.numeric'=>_i('must be numeric'),
        ]);

        $addMember =Membership::findOrFail($request->id);
        $addMember->name = $request->title;
        $addMember->cost = $request->cost;
        $addMember->years = $request->years;
        $addMember->lang_id = $request->language;

        $addMember->save();

        session()->flash('success',_i('edited Succfully'));
        return redirect()->route('memberships.index');
    }

    public function destroy(Membership $membership)
    {
        $membership->delete();
        session()->flash('success',_i('deleted Succfully'));
        return redirect()->route('memberships.index');


    }
}
