<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Model\Groups;
use App\Model\UsersGroup;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;

class GroupsController extends Controller
{


    public function index()
    {
        if(request()->ajax())
        {
            $groups = Groups::get();
            return DataTables::of($groups )
//                ->addColumn('action', function ($b ) {
//                    return $this->generateHtmlEdit_Delete([$b->id,$b->title,$b->description],$b->id);
//                })
                ->addColumn('action', function ($groups) {
                    return '<a target="_blank" href="' . $groups->id . '/edit" class="btn btn-primary" title="' . _i("Edit") . '"><i class="fa fa-edit"></i> </a>' . "&nbsp;" .
                        '<a   href="delete?id=' . $groups->id . '"  class="btn btn-danger" title="' . _i("Delete") . '"><i class="fa fa-trash"></i> </a>';
                })
                ->make(true);
        }
        $users = User::where('type' , "applicant")->get();

        return view('admin.groups.index',compact('users'));
    }


    public function add(Request $request)
    {
        $rules = [
            'title' => ['required', 'max:50','min:3', 'unique:bank_transfers'],
        ];

        $validator = validator()->make($request->all() , $rules);

        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $group = Groups::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        $group->save();

        foreach ($request->users_id as $user_id)
        {
            $users_group = UsersGroup::create([
                'group_id' => $group->id,
                'user_id' => $user_id
            ]);
            $users_group->save();
        }
        return redirect()->back()->withFlashMessage(_i('Added Successfully !'));
    }

    public function edit($id)
    {
        $group= Groups::findOrFail($id);
        $users = User::where('type' , "applicant")->get();
        $users_group = UsersGroup::where('group_id' , $id)->get();
        return view('admin.groups.edit' , compact('group','users','users_group'));
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $group= Groups::findOrFail($id);

        $rules = [
            'title' => ['required', 'max:50','min:3', Rule::unique('groups')->ignore($group->id)],
        ];

        $validator = validator()->make($request->all() , $rules);

        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $group->title = $request->input('title');
        $group->description = $request->input('description');
        $group->save();

        UsersGroup::where('group_id' , $group->id)->delete();
        if($request->users_id){
            foreach ($request->users_id as $user_id)
            {
                $users_group = UsersGroup::create([
                    'group_id' => $group->id,
                    'user_id' => $user_id
                ]);
                $users_group->save();
            }
        }
        return redirect()->back()->withFlashMessage(_i('Updated Successfully !'));

    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $groups= Groups::findOrFail($id);
        $groups->delete();
        return redirect()->back()->withFlashMessage(_i('Deleted Successully !'));
    }



    public function list(Request $request)
    {
        $users = UsersGroup::where('group_id' , $request->group_id)->pluck("user_id","id");
        return $users;
    }



}