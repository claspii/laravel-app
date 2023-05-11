<?php
namespace App\Repositories\ReviewShipper;

use App\Repositories\BaseRepository;

class ReviewShipperRepository extends BaseRepository implements IReviewShipperRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\ReviewShipper::class;
    }
}
