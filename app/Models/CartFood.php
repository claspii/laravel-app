<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartFood extends Model
{
    use HasFactory;
    protected $table="cartfood";
    public $timestamps = false;
    protected $fillable=["id_cartshop","id_food","quantity"];
    public function cartshop()
    {
        return $this->belongsTo(CartShop::class,'id_cartshop');
    }
    public function food()
    {
        return $this->belongsTo(Food::class,'id_food');
    }
}
