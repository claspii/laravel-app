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
                array_push($listFood, $cartFood->food);
            }
            $cartShopstd->id_shop = $cartShop->id_shop;
            $cartShopstd->id_vouncher = $cartShop->id_vouncher;
            $cartShopstd->ship_price = $cartShop->ship_price;
            $cartShopstd->listFood = $listFood;
            array_push($listcartshop, $cartShopstd);
        }
        return $listcartshop;
    }
}
