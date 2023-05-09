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
       return $this->belongsTo(Account::class,'id_account','id');
    }
    public function foods()
    {
        return $this->hasMany(Food::class, 'id_shop', 'id_account');
    }
}
