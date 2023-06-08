<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\FoodBill;
use App\Models\Role;
use App\Models\ShipperDonHangShop;

class BillPolicy
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
        return $account->id_role == Role::IS_USER && auth()->check();
    }
    public function update(Account $account,ShipperDonHangShop $ShipperDonHangShop)
    {
      return $account->id_role==Role::IS_SHOPPER && auth()->check() &&  $ShipperDonHangShop->id_shop==auth()->id()||
      ($account->id_role==Role::IS_USER && auth()->check() &&  $ShipperDonHangShop->id_user==auth()->id())||
      ($account->id_role==Role::IS_SHIPPER && auth()->check() &&  $ShipperDonHangShop->id_shipper==auth()->id());
    }
    public function delete(Account $account,ShipperDonHangShop $ShipperDonHangShop)
    {
        return $account->id_role==Role::IS_SHOPPER && auth()->check() &&  $ShipperDonHangShop->id_shop==auth()->id()||
        ($account->id_role==Role::IS_USER && auth()->check() &&  $ShipperDonHangShop->id_user==auth()->id());
    }
}
