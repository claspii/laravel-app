<?php
namespace App\Repositories\Food;

use App\Repositories\BaseRepository;

class FoodRepository extends BaseRepository implements IFoodRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Food::class;
    }
}
