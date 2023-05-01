<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartFood extends Model
{
    use HasFactory;
    protected $table="cartfood";
    protected $fillable=["id_shop","id_cart","id_vouncher","id_food"];
    public function inforShop()
    {
        return $this->belongsTo(InforShop::class,'id_shop');
    }
    public function cart()
    {
        return $this->belongsTo(Cart::class,'id_cart');
    }
    public function vouncher()
    {
        return $this->belongsTo(Vouncher::class,'id_vouncher');
    }
    public function food()
    {
        return $this->belongsTo(Vouncher::class,'id_food');
    }
}
