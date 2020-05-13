<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BestMemberDataTable;
use App\Models\User_status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BestMemberController extends Controller
{

    public function index(BestMemberDataTable $bestMemberDataTable)
    {
        return  $bestMemberDataTable->render('admin.status.best.index' , ['title' => _i('Manage best member')]);
    }

    public function store(Request $request)
    {
      $newbest = new User_status();
      $newbest->user_id = $request->User_id;
      $newbest->type = 'best';
      $newbest->created = Carbon::now();
      $newbest->save();

        session()->flash('success',_i('added Succfully'));
        return redirect()->route('Bestmember.index');

    }


    public function update(Request $request, $id)
    {
        $user_status = User_status::where('type','best')->where('user_id',$id)->first();
        $user_status_del = User_status::findOrFail($user_status->id);
        $user_status_del->delete();


        session()->flash('success',_i('edited Succfully'));
        return redirect()->route('Bestmember.index');
    }


}
