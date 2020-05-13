<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserOptionCode
{

    public $showMobile = 'show-mobile';
    public $showname = 'show-name';
    public $test1 = 'show-test';
    public $test2 = 'show-tes1';


    public function get($property)
    {
        if (isset($this->{$property})) {
            return $this->{$property};
        }
        return '';
    }
    public function set($property, $value)
    {
        $this->{$property} = $value;
        return $this->{$property};
    }
    //remove property from subscribe data with spacific name or as like word.{:-}
    public function cleanGroupPropWith($propLike)
    {
        foreach ($this as $prop => $value) {
            if (strpos($prop, $propLike)) {
                unset($this->$prop);
            }
        }
    }


}
