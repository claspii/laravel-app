<?php
namespace App\Repositories\InforShop;

use App\Repositories\BaseRepository;

class InforShopRepository extends BaseRepository implements IInforShopRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\InforShop::class;
    }
}
