<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class IPAddress extends Model {


    protected $table = 'ip_addresses';


    public function getAll() {

        return $this->all();
    }






}



?>