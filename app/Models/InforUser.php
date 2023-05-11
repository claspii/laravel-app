<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InforUser extends Model
{
    use HasFactory;
    protected $table="inforuser";
    protected $fillable=["id_account","last_name","first_name","phone_number","address","avatar"];
    public $timestamps=false;
    public function account()
    {
       return $this->belongsTo(Account::class,'id_account');
    }

    public function cart(){
        return $this->hasOne(Cart::class, 'id_user', 'id_account');
    }

    public function bill()
    {
        return $this->hasMany(FoodBill::class, 'id_user', 'id_account');
    }

    public function shipper_bill(){
        return $this->hasMany(ShipperDonHangShop::class, 'id_user', 'id_account');
    }

    public function reviewfood(){
        return $this->hasMany(reviewfood::class, 'id_user', 'id_account');
    }
}
