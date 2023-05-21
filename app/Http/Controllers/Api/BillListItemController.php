<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Bill_list_item\BillListItemResource;
use App\Http\Resources\CustomCollection;
use App\Http\Resources\Resources\CartResource;
use App\Http\Controllers\Controller;
use App\Repositories\Bill_list_item\IBillListItemRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BillListItemController extends Controller
{
    protected $billListItemRepo;
    public function __construct(IBillListItemRepository $repo)
    {
        $this->billListItemRepo = $repo;
    }

    public function index()
    {
        $billListItems = $this->billListItemRepo->getAll();
        if ($billListItems) {
            return new CustomCollection($billListItems);
        }

        return response()->json([
            'status' => 404,
            'message' => 'Empty Bill List!'
        ], 404);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id_listbill' => 'required|exists:bill_list,id',
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
            $billListItem = $this->billListItemRepo->create([
                'id_listbill' => $request->id_listbill,
                'quantity' => $request->quantity,
                'id_food' => $request->id_food,
            ]);
            if ($billListItem) {
                return new BillListItemResource($billListItem);
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
        $billListItem = $this->billListItemRepo->find($id);
        if ($billListItem) {
            return new BillListItemResource($billListItem);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Such Bill list item Found!'
            ], 404);
        };
    }

    public function update(Request $request, $id)
    {
        $dataUpdate = [
            'id_listbill' => $request->id_listbill,
            'quantity' => $request->quantity,
            'id_food' => $request->id_food,
        ];
        $result=$this->billListItemRepo->update($id, $dataUpdate);
        if($result)
        {
         return new BillListItemResource($result);
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
       $result=$this->billListItemRepo->delete($id);
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
}
