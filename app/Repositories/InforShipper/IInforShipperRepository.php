<?php
namespace App\Repositories\InforShop;

use App\Repositories\BaseRepository;

class InforShipperRepository extends BaseRepository implements IInforShipperRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\InforShipper::class;
    }
}
