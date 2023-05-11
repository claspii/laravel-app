<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InforShipper extends Model
{
  use HasFactory;
  protected $table="inforshipper";
  protected $fillable=["id_account","name","address","img"];
  public function account()
  {
    return $this->belongsTo(Account::class,"id_account");
  }
  public function shipper_bill(){
    return $this->hasMany(ShipperDonHangShop::class, 'id_shipper', 'id_account');
  }
  public function review(){
    return $this->hasMany(ReviewShipper::class, 'id_shipper', 'id_account');
  }
}
