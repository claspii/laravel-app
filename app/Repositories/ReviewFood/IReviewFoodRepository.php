<?php
namespace App\Repositories\ReviewFood;

use App\Repositories\BaseRepository;

class ReviewFoodRepository extends BaseRepository implements IReviewFoodRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\ReviewFood::class;
    }
}
