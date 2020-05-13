<?php

namespace App\Http\Controllers\web;

use App\Models\City;
use App\Models\Contact;
use App\Models\Membership;
use App\Models\Message;
use App\Models\User;
use App\Notifications\profilenotifcation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class profileController extends Controller
{
    public function index($id){
       $user = User::findOrFail($id);
       return view('web.user.userDetails',compact('user'));
    }
            /*like and blocked and send massege*/
    public function addheart(Request $request){

            if ($request->ajax()){

                    $active = \Illuminate\Support\Facades\DB::table('user_action')
//                    ->where('from_id',$request->f)
                        ->Where('to_id',$request->t)
                        ->Where('from_id',$request->f)
                        ->first();
        /* table histroy*/

                if (!$active){

                    $userhis =  DB::table('user_histories')->where('action','like')->where('user_id',\auth()->user()->id)->first();
                    if (!$userhis){
                        DB::table('user_histories')->insert([
                            'user_id' => \auth()->user()->id,
                            'action' => 'like',
                            'created' => Carbon::now(),
                        ]);
                    }else{
                        DB::table('user_histories')->where('action','like')->where('user_id',\auth()->user()->id)->update([
                            'created' =>  Carbon::now(),
                        ]);
                    }

                    DB::table('user_action')->insert([
                        'from_id' => $request->f,
                        'to_id' => $request->t,
                        'status' => 'pending',
                        'action' => 'like',
                        'created' => Carbon::now(),
                    ]);
                    return response()->json('true');

                }elseif($active && $active->action == 'dislike'){

                    $userhis =  DB::table('user_histories')->where('action','like')->where('user_id',\auth()->user()->id)->first();
                    if (!$userhis){
                        DB::table('user_histories')->insert([
                            'user_id' => \auth()->user()->id,
                            'action' => 'like',
                            'created' => Carbon::now(),
                        ]);
                    }else{
                        DB::table('user_histories')->where('action','like')->where('user_id',\auth()->user()->id)->update([
                            'created' =>  Carbon::now(),
                        ]);
                    }


                    DB::table('user_action')->where('id',$active->id)->update([
                        'from_id' => $request->f,
                        'to_id' => $request->t,
                        'status' => 'pending',
                        'action' => 'like',
                        'created' => Carbon::now(),
                    ]);
                    return response()->json('true');

                }else{
                    $userhis =  DB::table('user_histories')->where('action','dislike')->where('user_id',\auth()->user()->id)->first();
                    if (!$userhis){
                        DB::table('user_histories')->insert([
                            'user_id' => \auth()->user()->id,
                            'action' => 'dislike',
                            'created' => Carbon::now(),
                        ]);
                    }else{
                        DB::table('user_histories')->where('action','dislike')->where('user_id',\auth()->user()->id)->update([
                            'created' =>  Carbon::now(),
                        ]);
                    }

                    DB::table('user_action')->where('id',$active->id)->update([
                        'action' => 'dislike',
                    ]);
                    return response()->json('false');
                }


            }

    }
    public function addblock(Request $request){


        $userhis =  DB::table('user_histories')->where('action','block')->where('user_id',\auth()->user()->id)->first();
        if (!$userhis){
            DB::table('user_histories')->insert([
                'user_id' => \auth()->user()->id,
                'action' => 'block',
                'created' => Carbon::now(),
            ]);
        }else{
            DB::table('user_histories')->where('action','block')->where('user_id',\auth()->user()->id)->update([
                'created' =>  Carbon::now(),
            ]);
        }

        if ($request->ajax()){

                $active = \Illuminate\Support\Facades\DB::table('user_action')
//                    ->where('from_id',$request->f)
                    ->Where('to_id',$request->t)
                    ->Where('from_id',$request->f)
                    ->first();


            if (!$active){
                DB::table('user_action')->insert([
                    'from_id' => $request->f,
                    'to_id' => $request->t,
                    'status' => 'pending',
                    'action' => 'block',
                ]);
                return response()->json('true');
            }elseif($active){
                DB::table('user_action')->where('id',$active->id)->update([
                    'from_id' => $request->f,
                    'to_id' => $request->t,
                    'status' => 'pending',
                    'action' => 'block',
                ]);
                return response()->json('true');

            }else{
                DB::table('user_action')->where('action','=','block')->where('id',$active->id)->update([
                    'action' => 'dislike',
                ]);
                return response()->json('false');
            }


        }

    }
    public function sendmessage(Request $request){

            $request->validate([
               'messge' => 'required',
            ]);

            Message::create([
                'from_id' => $request->from,
                'to_id' => $request->to,
                'message' => $request->messge,
            ]);

        $userhis =  DB::table('user_histories')->where('action','send_message')->where('user_id',\auth()->user()->id)->first();
        if (!$userhis){
            DB::table('user_histories')->insert([
                'user_id' => \auth()->user()->id,
                'action' => 'send_message',
                'created' => Carbon::now(),
            ]);
        }else{
            DB::table('user_histories')->where('action','send_message')->where('user_id',\auth()->user()->id)->update([
                'created' =>  Carbon::now(),
            ]);
        }


            $userfrom = User::FindOrFail($request->from);
            $user = User::FindOrFail($request->to);
              $details = [
            'name' => _i($userfrom->username),
            'body' => _i('You have Massege from '),
            'id' => $request->from
                        ];
            $user->notify(new profilenotifcation($details));

        session()->flash('success',_i('Succesffly message sended'));
        return back();
    }
             /*end like and blocked and send massege*/



    public function get_Country(Request $request){

        $county = DB::table('nationalies_data')->where('nationalty_id',$request->id)->first();

        return response()->json(['data'=>$county]);
    }
    public function get_City(Request $request)
    {
        $city = DB::table('nationalies_data')
            ->where('id',$request->id)
            ->first();

        $cityId = City::where('nationalty_id','=',$city->nationalty_id)->first();
        if (empty($cityId)){
            return response()->json(['status'=>404]);
        }
        $cityname =  DB::table('cities_data')
            ->where('city_id','=',$cityId->id)->get();

        return response()->json(['data'=>$cityname,'city_id'=>$cityId->id]);


    }

        /*get acoount setting by load function*/
    public function newprofile(){
        $user = auth()->user();
        return view('web.user.accountsetting.editProfile',compact('user'));
    }
                /*end load*/
    public function profile(){
        $user = auth()->user();
        return view('web.user.profile',compact('user'));
    }

    /*update profile page*/
    public function updateuser(Request $request,$id){
        $request->validate([
            'memberShip' => 'required',
//            'category' => 'required',
//            'gendar' => 'required',
            'username' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($id),
            ],
            'password' => 'nullable|confirmed',
            'nationalty' => 'required',
            'country' => 'required',
//            'city' => 'required',
            'address' => 'required',
            'option_value' => 'required',
            'partener' => 'required',
            'about_me' => 'required',
        ]);

        $addUserTable = User::findOrFail($id);
        $addUserTable->username = $request->username;
        $addUserTable->email = $request->email;
        if ($request->password == null){
            $reqest_data = $request->except(['password', 'password_confirmation']);
        }else{
            $addUserTable->password = bcrypt($request->password);
        }
        if ($request->photo){

            if ($addUserTable->photo != 'default'){
                Storage::disk('public_uploads')->delete('/users/'.$addUserTable->photo);
            }
            Image::make($request->photo)->save(public_path('/uploads/users/'.$request->photo->hashName()));
            $addUserTable->photo = $request->photo->hashName();
        }

//        $addUserTable->password = bcrypt($request->password);
//        $addUserTable->gender = $request->gendar;
        $addUserTable->address = $request->address;
        $addUserTable->age = $request->age;
        $addUserTable->guard = 'web';
        $addUserTable->about_me = $request->about_me;
        $addUserTable->partener_info = $request->partener;
        $addUserTable->nationalty_id = $request->nationalty;
        $addUserTable->resident_country_id = $request->country;
        $addUserTable->material_status_id = $request->material_status_id;
        $addUserTable->city_id = $request->city;
        $addUserTable->save();

        if ($addUserTable->save()){
            $member = Membership::find($request->memberShip);
            $new_date = date('Y-m-d H:i:s', strtotime('+'.$member->years. 'years'));
            DB::table('user_membership')->where('user_id',$addUserTable->id)->update([
                'user_id' => $addUserTable->id,
                'membership_id' => $request->memberShip,
                'cost' => $member->cost,
                'expire' => $new_date,
            ]);
                if (isset($request->category)){
                    DB::table('user_category')->where('user_id',$addUserTable->id)->update([
                        'user_id' => $addUserTable->id,
                        'category_id' => $request->category,

                    ]);
                }

            DB::table('user_options')->where('user_id',$addUserTable->id)->delete();
            foreach ($request->option_value as $key=>$value){
                DB::table('user_options')->insert([
                    'user_id' => $addUserTable->id,
                    'option_value_id' =>$value,
                ]);
            }
        }

        session()->flash('success',_i('updated Succfully'));
        return redirect()->back();
    }
    public function updatePassword(Request $request){
            $request->validate([
               'password' => 'sometimes|nullable|confirmed',
            ]);
        $user = User::findOrFail($request->id);
               $user->password = bcrypt($request->pass);
               $user->save();
               return response()->json(['status'=>true]);
//             session()->flash('success',_i('password changed'));

    }
    public function updateEmail(Request $request){

        $user = User::findOrFail($request->id);
        $user->email = $request->email;
        $user->save();
        return response()->json(['status'=>true]);

    }
    public function deleteMember(Request $request){
        $user = User::findOrFail($request->id);
        $user->delete();
        session()->flash('success', 'member removed successfully');

    }


    public function wishlistandBlocked($value){

        $wishlistandBlocked = DB::table('user_action')->where('action','=',$value)->where('from_id',auth()->user()->id)
            ->get();

        return view('web.user.listed',compact('wishlistandBlocked'));

    }

    /*profilemassege*/


    // make datatable for notifaction
    public function  getDatatablenotifaction()
    {
        $user = User::findOrFail(auth()->user()->id);
        $not = DB::table('notifications')
            ->where('notifiable_id','=',$user->id)->get();

//        $data = User::where('id','=',$user->notifications)->get();


        return DataTables::of($not)
            ->addColumn('massege',function ($not){
                $newnot = json_decode($not->data,true);
                return $newnot['body'].'<a href="details/user/'.$newnot['id'].'">'.$newnot['name'].'</a>';
            })

            ->editColumn('created_at', function ($not) {
                return date( 'Y-m-d', strtotime( $not->created_at ));
            })
            ->addColumn('action', function ($not) {
                return '<a href="javascript:void(0)" class="btn-sm" data-id="'.$not->id.'" id="del""><i class="fa fa-times"></i></a>';
            })
            ->rawColumns([
                'massege',
                'action'
            ])
            ->make(true);
    }

    // make function remove notify

    public function deletenotify(Request $request){
        $not = DB::table('notifications')
            ->where('id','=',$request->id)->delete();

        session()->flash('success', 'removed successfully');
    }

    // make datatable for messages
    public function  getDatatablemessages()
    {
        $userId = auth()->user()->id;

        $messages = Message::all()->where('to_id',$userId);
        return DataTables::of($messages)
            ->addColumn('from_id', function (Message $message) {
                return '<a href="details/user/'.$message->user->id.'">'.$message->user->username.'</a>';
            })
            ->addColumn('message', function (Message $message) {
                return '<a href="replay/message/'.$message->id.'">'.$message->message.'</a>';
            })
            ->editColumn('created_at', function (Message $message) {
                return $message->created_at->diffForHumans();
            })
            ->addColumn('action', function ($message) {

                $fav = \Illuminate\Support\Facades\DB::table('user_action')
//                        ->where('from_id',\Illuminate\Support\Facades\Auth::id())
                    ->Where('to_id',$message->user->id)
//                    ->orWhere('status','pending')
                    ->first();
                 if (!$fav){
                        \Illuminate\Support\Facades\DB::table('user_action')->insert([
                           'status' => 'pending',
                           'from_id' => auth()->user()->id,
                         'to_id' => $message->user->id,
                     ]);
                }
                if(!empty($fav) && $fav->action == 'like'){
                    return '<a href="javascript:void(0)" class="add-to-fav add-'.$fav->id.'" data-id="'.$fav->id.'" data-to="'.$message->user->id.'" data-from="'.auth()->user()->id.'"><i class="fa fa-heart"></i></a>'."&nbsp;&nbsp;&nbsp;".
                       '<a href="javascript:void(0)" class="btn-sm block-'.$fav->id.'" id="block" data-id="'.$fav->id.'" data-to="'.$message->user->id.'" data-from="'.auth()->user()->id.'"><i class="fa fa-times"></i></a>'."&nbsp;&nbsp;&nbsp;".
                        '<a href="javascript:void(0)" class="btn-sm" id="delete" data-id="'.$message->id.'" data-favid="'.$fav->id.'"><i class="fa fa-ban"></i></a>';

                }else{
                    return '<a href="javascript:void(0)" class="add-to-fav add-'.$fav->id.'" data-id="'.$fav->id.'" data-to="'.$message->user->id.'" data-from="'.auth()->user()->id.'"><i class="fa fa-heart-o"></i></a>'."&nbsp;&nbsp;&nbsp;".
                    '<a href="javascript:void(0)" class="btn-sm block-'.$fav->id.'" id="block" data-id="'.$fav->id.'" data-to="'.$message->user->id.'" data-from="'.auth()->user()->id.'"><i class="fa fa-times"></i></a>'."&nbsp;&nbsp;&nbsp;".
                    '<a href="javascript:void(0)" class="btn-sm" id="delete" data-id="'.$message->id.'" data-favid="'.$fav->id.'"><i class="fa fa-ban"></i></a>';

                }

            })
            ->rawColumns([
                'from_id',
                'message',
                'action'
            ])
            ->make(true);
    }


    public function remove(Request $request)
    {

        if($request->id) {
            $massege = Message::findOrFail($request->id);
                $massege->delete();

            $delete =  DB::table('user_action')
                ->where('id',$request->fav)
                ->delete();

            session()->flash('success', 'removed successfully');
        }
    }
        // end make datatable for messages========================
//                ============//Replay massege============================
    public function replaypage($id){
        $massege = Message::findOrFail($id);

        return view('web.user.replayMass',compact('massege'));
    }

    public function replaymass(Request $request){

        $request->validate([
           'mass_id' => 'required',
           'replay' => 'required',
        ]);

        $addMass = new Message();
        $addMass->from_id = \auth()->user()->id;
        $addMass->to_id = $request->to;
        $addMass->message = $request->replay;
        $addMass->massege_id = $request->mass_id;
        $addMass->save();

        session()->flash('success',_i('Massege is sended succssfly'));
        return back();



    }

    /*My massege*/

    public function mymassege(){

        $messages = Message::where('from_id',\auth()->user()->id)->get();
        return view('web.user.accountsetting.mymassege',compact('messages'));
    }
    // make datatable for messages
    public function  getDatatablemymessages()
    {

        $userId = auth()->user()->id;

        $messages = Message::where('from_id',\auth()->user()->id)->get();
        return DataTables::of($messages)
            ->addColumn('to_id', function ($messages) {
                $user = User::findOrfail($messages->to_id);
                return $user->username;
            })
            ->addColumn('message', function ($messages) {
                return $messages->message;
            })
            ->editColumn('created_at', function ($messages) {
                return $messages->created_at->diffForHumans();
            })
            ->addColumn('action', function ($messages) {
                    return '<a href="javascript:void(0)" class="btn-sm" id="deletemass" data-id="'.$messages->id.'"><i class="fa fa-ban"></i></a>';

            })
            ->rawColumns([
                'to_id',
                'message',
                'action'
            ])
            ->make(true);
    }


    // make datatble for like
    public function getDatatablelike(){
        $like = DB::table('user_action')
            ->Where('action','like')
            ->where('from_id',auth()->user()->id)
            ->get();

        return DataTables::of($like)
            ->editColumn('to_id', function ($like) {
                    return $like->to_id;
            })
            ->addColumn('username', function ($like) {
                $user = User::where('id',$like->to_id)->first();
                return '<a href="details/user/'.$user->id.'">'.$user->username.'</a>';
            })
            ->editColumn('age', function ($like) {
                $user = User::where('id',$like->to_id)->first();
                return $user->age;
            })

            ->editColumn('nationalty_id', function ($like) {
                $user = User::where('id',$like->to_id)->first();
                $nationalty = DB::table('nationalies_data')
                    ->where('nationalty_id',$user->nationalty_id)->first();

                return $nationalty->name;
            })
            ->editColumn('resident_country_id', function ($like) {
                $user = User::where('id',$like->to_id)->first();
                $country = DB::table('nationalies_data')
                    ->where('id',$user->resident_country_id)->first();
                return $country->county_name;
            })
            ->addColumn('action', function ($like) {
            return '<a href="javascript:void(0)" class="btn-sm" id="deleteLike" data-id="'.$like->id.'"><i class="fa fa-times"></i></a>';
            })->rawColumns([
                'username',
                'action'
            ])

            ->make(true);

      }
      public function removelike(Request $request){
          if($request->id) {


              $delete =  DB::table('user_action')
                  ->where('id',$request->id)
                  ->delete();

              session()->flash('success', 'removed successfully');
          }
      }

    // make datatble for block
    public function getDatatableblock(){
        $like = DB::table('user_action')
            ->Where('action','block')
            ->orWhere('action','dislike')
            ->where('from_id',auth()->user()->id)
            ->get();

        return DataTables::of($like)
            ->editColumn('to_id', function ($like) {
                return $like->to_id;
            })
            ->addColumn('username', function ($like) {
                $user = User::where('id',$like->to_id)->first();
                return '<a href="details/user/'.$user->id.'">'.$user->username.'</a>';
            })
            ->editColumn('age', function ($like) {
                $user = User::where('id',$like->to_id)->first();
                return $user->age;
            })

            ->editColumn('nationalty_id', function ($like) {
                $user = User::where('id',$like->to_id)->first();
                $nationalty = DB::table('nationalies_data')
                    ->where('nationalty_id',$user->nationalty_id)->first();

                return $nationalty->name;
            })
            ->editColumn('resident_country_id', function ($like) {
                $user = User::where('id',$like->to_id)->first();
                $country = DB::table('nationalies_data')
                    ->where('id',$user->resident_country_id)->first();
                return $country->county_name;
            })
            ->addColumn('action', function ($like) {
                return '<a href="javascript:void(0)" class="btn-sm" id="deleteLike" data-id="'.$like->id.'"><i class="fa fa-times"></i></a>';
            })
            ->rawColumns([
                    'username',
                    'action'
                   ])
            ->make(true);

    }
    // make datatble for likeMe
    public function getDatatablelikeMe(){
        $like = DB::table('user_action')
            ->Where('action','like')
            ->where('to_id',auth()->user()->id)
            ->get();

        return DataTables::of($like)
            ->editColumn('from_id', function ($like) {
                return $like->from_id;
            })
            ->addColumn('username', function ($like) {
                $user = User::where('id',$like->from_id)->first();
                return '<a href="details/user/'.$user->id.'">'.$user->username.'</a>';
            })
            ->editColumn('age', function ($like) {
                $user = User::where('id',$like->from_id)->first();
                return $user->age;
            })
            ->editColumn('nationalty_id', function ($like) {
                $user = User::where('id',$like->from_id)->first();
                $nationalty = DB::table('nationalies_data')
                    ->where('nationalty_id',$user->nationalty_id)->first();
                return $nationalty->name;
            })
            ->editColumn('resident_country_id', function ($like) {
                $user = User::where('id',$like->from_id)->first();
                $country = DB::table('nationalies_data')
                    ->where('id',$user->resident_country_id)->first();
                return $country->county_name;
            })
            ->editColumn('created', function ($like) {

                return date( 'Y-m-d', strtotime( $like->created ));
            })
//            ->addColumn('action', function ($like) {
//                return '<a href="javascript:void(0)" class="btn-sm" id="deleteLike" data-id="'.$like->id.'"><i class="fa fa-times"></i></a>';
//            })
                ->rawColumns([
                'username',
//                'action'
            ])
            ->make(true);

    }

        // contact admin
    public function conatctAdmin(){
        $user = Auth::user();
        return view('web.user.accountsetting.contactAdmin',compact('user'));
    }
    public function conatctAdminpost(Request $request)
    {
           $data= $request->validate([
                'email' => 'required|email',
                'title' => 'required|string',
                'content' => 'required',
            ]);

           Contact::create($data);

           session()->flash('success',_i('message is send successflly'));
           return back();
    }

    // my favroute partiner

    public function favrouitpartener(){
        return view('web.user.accountsetting.myfavPartener');
    }

    public function favrouitpartenerpost(Request $request){
        $userId =\auth()->user()->id;
            $request->validate([
                'option_value' => 'required',
            ]);

            foreach ($request->option_value as $value){
                DB::table('user_favourite_options')->insert([
                   'user_id' => $userId,
                   'option_value_id' => $value,
                ]);
            }

//        session()->flash('success',_i('Succesffly message sended'));
            return response()->json('true');
    }
}


