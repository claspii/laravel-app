<?php

use App\Http\Controllers\ShipperDonHangShopController;
use App\Http\Controllers\TrangThaiDonHangController;
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

Route::get('/user', 'App\Http\Controllers\Api\AuthController@user')->middleware('auth:api');

// Route::group(['middleware' => ['auth:api', 'role']], function() {
//     Route::apiResource('/account', 'App\Http\Controllers\Api\AccountController');
// });

Route::group(['middleware' => ['auth:api']], function(){
    Route::apiResource('/account', 'App\Http\Controllers\Api\AccountController')->except(['index']);
});

Route::group(['middleware' => ['auth:api']], function(){
    Route::apiResource('/accounts', 'App\Http\Controllers\Api\AccountController');
});

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


Route::group(['middleware' => ['auth:api', 'role:3', 'check_id']], function(){
    Route::apiResource('/vouncher', 'App\Http\Controllers\Api\VouncherController')->except(['index', 'store']);
});

Route::apiResource('foods',FoodController::class)->missing(function (Request $request) {
    return Redirect::route('foods.index');
});


Route::group(['middleware' => ['auth:api']], function(){
    Route::apiResource('/vouncher', 'App\Http\Controllers\Api\VouncherController')->except(['index', 'store']);
});

Route::get('searchFood', 'App\Http\Controllers\Api\FoodController@SearchFoodbytext');

Route::scopeBindings()->group(function(){

    Route::apiResource('account.inforshop',InforShopController::class);

    Route::apiResource('account.inforuser',InforUserController::class);

    Route::apiResource('account.inforshipper',InforShipperController::class);

    Route::apiResource('inforshop.combo',ComboController::class);

    Route::apiResource('combo.combofood',ComboFoodController::class);

    Route::apiResource('donhang',DonHangController::class);

    Route::apiResource('donhang.shipperdonhangshop',ShipperDonHangShopController::class);

    Route::apiResource('inforuser.reviewfood',ReviewFoodController::class);

    // Route::apiResource('inforuser.reviewshipper',ReviewShipper::class);

    Route::apiResource('trangthaidonhang',TrangThaiDonHangController::class);
});



