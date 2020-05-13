<?php


namespace App\Http\Controllers\Master\Security;


use App\Admin;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    // function to show all users
    public function showUsers()
    {
        if (request()->ajax()) {
            $users = User::query()->where('guard' , 'store');

            return DataTables::eloquent($users)
//                ->order(function ($query) {
//                    $query->orderBy('id', 'asc');
//                })

                ->addColumn('name', function ($query) {
                    return $query['name'] .' '.$query['lastname'] ;
                })
                ->addColumn('edit', function ($query) {
                    return '<a href="../user/'.$query->id.'/edit" class="btn btn-success"><i class="ti-eye"></i> ' ._i('Show') .'</a>';
                })
                ->rawColumns([
                    'edit',
                ])
                ->make(true);
        }
        return view('master.security.users.index');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('master.security.users.edit', compact('user'));
    }



}