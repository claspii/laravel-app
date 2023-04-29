<?php
namespace App\Repositories\ShipperDonHangShop;

use App\Repositories\BaseRepository;

class ShipperDonHangShopRepository extends BaseRepository implements IShipperDonHangShopRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\ShipperDonHangShop::class;
    }
}
