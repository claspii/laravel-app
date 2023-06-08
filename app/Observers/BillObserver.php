<?php

namespace App\Observers;

use App\Models\FoodBill;
use App\Models\ShipperDonHangShop;
use App\Models\TrangThaiDonHang;

class BillObserver
{
    /**
     * Handle the FoodBill "created" event.
     */
    public function created(FoodBill $bill)
    {
        $state = TrangThaiDonHang::create(['des' => 'Cho xac nhan', 'id_bill' => $bill->id]);
        $bill->id_state = $state->id;
        $bill->save();
    }

}
