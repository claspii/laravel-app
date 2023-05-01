<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomCollection;
use App\Http\Resources\TrangThaiDonHang\TrangThaiDonHangResource;
use App\Models\TrangThaiDonHang;
use App\Repositories\TrangThaiDonHang\ITrangThaiDonHangRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrangThaiDonHangController extends Controller
{
    protected $TrangThaiDonHangRepo;
    public function __construct(ITrangThaiDonHangRepository $repo)
    {
        $this->TrangThaiDonHangRepo = $repo;
    }

    public function index()
    {
        $trangthaidonhang = $this->TrangThaiDonHangRepo->getAll();
        if ($trangthaidonhang->count > 0)
            return new CustomCollection($trangthaidonhang);
        else {
            return response()->json([
                'status' => 404,
                'message' => "Empty trang thai don hang!"
            ], 404);
        }
    }

    public function show(TrangThaiDonHang $TrangThaiDonHang)
    {
        $TrangThaiDonHang = $this->TrangThaiDonHangRepo->find($TrangThaiDonHang->id);
        if ($TrangThaiDonHang != null)
        {
            return new TrangThaiDonHangResource($TrangThaiDonHang);
        }

        else {
            return response()->json([
                'status' => 404,
                'message' => "No Such Trang Thai Don Hang Found!"
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
              'des'=>"required"
        ]);

        if ($validator->failed()) {
            return response()->json([
                'status' => 442,
                'errors' => $validator->errors()
            ], 442);
        }

        $dataInsert = [
           "des"=>$request->des
        ];
        $newTrangThaiDonHang = $this->TrangThaiDonHangRepo->create($dataInsert);

        if ($newTrangThaiDonHang) {
            return new TrangThaiDonHangResource($newTrangThaiDonHang);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong'
            ], 500);
        }
    }
    public function update(Request $request, TrangThaiDonHang $vouncher)
    {
        $dataUpdate = [
            'des'=>$request->des
        ];
        $result = $vouncher->update($dataUpdate);
        if ($result) {
            return response()->json([
                'status' => 200,
                'message' => 'Trang Thai Don Hang update successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong'
            ], 500);
        }
    }
    public function destroy(TrangThaiDonHang $TrangThaiDonHang)
    {
        $result = $TrangThaiDonHang->delete();
        if ($result) {
            return response()->json([
                'status' => 200,
                'message' => 'TrangThaiDonHang delete successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'TrangThaiDonHang delete failed'
            ], 404);
        }
}
}
