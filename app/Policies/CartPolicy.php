<?php

namespace App\Policies\Policies;

use App\Models\Account;
use App\Models\Cart;
use App\Models\Role;

class CartPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {

    }
    public function create(Account $account)
    {
      return $account->id_role==Role::IS_USER;
    }
    public function update(Account $account,Cart $cart)
    {
      return $account->id_role==Role::IS_USER && auth()->check() &&  $cart->id_shop==auth()->id();
    }
    public function delete(Account $account,Cart $cart)
    {
        return $account->id_role==Role::IS_USER && auth()->check() &&  $cart->id_shop==auth()->id();
    }
}
