<?php
namespace App\Repositories\Cart;

use App\Repositories\BaseRepository;

class CartRepository extends BaseRepository implements ICartRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Cart::class;
    }
}
