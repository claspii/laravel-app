<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipperDonHangShop extends Model
{
    use HasFactory;
    protected $table="shipperdonhangshop";
    protected $fillable=["id_user","id_shipper","id_shop","id_donhang"];

    public function donhang()
    {
        return $this->belongsTo(FoodBill::class,"id_donhang");
    }
    public function user()
    {
        return $this->belongsTo(InforUser::class, "id_user", "id_account");
    }
    public function shipper(){
        return $this->belongsTo(InforShipper::class, "id_shipper", "id_account");
    }
    public function shop(){
        return $this->belongsTo(InforShop::class, "id_shop", "id_account");
    }
}
