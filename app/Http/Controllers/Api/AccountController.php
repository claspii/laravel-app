<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Resources\Account\AccountResource;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $account = Account::all();
        return AccountResource::collection($account);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $account = Account::create($request->all());

        return new AccountResource($account);
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        return new AccountResource($account);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $account)
    {
        return $account->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        $account->delete();
    }
}
