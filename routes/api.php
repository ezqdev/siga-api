<?php

use App\Http\Controllers\PositionController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/rol',RolController::class);
Route::apiResource('/user',UserController::class);
Route::apiResource('/position',PositionController::class);
Route::apiResource('/space',SpaceController::class);
Route::apiResource('/service',ServiceController::class);
Route::apiResource('/reservation',ReservationController::class);