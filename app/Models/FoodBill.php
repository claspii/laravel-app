<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodBill extends Model
{
    use HasFactory;
    protected $table="bill";
    protected $fillable=["price", "payment_method", "created_at", "id_state", "id_user"];
    
    public function bill_list(){
        return $this->hasMany(Bill_list::class, "id_bill");
    }

    public function state(){
        return $this->hasOne(TrangThaiDonHang::class, "id_bill");
    }

    public function user(){
        return $this->belongsTo(Account::class, "id_user");
    }

    public function shipper_bill(){
        return $this->hasOne(ShipperDonHangShop::class, "id_donhang");
    }

}
