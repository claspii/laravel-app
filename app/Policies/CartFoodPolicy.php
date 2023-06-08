<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\Role;
use App\Models\CartFood;
use App\Models\CartShop;
use App\Models\Cart;

class CartFoodPolicy
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
      return auth()->user->id_role==Role::IS_USER;
    }
}
