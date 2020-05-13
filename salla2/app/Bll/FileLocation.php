<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Bll;

/**
 * Description of FileLocation
 *
 * @author fz
 */
class FileLocation {
    //put your code here
    public static function Digital($product_id)
    {
        return public_path()."/uploads/store/".\App\Bll\Utility::getStoreId()."/digital/".$product_id."/";
    }
    public static function CSS()
    {
        return public_path('uploads') . '/store/' . \App\Bll\Utility::getStoreId() ."/css";
    }
    public static function CSSLink()
    {
        return asset('uploads') . '/store/' . \App\Bll\Utility::getStoreId() ."/css";
    }
}
