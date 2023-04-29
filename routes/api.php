<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Api\FoodController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/account', 'App\Http\Controllers\Api\AccountController');
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'App\Http\Controllers\Api\AuthController@login');
    Route::post('signup', 'App\Http\Controllers\Api\AuthController@signup');
  
Route::group([
    'middleware' => 'auth:api'
], function() {
    Route::get('logout', 'App\Http\Controllers\Api\AuthController@logout');
    Route::get('user', 'App\Http\Controllers\Api\AuthController@user');
});
});

Route::apiResource('foods',FoodController::class)->missing(function (Request $request) {
    return Redirect::route('foods.index');
});
