<?php
namespace App\Repositories\InforShop;

use App\Repositories\RepositoryInterface;

interface IInforShopRepository extends RepositoryInterface
{
  public function selectShopBasedOnNameFood($name,$limit);

}