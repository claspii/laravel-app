<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill_list_item extends Model
{
    use HasFactory;
    protected $table="bill_list_item";
    protected $fillable=["id_listbill", "id_food", "quantity"];
    public function bill_list()
    {
        return $this->belongsTo(Bill_list::class,'id_listbill');
    }
    public function food()
    {
        return $this->belongsTo(Food::class,'id_food');
    }
}
