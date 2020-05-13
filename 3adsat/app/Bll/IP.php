<?php
namespace App\Bll;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utility
 *
 * @author fz
 */
class IP {

    //put your code here

    public $country_code;
    public $country_name;
    public $latitude;
    public $longitude;

    public static function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return  $ipaddress;
    }

    public  function getInfo() {
        $ip = self::get_client_ip();

        $findItem = \App\Models\IPAddress::where('Ip', '=', $ip)->first();

        // added data come from api to ip_adress table
        // if is not here
        if (!$findItem) {
            // get the Ip address
            $ip = self::get_client_ip();
            // pass ip to api to get the data
            $obj = file_get_contents("http://api.ipstack.com/" . $ip . "?access_key=2b88c49d40c2b16e6a1d6341ecd9e082&format=1");
            // convert json data
            $data = json_decode($obj);
            if ($data->latitude !== null) {
                $new = new \App\Models\IPAddress();
                $new->ip = $data->ip;
                $new->country_code = $data->country_code;
                $new->country_name = $data->country_name;
                $new->latitude = $data->latitude;
                $new->longitude = $data->longitude;
                $new->location = serialize($data->location);
                $new->save();

                $this->country_code = $new->country_code;
                $this->country_name = $new->country_name;
                $this->latitude = $new->latitude;
                $this->longitude = $new->longitude;
            }
        } else {

            $this->country_code = $findItem->country_code;
            $this->country_name = $findItem->country_name;
            $this->latitude = $findItem->latitude;
            $this->longitude = $findItem->longitude;
        }
    }

}
