<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::post("/shiprocket",[ApiController::class,"check"]);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
