<?php

namespace App\Bll;

class MyFatoorah
{

    protected static $domain = "apitest.myfatoorah.com";//"https://api.myfatoorah.com";
    protected static $token = "7Fs7eBv21F5xAocdPvvJ-sCqEyNHq4cygJrQUFvFiWEexBUPs4AkeLQxH4pzsUrY3Rays7GVA6SojFCz2DMLXSJVqk8NG-plK-cZJetwWjgwLPub_9tQQohWLgJ0q2invJ5C5Imt2ket_-JAlBYLLcnqp_WmOfZkBEWuURsBVirpNQecvpedgeCx4VaFae4qWDI_uKRV1829KCBEH84u6LYUxh8W_BYqkzXJYt99OlHTXHegd91PLT-tawBwuIly46nwbAs5Nt7HFOozxkyPp8BW9URlQW1fE4R_40BXzEuVkzK3WAOdpR92IkV94K_rDZCPltGSvWXtqJbnCpUB6iUIn1V-Ki15FAwh_nsfSmt_NQZ3rQuvyQ9B3yLCQ1ZO_MGSYDYVO26dyXbElspKxQwuNRot9hi3FIbXylV3iN40-nCPH4YQzKjo5p_fuaKhvRh7H8oFjRXtPtLQQUIDxk-jMbOp7gXIsdz02DrCfQIihT4evZuWA6YShl6g8fnAqCy8qRBf_eLDnA9w-nBh4Bq53b1kdhnExz0CMyUjQ43UO3uhMkBomJTXbmfAAHP8dZZao6W8a34OktNQmPTbOHXrtxf6DS-oKOu3l79uX_ihbL8ELT40VjIW3MJeZ_-auCPOjpE3Ax4dzUkSDLCljitmzMagH2X8jN8-AYLl46KcfkBV";
    public static $callBackUrl = 'http://sallatk.com/ar/success/';
    public static $errorUrl = 'http://sallatk.com/ar/fail/';

    protected static function doRequest($params, $query)
    {
        $curl = curl_init();                                // Create Curl Object
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);       // Allow self-signed certs
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);       // Allow certs that do not match the hostname
        curl_setopt($curl, CURLOPT_HEADER, 0);               // Do not include header in output
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);       // Return contents of transfer on curl_exec
        $header[0] = "Authorization: bearer " . self::$token;
        $header[1] = 'Content-Type:application/json';
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);    // set the username and password
        curl_setopt($curl, CURLOPT_URL, $query);            // execute the query
        $result = curl_exec($curl);
        if ($result == false) {
            error_log("Domain::CreateSubSomain Exception curl_exec threw error \"" . curl_error($curl) . "\" for $query");
            //   var_dump(curl_error($curl));
            // log error if curl exec fails
        }
        curl_close($curl);
        return $result;
    }

    public static function initializePayment($price, $currency)
    {
        $directory = "/v2/InitiatePayment";
        $query = "https://" . self::$domain . "/{$directory}";
        $params = json_encode(["InvoiceAmount" => $price, "CurrencyIso" => $currency]);
        $result = self::doRequest($params, $query);
        return $result;
    }

    public static function executePayment($params)
    {

        $directory = "/v2/ExecutePayment";
        $query = "https://" . self::$domain . "/{$directory}";
        $params = json_encode($params);

        $result = self::doRequest($params, $query);

        return $result;
    }

    public static function directPayment($params, $url)
    {

        $params = json_encode($params);

        $result = self::doRequest($params, $url);

        return $result;
    }


}
