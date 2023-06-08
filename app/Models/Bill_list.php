<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill_list extends Model
{
    use HasFactory;
    protected $table="bill_list";
    protected $fillable=["id_bill", "id_shop", "id_vouncher", "ship_price"];
    public $timestamps = false;
    public function bill()
    {
        return $this->belongsTo(FoodBill::class,'id_bill');
    }
    public function vouncher(){
        return $this->belongsTo(Vouncher::class, "id_vouncher");
    }
    public function shop(){
        return $this->belongsTo(InforShop::class, 'id_shop', 'id_account');
    }
    public function bill_list_item(){
        return $this->hasMany(Bill_list_item::class, "id_listbill");
    }
}
