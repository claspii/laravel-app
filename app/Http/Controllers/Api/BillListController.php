<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Bill_list\BillListResource;
use App\Http\Resources\CustomCollection;
use App\Http\Resources\Resources\CartResource;
use App\Http\Controllers\Controller;
use App\Repositories\Bill_list\IBillListRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BillListController extends Controller
{
    protected $billListRepo;
    public function __construct(IBillListRepository $repo)
    {
        $this->billListRepo = $repo;
    }

    public function index()
    {
        $billLists = $this->billListRepo->getAll();
        if ($billLists) {
            return new CustomCollection($billLists);
        }

        return response()->json([
            'status' => 404,
            'message' => "Empty Bill List!"
        ], 404);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "id_shop" => 'required|exists:inforshop,id',
            "id_bill" => 'required|exists:bill,id',
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
            $billList = $this->billListRepo->create([
                'id_shop' => $request->id_shop,
                'id_bill' => $request->id_bill,
                'id_vouncher' => $request->id_vouncher,
            ]);
            if ($billList) {
                return new BillListResource($billList);
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
        $billList = $this->billListRepo->find($id);
        if ($billList) {
            return new BillListResource($billList);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Such Bill List Found!"
            ], 404);
        };
    }

    public function update(Request $request, $id)
    {
        $dataUpdate = [
            'id_shop' => $request->id_shop,
            'id_bill' => $request->id_bill,
            'id_vouncher' => $request->id_vouncher,
        ];
        $result=$this->billListRepo->update($id, $dataUpdate);
        if($result)
        {
         return new BillListResource($result);
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
       $result=$this->billListRepo->delete($id);
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
