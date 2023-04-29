<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Food\FoodCollection;
use App\Http\Resources\Food\FoodResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Food\IFoodRepository;



class FoodController extends Controller
{
    protected $foodRepo;
    public function __construct(IFoodRepository $repo){
      $this->foodRepo=$repo;
    }
    public function index()
    {
        $foods=$this->foodRepo->getAll();
        if($foods)
        {
            return new FoodCollection($foods);
        }
        return response()->json([
            'status'=>404,
            'message'=>"Empty Foods!"
          ],404);

    }
    public function show($id)
    {
        $food=$this->foodRepo->find($id);
        if($food)
        {
            return new FoodResource($food);
        }
        return response()->json([
            'status'=>404,
            'message'=>"No Such Food Found!"
          ],404);
    }
    public function store(Request $request)
    {
        $dataInsert=[
         'type'=>$request->type,
         'first_price'=>$request->firstprice,
         'last_price'=>$request->lastprice,
         'name'=>$request->name,
         'id_shop'=>$request->idshop,
        ];
         return $this->foodRepo->create($dataInsert);
    }
    public function update(Request $request)
    {
        $dataUpdate=[
            'food_id'=>$request->id,
            'type'=>$request->type,
            'first_price'=>$request->firstprice,
            'last_price'=>$request->lastprice,
            'name'=>$request->name,
            'id_shop'=>$request->idshop,
        ];
       return $this->foodRepo->update($request->id,$dataUpdate);
    }
    public function destroy(Request $request)
    {
      
    }
}
