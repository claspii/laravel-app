<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table="cart";
    protected $fillable=["id","id_user"];
    public function CartFoods()
    {
       return $this->hasMany(CartFood::class,'id_cart');
    }
}
