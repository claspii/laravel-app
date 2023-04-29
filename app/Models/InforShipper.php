<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InforShipper extends Model
{
    use HasFactory;
    protected $table="inforshipper";
    protected $fillable=["id_account","name","address","img"];
}
