<?php

namespace App\Http\Controllers;

use App\Models\product\product_photos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\files;
class uploads extends Controller
{

    public static function delete($id){
        $file = product_photos::findOrFail($id);
        if(!empty($file)){
            Storage::delete($file->full_file);
            $file->delete();
        }
    }
//$request,$upload_type = 'single',$delete_file = null ,$path,$new_name=null,$crud_type=[]
    public static function upload($data = []){
        if(!empty($data['new_name'])){
            $new_name = $data['new_name'] === null ?time():$data['new_name'];
        }
        if (request()->hasFile($data['request']) && $data['upload_type'] == 'single'){
//            !empty($data['delete_file'])?Storage::delete($data['delete_file']):'';
            return request()->file($data['request'])->store($data['path']);
        }elseif (request()->hasFile($data['request']) && $data['upload_type'] == 'files'){
            $file =  request()->file($data['request']);

            $size = $file->getSize();
            $mime_type = $file->getMimeType();
            $name = $file->getClientOriginalName();
            $hashname = $file->hashName();

            $file->store($data['path']);

            $add = product_photos::create([
                'product_id' => $data['product_id'],
                'photo' => $data['path'].'/' . $hashname,
                'description' => $name,
                'tag' => $name,
                'main' => 0,
            ]);
            return $data['path'].'/' . $hashname;
        }
    }

}

//Up::upload([
//    'request' => 'file',
//    'path'=>'products/'.$id,
//    'upload_type' => 'files',
//    'file_type' => 'products',
//    'product_id' => $id
//]);