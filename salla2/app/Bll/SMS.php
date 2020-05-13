<?php


namespace App\Bll;


class SMS
{

    private static $url = 'http://api-server3.com/api/send.aspx';
    private static $user = 'trlyoon';
    private static $password = 'trlyoon3422';

    public static function SmsSender($phone = null, $message = null)
    {
        if ($phone != null && $message != null) {
            $user = self::$user;
            $password = self::$password;
            $urlserver = self::$url;
//            dd(\auth()->user());
//            $sender = auth()->user()->name;
            $postData = [
                'username' => $user,
                'password' => $password,
                'language' => 1,
                'sender' => 'AL-HWAT',
                'mobile' => $phone,
                'message' => $message,
            ];
            $ch = curl_init();
            curl_setopt_array($ch, array(
                CURLOPT_URL => $urlserver,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $postData,
            ));
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);
        } else {
            return;
        }

    }

    public function smsSave($message, $store_id, $phone, $user_id, $model_type)
    {

        $data = [
            'to' => $phone,
            'message' => $message,
            'store_id' => $store_id,
            'model_type' => $model_type,
            'user_id' => $user_id,
        ];
        \App\Models\SMS::create($data);
        return $data;
    }
}
