<?php
namespace App\Repositories\Food;

use App\Repositories\BaseRepository;
use App\Models\Food;

class FoodRepository extends BaseRepository implements IFoodRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Food::class;
    }

    public function searchlistfoodbytext($text, $limit)
    {
        $listFood = Food::select('name')->where('name', 'like', '%'.$text.'%')->limit($limit)->get();
        return $listFood;
    }
}
