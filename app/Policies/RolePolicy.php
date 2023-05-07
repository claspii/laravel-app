<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\Role;

class RolePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function update(Account $account)
    {
      return $account->id_role==Role::IS_ADMIN;
    }
    public function delete(Account $account)
    {
        return $account->id_role==Role::IS_ADMIN ;
    }
}
