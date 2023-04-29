<?php
namespace App\Repositories\CartFood;

use App\Repositories\BaseRepository;

class CartFoodRepository extends BaseRepository implements ICartFoodRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\CartFood::class;
    }
}
