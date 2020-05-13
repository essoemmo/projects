<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Bll;

/**
 * Description of Domain
 *
 * @author fz
 */
class Domain {

    public static function isSubDomain() {
        $arr = explode(".", request()->getHttpHost());
        $len = 1;
        //echo \Config::get('app.env');
        if (\Config::get('app.env') !== "local") {
            $len = 2;
        }
        if (count($arr) > $len) {
            $sub = $arr[0];

            $store = \App\StoreData::where("domain", $sub)->first();
            if ($store != null) {
                session()->put(\App\Bll\Constants::StoreId, $store->id);
                //return redirect("/home");
                return true ;
            } 
        }
        return false ;
    }

    //put your code here
    public static function CreateSubDomain($subdomain) {
        $cpanelsername = "sallatk";
        $cpanelpassword = "RTFYJkhlikmda^&";
        // $subdomain = 'fz';
        $domain = "sallatk.com"; //'164.132.156.226';
        $directory = "/public_html";  // A valid directory path, relative to the user's home directory. Or you can use "/$subdomain" depending on how you want to structure your directory tree for all the subdomains.

        $query = "https://{$domain}:2083/json-api/cpanel?cpanel_jsonapi_func=addsubdomain&cpanel_jsonapi_module=SubDomain&cpanel_jsonapi_version=2&domain=$subdomain&rootdomain=$domain&dir=$directory";

        $curl = curl_init();                                // Create Curl Object
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);       // Allow self-signed certs
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);       // Allow certs that do not match the hostname
        curl_setopt($curl, CURLOPT_HEADER, 0);               // Do not include header in output
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);       // Return contents of transfer on curl_exec
        $header[0] = "Authorization: Basic " . base64_encode($cpanelsername . ":" . $cpanelpassword) . "\n\r";
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);    // set the username and password
        curl_setopt($curl, CURLOPT_URL, $query);            // execute the query
        $result = curl_exec($curl);

        if ($result == false) {
            error_log("Domain::CreateSubSomain Exception curl_exec threw error \"" . curl_error($curl) . "\" for $query");
            //   var_dump(curl_error($curl));
            // log error if curl exec fails
        }
        curl_close($curl);
        error_log($result);

        //dd( $result);
    }

}
