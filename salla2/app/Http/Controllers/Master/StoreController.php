<?php


namespace App\Http\Controllers\Master;


use App\Http\Controllers\Controller;
use App\Models\Membership\Membership;
use App\Models\Membership\MembershipData;
use App\StoreData;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StoreController extends Controller
{

    public function index()
    {
        if (request()->ajax()) {
            $query = StoreData::all();

            return Datatables::of($query)
                ->editColumn('domain', function ($query) {
                    return '<a href="' . request()->getScheme() . ':' . '//' . $query['domain'] . '.' . request()->getHost() . '/home' . '">' . $query['domain'] . '.' . request()->getHost() . '</a>';
                })
                ->editColumn('membership_id', function ($query) {
                    $membership = MembershipData::where('membership_id', $query->membership_id)
                        ->where('lang_id', getLang(session('MasterLang')))->first();
                    return $membership['title'];
                })
                ->addColumn('action', function ($query) {
                    return '<a href="../store/' . $query->id . '/show" class="btn btn-primary"><i class="ti-eye"></i> ' . _i('Show') . '</a>';
                })
                ->rawColumns(['action', 'membership_id', 'domain'])->make(true);
        }
        return view('master.store.index');
    }


    public function show($id)
    {
      //  dd(StoreData::find($id));
        $store = StoreData::findOrFail($id);

        $user = User::where('id', $store->owner_id)->first();
        $membership_data = MembershipData::where('membership_id', $store->membership_id)
            ->where('lang_id', getLang(session('MasterLang')))->first();
        $membership = Membership::findOrFail($store->membership_id);
        $store_users = User::where('store_id', $store->id)->count();
        return view('master.store.show', compact('store', 'membership', 'membership_data', 'user', 'store_users'));
    }

    public function change_status(Request $request)
    {
        //dd($request->all());
        $store = StoreData::findOrFail($request->store_id);
        $store->is_active = $request->store_status;
        $store->save();
        return response()->json($store);
    }
}
