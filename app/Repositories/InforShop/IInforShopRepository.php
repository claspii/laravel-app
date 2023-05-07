<?php
namespace App\Repositories\InforShop;

use App\Models\Food;
use App\Models\InforShop;
use App\Models\ReviewFood;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

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

     return  InforShop::join('reviewfood','inforshop.id','=','reviewfood.id_shop')
        ->select('inforshop.id','inforshop.name',
        DB::raw('avg(review.star) as average_rating'))->groupBy('review.id_shop')->orderBy('average_rating','desc')->limit($limit)->get();
    }
    public function selectLatLongBasedOnAddress($address)
    {

    }
}
