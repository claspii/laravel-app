<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CustomCollection;
use App\Http\Controllers\Controller;
use App\Http\Resources\Cart\CartResource;
use App\Repositories\Cart\ICartRepository;
use Illuminate\Http\Request;
use App\Models\Cart;
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
        $carts = Cart::All();
        if ($carts) {
            return new CustomCollection($carts);
        }

        return response()->json([
            'status' => 404,
            'message' => 'Empty Cart!'
        ], 404);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id_user' => 'required|exists:inforuser,id_account',

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
            $cart = Cart::create([
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
                        'message' => 'Some thing went wrong'
                    ],
                    500);
            }
        }
    }


    public function show($id)
    {
        $cart = Cart::find($id);
        if ($cart) {
            return new CartResource($cart);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Such Cart Found!'
            ], 404);
        };
    }

    public function update(Request $request,$id)
    {
        $dataUpdate=[
            'id_user' => $request->id_user,
        ];
       $result= Cart::where('id', $id)->update($dataUpdate);
       if ($result) {
        return new CartResource($result);
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


    public function destroy($id)
    {

        $result=Cart::destroy($id);
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

    public function infocart(Request $request)
    {
        $this->authorize('create', Cart::class);
        $result = $this->cartRepo->getInfoCart($request->user()->id);
        if($result)
        {
            return response()->json([
                'cart' => $result
            ], 200);
        }
        else 
        {
            return response()->json([
                'status' => 404,
                'message' => 'Cart is Empty'
            ], 404);
        }
    }
}
