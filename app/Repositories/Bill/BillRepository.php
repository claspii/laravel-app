<?php
namespace App\Repositories\Bill;

use App\Repositories\BaseRepository;

class BillRepository extends BaseRepository implements IBillRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\FoodBill::class;
    }
}
