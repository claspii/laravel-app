<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CustomCollection;
use App\Http\Resources\InforShop\InforShopResource;
use App\Repositories\InforShop\IInforShopRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InforShopController extends Controller
{
    protected $inforShopRepo;
    public function __construct(IInforShopRepository $repo)
    {
        $this->inforShopRepo=$repo;
    }

    public function index()
    {
        $inforshopers = $this->inforShopRepo->getAll();
        if ($inforshopers) {
            return new CustomCollection($inforshopers);
        }

        return response()->json([
            'status' => 404,
            'message' => "Empty InforShop!"
        ], 404);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "id_account" => 'required|exists:account,id',
            "name"=>'required',
            "address"=>'required',

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
            $inforShoper = $this->inforShopRepo->create([
                'id_account' => $request->id_food,
                'name'=>$request->id_combo,
                'address'=>$request->address,
                'image'=>$request->image,
            ]);
            if ($inforShoper) {
                return new InforShopResource($inforShoper);
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
        $InforShoper = $this->inforShopRepo->find($id);
        if ($InforShoper) {
            return new InforShopResource($InforShoper);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Such InforShop Found!"
            ], 404);
        };
    }





    public function update(Request $request, $id)
    {
        $dataUpdate = [
            'id_account' => $request->id_food,
            'name'=>$request->id_combo,
            'address'=>$request->address,
            'image'=>$request->image,
        ];
       $result=$this->inforShopRepo->update($id, $dataUpdate);
       if ($result) {
        return new InforShopResource($result);
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
       $result=$this->inforShopRepo->delete($id);
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

    public function selectShopbyNameFood(Request $request){
        $result = $this->inforShopRepo->selectShopBasedOnNameFood($request->name, 10);
        if ($result == null){
            return response()->json([
                'status' => 404,
                'message' => 'No shop exists'
            ], 404);
        }
        else
        {
            return new CustomCollection($result);
        }
    }

    public function selectTopShop(Request $request){
        $result = $this->inforShopRepo->selectTop10Shop(2);
        if ($result == null){
            return response()->json([
                'status' => 404,
                'message' => 'No shop exists'
            ], 404);
        }
        else
        {
            return new CustomCollection($result);
        }
    }
}


