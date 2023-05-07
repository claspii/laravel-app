<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;
    protected $table='role';
    protected $fillable=['name'];

    public function accounts()
    {
     return $this->belongsToMany(Account::class,"id_role");
    }
    public const IS_USER=1;
    public const IS_SHOPPER=2;

    public const IS_ADMIN=3;

    public const IS_SHIPPER=4;
}
