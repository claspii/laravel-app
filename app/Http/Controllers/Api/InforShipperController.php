<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CustomCollection;
use App\Http\Resources\InforShipper\InforShipperResource;
use App\Repositories\InforShipper\IInforShipperRepository;
use App\Http\Controllers\Controller;
use App\Models\InforShipper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InforShipperController extends Controller
{
    protected $inforShipperRepo;
    public function __construct(IInforShipperRepository $repo)
    {
        $this->inforShipperRepo=$repo;
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
        $this->authorize('create', [InforShipper::class, $request->id_account]);
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
                'name'=>$request->name,
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
        $inforShipper = InforShipper::find($id);
        if($inforShipper == null)
        return response()->json([
            'status' => 404,
            'message' => 'Info not found'
        ], 404);
        $this->authorize('update', [InforShipper::class, $inforShipper]);
       $result = $inforShipper->update($request->all());
       if ($result) {
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
