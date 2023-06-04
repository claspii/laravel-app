<?php

namespace App\Observers;

use App\Models\CartFood;
use App\Models\CartShop;
use App\Models\Cart;

class CartFoodObserver
{
    /**
     * Handle the CartFood "created" event.
     */

    public function updated(CartFood $cartFood)
    {
        $old_quantity = $cartFood->getOriginal('quantity');
        $cartShop = CartShop::where('id', $cartFood->id_cartshop)->firstOrFail();
        $cart = Cart::where('id', $cartShop->id_cart)->firstOrFail();
        $cart->tongtien = $cart->tongtien + $cartFood->food->last_price*($cartFood->quantity - $old_quantity);
        $cart->save();
    }
    /**
     * Handle the CartFood "deleted" event.
     */
    public function deleted(CartFood $cartFood)
    {
        $cartShop = CartShop::where('id', $cartFood->id_cartshop)->firstOrFail();
        $cart = Cart::where('id', $cartShop->id_cart)->firstOrFail();
        $cart->tongtien = $cart->tongtien - $cartFood->food->last_price*$cartFood->quantity;
        $cart->save(); 
        if($cartShop->CartFood->count() == 0)
            $cartShop->delete();     
        
    }
}
