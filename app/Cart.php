<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart 
{
   
    public $product =null;
    public $totalprice_buy=0;
    public $totalqty=0;

    public function __construct($cart)
    {
        if($cart)
        {
            $this->product =$cart->product;
            $this->totalprice_buy =$cart->totalprice_buy;
            $this->totalqty =$cart->totalqty;

        }
    }

    public function AddCart($product,$id)
    {
        $newProduct =['qty'=>0,'price'=>$product->price_buy, 'productinfo'=>$product];
        if($this->product)
        {
            if(array_key_exists($id, $this->product))
            {
                $newProduct= $this->product[$id];
            }
        }
        $newProduct['qty']++;
        $newProduct['price']=$newProduct['qty']*$product->price_buy;
        $this->product[$id]=$newProduct;
        $this->totalprice_buy += $product->price_buy;
        $this->totalqty ++;


    }
}

