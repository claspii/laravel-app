<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vouncher extends Model
{
    use HasFactory;
    protected $table="vouncher";
    protected $fillable=["id_shop", "value", "number_of_vouncher"];

    public function InforShop()
    {
        return $this->belongsTo(InforShop::class, "id_shop", "id_account");
    }

}
