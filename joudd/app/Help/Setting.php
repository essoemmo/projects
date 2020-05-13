<?php
namespace App\Help;

use Illuminate\Support\Facades\Storage;

class Setting
{
    //TODO:: create folder with model name
    //create folder with model id.
    //set files inside.
    public static function storeModelAttachments($files, $model, $path)
    {
        if (empty($files) || !isset($files) || !isset($model)) return false;
        if (is_array($files)) {
            foreach ($files as $file) {
                $file->storeAs($path . '/' . $model->id, $file->getClientOriginalName());
            }
        } else {
            $files->storeAs($path . '/' . $model->id, $files->getClientOriginalName());
        }
        return true;
    }
    public static function getmodelAttachments($model, $path)
    {
       // dd($path);
        if (!isset($model)) return false;
        $allfiles = Storage::files($path . '/' . $model->id);
        $urls = array_map(function ($fileName) {
            return Storage::url($fileName);
        }, $allfiles);
        return $urls;
    }
    //Delete Attachments By Id
    public static function destroyAttachments($model, $path)
    {
        if (!isset($model)) return false;
        Storage::deleteDirectory($path . '/' . $model->id);
    }

    public static function deleteAttachmentByUrl($url, $model, $path)
    {
        $a = explode('/', $url);
        $filename = end($a);
        Storage::delete([$path . '/' . $model->id . '/' . $filename]);
        return true;
    }
}
