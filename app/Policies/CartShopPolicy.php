<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\CartShop;
use App\Models\Role;

class CartShopPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function update(Account $account,CartShop $cartShop)
    {
        return $account->id_role==Role::IS_USER && auth()->check() &&  $cartShop->cart->id_user==$account->id;
    }
}
