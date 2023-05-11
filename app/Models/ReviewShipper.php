<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewShipper extends Model
{
    use HasFactory;
    protected $table="reviewshipper";
    protected $fillable=["id_shipper", "average_star", "number_of_review"];
    
    public function shipper(){
        return $this->belongsTo(InforShipper::class, 'id_shipper', 'id_account');
    }

}
