<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\InforShop;
use App\Models\Role;

class InforShopPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
     {
         //
     }
     public function create(Account $account, $id)
     {
        return $account->id_role == Role::IS_SHOPPER && $account->id == $id;
     }
     public function update(Account $account,InforShop $InforShop)
     {
       return $account->id_role==Role::IS_SHOPPER && auth()->check() &&  $InforShop->id_account==auth()->id();
     }
     public function delete(Account $account,InforShop $InforShop)
     {
         return $account->id_role==Role::IS_SHOPPER && auth()->check() &&  $InforShop->id_account==auth()->id();
     }
}
