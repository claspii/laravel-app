<?php

namespace App\Observers;

use App\Models\DonHang;
use App\Models\Food;
use App\Models\FoodBill;

class FoodBillObserver
{

    public function updateting(FoodBill $foodBill)
    {
        $moneyFood=Food::where('id',$foodBill->id_food)->firstOrFail()->last_price;
        $foodBill->moneyUpdating=$moneyFood;
    }
    public function updated(FoodBill $foodBill)
    {
        $donhang=FoodBill::where('id',$foodBill->id_bill)->firstOrFail();
        $moneyFood=Food::where('id',$foodBill->id_food)->firstOrFail()->last_price;
        $donhang->update('tongtien',$donhang->tongtien+$moneyFood-$foodBill->moneyUpdating);
    }

    public  function created(FoodBill $foodBill)
    {
        $donhang=FoodBill::where('id',$foodBill->id_bill)->firstOrFail();
        $moneyFood=Food::where('id',$foodBill->id_food)->firstOrFail()->last_price;
        $donhang->update('tongtien',$donhang->tongtien+$moneyFood);
    }

    public function deleted(FoodBill $foodBill)
    {
        $donhang=FoodBill::where('id',$foodBill->id_bill)->firstOrFail();
        $moneyFood=Food::where('id',$foodBill->id_food)->firstOrFail()->last_price;
        $donhang->update('tongtien',$donhang->tongtien-$moneyFood);
    }
}
