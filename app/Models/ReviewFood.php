<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewFood extends Model
{
    use HasFactory;
    protected $table="reviewfood";
    protected $fillable=["id_food","id_shop","id_user","des","thoigian","star"];
    public function food()
    {
        return $this->belongsTo(Food::class,"id_food","id");
    }
    public function shop()
    {
        return $this->belongsTo(InforShop::class,"id_shop");
    }
    public function user()
    {
        return $this->belongsTo(InforUser::class,"id_user");
    }
}
