<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\ReviewFood;
use App\Models\Role;

class ReviewFoodPolicy
{
    /**
     * Create a new policy instance.
     */
    public function view(Account $account, ReviewFood $ReviewFood)
    {
      return auth()->id() == $ReviewFood->id_user;
    }
    public function create()
    {
      return auth()->check();
    }
    public function update(Account $account,ReviewFood $ReviewFood)
    {
      return ($account->id_role==Role::IS_USER && auth()->check() &&  $ReviewFood->id_user==auth()->id());
    }
    public function delete(Account $account,ReviewFood $ReviewFood)
    {
        return $account->id_role==Role::IS_ADMIN || ($account->id_role==Role::IS_SHOPPER && auth()->check() && $ReviewFood->id_shop==auth()->id())||$account->id_role==Role::IS_USER && auth()->check() &&  $ReviewFood->id_user==auth()->id();
    }
}
