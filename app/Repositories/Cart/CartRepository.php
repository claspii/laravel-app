<?php
namespace App\Repositories\Cart;

use App\Repositories\BaseRepository;
use App\Models\Cart;
use stdClass;

class CartRepository extends BaseRepository implements ICartRepository
{
    //lấy model tương ứng
    public function __construct()
    {
        $this->setModel();
    }
    public function getModel()
    {
        return \App\Models\Cart::class;
    }
    public function getInfoCart($id_user)
    {
        $cart = Cart::where('id_user', $id_user)->first();
        $cartShops = $cart->CartShop;
        $result = new \stdClass();
        $listcartshop = [];
        foreach($cartShops as $cartShop)
        {
            $cartShopstd = new \stdClass();
            $listFood = [];
            $cartFoods = $cartShop->CartFood;
            foreach($cartFoods as $cartFood)
            {
                $cartFoodstd = new \stdClass();
                $cartFoodstd->quantity = $cartFood->quantity;
                $cartFoodstd->food = $cartFood->food;
                array_push($listFood, $cartFoodstd);
            }
            $cartShopstd->shop = $cartShop->shop;
            $cartShopstd->vouncher = $cartShop->vouncher;
            $cartShopstd->ship_price = $cartShop->ship_price;
            $cartShopstd->listFood = $listFood;
            array_push($listcartshop, $cartShopstd);
        }
        return $listcartshop;
    }
}
