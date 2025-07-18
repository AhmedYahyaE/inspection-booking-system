<?php

use Illuminate\Support\Facades\Route;
use Modules\Teams\Controllers\TeamController;

Route::middleware('auth:sanctum')->prefix('api/v1/teams')->group(function () {
    Route::get('/', [TeamController::class, 'index']);
    Route::post('/', [TeamController::class, 'store']);
    Route::put('{id}', [TeamController::class, 'update']);
    Route::delete('{id}', [TeamController::class, 'destroy']);
    Route::post('{id}/availability', [TeamController::class, 'setAvailability']);
    Route::get('{id}/generate-slots', [TeamController::class, 'generateSlots']);
});
