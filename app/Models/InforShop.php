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
    public function InforShope()
    {
       return $this->belongsTo(InforShop::class,'id_account','id');
    }
}
