<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;
    protected $table='role';
    protected $primaryKey='id_role';

    protected $fillable=['name'];

    public function accounts()
    {
     return $this->belongsToMany(Account::class,"id_role","id_role");
    }
}
