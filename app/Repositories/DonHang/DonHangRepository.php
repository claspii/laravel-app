<?php
namespace App\Repositories\DonHang;

use App\Repositories\BaseRepository;

class DonHangRepository extends BaseRepository implements IDonHangRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\DonHang::class;
    }
}
