<?php
namespace App\Repositories\Cart;

use App\Repositories\RepositoryInterface;

interface ICartRepository extends RepositoryInterface
{
    public function getInfoCart($id_user);
}
