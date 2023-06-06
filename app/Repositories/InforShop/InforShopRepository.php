<?php
namespace App\Repositories\InforShop;

use App\Models\Food;
use App\Models\InforShop;
use App\Models\ReviewFood;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use stdClass;

class InforShopRepository extends BaseRepository implements IInforShopRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        return InforShop::class;
    }
    public function selectShopBasedOnNameFood($name, $limit)
    {
       $listIdShop=Food::select('id_shop')->where('name', 'like', '%'.$name.'%')->limit($limit)->get()->toArray();
       $result=$this->model->whereIn('id_account',$listIdShop)->limit($limit)->get();
       $shopfoods = [];
       foreach($result as $shop){
            $obj = new stdClass();
            $foodFilter = $shop->foods->filter(function ($food) use ($name) { return strpos($food->name, $name) !== false; });
            $filter = [];
            foreach($foodFilter as $food)
            {
                array_push($filter, $food);
            }
            $obj->foodFilter = $filter;
            $obj->shop = $shop->setRelation('foods', null);
            array_push($shopfoods, $obj);
       }
       return $shopfoods;
    }
    public function selectShopBasedOnReviewHighest($name, $limit)
    {

        $listIdShop=Food::select('id_shop')->where('name', 'like', '%'.$name.'%')->limit($limit)->get()->toArray();

        $result=$this->model->whereIn('id_account',$listIdShop)->orderBy('star', 'desc')->limit($limit)->get();
        $shopfoods = [];
        foreach($result as $shop){
             $obj = new stdClass();
             $foodFilter = $shop->foods->filter(function ($food) use ($name) { return strpos($food->name, $name) !== false; });
             $obj->foodFilter = $foodFilter;
             $obj->shop = $shop;
             array_push($shopfoods, $obj);
        }
        return $shopfoods;
    }

    public function selectTop10Shop($limit)
    {
        $listIdTopShop=$this->model->select('id')->orderBy('star', 'desc')->limit($limit)->get()->toArray();
        $result = $this->model->whereIn('id', $listIdTopShop)->get();
        return $result;
    }

    public function selectLatLongBasedOnAddress($address)
    {

    }
}
