<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    use HasFactory;
    protected $table="combo";
    public $timestamps = false;
    protected $fillable=["id","des","id_shop"];
    public function shop()
    {
        return $this->belongsTo(InforShop::class, 'id_shop', 'id_account');
    }
    public function combofood()
    {
        return $this->hasMany(ComboFood::class,'id_combo');
    }
}
