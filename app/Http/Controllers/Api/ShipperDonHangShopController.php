<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CustomCollection;
use App\Http\Resources\ShipperDonHangShop\ShipperDonHangShopResource;
use App\Repositories\ShipperDonHangShop\IShipperDonHangShopRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShipperDonHangShopController extends Controller
{
    protected $ShipperDonHangShopRepo;
    public function __construct(IShipperDonHangShopRepository $repo)
    {
        $this->ShipperDonHangShopRepo=$repo;
    }

    public function index()
    {
        $shipperDonHang= $this->ShipperDonHangShopRepo->getAll();
        if ($shipperDonHang) {
            return new CustomCollection($shipperDonHang);
        }

        return response()->json([
            'status' => 404,
            'message' => "Empty shipper don hang!"
        ], 404);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "id_user" => 'required|exists:inforuser,id',
            "id_shipper"=>'required|exists:inforshipper,id',
            "id_shop"=>'required|exists:inforshop,id',
            "id_donhang"=>'required|exists:donhang,id'
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
            $ShipperDonHangShop = $this->ShipperDonHangShopRepo->create([
                'id_user'=>$request->id_user,
                'id_shipper'=>$request->id_shipper,
                'id_shop'=>$request->id_shop,
                'id_donhang'=>$request->id_donhang,

            ]);
            if ($ShipperDonHangShop) {
                return new ShipperDonHangShopResource($ShipperDonHangShop);
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
        $ShipperDonHang = $this->ShipperDonHangShopRepo->find($id);
        if ($ShipperDonHang) {
            return new ShipperDonHangShopResource($ShipperDonHang);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Such Shippe Don Hang Found!"
            ], 404);
        };
    }





    public function update(Request $request, $id)
    {
        $dataUpdate = [
            'id_user'=>$request->id_user,
            'id_shipper'=>$request->id_shipper,
            'id_shop'=>$request->id_shop,
            'id_donhang'=>$request->id_donhang,
        ];
       $result=$this->ShipperDonHangShopRepo->update($id, $dataUpdate);
       if ($result) {
        return new ShipperDonHangShopResource($result);
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
       $result=$this->ShipperDonHangShopRepo->delete($id);
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
