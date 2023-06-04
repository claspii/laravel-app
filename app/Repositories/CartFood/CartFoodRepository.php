<?php
namespace App\Repositories\CartFood;

use App\Models\Cart;
use App\Models\CartFood;
use App\Models\CartShop;
use App\Repositories\BaseRepository;
use App\Repositories\CartShop\ICartShopRepository;
use App\Repositories\Cart\ICartRepository;
use App\Repositories\Food\IFoodRepository;
use Attribute;

class CartFoodRepository extends BaseRepository implements ICartFoodRepository
{
    protected $cartRepo;
    protected $cartShopRepo;
    protected $foodRepo;
    public function __construct(ICartRepository $cartRepo,ICartShopRepository $cartShopRepo,IFoodRepository $foodRepo){
        $this->cartRepo=$cartRepo;
        $this->cartShopRepo=$cartShopRepo;
        $this->foodRepo=$foodRepo;
        $this->setModel();
    }
    //lấy model tương ứng
    public function getModel()
    {
        return CartFood::class;
    }
    public function addCartFoodtoCart($user_id,$attributes = [])
    {
        $food=$this->foodRepo->find($attributes['id_food']);
        if($food==null)
        {
            return;
        }
        $cart = Cart::where('id_user',$user_id)->first();
        if($cart==null)
        {
           $cart=$this->cartRepo->create(['id_user'=>$user_id]);
        }

        $cartShop=CartShop::where('id_cart',$cart->id)->where('id_shop',$food->id_shop)->first();

        if($cartShop==null)
        {
            $cartShop=$this->cartShopRepo->create(['id_cart'=>$cart->id,'id_shop'=>$food->id_shop,'id_vouncher'=>$attributes['id_vouncher']]);
        }

        $cartFood= CartFood::where(['id_cartshop' => $cartShop->id, 'id_food' => $food->id])->first();

        if($cartFood==null)
        {
            $cartFood = CartFood::create(['id_food'=>$food->id,'id_cartshop'=>$cartShop->id]);
        }
        if($cartFood)
        {
            if ($attributes['quantity'] != null)
            {
                $cartFood->update([
                    'quantity'=>$cartFood->quantity + $attributes['quantity']
                    ]);
            }
            else
            {
                $cartFood->update([
                    'quantity'=>$cartFood->quantity+1
                    ]);
            }  
        }

        return $cartFood;

    }

    public function decreaseFoodtoCart($user_id,$attributes = [])
    {
        $food=$this->foodRepo->find($attributes['id_food']);
        if($food==null)
        {
            return;
        }
        $cart = Cart::where('id_user',$user_id)->first();
        if($cart==null)
        {
          return ;
        }
        $cartShop=CartShop::where(['id_cart' => $cart->id, 'id_shop' => $food->id_shop])->first();
        if($cartShop==null)
        {
           return;
        }
        $cartFood= CartFood::where(['id_cartshop' => $cartShop->id, 'id_food' => $food->id])->first();

        if($cartFood==null)
        {
            return;
        }
        if($cartFood->quantity==1)
        {
            $cartFood->delete();
        }
        else
        {
            $cartFood->update([
              'quantity'=>$cartFood->quantity-1
            ]);
        }

        return $cartFood;

    }
    public function deleteFoodInCart($user_id, $attributes = [])
    {
        $food=$this->foodRepo->find($attributes['id_food']);
        if($food==null)
        {
            return;
        }
        $cart = Cart::where('id_user',$user_id)->first();
        if($cart==null)
        {
          return ;
        }
        $cartShop=CartShop::where(['id_cart' => $cart->id, 'id_shop' => $food->id_shop])->first();
        if($cartShop==null)
        {
           return;
        }
        $cartFood= CartFood::where(['id_cartshop' => $cartShop->id, 'id_food' => $food->id])->first();

        if($cartFood==null)
        {
            return;
        }
        $cartFood->delete();
        return True;
    }
}
