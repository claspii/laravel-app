<?php
namespace App\Repositories\TrangThaiDonHang;

use App\Repositories\BaseRepository;

class TrangThaiDonHangRepository extends BaseRepository implements ITrangThaiDonHangRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\TrangThaiDonHang::class;
    }
}
