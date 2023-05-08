<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\Role;

class AccountPolicy
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
      return auth()->check() == $account->id;
    }
    public function delete(Account $account)
    {
        return  auth()->check() == $account->id;
    }
}
