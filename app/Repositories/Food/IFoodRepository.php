<?php
namespace App\Repositories\Food;

use App\Repositories\RepositoryInterface;

interface IFoodRepository extends RepositoryInterface
{
    public function searchlistfoodbytext($text, $limit);
}

