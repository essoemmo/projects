<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Bll;

/**
 * Description of Products
 *
 * @author fz
 */
class Products {
    //put your code here
    public static function My()
    {
      return  \App\Models\product\products::where("store_id", Utility::getStoreId())->where("hidden",0)->get();
    }
}
