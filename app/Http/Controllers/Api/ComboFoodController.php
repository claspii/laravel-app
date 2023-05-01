<?php

namespace App\Http\Controllers;

use App\Http\Resources\Combo\ComboResource;
use App\Http\Resources\ComboFood\ComboFoodResource;
use App\Http\Resources\CustomCollection;
use App\Repositories\ComboFood\IComboFoodRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComboFoodController extends Controller
{
    protected $comboFoodRepo;
    public function __construct(IComboFoodRepository $repo)
    {
        $this->comboFoodRepo=$repo;
    }

    public function index()
    {
        $comboFoods = $this->comboFoodRepo->getAll();
        if ($comboFoods) {
            return new CustomCollection($comboFoods);
        }

        return response()->json([
            'status' => 404,
            'message' => "Empty Combo!"
        ], 404);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "id_food" => 'required|exists:food,id',
            "id_combo"=>'required|exits:combo,id',
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
            $comboFood = $this->comboFoodRepo->create([
                'id_food' => $request->id_food,
                'id_combo'=>$request->id_combo,
            ]);
            if ($comboFood) {
                return new ComboFoodResource($comboFood);
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
        $comboFood = $this->comboFoodRepo->find($id);
        if ($comboFood) {
            return new ComboFoodResource($comboFood);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Such ComboFood Found!"
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
       $result=$this->comboFoodRepo->update($id, $dataUpdate);
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
       $result=$this->comboFoodRepo->delete($id);
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
