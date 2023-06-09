<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComboFood extends Model
{
    use HasFactory;
    protected $table="combofood";
    public $timestamps = false;
    protected $fillable=["id","id_food","id_combo"];
    public function food()
    {
        return $this->belongsTo(Food::class, "id_food");
    }
    public function combo()
    {
        return $this->belongsTo(Combo::class,"id_combo");
    }
}
