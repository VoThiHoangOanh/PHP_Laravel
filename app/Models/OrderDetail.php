<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table='vtho_orderdetail';
    public $timestamps= false;
    public function productimg()
    {
        return $this->hasMany(Productimage::class,'product_id','id');
    }
    public function productdetail()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }



}
