<?php


namespace App\Http\Controllers\Admin;


use App\DataTables\FeaturedUserDataTable;
use App\Http\Controllers\Controller;
use App\Models\FeaturedAdUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FeaturedUserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:FeaturedUser-Show'])->only(['update', 'show', 'index']);
        $this->middleware(['permission:FeaturedUser-Delete'])->only('delete');
    }

    public function index(FeaturedUserDataTable $membersDataTable)
    {
        $users = User::where('user_type', "normal")->orWhere('user_type', "famous")->get();
        return $membersDataTable->render('admin.featured_users.index', compact('users'));
    }


    public function show($id)
    {
        $advertise_details = FeaturedAdUser::findOrFail($id);
        $users = User::where('id', $advertise_details->user_id)->first();
        return view('admin.featured_users.show', compact('users', 'advertise_details', 'id'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $from = Carbon::parse($request->from)->format('Y-m-d H:i:s'); // to change to date time format on database
        $to = Carbon::parse($request->to)->format('Y-m-d H:i:s');
        //dd($from);
        $advertise_details = FeaturedAdUser::findOrFail($id);

        if ($request->publish == null) {
            $request->publish = 0;
        }
        $advertise_details->update([
            'from' => $from,
            'to' => $to,
            'publish' => $request->publish,
        ]);

        return redirect(aUrl('featured_users'))->with(['success' => 'success save']);
    }


    public function destroy($id)
    {
        $advertise_details = FeaturedAdUser::findOrFail($id);
        $advertise_details->delete();
        return redirect(aurl('featured_users'))->with('success', _i('success delete'));
    }

}
