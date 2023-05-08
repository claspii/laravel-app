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
}
