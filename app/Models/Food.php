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
        return $this->belongsTo(InforShop::class, 'id_shop', 'id_account');
    }
    public function reviewfood(){
        return $this->hasMany(reviewfood::class, 'id_food');
    }
}
