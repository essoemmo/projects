<?php


namespace App\Help;


class Buy
{
//    const ID = "";

    private  $id;
    private  $type;
    private  $title;
    private  $currency;
    private  $price;
    private  $net_price;

    public function __construct($id , $type , $title , $currency , $price ,$net_price)
    {

        $this->id = $id;
        $this->type = $type;
        $this->title = $title;
        $this->currency = $currency;
        $this->price = $price;
        $this->net_price = $net_price;
    }

    public function data ()
    {
        return [
            'item_id' => $this->id,
            'type' => $this->type,
            'title' => $this->title,
            'currency' => $this->currency,
            'price' => $this->price,
            'net_price' => $this->net_price,
        ];
    }

}