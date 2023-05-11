<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrangThaiDonHang extends Model
{
    use HasFactory;
    protected $table="trangthaidonhang";
    protected $fillable=["id_bill" ,"des"];

    public function bill(){
        return $this->belongsTo(FoodBill::class, "id_bill");
    }
}
