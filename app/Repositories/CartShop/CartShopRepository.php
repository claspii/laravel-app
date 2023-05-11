<?php
namespace App\Repositories\CartShop;

use App\Repositories\BaseRepository;

class CartShopRepository extends BaseRepository implements ICartShopRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\CartShop::class;
    }
}
