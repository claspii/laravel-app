<?php
namespace App\Repositories\Bill;

use App\Repositories\BaseRepository;
use App\Models\FoodBill;

class BillRepository extends BaseRepository implements IBillRepository
{
    //lấy model tương ứng
    public function __construct()   
    {
        $this->setModel();
    }
    public function getModel()
    {
        return FoodBill::class;
    }
    
}
