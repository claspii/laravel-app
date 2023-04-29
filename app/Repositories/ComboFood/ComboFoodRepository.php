<?php
namespace App\Repositories\ComboFood;

use App\Repositories\BaseRepository;

class ComboFoodRepository extends BaseRepository implements IComboFoodRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\ComboFood::class;
    }
}
