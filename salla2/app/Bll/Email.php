<?php


namespace App\Bll;


class Email
{

    public function emailSave($message, $store_id, $email, $user_id, $model_type)
    {
        $data = [
            'to' => $email,
            'message' => $message,
            'store_id' => $store_id,
            'model_type' => $model_type,
            'user_id' => $user_id,
        ];
        \App\Models\Email::create($data);
        return $data;
    }
}
