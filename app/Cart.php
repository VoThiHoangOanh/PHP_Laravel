<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart 
{
   
    public $products = null;
    public $totalprice_buy=0;
    public $totalqty=0;

    public function __construct($cart)
    {
        if($cart)
        {
            $this->products =$cart->products;
            $this->totalprice_buy =$cart->totalprice_buy;
            $this->totalqty =$cart->totalqty;

        }
    }

    public function AddCart($product,$id)
    {
        $newProduct =['qty'=>0,'price_buy'=>$product->price_buy, 'productinfo'=>$product,'img'=>$product->productimg];
        if($this->products)
        {
            if(array_key_exists($id, $this->products))
            {
                $newProduct= $this->products[$id];
            }
        }
        $newProduct['qty']++;
        $newProduct['price_buy']=$newProduct['qty'] * $product->price_buy;
        $this->products[$id]=$newProduct;
        $this->totalprice_buy += $product->price_buy;
        $this->totalqty ++;


    }
    public function DeleteCart($id)
    {
        $this->totalqty -= $this->products[$id]['qty'];
        $this->totalprice_buy -= $this->products[$id]['price_buy'];
        unset($this->products[$id]);
    }
}

