<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table='vtho_category';

    public function CategorySub(){
        return $this->hasMany(Category::class,'parent_id');
    }

}
