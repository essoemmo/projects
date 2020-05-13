<?php


namespace App\Http\Controllers\web\store;


use App\Http\Controllers\Controller;

class UserResetPassword extends  Controller
{

    public function showEmailForm()
    {
        return view('store.user.auth.email_form');
    }




    public function showUpdatePasswordForm()
    {
        return view('store.user.auth.updatePassword_form');
    }

}