<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ApiProductController;
use Illuminate\Support\Facades\Route;

Route::post("/shiprocket",[ApiController::class,"check"]);

Route::get('/product',[ApiProductController::class,"list"]);
Route::get('/product/{id}',[ApiProductController::class,"product"]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
