<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CustomCollection;
use App\Http\Controllers\Controller;
use App\Http\Resources\Resources\CartResource;


use App\Repositories\CartFood\ICartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CartController extends Controller
{
    protected $cartRepo;
    public function __construct(ICartRepository $repo)
    {
        $this->cartRepo = $repo;
    }

    public function index()
    {
        $carts = $this->cartRepo->getAll();
        if ($carts) {
            return new CustomCollection($carts);
        }

        return response()->json([
            'status' => 404,
            'message' => "Empty Cart!"
        ], 404);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "id_user" => 'required|exists:inforuser,id',

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
            $cart = $this->cartRepo->create([
                'id_user' => $request->id,
            ]);
            if($cart)
            {
                return new CartResource($cart);
            }
            else{
                return response()->json(
                    [
                        'status' => 500,
                        'message' => "Some thing went wrong"
                    ],
                    500);
            }
        }
    }


    public function show($id)
    {
        $cart = $this->cartRepo->find($id);
        if ($cart) {
            return new CartResource($cart);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Such Cart Found!"
            ], 404);
        };
    }





    public function update(Request $request,$id)
    {
        $dataUpdate=[
            'id_user' => $request->id_user,
        ];
       $result= $this->cartRepo->update($id,$dataUpdate);
       if ($result) {
        return new CartResource($result);
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

        $result=$this->cartRepo->delete($id);
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
