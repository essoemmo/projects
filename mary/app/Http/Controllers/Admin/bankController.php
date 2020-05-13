<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\bankDataTable;
use App\Models\Bank;
use App\Models\Bank_data;
use App\Models\Banner_data;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class bankController extends Controller
{
        public function index(bankDataTable $bankDataTable){
            $title = _i('banks');
            return $bankDataTable->render('admin.banks.index',compact('title'));
        }

        public function store(Request $request)
        {
            $v = Validator::make($request->all(), [
                'name' => 'required',
            ]);
            $acc = $request->all();
            $lang = Language::where('code', 'ar')->first();
            if ($v->fails()) {
                return Response::json(['errors' => $v->errors()]);
            }
            if ($request->hasFile('image')){
                if (!is_dir(public_path('uploads/banks'))){
                    mkdir(public_path('uploads/banks'));
                }
//                Storage::disk('public_uploads')->delete('/membership/'.$add->image);
                Image::make($request->image)->save(public_path('/uploads/banks/' . $request->image->hashName()));
            }

            $bank  = Bank::create([
            'code' => $request->code,
             'image' => $request->image ?  $request->image->hashName() :  '',
            ]);

            Bank_data::create([
               'name' =>$request->name,
               'bank_id' =>$bank->id,
               'lang_id' =>$request->language,
               'source_id' =>null,
            ]);


            return Response::json(['SUCCESS']);
        }
        public function update(Request $request){
            $v = Validator::make($request->all(), [
                'name' => 'required',
            ]);
            $acc = $request->all();
            $lang = Language::where('code', 'ar')->first();
            if ($v->fails()) {
                return Response::json(['errors' => $v->errors()]);
            }

            $add = Bank::findOrFail($request->id);
            if ($request->hasFile('image')){
                if (!is_dir(public_path('uploads/banks'))){
                    mkdir(public_path('uploads/banks'));
                }
                Storage::disk('public_uploads')->delete('/banks/'.$add->image);
                Image::make($request->image)->save(public_path('/uploads/banks/' . $request->image->hashName()));
            }

            Bank::where('id',$request->id)->update([
                'code' => $request->code,
                'image' => $request->image ?  $request->image->hashName() :  $add->image,
            ]);

            Bank_data::where('bank_id',$request->id)->update([
                'name' =>$request->name,
                'bank_id' =>$request->id,
                'lang_id' =>$request->language,
                'source_id' =>null,
            ]);


            return Response::json(['SUCCESS']);
        }

        public function destroy($id){
            $bank = Bank::findOrFail($id);
            $bank->delete();
            return Response::json(['SUCCESS']);

        }


}
