<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CustomCollection;
use App\Http\Resources\ReviewFood\ReviewFoodResource;
use App\Repositories\ReviewFood\IReviewFoodRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewFoodController extends Controller
{
    protected $ReviewFoodRepo;
    public function __construct(IReviewFoodRepository $repo)
    {
        $this->ReviewFoodRepo=$repo;
    }

    public function index()
    {
        $reviewFood= $this->ReviewFoodRepo->getAll();
        if ($reviewFood) {
            return new CustomCollection($reviewFood);
        }

        return response()->json([
            'status' => 404,
            'message' => "Empty reviewFood!"
        ], 404);
    }

    public function store(Request $request)
    {
        $this->authorize('create', ReviewFood::class);
        $validator = Validator::make($request->all(), [
            "id_food" => 'required|exists:food,id',
            "id_user"=>'required|exists:account,id',
            "des"=>'required',
            "thoigian"=>"required",
            "star"=>"required",
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
            $ReviewFood = $this->ReviewFoodRepo->create([
                'id_food' => $request->id_food,
                'id_user'=>$request->id_user,
                'des'=>$request->des,
                'thoigian'=>$request->thoigian,
                'star'=>$request->star,
            ]);
            if ($ReviewFood) {
                return new ReviewFoodResource($ReviewFood);
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

    public function show(Request $request, $id)
    {
        $ReviewFood = $this->ReviewFoodRepo->find($id);
        $this->authorize('view', [ReviewFood::class, $ReviewFood]);
        if ($ReviewFood) {
            return new ReviewFoodResource($ReviewFood);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Such Review Found!"
            ], 404);
        };
    }

    public function update(Request $request, $id)
    {
        $dataUpdate = [
            'des'=>$request->des,
            'thoigian'=> $request->thoigian,
            'star'=>$request->star,
        ];
       $result=$this->ReviewFoodRepo->update($id, $dataUpdate);
       if ($result) {
        return new ReviewFoodResource($result);
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
       $result=$this->ReviewFoodRepo->delete($id);
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
