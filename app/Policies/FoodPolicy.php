<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\Food;
use App\Models\Role;

class FoodPolicy
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
    public function update(Account $account,Food $Food)
    {
      return $account->id_role==Role::IS_SHOPPER && auth()->check() &&  $Food->id_shop==auth()->id();
    }
    public function delete(Account $account,Food $Food)
    {
        return $account->id_role==Role::IS_SHOPPER && auth()->check() &&  $Food->id_shop==auth()->id();
    }
}
