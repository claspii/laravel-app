<?php

namespace App\Observers;

use App\Models\Food;
use App\Models\CartFood;
use App\Models\CartShop;
use App\Models\Cart;

class FoodObserver
{

    public function updated(Food $food)
    {
      $old_last_price = $food->getOriginal('last_price');
      $cartFoods = CartFood::where('id_food', $food->id)->get();
      foreach($cartFoods as $cartFood)
      {
        $cartShop = CartShop::where('id', $cartFood->id_cartshop)->firstOrFail();
        $cart = Cart::where('id', $cartShop->id_cart)->firstOrFail();
        $cart->tongtien = $cart->tongtien + ($food->last_price - $old_last_price)*$cartFood->quantity; 
        $cart->save();
      }
    }

    public function deleting(Food $food)
    {
      $cartFoods = CartFood::where('id_food', $food->id)->get();
      foreach($cartFoods as $cartFood)
      {
        $cartFood->delete();
      }
    }
}
