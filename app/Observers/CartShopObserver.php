<?php

namespace App\Observers;

use App\Models\CartShop;
use App\Models\Cart;
use App\Models\CartFood;
use App\Models\Vouncher;

class CartShopObserver
{
    /**
     * Handle the CartShop "created" event.
     */
    public function created(CartShop $cartShop)
    {
        $cart = Cart::where('id', $cartShop->id_cart)->firstOrFail();
        $cart->tongtien = $cart->tongtien + 15000;  
        if ($cartShop->id_vouncher != null)
            $cart->tongtien = $cart->tongtien - $cartShop->vouncher->value;
        $cart->save();
    }

    public function updated(CartShop $cartShop)
    {
        $old_ship_price = $cartShop->getOriginal('ship_price');
        $old_id_vouncher = $cartShop->getOriginal('id_vouncher');
        $cart = Cart::where('id', $cartShop->id_cart)->firstOrFail();
        $cart->tongtien = $cart->tongtien - $old_ship_price + $cartShop->ship_price;
        if($cartShop->id_vouncher != null)
        {
            $vouncher = Vouncher::where('id', $cartShop->id_vouncher);
            $cart->tongtien = $cart->tongtien - $vouncher->value;
        }
        if($old_id_vouncher != null)
        {
            $old_vouncher = Vouncher::where('id', $old_id_vouncher);
            $cart->tongtien = $cart->tongtien + $old_vouncher->value;
        }
        $cart->save();
    }

    /**
     * Handle the CartShop "deleted" event.
     */
    public function deleted(CartShop $cartShop)
    {
        $cart = Cart::where('id', $cartShop->id_cart)->firstOrFail();
        $cart->tongtien = $cart->tongtien - $cartShop->ship_price;
        if($cartShop->id_vouncher != null)
        {
            $vouncher = Vouncher::where('id', $cartShop->id_vouncher);
            $cart->tongtien = $cart->tongtien + $vouncher->value;
        }
        $cart->save();
    }

}
