<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\Combo;
use App\Models\Role;

class ComboPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function create(Account $account)
    {
      return $account->id_role==Role::IS_SHOPPER;
    }
    public function update(Account $account,Combo $Combo)
    {
      return $account->id_role==Role::IS_SHOPPER && auth()->check() &&  $Combo->id_shop==auth()->id();
    }
    public function delete(Account $account,Combo $Combo)
    {
        return $account->id_role==Role::IS_SHOPPER&& auth()->check() &&  $Combo->id_shop==auth()->id();
    }
}
