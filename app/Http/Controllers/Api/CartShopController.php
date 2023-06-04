<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CartShop\CartShopResource;
use App\Http\Resources\CustomCollection;
use App\Http\Resources\Resources\CartResource;
use App\Http\Controllers\Controller;
use App\Models\CartShop;
use App\Repositories\CartShop\ICartShopRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartShopController extends Controller
{
    protected $cartShopRepo;
    public function __construct(ICartShopRepository $repo)
    {
        $this->cartShopRepo = $repo;
    }

    public function index()
    {
        $cartShops = $this->cartShopRepo->getAll();
        if ($cartShops) {
            return new CustomCollection($cartShops);
        }

        return response()->json([
            'status' => 404,
            'message' => "Empty Cart Shop!"
        ], 404);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "id_shop" => 'required|exists:inforshop,id',
            "id_cart" => 'required|exists:cart,id',
            "id_vouncher" => 'required|exists:vouncher,id'
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
            $cartShop = $this->cartShopRepo->create([
                'id_shop' => $request->id_shop,
                'id_cart' => $request->id_cart,
                'id_vouncher' => $request->id_vouncher,
            ]);
            if ($cartShop) {
                return new CartShopResource($cartShop);
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


    public function show($id)
    {
        $cartShop = $this->cartShopRepo->find($id);
        dd($cartShop->ship_price);
        if ($cartShop) {
            return new CartShopResource($cartShop);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Such Cart Shop Found!"
            ], 404);
        };
    }

    public function update(Request $request, $id)
    {
        $cartShop = CartShop::find($id);
        if($cartShop == null)
        return response()->json([
            'status' => 404,
            'message' => 'Cart Shop not found'
        ], 404);
        $this->authorize('update', [CartShop::class, $cartShop]);
        $result=$cartShop->update($request->all());
        if($result)
        {
         return new CartShopResource($cartShop);
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
       $result=$this->cartShopRepo->delete($id);
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
