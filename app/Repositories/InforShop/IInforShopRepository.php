<?php
namespace App\Repositories\InforShop;

use App\Models\Food;
use App\Models\InforShop;
use App\Repositories\BaseRepository;

class InforShopRepository extends BaseRepository implements IInforShopRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        return InforShop::class;
    }
    public function selectShopBasedOnNameFood($name,$limit)
    {
       $listIdShop=Food::select('id_shop')->whereColumn('name',$name)->limit($limit)->get();
       $result=$this->model->whereIn('id',$listIdShop)->limit($limit)->get();
       return $result;
    }
    public function selectShopBasedOnReviewHighest($limit)
    {

    }
    public function selectLatLongBasedOnAddress($address)
    {

    }
}
