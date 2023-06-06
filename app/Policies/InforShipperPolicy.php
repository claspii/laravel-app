<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\InforShipper;
use App\Models\Role;

class InforShipperPolicy
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
        return $account->id_role == Role::IS_SHIPPER && $account->id == $id;
     }
     public function update(Account $account,InforShipper $InforShipper)
     {
       return $account->id_role==Role::IS_SHIPPER && auth()->check() &&  $InforShipper->id_account==auth()->id();
     }
     public function delete(Account $account,InforShipper $InforShipper)
     {
         return $account->id_role==Role::IS_SHIPPER && auth()->check() &&  $InforShipper->id_account==auth()->id();
     }
}
