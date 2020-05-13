<?php

namespace App\Http\Controllers;

use App\Hr\Course\Applicant;
use App\Model\Groups;
use App\Model\UsersGroup;
use App\Models\Message;
use App\Notifications\acceptTrainer;
use App\Notifications\AdminNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Yajra\DataTables\Facades\DataTables;

class NotificationController extends Controller
{
    public function notify_read(Request $request)
    {
        $user = User::where('is_admin', 1)->first();

        $user->unreadNotifications()->update(['read_at' => now()]);
    }

    public function getDatatableApplicant()
    {
        $applicant = Applicant::leftJoin('users', 'users.id', 'applicants.user_id')->select(['applicants.id', 'first_name', 'last_name', 'website', 'email', 'address', 'dob', 'gender', 'is_active', 'applicants.created_at', 'applicants.updated_at']);

        return \Yajra\DataTables\Facades\DataTables::of($applicant)
            ->addColumn('action', function ($applicant) {
                return '<a href="' . url('admin/course/applicant/' . $applicant->id . '/edit') . '"  class="btn btn-icon waves-effect waves-light btn-default" title="Edit"><i class="fa fa-edit"></i> </a>' . "&nbsp;" .
                    '<a href="' . route('info_applicant') . '?id=' . $applicant->id . '" class="btn btn-icon waves-effect waves-light btn-default" title="Show Info"><i class="fa fa-fw fa-gg-circle"></i> </a>' . "&nbsp;" .
                    '<a href="' . url('admin/course/applicant/' . $applicant->id . '/delete') . '"  class="btn btn-icon waves-effect waves-light btn-pink" title="Delete"><i class="fa fa-remove"></i> </a>';
            })
            ->editColumn('is_active', function ($applicant) {
                return $applicant->is_active == 1 ? 'Active' : 'Not Active';
            })
            ->editColumn('website', function ($applicants) {
                return $applicants->website == 0 ? 'yes' : 'No';
            })
            ->addColumn('select_users', function ($applicant) {

                return '<input type="checkbox" class="minimal control-label" id="checkbox" name="users[]" value="' . $applicant->id . '" >';
            })
            ->rawColumns([
                'select_users',
                'action',
            ])
            ->make(true);
    }

    public function notification()
    {
        $applicant = Applicant::leftJoin('users', 'users.id', 'applicants.user_id')
            ->select(['applicants.id','applicants.user_id as userId' ,'first_name', 'last_name', 'website', 'email', 'address', 'dob', 'gender',
                'is_active', 'applicants.created_at', 'applicants.updated_at']);

        if (\request()->ajax()) {
            $applicant = Applicant::leftJoin('users', 'users.id', 'applicants.user_id')->select(['applicants.id','applicants.user_id as userId' ,'first_name', 'last_name', 'website', 'email', 'address', 'dob', 'gender', 'is_active', 'applicants.created_at', 'applicants.updated_at']);

            return DataTables::of($applicant)
                ->addColumn('action', function ($applicant) {
                    return '<a href="' . url('admin/course/applicant/' . $applicant->id . '/edit') . '"  class="btn btn-icon waves-effect waves-light btn-default" title="Edit"><i class="fa fa-edit"></i> </a>' . "&nbsp;" .
                        '<a href="' . route('info_applicant') . '?id=' . $applicant->id . '" class="btn btn-icon waves-effect waves-light btn-default" title="Show Info"><i class="fa fa-fw fa-gg-circle"></i> </a>' . "&nbsp;" .
                        '<a href="' . url('admin/course/applicant/' . $applicant->id . '/delete') . '"  class="btn btn-icon waves-effect waves-light btn-pink" title="Delete"><i class="fa fa-remove"></i> </a>';
                })
                ->editColumn('is_active', function ($applicant) {
                    return $applicant->is_active == 1 ? 'Active' : 'Not Active';
                })
                ->editColumn('website', function ($applicants) {
                    return $applicants->website == 0 ? 'yes' : 'No';
                })
                ->addColumn('select_users', function ($applicant) {

                    return  '<input type="checkbox" data-parsley-mincheck="1" class="minimal control-label" id="checkbox" name="users[]" value="'. $applicant->userId .'" >';
                })
                ->rawColumns([
                    'select_users',
                    'action',
                ])
                ->make(true);
        }
        $groups = Groups::all();
        return view('admin.groups.notification', compact('groups'));
    }

    public function store_notification(Request $request)
    {
        //dd($request);
        //$url =   url('/admin/trainer/pending');
        //$admin = auth()->user();
        if($request->notify_type == "group")
        {
            $user_groups = UsersGroup::where('group_id' , $request->group_id)->get();
            foreach($user_groups as $item)
            {
                $message = $request->send_message;
                $user = User::findOrFail($item->user_id);

                //Notification::send($user, new AdminNotification($user->id, $admin->first_name, $admin['last_name'], $message ,$url));
               // $user->notify(new AdminNotification($user->id, $admin->first_name, $admin['last_name'], $message ,$url));
                $message = Message::create([
                    'message' => $message,
                    'from_id' => auth()->id(),
                    'to_id' => $user->id,
                ]);
                $message->save();
            }
        }
        elseif($request->notify_type == "user")
        {
            $rules = ['user' =>  ['required'],];
            $messages = ['required' => 'The User table Checkbox must choose at least one value',];
            $validator = validator()->make($request->all() , $rules ,$messages);
            if($validator->fails())
                return redirect()->back()->withErrors($validator)->withInput();

            $users = $request->users;
            foreach($users as $id)
            {
                $message = $request->send_message;
                $user = User::findOrFail($id);
                // Notification::send($user, new AdminNotification($user->id, $admin->first_name, $admin['last_name'], $message ,$url));
                //$user->notify(new AdminNotification($user->id, $admin->first_name, $admin['last_name'], $message ,$url));
                $message = Message::create([
                    'message' => $message,
                    'from_id' => auth()->id(),
                    'to_id' => $user->id,
                ]);
                $message->save();
            }
        }
        //return redirect(route('notify.send'))->withFlashMessage(_i('Notification Send Successfully !'));
        return redirect()->back()->withFlashMessage(_i('Notification Send Successfully !'));
    }



}
