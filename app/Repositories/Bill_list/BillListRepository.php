<?php
namespace App\Repositories\Bill_list;

use App\Repositories\BaseRepository;

class BillListRepository extends BaseRepository implements IBillListRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Bill_list::class;
    }
}
