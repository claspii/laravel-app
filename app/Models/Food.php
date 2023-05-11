<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $table='food';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =
    ['type',
    'first_price',
    'last_price',
    'name',
    'id_shop'];

    public $timestamps=false;
    public function InforShop()
    {
        return $this->belongsTo(Account::class,'id_shop');
    }
    public function FoodBill()
    {
        return $this->hasMany(FoodBill::class,"id_food","id");
    }
}
