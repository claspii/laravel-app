<?php

namespace App\Http\Controllers;

use App\Http\Resources\Food\FoodCollection;
use \App\Http\Resources\Food\FoodResource;
use Illuminate\Http\Request;
use App\Repositories\Food\IFoodRepository;
use Illuminate\Support\Facades\Validator;



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
        $validator = Validator::make($request->all(), [
            "id_shop" => 'required|exists:inforshop,id',

        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 442,
                    'errors' => $validator->errors(),
                ],
                442
            );
        } else {
            $dataInsert=[
                'type'=>$request->type,
                'first_price'=>$request->firstprice,
                'last_price'=>$request->lastprice,
                'name'=>$request->name,
                'id_shop'=>$request->idshop,
               ];
            $donhang = $this->foodRepo->create($dataInsert);
            if ($donhang) {
                return new FoodResource($donhang);
            } else {
                return response()->json(
                    [
                        'status' => 500,
                        'message' => "Some thing went wrong"
                    ],
                    500
                );
            }
        }
    }
    public function update(Request $request,$id)
    {
        $dataUpdate=[
            'food_id'=>$request->id,
            'type'=>$request->type,
            'first_price'=>$request->firstprice,
            'last_price'=>$request->lastprice,
            'name'=>$request->name,
            'id_shop'=>$request->idshop,
        ];
        $result=$this->foodRepo->update($id,$dataUpdate);

       if ($result) {
        return new FoodResource($result);
    } else {
        return response()->json(
            [
                'status' => 500,
                'message' => "Some thing went wrong"
            ],
            500
        );
    }
    }
    public function destroy($id)
    {
        $result=$this->foodRepo->delete($id);
        if($result)
       {
        return response()->json(
            [
                'status' => 200,
                'message' => "Delete sucessfully"
            ],
            200
        );
       }
       return response()->json(
        [
            'status' => 404,
            'message' => "Delete failed"
        ],
        404
    );
    }
}
