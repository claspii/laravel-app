<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CustomCollection;
use App\Http\Resources\InforShipper\InforShipperResource;
use App\Repositories\InforUser\IInforUserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InforShipperController extends Controller
{
    protected $inforShipperRepo;
    public function __construct(IInforUserRepository $repo)
    {
        $this->inforShipperRepo=$repo;
        $this->authorizeResource(InforShipper::class,'App\Policies\InforShipperPolicy');
    }

    public function index()
    {
        $inforshippers = $this->inforShipperRepo->getAll();
        if ($inforshippers) {
            return new CustomCollection($inforshippers);
        }

        return response()->json([
            'status' => 404,
            'message' => "Empty InforShiper!"
        ], 404);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "id_account" => 'required|exists:account,id',
            "name"=>'required',
            "address"=>'required',

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
            $inforShipper = $this->inforShipperRepo->create([
                'id_account' => $request->id_account,
                'name'=>$request->id_name,
                'address'=>$request->address,
                'img'=>$request->img,
            ]);
            if ($inforShipper) {
                return new InforShipperResource($inforShipper);
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
        $InforShipper = $this->inforShipperRepo->find($id);
        if ($InforShipper) {
            return new InforShipperResource($InforShipper);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Such InforShipper Found!"
            ], 404);
        };
    }





    public function update(Request $request, $id)
    {
        $dataUpdate = [
            'id_account' => $request->id_account,
            'name'=>$request->name,
            'address'=>$request->address,
            'img'=>$request->img,
        ];
       $result=$this->inforShipperRepo->update($id, $dataUpdate);
       if ($result) {
        return new InforShipperResource($result);
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
       $result=$this->inforShipperRepo->delete($id);
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
