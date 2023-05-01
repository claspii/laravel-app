<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodBill extends Model
{
    use HasFactory;
    protected $fillable=["id_bill","id_food"];
    public function donhang()
    {
        return $this->belongsTo(DonHang::class,"id_bill","id");
    }
    public function food()
    {
        return $this->belongsTo(Food::class,"id_food","id");
    }
}
