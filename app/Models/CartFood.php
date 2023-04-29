<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartFood extends Model
{
    use HasFactory;
    protected $table="cartfood";
    protected $fillable=["id_shop","id_cart","id_vouncher","id_food"];
    public function InforShop()
    {
        return $this->hasOne(InforShop::class,'id_shop','id');
    }
    public function Cart()
    {

    }
}
