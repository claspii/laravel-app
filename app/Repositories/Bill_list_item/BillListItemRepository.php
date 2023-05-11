<?php
namespace App\Repositories\Bill_list_item;

use App\Repositories\BaseRepository;

class BillListItemRepository extends BaseRepository implements IBillListItemRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Bill_list_item::class;
    }
}
