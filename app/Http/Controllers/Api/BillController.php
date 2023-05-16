<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CustomCollection;
use App\Http\Resources\Bill\BillResource;
use App\Repositories\Bill\IBillRepository;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BillController extends Controller
{
    protected $billRepo;
    public function __construct(IBillRepository $repo)
    {
        $this->billRepo=$repo;
        $this->authorizeResource(Bill::class,'App\Policies\BillPolicy');
    }

    public function index()
    {
        $bills = $this->billRepo->getAll();
        if ($bills) {
            return new CustomCollection($bills);
        }

        return response()->json([
            'status' => 404,
            'message' => 'Empty Bill!'
        ], 404);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id_state' => 'required|exists:trangthaidonhang,id',
            'price' => 'required',
            'id_user' => 'required|exists:inforuser,id_account',
            'payment_method' => 'required'
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
            $bill = $this->billRepo->create([
                'id_state' => $request->id_state,
                'price' => $request->price,
                'id_user' => $request->id_user,
                'payment_method' => $request->payment_method,
                'created_at' => Carbon::now()
            ]);
            if ($bill) {
                return new BillResource($bill);
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
        $Bill = $this->billRepo->find($id);
        if ($Bill) {
            return new BillResource($Bill);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Such Bill Found!'
            ], 404);
        };
    }

    public function update(Request $request, $id)
    {
        $dataUpdate = [
            'id_state' => $request->id_state,
            'price' => $request->price,
            'id_user' => $request->id_user,
            'payment_method' => $request->payment_method,
            'created_at' => Carbon::now()
        ];
       $result=$this->billRepo->update($id, $dataUpdate);
       if ($result) {
        return new BillResource($result);
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
       $result=$this->billRepo->delete($id);
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
