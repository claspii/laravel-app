<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CustomCollection;
use App\Http\Resources\InforUser\InforUserResource;
use App\Repositories\InforUser\IInforUserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\InforUser;
use Illuminate\Support\Facades\Validator;

class InforUserController extends Controller
{
    protected $inforUserRepo;
    public function __construct(IInforUserRepository $repo)
    {
        $this->inforUserRepo=$repo;
    }

    public function index()
    {
        $inforUser= $this->inforUserRepo->getAll();
        if ($inforUser) {
            return new CustomCollection($inforUser);
        }

        return response()->json([
            'status' => 404,
            'message' => "Empty InforUser!"
        ], 404);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id_account" => 'required|exists:account,id',
            "last_name"=>'required',
            "first_name"=>'required',
            "address"=>'required',
            "phone_number"=>"required",
        ]);
        $this->authorize('create', [InforUser::class, $request->id_account]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 442,
                    'errors' => $validator->errors(),
                ],
                442
            );
        } else {
            $InforUser = $this->inforUserRepo->create([
                'id_account' => $request->id_account,
                'last_name'=>$request->last_name,
                'first_name'=>$request->first_name,
                'address'=>$request->address,
                'phone_number'=>$request->phone_number,
                'avatar'=>$request->avatar,
            ]);
            if ($InforUser) {
                return new InforUserResource($InforUser);
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
        $inforUser = $this->inforUserRepo->find($id);
        if ($inforUser) {
            return new InforUserResource($inforUser);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Such inforUser Found!"
            ], 404);
        };
    }





    public function update(Request $request, $id)
    {
        $inforUser = InforUser::find($id);
        if($inforUser == null)
        return response()->json([
            'status' => 404,
            'message' => 'Info not found'
        ], 404);
        $this->authorize('update', [InforUser::class, $inforUser]);
       $result = $inforUser->update($request->all());
       if ($result) {
        return new InforUserResource($inforUser);
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
       $result=$this->inforUserRepo->delete($id);
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
