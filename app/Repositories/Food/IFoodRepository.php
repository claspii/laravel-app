<?php
namespace App\Repositories\Food;

use App\Repositories\RepositoryInterface;

interface IFoodRepository extends RepositoryInterface
{
    public function searchlistfoodbytext($text, $limit);
    public function selectTop10Food($limit);
    public function updateFoodListToShop($idshop,$comboFoodList);
    public function savelistfoodandcombo($comboFoodList);
    public function getComboAndFoodListFromShop($idshop);
}

