<?php
namespace App\Repositories\CartFood;

use App\Repositories\RepositoryInterface;

interface ICartFoodRepository extends RepositoryInterface
{
    public function addCartFoodtoCart($user_id,$attributes = []);
    public function decreaseFoodtoCart($user_id,$attributes = []);
}