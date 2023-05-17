<?php
namespace App\Repositories\Food;

use App\Repositories\BaseRepository;
use App\Models\Food;
use App\Repositories\Combo\IComboRepository;
use App\Repositories\ComboFood\IComboFoodRepository;
use App\Repositories\InforShop\IInforShopRepository;

class FoodRepository extends BaseRepository implements IFoodRepository
{
    protected $comboRepo;
    protected $comboFoodRepo;
    protected $inforShopRepo;
    public function __construct(IComboRepository $comboRepo,IComboFoodRepository $comboFoodRepo,IInforShopRepository $inforShopRepo){
     $this->comboFoodRepo=$comboFoodRepo;
     $this->comboRepo=$comboRepo;
     $this->inforShopRepo=$inforShopRepo;
     $this->setModel();
    }
    //lấy model tương ứng
    public function getModel()
    {
        return Food::class;
    }

    public function searchlistfoodbytext($text, $limit)
    {
        $listFood = Food::select('name')->where('name', 'like', '%'.$text.'%')->limit($limit)->get();
        return $listFood;
    }
    public function saveFoodListToShop($comboFoodList)
    {
         foreach($comboFoodList as $comboFood)
         {
             $combo=$this->comboRepo->create($comboFood['combo']);
             foreach($comboFood['foods'] as $food)
             {
                $food=$this->model->create($food);
                $this->comboFoodRepo->create(["id_food"=>$food->id,"id_combo"=>$combo->id]);
             }
         }
    }
    public function getComboAndFoodListFromShop($idshop)
    {
        $shop=$this->inforShopRepo->find($idshop);
        $combos=$shop->combo;
        $list=[];
        foreach($combos as $combo)
        {
          $comboFoodStd=new \stdClass();
          $comboFoodStd->combo=$combo;
          $comboFood=$combo->comboFood;
          $comboFoodStd->food=$comboFood->food;
          array_push($list,$comboFood);
        }
        return $list;
    }
    public function updateFoodListToShop($idshop,$comboFoodList)
    {
        $shop=$this->inforShopRepo->find($idshop);
        $comboFoods=$shop->combo->combofood;
        foreach($comboFoods as $comboFood)
        {
            if($comboFood)
            {
                $combo=$comboFood->combo;
                if($combo)
                {
                    $comboFood->combo()->dissociate();
                    $comboFood->save();
                    $combo->delete();
                }
                $food=$comboFood->food;
                if($food)
                {
                    $comboFood->food()->dissociate();
                    $comboFood->save();
                    $food->delete();
                }
            }
        }
        $this->saveFoodListToShop($comboFoodList);
    }
}
