<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ActivememberDataTable;
use App\Models\User;
use App\Models\User_status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActiveMemberController extends Controller
{

    public function index(ActivememberDataTable $activememberDataTable)
    {

        return  $activememberDataTable->render('admin.status.active.index' , ['title' => _i('Manage Active member')]);
    }

    public function store(Request $request)
    {
        $newbest = new User_status();
        $newbest->user_id = $request->User_id;
        $newbest->type = 'active';
        $newbest->created = Carbon::now();
        $newbest->save();

        session()->flash('success',_i('added Succfully'));
        return redirect()->route('Activemember.index');

    }


    public function update(Request $request, $id)
    {

        $user_status = User_status::where('type','active')->where('user_id',$id)->first();
        $user_status_del = User_status::findOrFail($user_status->id);
        $user_status_del->delete();


        session()->flash('success',_i('edited Succfully'));
        return redirect()->route('Activemember.index');
    }
}
