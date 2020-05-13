<?php

namespace App\Http\Controllers\web;

use App\Models\Material_status;
use App\Models\Story;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class SearchController extends Controller
{
    public function search(Request $request){
//    dd($request->to);
        if (Auth::check()){
            $userhis =  DB::table('user_histories')->where('action','search')->where('user_id',\auth()->user()->id)->first();
            if (!$userhis){
                DB::table('user_histories')->insert([
                    'user_id' => \auth()->user()->id,
                    'action' => 'search',
                    'created' => Carbon::now(),
                ]);
            }else{
                DB::table('user_histories')->where('action','search')->where('user_id',\auth()->user()->id)->update([
                    'created' =>  Carbon::now(),
                ]);
            }
        }


        if ($request->order == 'lastlogin desc'){
            if (Auth::check()){
                $search = User::
                leftJoin('nationalties','nationalties.id','users.nationalty_id')->
                leftJoin('nationalies_data','nationalies_data.nationalty_id','nationalties.id')->
                leftJoin('user_activity','user_activity.user_id','users.id')


                    ->where(function ($q) use($request) {
                        return $q->when($request->nationalty, function ($query) use ($request) {
                            return $query->where('users.nationalty_id', $request->nationalty);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->country, function ($query) use ($request) {
                            return $query->where('users.resident_country_id', $request->country);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->gendar, function ($query) use ($request) {
                            return $query->where('users.gender', $request->gendar);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->status, function ($query) use ($request) {
                            return $query->where('users.material_status_id', $request->status);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->from, function ($query) use ($request) {
                            return $query->whereBetween('users.age', [$request->from, $request->to]);
                        });
                    })
                    ->where('users.id','!=',\auth()->user()->id)
                    ->where('users.guard','!=','admin')
                    ->select('users.*','nationalies_data.county_name','nationalies_data.name')
                    ->orderBy('user_activity.created','DESC')->paginate(24);

            }else{


                $search = User::
                leftJoin('nationalties','nationalties.id','users.nationalty_id')->
                leftJoin('nationalies_data','nationalies_data.nationalty_id','nationalties.id')->
                leftJoin('user_activity','user_activity.user_id','users.id')

                    ->where(function ($q) use($request) {
                        return $q->when($request->nationalty, function ($query) use ($request) {
                            return $query->where('users.nationalty_id', $request->nationalty);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->country, function ($query) use ($request) {
                            return $query->where('users.resident_country_id', $request->country);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->gendar, function ($query) use ($request) {
                            return $query->where('users.gender', $request->gendar);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->status, function ($query) use ($request) {
                            return $query->where('users.material_status_id', $request->status);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->from, function ($query) use ($request) {
                            return $query->whereBetween('users.age', [$request->from, $request->to]);
                        });
                    })
                    ->where('users.guard','!=','admin')
                    ->select('users.*','nationalies_data.county_name','nationalies_data.name')
                    ->orderBy('user_activity.created','DESC')->paginate(24);


            }

//            =========================postdate desc========================

        }elseif($request->order == 'postdate desc'){
            if (Auth::check()){
                $search = User::
                leftJoin('nationalties','nationalties.id','users.nationalty_id')->
                leftJoin('nationalies_data','nationalies_data.nationalty_id','nationalties.id')->
                leftJoin('user_activity','user_activity.user_id','users.id')
                    ->where(function ($q) use($request) {
                        return $q->when($request->nationalty, function ($query) use ($request) {
                            return $query->where('users.nationalty_id', $request->nationalty);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->country, function ($query) use ($request) {
                            return $query->where('users.resident_country_id', $request->country);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->gendar, function ($query) use ($request) {
                            return $query->where('users.gender', $request->gendar);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->status, function ($query) use ($request) {
                            return $query->where('users.material_status_id', $request->status);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->from, function ($query) use ($request) {
                            return $query->whereBetween('users.age', [$request->from, $request->to]);
                        });
                    })
                    ->where('users.id','!=',\auth()->user()->id)
                    ->where('users.guard','!=','admin')
                    ->select('users.*','nationalies_data.county_name','nationalies_data.name')
                    ->orderBy('users.created_at','DESC')->paginate(24);
            }else{
                $search = User::
                leftJoin('nationalties','nationalties.id','users.nationalty_id')->
                leftJoin('nationalies_data','nationalies_data.nationalty_id','nationalties.id')->
                leftJoin('user_activity','user_activity.user_id','users.id')
                    ->where(function ($q) use($request) {
                        return $q->when($request->nationalty, function ($query) use ($request) {
                            return $query->where('users.nationalty_id', $request->nationalty);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->country, function ($query) use ($request) {
                            return $query->where('users.resident_country_id', $request->country);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->gendar, function ($query) use ($request) {
                            return $query->where('users.gender', $request->gendar);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->status, function ($query) use ($request) {
                            return $query->where('users.material_status_id', $request->status);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->from, function ($query) use ($request) {
                            return $query->whereBetween('users.age', [$request->from, $request->to]);
                        });
                    })

                    ->where('users.guard','!=','admin')
                    ->select('users.*','nationalies_data.county_name','nationalies_data.name')
                    ->orderBy('users.created_at','DESC')->paginate(24);
            }

//            =========================age desc========================

        }elseif ($request->order == 'age'){
            if (Auth::check()){
                $search = User::
                leftJoin('nationalties','nationalties.id','users.nationalty_id')->
                leftJoin('nationalies_data','nationalies_data.nationalty_id','nationalties.id')->
                leftJoin('user_activity','user_activity.user_id','users.id')

                    ->where(function ($q) use($request) {
                        return $q->when($request->nationalty, function ($query) use ($request) {
                            return $query->where('users.nationalty_id', $request->nationalty);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->country, function ($query) use ($request) {
                            return $query->where('users.resident_country_id', $request->country);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->gendar, function ($query) use ($request) {
                            return $query->where('users.gender', $request->gendar);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->status, function ($query) use ($request) {
                            return $query->where('users.material_status_id', $request->status);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->from, function ($query) use ($request) {
                            return $query->whereBetween('users.age', [$request->from, $request->to]);
                        });
                    })

                    ->where('users.id','!=',\auth()->user()->id)
                    ->where('users.guard','!=','admin')
                    ->select('users.*','nationalies_data.county_name','nationalies_data.name')
                    ->orderBy('users.age','ASC')->paginate(24);
            }else{
                $search = User::
                leftJoin('nationalties','nationalties.id','users.nationalty_id')->
                leftJoin('nationalies_data','nationalies_data.nationalty_id','nationalties.id')->
                leftJoin('user_activity','user_activity.user_id','users.id')

                    ->where(function ($q) use($request) {
                        return $q->when($request->nationalty, function ($query) use ($request) {
                            return $query->where('users.nationalty_id', $request->nationalty);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->country, function ($query) use ($request) {
                            return $query->where('users.resident_country_id', $request->country);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->gendar, function ($query) use ($request) {
                            return $query->where('users.gender', $request->gendar);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->status, function ($query) use ($request) {
                            return $query->where('users.material_status_id', $request->status);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->from, function ($query) use ($request) {
                            return $query->whereBetween('users.age', [$request->from, $request->to]);
                        });
                    })
                    ->where('users.guard','!=','admin')
                    ->select('users.*','nationalies_data.county_name','nationalies_data.name')
                    ->orderBy('users.age','ASC')->paginate(24);
            }

//            =========================country desc========================

        }elseif ($request->order == 'country'){
            if (Auth::check()){
                $search = User::
                leftJoin('nationalties','nationalties.id','users.nationalty_id')->
                leftJoin('nationalies_data','nationalies_data.nationalty_id','nationalties.id')->
                leftJoin('user_activity','user_activity.user_id','users.id')


                    ->where(function ($q) use($request) {
                        return $q->when($request->nationalty, function ($query) use ($request) {
                            return $query->where('users.nationalty_id', $request->nationalty);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->country, function ($query) use ($request) {
                            return $query->where('users.resident_country_id', $request->country);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->gendar, function ($query) use ($request) {
                            return $query->where('users.gender', $request->gendar);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->status, function ($query) use ($request) {
                            return $query->where('users.material_status_id', $request->status);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->from, function ($query) use ($request) {
                            return $query->whereBetween('users.age', [$request->from, $request->to]);
                        });
                    })
                    ->where('users.id','!=',\auth()->user()->id)
                    ->where('users.guard','!=','admin')
                    ->select('users.*','nationalies_data.county_name','nationalies_data.name')
                    ->orderBy('nationalies_data.id','ASC')->paginate(24);
            }else{
                $search = User::
                leftJoin('nationalties','nationalties.id','users.nationalty_id')->
                leftJoin('nationalies_data','nationalies_data.nationalty_id','nationalties.id')->
                leftJoin('user_activity','user_activity.user_id','users.id')


                    ->where(function ($q) use($request) {
                        return $q->when($request->nationalty, function ($query) use ($request) {
                            return $query->where('users.nationalty_id', $request->nationalty);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->country, function ($query) use ($request) {
                            return $query->where('users.resident_country_id', $request->country);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->gendar, function ($query) use ($request) {
                            return $query->where('users.gender', $request->gendar);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->status, function ($query) use ($request) {
                            return $query->where('users.material_status_id', $request->status);
                        });
                    })->where(function ($q) use($request) {
                        return $q->when($request->from, function ($query) use ($request) {
                            return $query->whereBetween('users.age', [$request->from, $request->to]);
                        });
                    })
                    ->where('users.guard','!=','admin')
                    ->select('users.*','nationalies_data.county_name','nationalies_data.name')
                    ->orderBy('nationalies_data.id','ASC')->paginate(24);
            }

        }
//        dd($search);
        return view('web.search.index',compact('search'));

    }


    public function getCountry(Request $request){

        $county = DB::table('nationalies_data')->where('nationalty_id',$request->id)->first();

        return response()->json(['data'=>$county]);
    }

    public function getstatueuser(Request $request){
        if ($request->val == 'female'){
            $statue = Material_status::whereIn('id',[1,3,4,9,10,11])->where('lang_id',session('language'))->get();
            return response()->json(['data'=>$statue]);
        }else{
            $statue = Material_status::whereIn('id',[5,6,7,8,12,13,14,15])->where('lang_id',session('language'))->get();
            return response()->json(['data'=>$statue]);
        }
    }

    public function advancedsearch(){
        return view('web.search.advanced.advanced');
    }

    public function advancedsearchpost(Request $request){
        if (Auth::check()){
            $search = User::
            join('user_options','users.id','=','user_options.user_id')

                ->where(function ($q) use($request) {
                    return $q->when($request->option_value, function ($query) use ($request) {
                        return $query->whereIn('option_value_id', $request->option_value);
                    });
                })

//                ->whereIn('option_value_id',$request->option_value)
                ->where('users.guard','!=','admin')
                ->where('users.id','!=',\auth()->user()->id)
                ->groupBy('users.id','users.age','user_options.user_id','users.username','users.gender','users.nationalty_id','users.resident_country_id')
                ->select(['users.id','users.age','user_options.user_id','users.username','users.gender','users.nationalty_id','users.resident_country_id'])->paginate(12);


        }else{
            $search = User::
            join('user_options','users.id','=','user_options.user_id')


                ->where(function ($q) use($request) {
                    return $q->when($request->option_value, function ($query) use ($request) {
                        return $query->whereIn('option_value_id', $request->option_value);
                    });
                })

                ->where('users.guard','!=','admin')
                ->groupBy('users.id','users.age','user_options.user_id','users.username','users.gender','users.nationalty_id','users.resident_country_id')
                ->select(['users.id','users.age','user_options.user_id','users.username','users.gender','users.nationalty_id','users.resident_country_id'])->paginate(12);
        }

        return view('web.search.advanced.index',compact('search'));

    }
}
