<?php

namespace App\Models;

use App\Observers\CartShopObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartShop extends Model
{
    use HasFactory;
    protected $table="cart_shop";
    public $timestamps = false;
    protected $fillable=["id_cart", "id_shop", "id_vouncher", "ship_price"];
    public function cart()
    {
        return $this->belongsTo(Cart::class,'id_cart');
    }
    public function vouncher(){
        return $this->belongsTo(Vouncher::class, "id_vouncher");
    }
    public function shop(){
        return $this->belongsTo(InforShop::class, 'id_shop', 'id_account');
    }
    public function CartFood(){
        return $this->hasMany(CartFood::class, "id_cartshop");
    }
    protected static function boot()
    {
        parent::boot();
        CartShop::observe(CartShopObserver::class);
    }
}
