<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\InforUser;
use App\Models\Role;

class InforUserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
     {
         //
     }

     public function update(Account $account,InforUser $InforUser)
     {
       return $account->id_role==Role::IS_USER && auth()->check() &&  $InforUser->id_account==auth()->id();
     }
     public function delete(Account $account,InforUser $InforUser)
     {
         return $account->id_role==Role::IS_USER && auth()->check() &&  $InforUser->id_account==auth()->id();
     }
}
