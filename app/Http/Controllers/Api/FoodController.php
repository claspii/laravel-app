<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Food\FoodCollection;
use App\Http\Controllers\Controller;
use \App\Http\Resources\Food\FoodResource;
use App\Http\Resources\CustomCollection;
use App\Models\Food;
use Illuminate\Http\Request;
use App\Repositories\Food\IFoodRepository;
use Exception;
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
        $this->authorize('create', Food::class);
        $validator = Validator::make($request->all(), [
            "id_shop" => 'required|exists:inforshop,id_account',

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
                'first_price'=>$request->first_price,
                'last_price'=>$request->last_price,
                'name'=>$request->name,
                'id_shop'=>$request->id_shop,
                'image' => $request->image
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
    public function update(Request $request, $id)
    {
        $food = Food::find($id);
        if($food == null)
        return response()->json([
            'status' => 404,
            'message' => 'Food not found'
        ], 404);
        $this->authorize('update', [Food::class, $food]);
        $result = $food->update($request->all());
        if($result)
        {
         return new FoodResource($food);
        }
        else{
             return response()->json(
            [
                'status' => 404,
                'message' => "Update failed"
            ],
            404);
        }
    }
    public function destroy($id)
    {
        $food = Food::find($id);
        if($food == null)
        return response()->json([
            'status' => 404,
            'message' => 'Food not found'
        ], 404);
        $this->authorize('delete', [Food::class, $food]);
        $result= $food->delete();
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

    public function SearchFoodbytext(Request $request){
        $result = $this->foodRepo->searchlistfoodbytext($request->text, 5);
        if($result == null)
        {
            return response()->json([
                'status' => 404,
                'message' => 'No such food found'
            ], 404);
        }
        return $result;
    }
    public function getComboAndFoodListFromShop(Request $request){
     $result=$this->foodRepo->getComboAndFoodListFromShop($request->id_shop);
     if($result == null)
     {
         return response()->json([
             'status' => 404,
             'message' => 'Shop do not have list food'
         ], 404);
     }
     return $result;
    }
    public function updateFoodListToShop(Request $request)
    {
        try{
            $this->foodRepo->updateFoodListToShop($request->id_shop,$request->comboFoodList);
            return response()->json([
                'status' => 200,
                'message' => 'Update success'
            ], 200);
        }catch(Exception $e)
         {
            return response()->json([
                'status' => 404,
                'message' => 'update fail'
            ], 404);
         }
    }
    public function savelistfoodandcombo(Request $request)
    {
        try{
            $this->foodRepo->savelistfoodandcombo($request->comboFoodList);
            return response()->json([
                'status' => 200,
                'message' => 'save success'
            ], 200);
        }catch(Exception $e)
         {
            return response()->json([
                'status' => 404,
                'message' => 'save fail'
            ], 404);
         }

    }
    public function selectTopFood(Request $request)
    {
        $result = $this->foodRepo->selectTop10Food(3);
        if ($result == null){
            return response()->json([
                'status' => 404,
                'message' => 'No food exists'
            ], 404);
        }
        else
        {
            return new CustomCollection($result);
        }  
    }
}
