<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomCollection;
use App\Http\Resources\Vouncher\VouncherResource;
use App\Models\Vouncher;
use App\Repositories\Vouncher\IVouncherRepository;
use Illuminate\Support\Facades\Validator;

class VouncherController extends Controller
{
    protected $vouncherRepo;
    public function __construct(IVouncherRepository $repo)
    {
        $this->vouncherRepo = $repo;
    }

    public function index()
    {
        $vouncher = $this->vouncherRepo->getAll();
        if ($vouncher->count > 0)
            return new CustomCollection($vouncher);
        else {
            return response()->json([
                'status' => 404,
                'message' => "Empty Vounchers!"
            ], 404);
        }
    }

    public function show(Vouncher $vouncher)
    {
        $vouncher = $this->vouncherRepo->find($vouncher->id);
        if ($vouncher != null)
        {
            return new VouncherResource($vouncher);
        }
            
        else {
            return response()->json([
                'status' => 404,
                'message' => "No Such Vouncher Found!"
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id_shop" => 'required',
            "value" => 'required',
            "number_of_vouncher" => 'required'
        ]);

        if ($validator->failed()) {
            return response()->json([
                'status' => 442,
                'errors' => $validator->errors()
            ], 442);
        }

        $dataInsert = [
            'id' => $request->id,
            'id_shop' => $request->id_shop,
            'value' => $request->value,
            'number_of_vouncher' => $request->number_of_vouncher
        ];
        $newvouncher = $this->vouncherRepo->create($dataInsert);

        if ($newvouncher) {
            return new VouncherResource($newvouncher);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong'
            ], 500);
        }
    }
    public function update(Request $request, Vouncher $vouncher)
    {
        $dataUpdate = [
            'id' => $request->id,
            'id_shop' => $request->id_shop,
            'value' => $request->value,
            'number_of_vouncher' => $request->number_of_vouncher
        ];
        $result = $vouncher->update($dataUpdate);
        if ($result) {
            return response()->json([
                'status' => 200,
                'message' => 'Vouncher update successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong'
            ], 500);
        }
    }
    public function destroy(Vouncher $vouncher)
    {
        $result = $vouncher->delete();
        if ($result) {
            return response()->json([
                'status' => 200,
                'message' => 'Vouncher delete successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Vouncher delete failed'
            ], 404);
        }
    }
}
