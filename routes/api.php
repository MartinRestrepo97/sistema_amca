<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AnimalController;
use App\Http\Controllers\Api\VegetalController;
use App\Http\Controllers\Api\PreparadoController;
use App\Http\Controllers\Api\AgricultorController;
use App\Http\Controllers\Api\FincaController;

Route::middleware('api')->group(function () {
    Route::apiResource('animales', AnimalController::class);
    Route::apiResource('vegetales', VegetalController::class);
    Route::apiResource('preparados', PreparadoController::class);
    Route::apiResource('agricultores', AgricultorController::class);
    Route::apiResource('fincas', FincaController::class);
});
