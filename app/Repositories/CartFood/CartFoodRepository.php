<?php
namespace App\Repositories\CartFood;

use App\Models\Cart;
use App\Models\CartShop;
use App\Repositories\BaseRepository;
use App\Repositories\CartShop\IcartShopRepository;
use App\Repositories\Food\IFoodRepository;

class CartFoodRepository extends BaseRepository implements ICartFoodRepository
{
    protected $cartRepo;
    protected $cartShopRepo;
    protected $foodRepo;
    public function __construct(ICartRepository $cartRepo,IcartShopRepository $cartShopRepo,IFoodRepository $foodRepo){
        $this->cartRepo=$cartRepo;
        $this->cartShopRepo=$cartShopRepo;
        $this->foodRepo=$foodRepo;
    }
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\CartFood::class;
    }
    public function addCartFoodtoCart($user_id,$attributes = [])
    {
        $food=$this->foodRepo->find($attributes['id_food']);
        if($food==null)
        {
            return;
        }
        $cart = Cart::where('user_id',$user_id)->get();

        if($cart==null)
        {
           $cart=$this->cartRepo->create($user_id);
        }
        $cartShop=CartShop::where('id_shop',$food->id_shop)->get();
        if($cartShop==null)
        {
            $cartShop=$this->cartShopRepo->create(['id_cart'=>$cart->id,'id_shop'=>$food->id_shop,'id_vouncher'=>$attributes['id_vouncher'],'ship_price'=>$attributes['ship_price']]);
        }
        $cartFood=$this->model->where('id_cartshop',$cartShop->id)->where('id_food',$food->id)->get();
        if($cartFood==null)
        {
            $this->model->create(['id_food'=>$food->id,'id_cartshop'=>$cartShop->id,'quantity'=>$attributes['quantity']]);
        }
        if($cartFood)
        {
            $cartFood->update([
              'quantity'=>$cartFood->quantity+1
            ]);
        }
    }
    public function decreaseFooodtoCart($user_id,$attributes = [])
    {
        $food=$this->foodRepo->find($attributes['id_food']);
        if($food==null)
        {
            return;
        }
        $cart = Cart::where('user_id',$user_id)->get();
        if($cart==null)
        {
          return ;
        }
        $cartShop=CartShop::where('id_shop',$food->id_shop)->get();
        if($cartShop==null)
        {
            $cartShop=$this->cartShopRepo->create(['id_cart'=>$cart->id,'id_shop'=>$food->id_shop,'id_vouncher'=>$attributes['id_vouncher'],'ship_price'=>$attributes['ship_price']]);
        }
        $cartFood=$this->model->where('id_cartshop',$cartShop->id)->where('id_food',$food->id)->get();
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
    }
    public function deleteFoodInCart($foodid,$shopid)
    {
         $food=$this->foodRepo->find(($foodid));
         if($food==null)
         {
           return;
         }

    }
}