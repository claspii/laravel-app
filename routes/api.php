<?php

use App\Http\Controllers\Api\AccountController; 
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\BillController;
use App\Http\Controllers\Api\CartShopController;
use App\Http\Controllers\ShipperDonHangShopController;
use App\Http\Controllers\TrangThaiDonHangController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Api\FoodController;
use App\Http\Controllers\Api\ReviewFoodController;
use App\Http\Controllers\Api\InforUserController;
use App\Http\Controllers\Api\InforShopController;
use App\Http\Controllers\Api\InforShipperController;

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
Route::get('/info', 'App\Http\Controllers\Api\AuthController@info')->middleware('auth:api');

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

Route::post('savelistfood','App\Http\Controllers\Api\FoodController@savelistfoodandcombo');



// Route::apiResource('foods',FoodController::class)->missing(function (Request $request) {
//     return Redirect::route('foods.index');
// });


Route::group(['middleware' => ['auth:api']], function(){
    Route::apiResource('/vouncher', 'App\Http\Controllers\Api\VouncherController')->except(['index', 'store']);
    Route::post('savefoods','App\Http\Controllers\Api\FoodController@savelistfoodandcombo');


});

Route::put('updatefoods','App\Http\Controllers\Api\FoodController@updateFoodListToShop');

Route::get('searchFood', 'App\Http\Controllers\Api\FoodController@SearchFoodbytext');

Route::get('searchshopbynamefood', 'App\Http\Controllers\Api\InforShopController@selectShopbyNameFood');

Route::get('showTopShop', 'App\Http\Controllers\Api\InforShopController@selectTopShop');

Route::get('showTopFood', 'App\Http\Controllers\Api\FoodController@selectTopFood');

Route::post('addFood', 'App\Http\Controllers\Api\CartFoodController@addFoodtoCart')->middleware('auth:id');

Route::post('decreaseFood', 'App\Http\Controllers\Api\CartFoodController@decreaseFoodtoCart')->middleware('auth:id');

Route::post('deleteFood', 'App\Http\Controllers\Api\CartFoodController@deleteFoodInCart')->middleware('auth:id');


Route::apiResource('account', AccountController::class)->except(['index', 'show']);



Route::apiResource('food', FoodController::class);

Route::apiResource('cartshop', CartShopController::class);

Route::apiResource('inforshipper',InforShipperController::class);

Route::apiResource('inforuser', InforUserController::class);

Route::apiResource('inforshop',InforShopController::class);

Route::apiResource('donhang.shipperdonhangshop',ShipperDonHangShopController::class);

Route::apiResource('reviewfood', 'App\Http\Controllers\Api\ReviewFoodController');

// Route::apiResource('inforuser.reviewshipper',ReviewShipper::class);

Route::apiResource('trangthaidonhang',TrangThaiDonHangController::class);


Route::get('getfoods','App\Http\Controllers\Api\FoodController@getComboAndFoodListFromShop');

Route::get('inforRestaurant', 'App\Http\Controllers\Api\FoodController@inforRestaurant');

Route::post('savebill', 'App\Http\Controllers\Api\BillController@savebill');

Route::get('cartinfo', 'App\Http\Controllers\Api\CartController@infocart');
