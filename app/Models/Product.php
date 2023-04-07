<?php

namespace App\Models;
use App\Models\Productimage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table='vtho_product';

    public function productimg()
    {
        return $this->hasMany(Productimage::class,'product_id','id');
    }

}
