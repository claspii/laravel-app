<?php

namespace App\Observers;

use App\Models\DonHang;
use App\Models\Food;
use App\Models\FoodBill;

class FoodObserver
{
    public function updateting(Food $Food)
    {
       $Food->lastPriceOld=$Food->last_price;
    }
    public function updated(Food $food)
    {
      $foodbill=FoodBill::where('id_food',$food->id)->firstOrFail();
      $donhang=DonHang::where('id',$foodbill->id_bill);
      $donhang->update('tongtien',$donhang->tongtien+$food->last_price-$food->lastPriceOld);
    }

    public  function created(Food $food)
    {
      $foodbill=FoodBill::where('id_food',$food->id)->firstOrFail();
      $donhang=DonHang::where('id',$foodbill->id_bill);
      $donhang->update('tongtien',$donhang->tongtien+$food->last_price);
    }

    public function deleted(Food $food)
    {
        $foodbill=FoodBill::where('id_food',$food->id)->firstOrFail();
        $donhang=DonHang::where('id',$foodbill->id_bill);
        $donhang->update('tongtien',$donhang->tongtien-$food->last_price);
    }
}
