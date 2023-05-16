<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CartFood\CartFoodResource;
use App\Http\Resources\CustomCollection;
use App\Http\Resources\Resources\CartResource;
use App\Http\Controllers\Controller;
use App\Repositories\CartFood\ICartFoodRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartFoodController extends Controller
{
    protected $cartFoodRepo;
    public function __construct(ICartFoodRepository $repo)
    {
        $this->cartFoodRepo = $repo;
    }

    public function index()
    {
        $cartFoods = $this->cartFoodRepo->getAll();
        if ($cartFoods) {
            return new CustomCollection($cartFoods);
        }

        return response()->json([
            'status' => 404,
            'message' => 'Empty Cart Food!'
        ], 404);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id_cartshop' => 'required|exists:cartshop,id',
            'quantity' => 'required',
            'id_food' => 'required|exists:food,id',
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
            $cartFood = $this->cartFoodRepo->create([
                'id_cartshop' => $request->id_cartshop,
                'quantity' => $request->quantity,
                'id_food' => $request->id_food,
            ]);
            if ($cartFood) {
                return new CartFoodResource($cartFood);
            } else {
                return response()->json(
                    [
                        'status' => 500,
                        'message' => 'Some thing went wrong'
                    ],
                    500
                );
            }
        }
    }


    public function show($id)
    {
        $cartFood = $this->cartFoodRepo->find($id);
        if ($cartFood) {
            return new CartFoodResource($cartFood);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Such Cart Food Found!'
            ], 404);
        };
    }

    public function update(Request $request, $id)
    {
        $dataUpdate = [
            'id_cartshop' => $request->id_cartshop,
            'quantity' => $request->quantity,
            'id_food' => $request->id_food,
        ];
        $result=$this->cartFoodRepo->update($id, $dataUpdate);
        if($result)
        {
         return new CartFoodResource($result);
        }
        else{
             return response()->json(
            [
                'status' => 404,
                'message' => 'Update failed'
            ],
            404);
        }
    }


    public function destroy($id)
    {
       $result=$this->cartFoodRepo->delete($id);
       if($result)
       {
        return response()->json(
            [
                'status' => 200,
                'message' => 'Delete sucessfully'
            ],
            200
        );
       }
       return response()->json(
        [
            'status' => 404,
            'message' => 'Delete failed'
        ],
        404
    );
    }

    public function addFoodtoCart(Request $request)
    {
        $result = $this->cartFoodRepo->addCartFoodtoCart(auth()->id(), ['id_food' => $request->id_food, 
                'id_vouncher' => $request->id_vouncher, 'quantity' => $request->quantity]);

        
        if($result)
        {
            return new CartFoodResource($result);
        }
        else{
                return response()->json(
            [
                'status' => 404,
                'message' => 'Add failed'
            ],
            404);
        }
    }

    public function decreaseFoodtoCart(Request $request)
    {
        $result = $this->cartFoodRepo->decreaseFoodtoCart(auth()->id(), ['id_food' => $request->id_food]);
        
        if($result)
        {
            return new CartFoodResource($result);
        }
        else{
                return response()->json(
            [
                'status' => 404,
                'message' => 'Decrease failed'
            ],
            404);
        }
    }
}
