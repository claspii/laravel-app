<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InforShop extends Model
{
    use HasFactory;
    protected $table='inforshop';
    protected $fillable =
    ['id_account',
    'name',
    'address',
    'image',
    ];

    public $timestamps=false;
    public function account()
    {
       return $this->belongsTo(Account::class,'id_account');
    }
    public function foods()
    {
        return $this->hasMany(Food::class, 'id_shop', 'id_account');
    }
    public function vouncher()
    {
        return $this->hasMany(Vouncher::class, 'id_shop', 'id_account');
    }
    public function shipper_bill(){
        return $this->hasMany(ShipperDonHangShop::class, 'id_shop', 'id_account');
    }
    public function reviewfood(){
        return $this->hasMany(Reviewfood::class, 'id_shop', 'id_account');
    }
    public function combo(){
        return $this->belongsTo(InforShop::class, 'id_shop', 'id_account');
    }
}
