<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CustomCollection;
use App\Http\Resources\Bill\BillResource;
use App\Repositories\Bill\IBillRepository;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Cart;
use App\Models\FoodBill;
use App\Models\Bill_list;
use App\Models\Bill_list_item;

class BillController extends Controller
{

    public function index()
    {
        $bills = FoodBill::all();
        if ($bills->count() > 0) {
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
            $bill = FoodBill::create([
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
        $Bill = FoodBill::find($id);
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
       $result= FoodBill::where('id', $id)->update($dataUpdate);
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
       $result= FoodBill::destroy($id);
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

    public function saveBill(Request $request)
    {
        $this->authorize('create', Bill::class);
        $cart = Cart::where('id_user', $request->user()->id)->first();
        $cartShops = $cart->CartShop;
        if($cartShops->count() == 0)    
            return response()->json([
                'status' => 404,
                'message' => 'No Food in Cart'
            ], 404);
        $bill = FoodBill::create(['id_user' => $cart->id_user, 'price' => $cart->tongtien, 
        'created_at' => Carbon::now() ,'payment_method' => $request->payment_method == null ? 1 : $request->payment_method]);
        foreach($cartShops as $cartShop)
        {
            $bill_list = Bill_list::create(['id_bill' => $bill->id, 'id_shop' => $cartShop->id_shop
            , 'id_vouncher' => $cartShop->id_vouncher, 'ship_price' => $cartShop->ship_price]);
            $cartFoods = $cartShop->CartFood;
            foreach($cartFoods as $cartFood)
            {
                Bill_list_item::create(['id_listbill' => $bill_list->id, 
                'id_food' => $cartFood->id_food, 'quantity' => $cartFood->quantity]);
                $cartFood->delete();
            }
        }
        if($bill)
        {
            return new BillResource($bill);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Something went wrong'
            ]. 404);
        }
    }
}
