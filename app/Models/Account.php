<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Account extends Authenticatable
{
    use Notifiable, HasApiTokens;
    public $table = 'account';
    public $timestamps = false;

    protected $fillable = ['username', 'password', 'email', 'id_role'];
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function get_access_token(){
        return $this->accessToken;
    }
    public function cart(){
        return $this->hasMany(Cart::class, "id_user");
    }
    public function InforUser()
    {
        return $this->hasOne(InforUser::class, "id_account", "id");
    }
    public function InforShop()
    {
        return $this->hasOne(InforShop::class, "id_account", "id");
    }
    public function InforShipper()
    {
        return $this->hasOne(InforShipper::class, "id_account", "id");
    }
}
