<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $table='food';
    protected $primaryKey='food_id';
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
    public function InforShope()
    {
        return $this->belongsTo(InforShop::class,'id_shop','id');
    }
    public function FoodBill()
    {
        return $this->hasMany(FoodBill::class,"id_food","id");
    }
}
