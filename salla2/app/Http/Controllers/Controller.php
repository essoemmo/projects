<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Xinax\LaravelGettext\Facades\LaravelGettext;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    //extra functions
    private function editFuncMaker(array $items){
        $s = 'edit(';
        foreach($items as $item){
            $s.='\'';
            $s.=$item;
            $s.='\',';
        }
        $s =rtrim($s,',');
        $s.=')';
        return $s;
    }
    protected function generateHtmlEdit_Delete(array $items,$itemId,$deleteOnly=false){
        if($deleteOnly){
            $html = '<a href="delete?id='.$itemId.'"  class="btn btn-icon waves-effect waves-light btn btn-danger">
                   <i class="ti-trash"></i></a></div>';
            return $html;
        }
        $html = '<div class="text-center"><a onclick="'.$this->editFuncMaker($items).'" id="item_id_'.$itemId.'" class="btn btn-icon waves-effect waves-light btn-primary" data-toggle="modal" data-target="#modal-edit" title="'._i('Edit').'">
                   <i class="ti-pencil-alt"></i></a>&nbsp;
                   <a href="'.route('city-delete',$itemId).'"  class="btn btn-icon waves-effect waves-light btn btn-danger" title="'._i('Delete').'">
                   <i class="ti-trash"></i></a></div>';
        return $html;
    }

    protected function generateHtmlEdit_Delete_btnIncreased(array $items, $itemId,$route_name,$getTrans=false,$langId=false, $deleteOnly = false, $func_name = "edit") {
        if ($deleteOnly) {
            $html = '<a href="delete?id=' . $itemId . '"  class="btn btn-icon waves-effect waves-light btn btn-danger btn-sm " title="' . _i("Delete") . '">
                   <i class="fa fa-trash"></i></a></div>';
            return $html;
        }
        $html = '<a href="'.url("master/"."$route_name".'/'.$itemId."/edit") .'" id="item_id_' . $itemId . '" class="btn btn-primary"  title="' . _i("Edit") . '">
                   <i class="ti-pencil-alt"></i></a>  &nbsp;'.'
                   <form class=" delete"  action="'.url("master/"."$route_name".'/'.$itemId) .'"  method="POST" id="deleteRow"  
                   style="display: inline-block; right: 50px;" > 
                   <input name="_method" type="hidden" value="DELETE">
                   <input type="hidden" name="_token" value="' . csrf_token() . '">
                   <button type="submit" class="btn btn-danger" title=" '._i('Delete').' "> <span> <i class="ti-trash"></i></span></button>
                    </form>
                   </div>';

        if($getTrans == "true"){
            $langs = Language::get();
            $options = '';
            foreach ($langs as $lang) {
                if ($lang->id != $langId){
                    $options .= '<li ><a href="#" data-toggle="modal" data-target="#langedit" class="lang_ex" data-id="'.$itemId.'" data-lang="'.$lang->id.'"
                    style="display: block; padding: 5px 10px 10px;">'.$lang->title.'</a></li>';
                }
            }
            $html = $html.'
                <div class="btn-group">
                  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"  title=" '._i('Translation').' ">
                    <span class="ti ti-settings"></span>
                  </button>
                  <ul class="dropdown-menu" style="right: auto; left: 0; width: 5em; " >
                    '.$options.'
                  </ul>
                </div> ';
        }

        return $html;
    }



    protected function generateHtmlEdit_Delete_About(array $items,$itemId,$deleteOnly=false){
        if($deleteOnly){
            $html = '<a href="delete?id='.$itemId.'"  class="btn btn-icon waves-effect waves-light btn btn-danger">
                   <i class="ti-trash"></i></a></div>';
            return $html;
        }
        $html = '<div class="text-center"><a onclick="'.$this->editFuncMaker($items).'" id="item_id_'.$itemId.'" class="btn btn-icon waves-effect waves-light btn-primary" data-toggle="modal" data-target="#modal-edit" title="'._i('Edit').'">
                   <i class="ti-pencil-alt"></i></a>&nbsp;
                   <a href="/adminpanel/about/delete?id='.$itemId.'"  class="btn btn-icon waves-effect waves-light btn btn-danger" title="'._i('Delete').'">
                   <i class="ti-trash"></i></a></div>';
        return $html;


    }
}//class="btn btn-danger waves-effect waves-light remove-record"   <i class="fa fa-remove"></i>
//<button type="button" class="btn btn-danger "> <i class="fa fa-trash"></i> {{_i('Delete')}}</button>
