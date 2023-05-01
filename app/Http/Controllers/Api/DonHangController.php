<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomCollection;
use App\Http\Resources\DonHang\DonHangResource;
use App\Repositories\DonHang\IDonHangRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DonHangController extends Controller
{
    protected $donhangRepo;
    public function __construct(IDonHangRepository $repo)
    {
        $this->donhangRepo=$repo;
    }

    public function index()
    {
        $donhangs = $this->donhangRepo->getAll();
        if ($donhangs) {
            return new CustomCollection($donhangs);
        }

        return response()->json([
            'status' => 404,
            'message' => "Empty Don Hang!"
        ], 404);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "id_trangthai" => 'required|exists:trangthaidonhang,id',

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
            $donhang = $this->donhangRepo->create([
                'id_trangthai' => $request->id_trangthai,
                'tongtien'=>$request->tongtien,
            ]);
            if ($donhang) {
                return new DonHangResource($donhang);
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
        $DonHang = $this->donhangRepo->find($id);
        if ($DonHang) {
            return new DonHangResource($DonHang);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Such Don Hang Found!"
            ], 404);
        };
    }





    public function update(Request $request, $id)
    {
        $dataUpdate = [
            'id_trangthai' => $request->id_trangthai,
            'tongtien' => $request->tongtien,
        ];
       $result=$this->donhangRepo->update($id, $dataUpdate);
       if ($result) {
        return new DonHangResource($result);
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
       $result=$this->donhangRepo->delete($id);
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
