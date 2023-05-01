<?php
namespace App\Repositories\InforShop;

use App\Models\InforShop;
use App\Repositories\BaseRepository;

class InforShopRepository extends BaseRepository implements IInforShopRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        return InforShop::class;
    }
    public function selectShopBasedOnNameFood($name)
    {
        InforShop::where("",$name)->get();
    }
}
