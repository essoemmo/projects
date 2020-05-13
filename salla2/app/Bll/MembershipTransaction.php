<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Bll;

/**
 * Description of Transaction
 *
 * @author fz
 */
class MembershipTransaction {

    //put your code here
    public $domain;
    public $Membership;
    public $Request;

    public function Save() {
        session()->put(\App\Bll\Constants::MEMBERSHIP_TRANSACTION, $this);
    }

    public function get() {
        return session()->get(\App\Bll\Constants::MEMBERSHIP_TRANSACTION);
    }

    public function destroy() {
        if ($this->get() !== null)
            session()->remove(\App\Bll\Constants::MEMBERSHIP_TRANSACTION);
    }

}
