<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table="cart";
    protected $fillable=["id_user"];
    public function CartShop()
    {
       return $this->hasMany(CartShop::class,'id_cart');
    }
    public function user(){
        return $this->belongsTo(InforUser::class, 'id_user', 'id_account');
    }
}
