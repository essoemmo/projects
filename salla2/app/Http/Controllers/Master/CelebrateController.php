<?php

namespace App\Http\Controllers\Master;

use App\Celebrate;
use App\Models\cities;
use App\Models\countries;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class CelebrateController extends Controller
{

    public function index(Request $request){

        if ($request->ajax()) {

            $celebrate = Celebrate::get();

            return DataTables::of($celebrate)
                ->editColumn('store_id',function ($p){
                    return $p->store->title;
                })
                ->addColumn('action', function ($p) {

                    $btn = '<a href="../store/' . $p->store_id . '/show" class="btn btn-success btn-sm">'._i('show').'</a>';
                    return $btn;

                })
//            ->addColumn('delete', function($p){
//                return view('admin.city.btn.delete');
//            })

                ->make(true);
        }

        return view('master.celebrate.index');
    }

}
