<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('data')->group(function () {
    Route::get('get/product',[ApiController::class,'getProductlist']);
    Route::get('get/category',[ApiController::class,'getCategory']);

    //data create
    Route::post('create/product',[ApiController::class,'creatProduct']);
    Route::post('create/contact',[ApiController::class,'createContact']);


    //deleted data
    Route::post('delete/contact',[ApiController::class,'delteContact']);
    Route::get('delete/contact/{id}',[ApiController::class,'getdelteContact']);

    //view data
    Route::post('view/product',[ApiController::class,'viewproduct']);
    Route::get('view/product/{id}',[ApiController::class,'getviewproduct']);

    //update data
    Route::post('update/category',[ApiController::class,'updatecategory']);




});
