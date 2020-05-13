<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model;

/**
 * Description of Api
 *
 * @author fz
 */
class Api {
    
     public function callApiPost($func, $params) {

        $client = new \GuzzleHttp\Client();
//         if (request()->session()->get("access_token") !== null) {
//            //   echo "kkkkkkk";
//            $header[] = 'Authorization:' . request()->session()->get("access_token");
//            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
//        }
        $res = $client->request('POST', Config('app.api_url') ."/api/". $func, [
            "headers" => ["Authorization" =>  request()->session()->get("access_token")],
            'form_params' => [
                $params
            ]
        ]);
        return $res ;
    }
}
