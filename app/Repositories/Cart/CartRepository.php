<?php
namespace App\Repositories\CartFood;

use App\Repositories\BaseRepository;

class CartRepository extends BaseRepository implements ICartRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Cart::class;
    }
}
