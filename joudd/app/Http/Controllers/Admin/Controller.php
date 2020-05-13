<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Xinax\LaravelGettext\Facades\LaravelGettext;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    //extra functions
    private function editFuncMaker(array $items, $func_name = "edit") {
        $s = $func_name . '(';
        foreach ($items as $item) {
            $s .= '\'';
            $s .= $item;
            $s .= '\',';
        }
        $s = rtrim($s, ',');
        $s .= ')';
        return $s;
    }

    protected function generateHtmlEdit_Delete(array $items, $itemId, $deleteOnly = false, $func_name = "edit") {
        if ($deleteOnly) {
            $html = '<a href="delete?id=' . $itemId . '"  class="btn btn-icon waves-effect waves-light btn btn-danger" title="' . _i("Delete") . '">
                   <i class="fa fa-remove"></i></a></div>';
            return $html;
        }
        $html = '<div class="text-center"><a onclick="' . $this->editFuncMaker($items, $func_name) . '" id="item_id_' . $itemId . '" class="btn btn-icon waves-effect waves-light btn-primary" data-toggle="modal" data-target="#modal-edit" title="' . _i("Edit") . '">
                   <i class="fa fa-edit"></i></a>
                   <a href="delete?id=' . $itemId . '"  class="btn btn-icon waves-effect waves-light btn btn-danger" title="' . _i("Delete") . '">
                   <i class="fa fa-remove"></i></a></div>';
        return $html;
    }

  protected function generateHtmlEdit_Del(array $items, $itemId, $deleteOnly = false, $func_name = "edit") {
        if ($deleteOnly) {
            $html = '<a href="delete?id=' . $itemId . '"  class="btn btn-icon waves-effect waves-light btn btn-danger" title="' . _i("Delete") . '">
                   <i class="fa fa-remove"></i></a></div>';
            return $html;
        }
        $html = '<div class="text-center"><a onclick="' . $this->editFuncMaker($items, $func_name) . '" id="item_id_' . $itemId . '" class="btn btn-icon waves-effect waves-light btn-primary" data-toggle="modal" data-target="#modal-edit" title="' . _i("Edit") . '">
                   <i class="fa fa-edit"></i></a>
                   <a href="del?id=' . $itemId . '"  class="btn btn-icon waves-effect waves-light btn btn-danger" title="' . _i("Delete") . '">
                   <i class="fa fa-remove"></i></a></div>';
        return $html;
    }


}//class="btn btn-danger waves-effect waves-light remove-record"   <i class="fa fa-remove"></i>
//<button type="button" class="btn btn-danger "> <i class="fa fa-trash"></i> {{_i('Delete')}}</button>
