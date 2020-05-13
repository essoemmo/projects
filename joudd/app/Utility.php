<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of Utility
 *
 * @author fz
 */
class Utility {
    //put your code here
    public static function serialNumber() {
        return strtoupper(substr(md5(rand(0, 100000)), 0, 12));
    }
}
