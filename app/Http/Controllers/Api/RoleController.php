<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomCollection;
use App\Http\Resources\Role\RoleResource;
use App\Repositories\Role\IRoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    protected $RoleRepo;
    public function __construct(IRoleRepository $repo)
    {
        $this->RoleRepo=$repo;
    }

    public function index()
    {
        $roles= $this->RoleRepo->getAll();
        if ($roles) {
            return new CustomCollection($roles);
        }

        return response()->json([
            'status' => 404,
            'message' => "Empty role!"
        ], 404);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "name" => 'required',
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
            $role = $this->RoleRepo->create([
                'name' => $request->name,

            ]);
            if ($role) {
                return new RoleResource($role);
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
        $Role = $this->RoleRepo->find($id);
        if ($Role) {
            return new RoleResource($Role);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Such Role Found!"
            ], 404);
        };
    }





    public function update(Request $request, $id)
    {
        $dataUpdate = [
            'name' => $request->name,
        ];
       $result=$this->RoleRepo->update($id, $dataUpdate);
       if ($result) {
        return new RoleResource($result);
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
       $result=$this->RoleRepo->delete($id);
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
