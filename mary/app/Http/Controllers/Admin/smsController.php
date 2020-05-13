<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use App\Models\Banner_data;
use App\Models\Language;
use App\Models\Sms;
use App\Models\Sms_data;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class smsController extends Controller
{
    public function index(Request $request){
        $title = _i('sms management');
        if ($request->ajax()) {
            $data = Sms::
                leftJoin('sms_datas','sms.id','=','sms_datas.sms_id')
                ->select('sms.*','sms_datas.message')
                ->where('lang_id',getLang())
                ->get();
            return \Yajra\DataTables\Facades\DataTables::of($data)
                ->addIndexColumn()
                 ->editColumn('message',function ($row){
                     return $row->message;
                 })
                ->editColumn('status',function ($row){
                    return $row->status;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('sms.edit',$row->id).'" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-data" ><i class="fa fa-edit"></i></a>';
                    $btn = $btn.'
                        <form action="'.route('sms.destroy',$row->id).'" method="post" style="display:inline-block;" class="delform">
                            <input name="_method" type="hidden" value="delete">
                             <input type="hidden" name="_token" value="'.csrf_token().'">
                        <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></button>
                        </form>';

                    if ($row->status == 'pending'){
                        $btn = $btn.' <button  data-id="'.$row->id.'" data-original-title="change" class="btn btn-warning btn-sm change" data-toggle="modal" data-target="#exampleModal1"><i class="far fa-thumbs-up"></i></a>';
                    }elseif($row->status == 'ok'){
                        $btn = $btn.' <button  data-id="'.$row->id.'" data-original-title="change" class="btn btn-warning btn-sm change"><i class="fas fa-thumbs-down"></i></a>';

                    }
                    return $btn;
                })
                ->rawColumns(['message','status','action'])
                ->make(true);

        }

    return view('admin.setting.sms.index',compact('title'));
    }


    public function create(){
        $title = _i('sms create');
        $users = User::where('guard','!=','admin')->where('userlog',1)->get();
        $langs = Language::get();
        return view('admin.setting.sms.create',compact('title','users','langs'));
    }

    public function store(Request $request){
        $v = Validator::make($request->all(), [
            '*__message' => 'required',
        ]);

        if ($v->fails()) {
            return Response::json(['errors' => $v->errors()]);
        }

        $add= Sms::create([
           'user_id' => $request->user,
           'from_id' => \auth()->user()->id,
           'created' => $request->created,
           'status' => $request->status,
        ]);

        foreach ($request->lang_id as $lang){
            $langg = Language::findOrFail($lang);
            Sms_data::create([
                'sms_id' => $add->id,
                'message' => $request->get($langg->code.'_message'),
                'lang_id' => $lang,
            ]);
        }


        return Response::json(['SUCCESS']);
    }

    public function edit(Request $request,$id){
        $title = _i('sms edit');
        $users = User::where('guard','!=','admin')->where('userlog',1)->get();
        $langs = Language::get();

        $langs_id =Sms::
        leftJoin('sms_datas','sms.id','=','sms_datas.sms_id')
            ->select('sms.*','sms_datas.message','sms_datas.lang_id')
            ->where('sms.id',$id)
            ->pluck('lang_id')->toArray();

        $data =Sms::
        leftJoin('sms_datas','sms.id','=','sms_datas.sms_id')
            ->select('sms.*','sms_datas.message','sms_datas.lang_id')
            ->where('sms.id',$id)
            ->get();

        $datasms =Sms::
        leftJoin('sms_datas','sms.id','=','sms_datas.sms_id')
            ->select('sms.*','sms_datas.message','sms_datas.lang_id')
            ->where('sms.id',$id)
            ->first();

        return view('admin.setting.sms.edit',compact('title','users','langs','langs_id','data','datasms'));
    }

    public function update(Request $request,$id){
        $v = Validator::make($request->all(), [
            '*__message' => 'required',
        ]);

        if ($v->fails()) {
            return Response::json(['errors' => $v->errors()]);
        }

        $add= Sms::where('id',$id)->update([
            'user_id' => $request->user,
            'from_id' => \auth()->user()->id,
            'created' => $request->created,
            'status' => $request->status,
        ]);

        foreach ($request->lang_id as $lang){
            $langg = Language::findOrFail($lang);
            Sms_data::where('sms_id',$id)->where('lang_id',$langg->id)->update([
                'sms_id' => $id,
                'message' => $request->get($langg->code.'_message'),
                'lang_id' => $langg->id,
            ]);
        }
        return Response::json(['SUCCESS']);
    }

    public function destroy ($id){
        Sms::where('id',$id)->delete();
        return Response::json(['SUCCESS']);
    }

    public function change(Request $request){
        $add= Sms::where('id',$request->id)->first();

        if ($add->status == 'pending'){
            Sms::where('id',$request->id)->update([
                'status' => 'ok',
            ]);
        }else{
            Sms::where('id',$request->id)->update([
                'status' => 'pending',
            ]);
        }


        return Response::json(['SUCCESS']);
    }

}
