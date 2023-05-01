<?php

namespace App\Http\Controllers;

use App\Http\Resources\Combo\ComboResource;
use App\Http\Resources\CustomCollection;
use App\Repositories\Combo\IComboRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComboController extends Controller
{
    protected $comboRepo;
    public function __construct(IComboRepository $repo)
    {
        $this->comboRepo=$repo;
    }

    public function index()
    {
        $combos = $this->comboRepo->getAll();
        if ($combos) {
            return new CustomCollection($combos);
        }

        return response()->json([
            'status' => 404,
            'message' => "Empty Combo!"
        ], 404);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "id_shop" => 'required|exists:inforshop,id',
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
            $combo = $this->comboRepo->create([
                'id_shop' => $request->id,
                'des'=>$request->des,
            ]);
            if ($combo) {
                return new ComboResource($combo);
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
        $combo = $this->comboRepo->find($id);
        if ($combo) {
            return new ComboResource($combo);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Such combo Found!"
            ], 404);
        };
    }





    public function update(Request $request, $id)
    {
        $dataUpdate = [
            'id_shop' => $request->id,
            'id_cart' => $request->id_cart,
            'id_vouncher' => $request->id_vouncher,
            'id_food' => $request->id_food,
        ];
       $result=$this->comboRepo->update($id, $dataUpdate);
       if ($result) {
        return new ComboResource($result);
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
       $result=$this->comboRepo->delete($id);
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
